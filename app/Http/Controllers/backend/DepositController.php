<?php
// app/Http/Controllers/Backend/DepositController.php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DepositController extends Controller
{
    // Store deposit request - WITH PROPER ERROR HANDLING
    public function store(Request $request)
    {
        try {
            // Check if user is authenticated
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login first.'
                ], 401);
            }

            // Get the payment method
            $paymentMethod = PaymentMethod::find($request->payment_method_id);
            if (!$paymentMethod) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid payment method selected.'
                ], 404);
            }

            // Base validation rules
            $rules = [
                'account_holder_name' => 'required|string|max:255',
                'user_account_number' => 'nullable|string|max:255',
                'amount' => 'required|numeric|min:50',
                'payment_method_id' => 'required|exists:payment_methods,id',
                'transaction_id' => 'nullable|string|max:255',
                'transaction_id_receipt' => 'nullable|string|max:255',
                'screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'receipt' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:5120',
                'bank_name' => 'nullable|string|max:255',
                'account_number' => 'nullable|string|max:255',
                'branch_code' => 'nullable|string|max:255',
            ];

            // Add bank-specific validation for required fields
            if ($paymentMethod->type === 'bank') {
                $rules['bank_name'] = 'required|string|max:255';
                $rules['account_number'] = 'required|string|max:255';
                $rules['transaction_id'] = 'required|string|max:255';
                $rules['screenshot'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $validated = $validator->validated();

            // Handle Screenshot Upload (for Bank Transfers)
            $screenshotPath = null;
            if ($request->hasFile('screenshot')) {
                try {
                    $file = $request->file('screenshot');
                    $filename = 'screenshot_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    if (!file_exists(public_path('deposits'))) {
                        mkdir(public_path('deposits'), 0777, true);
                    }

                    $file->move(public_path('deposits'), $filename);
                    $screenshotPath = 'deposits/' . $filename;
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to upload screenshot: ' . $e->getMessage()
                    ], 500);
                }
            }

            // Handle Receipt Upload (for Mobile Wallets)
            $receiptPath = null;
            if ($request->hasFile('receipt')) {
                try {
                    $file = $request->file('receipt');
                    $filename = 'receipt_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    if (!file_exists(public_path('deposits/'))) {
                        mkdir(public_path('deposits/'), 0777, true);
                    }

                    $file->move(public_path('deposits/'), $filename);
                    $receiptPath = 'deposits/' . $filename;
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to upload receipt: ' . $e->getMessage()
                    ], 500);
                }
            }

            // Determine transaction ID
            $transactionId = $validated['transaction_id_receipt'] ?? $validated['transaction_id'] ?? null;

            if (empty($transactionId)) {
                $transactionId = 'TXN' . time() . rand(1000, 9999);
            } else {
                $existing = Deposit::where('transaction_id', $transactionId)->first();
                if ($existing) {
                    $transactionId = $transactionId . rand(10, 99);
                }
            }

            $expiresAt = Carbon::now()->addHours(24);

            // Prepare deposit data
            $depositData = [
                'user_id' => $user->id,
                'payment_method_id' => $validated['payment_method_id'],
                'account_holder_name' => $validated['account_holder_name'],
                'user_account_number' => $validated['user_account_number'] ?? null,
                'amount' => $validated['amount'],
                'payment_method' => $paymentMethod->type,
                'bank_name' => $request->bank_name ?? $paymentMethod->name,
                'account_number' => $paymentMethod->account_number,
                'branch_code' => $request->branch_code ?? null,
                'transaction_id' => $transactionId,
                'screenshot_path' => $screenshotPath,
                'receipt_path' => $receiptPath,
                'is_receipt_required' => $paymentMethod->type === 'mobile_wallet' ? true : false,
                'expires_at' => $expiresAt,
                'status' => 'pending',
            ];

            $deposit = Deposit::create($depositData);

            // Generate deep link if mobile wallet
            $deepLink = null;
            if ($paymentMethod->type === 'mobile_wallet') {
                try {
                    $deepLink = $paymentMethod->generateDeepLink($validated['amount'], $transactionId);
                } catch (\Exception $e) {
                    // Deep link generation failed but deposit is created
                    $deepLink = null;
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Deposit request submitted successfully!',
                'deposit' => $deposit,
                'deep_link' => $deepLink,
                'payment_method' => [
                    'name' => $paymentMethod->name,
                    'account_number' => $paymentMethod->account_number,
                    'account_holder_name' => $paymentMethod->account_holder_name,
                    'account_iban' => $paymentMethod->account_iban,
                ]
            ]);

        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Deposit database error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Database error: Failed to save deposit.'
            ], 500);
        } catch (\Exception $e) {
            \Log::error('Deposit error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Submit receipt after payment - WITH PROPER ERROR HANDLING
    public function submitReceipt(Request $request, $id)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login first.'
                ], 401);
            }

            $deposit = Deposit::find($id);
            if (!$deposit) {
                return response()->json([
                    'success' => false,
                    'message' => 'Deposit not found.'
                ], 404);
            }

            if ($deposit->user_id !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access.'
                ], 403);
            }

            if ($deposit->receipt_submitted_at) {
                return response()->json([
                    'success' => false,
                    'message' => 'Receipt already submitted.'
                ], 400);
            }

            if ($deposit->isExpired()) {
                $deposit->status = 'expired';
                $deposit->save();
                return response()->json([
                    'success' => false,
                    'message' => 'This deposit request has expired.'
                ], 400);
            }

            $validator = Validator::make($request->all(), [
                'receipt' => 'required|image|mimes:jpeg,png,jpg,gif,pdf|max:5120',
                'transaction_id_receipt' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            if ($request->hasFile('receipt')) {
                try {
                    $file = $request->file('receipt');
                    $filename = 'receipt_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    if (!file_exists(public_path('deposits/'))) {
                        mkdir(public_path('deposits/'), 0777, true);
                    }

                    $file->move(public_path('deposits/'), $filename);
                    $receiptPath = 'deposits/' . $filename;

                    $deposit->receipt_path = $receiptPath;
                    $deposit->receipt_submitted_at = now();
                    $deposit->is_receipt_required = false;

                    if ($request->has('transaction_id_receipt') && !empty($request->transaction_id_receipt)) {
                        $existing = Deposit::where('transaction_id', $request->transaction_id_receipt)
                            ->where('id', '!=', $deposit->id)
                            ->first();
                        if (!$existing) {
                            $deposit->transaction_id = $request->transaction_id_receipt;
                        }
                    }

                    $deposit->save();

                    return response()->json([
                        'success' => true,
                        'message' => 'Receipt submitted successfully! Please wait for admin verification.',
                        'deposit' => $deposit
                    ]);

                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to upload receipt: ' . $e->getMessage()
                    ], 500);
                }
            }

            return response()->json([
                'success' => false,
                'message' => 'No receipt file found.'
            ], 400);

        } catch (\Exception $e) {
            \Log::error('Submit receipt error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Check if user has pending receipt
    public function checkPendingReceipt()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login first.'
                ], 401);
            }

            $deposit = Deposit::where('user_id', $user->id)
                ->where('status', 'pending')
                ->where('is_receipt_required', true)
                ->whereNull('receipt_submitted_at')
                ->where(function ($q) {
                    $q->whereNull('expires_at')
                        ->orWhere('expires_at', '>', now());
                })
                ->latest()
                ->first();

            if ($deposit) {
                $remainingTime = $deposit->expires_at ? $deposit->expires_at->diffInMinutes(now()) : null;
                return response()->json([
                    'requires_receipt' => true,
                    'deposit' => $deposit,
                    'remaining_time' => $remainingTime,
                    'expires_at' => $deposit->expires_at,
                ]);
            }

            return response()->json(['requires_receipt' => false]);

        } catch (\Exception $e) {
            \Log::error('Check pending receipt error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error'
            ], 500);
        }
    }

    // Get user's deposits

    public function getUserDeposits()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login first.'
                ], 401);
            }

            $deposits = Deposit::with('paymentMethod')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($deposit) {
                    return [
                        'id' => $deposit->id,
                        'amount' => $deposit->amount,
                        'status' => $deposit->status,
                        'payment_method' => $deposit->paymentMethod->name ?? $deposit->bank_name ?? 'N/A',
                        'transaction_id' => $deposit->transaction_id ?? 'N/A',  // <-- ADD THIS
                        'account_holder_name' => $deposit->account_holder_name,
                        'user_account_number' => $deposit->user_account_number,
                        'bank_name' => $deposit->bank_name,
                        'account_number' => $deposit->account_number,
                        'branch_code' => $deposit->branch_code,
                        'image_url' => $deposit->image_url,
                        'image_type' => $deposit->image_type,
                        'has_image' => $deposit->hasImage(),
                        'created_at' => $deposit->created_at,
                    ];
                });

            return response()->json([
                'success' => true,
                'deposits' => $deposits
            ]);

        } catch (\Exception $e) {
            \Log::error('Get user deposits error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch deposits'
            ], 500);
        }
    }
    // Get all active payment methods
    public function getPaymentMethods()
    {
        try {
            $methods = PaymentMethod::active()
                ->orderBy('sort_order')
                ->get()
                ->map(function ($method) {
                    return [
                        'id' => $method->id,
                        'name' => $method->name,
                        'type' => $method->type,
                        'account_holder_name' => $method->account_holder_name,
                        'account_number' => $method->account_number,
                        'account_iban' => $method->account_iban,
                        'branch_code' => $method->branch_code,
                        'logo_url' => $method->logo_url,
                        'deep_link_scheme' => $method->deep_link_scheme,
                        'is_mobile_wallet' => $method->type === 'mobile_wallet',
                    ];
                });

            return response()->json([
                'success' => true,
                'methods' => $methods
            ]);

        } catch (\Exception $e) {
            \Log::error('Get payment methods error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch payment methods'
            ], 500);
        }
    }

    // Admin: Get all deposits
    // Admin: Get all deposits
    public function index()
    {
        try {
            $deposits = Deposit::with(['user', 'paymentMethod'])
                ->orderBy('created_at', 'desc')
                ->get();

            // Updated to match your file path: admin/pages/deposits/index.blade.php
            return view('admin.pages.deposits.index', compact('deposits'));
        } catch (\Exception $e) {
            \Log::error('Admin deposits index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load deposits');
        }
    }

    // Admin: Get all deposits (JSON for API)
    public function getAdminDeposits()
    {
        try {
            $deposits = Deposit::with(['user', 'paymentMethod'])
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($deposit) {
                    return [
                        'id' => $deposit->id,
                        'amount' => $deposit->amount,
                        'status' => $deposit->status,
                        'payment_method' => $deposit->paymentMethod->name ?? $deposit->bank_name ?? 'N/A',
                        'transaction_id' => $deposit->transaction_id ?? 'N/A',
                        'account_holder_name' => $deposit->account_holder_name,
                        'user_account_number' => $deposit->user_account_number,
                        'bank_name' => $deposit->bank_name,
                        'account_number' => $deposit->account_number,
                        'branch_code' => $deposit->branch_code,
                        'image_url' => $deposit->image_url,
                        'image_type' => $deposit->image_type,
                        'has_image' => $deposit->hasImage(),
                        'created_at' => $deposit->created_at,
                    ];
                });

            return response()->json([
                'success' => true,
                'deposits' => $deposits
            ]);
        } catch (\Exception $e) {
            \Log::error('Get admin deposits error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch deposits'
            ], 500);
        }
    }

    // Admin: Update deposit status
    public function updateStatus(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required|in:approved,declined',
                'admin_notes' => 'nullable|string|max:1000',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $deposit = Deposit::find($id);
            if (!$deposit) {
                return response()->json([
                    'success' => false,
                    'message' => 'Deposit not found.'
                ], 404);
            }

            $deposit->status = $request->status;
            $deposit->admin_notes = $request->admin_notes ?? null;

            if ($request->status === 'approved') {
                $deposit->approved_at = now();
                $deposit->is_receipt_required = false;
            } else {
                $deposit->declined_at = now();
            }

            $deposit->save();

            return response()->json([
                'success' => true,
                'message' => 'Deposit status updated successfully!',
                'deposit' => $deposit
            ]);

        } catch (\Exception $e) {
            \Log::error('Update deposit status error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }

    // Admin: Get single deposit details
    public function show($id)
    {
        try {
            $deposit = Deposit::with(['user', 'paymentMethod'])->find($id);
            if (!$deposit) {
                return response()->json([
                    'success' => false,
                    'message' => 'Deposit not found.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'deposit' => $deposit
            ]);

        } catch (\Exception $e) {
            \Log::error('Show deposit error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch deposit details'
            ], 500);
        }
    }

    // Get deposit statistics
    public function statistics()
    {
        try {
            $stats = [
                'total' => Deposit::count(),
                'pending' => Deposit::pending()->count(),
                'approved' => Deposit::approved()->count(),
                'declined' => Deposit::declined()->count(),
                'expired' => Deposit::expired()->count(),
                'needs_receipt' => Deposit::needsReceipt()->count(),
                'total_amount' => Deposit::approved()->sum('amount'),
            ];

            return response()->json($stats);

        } catch (\Exception $e) {
            \Log::error('Deposit statistics error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch statistics'
            ], 500);
        }
    }
}