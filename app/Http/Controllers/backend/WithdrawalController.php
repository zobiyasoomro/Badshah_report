<?php
// app/Http/Controllers/Backend/WithdrawalController.php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class WithdrawalController extends Controller
{
    // Store withdrawal request
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

            // Validation rules
            $rules = [
                'account_holder_name' => 'required|string|max:255',
                'amount' => 'required|numeric|min:100',
                'payment_method_id' => 'required|exists:payment_methods,id',
                'account_number' => 'nullable|string|max:255',
                'bank_name' => 'nullable|string|max:255',
                'iban_number' => 'nullable|string|max:255',
                'card_number' => 'nullable|string|max:255',
                'branch_code' => 'nullable|string|max:255',
            ];

            // Add bank-specific validation
            if ($paymentMethod->type === 'bank') {
                $rules['bank_name'] = 'required|string|max:255';
                $rules['iban_number'] = 'required|string|max:255';
                $rules['account_holder_name'] = 'required|string|max:255';
            }

            // Add mobile wallet validation
            if ($paymentMethod->type === 'mobile_wallet') {
                $rules['account_number'] = 'required|string|min:11|max:20';
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

            // Prepare withdrawal data
            $withdrawalData = [
                'user_id' => $user->id,
                'payment_method_id' => $validated['payment_method_id'],
                'user_name' => $user->user_name,
                'full_name' => $user->name,
                'email' => $user->email,
                'whatsapp_number' => $user->whatsapp_number,
                'account_holder_name' => $validated['account_holder_name'],
                'account_number' => $validated['account_number'] ?? null,
                'amount' => $validated['amount'],
                'payment_method' => $paymentMethod->type,
                'bank_name' => $request->bank_name ?? null,
                'iban_number' => $request->iban_number ?? null,
                'card_number' => $request->card_number ?? null,
                'branch_code' => $request->branch_code ?? null,
                'status' => 'pending',
            ];

            $withdrawal = Withdrawal::create($withdrawalData);

            return response()->json([
                'success' => true,
                'message' => 'Withdrawal request submitted successfully! Please wait for admin approval.',
                'withdrawal' => $withdrawal,
                'payment_method' => [
                    'name' => $paymentMethod->name,
                    'type' => $paymentMethod->type,
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Withdrawal error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Get user's withdrawals

    public function getUserWithdrawals()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login first.'
                ], 401);
            }

            $withdrawals = Withdrawal::with('paymentMethod')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($withdrawal) {
                    return [
                        'id' => $withdrawal->id,
                        'amount' => $withdrawal->amount,
                        'status' => $withdrawal->status,
                        'payment_method' => $withdrawal->paymentMethod->name ?? $withdrawal->payment_method ?? 'N/A',
                        'account_holder_name' => $withdrawal->account_holder_name,
                        'account_number' => $withdrawal->account_number,
                        'bank_name' => $withdrawal->bank_name,
                        'iban_number' => $withdrawal->iban_number,
                        'card_number' => $withdrawal->card_number,
                        'branch_code' => $withdrawal->branch_code,
                        'created_at' => $withdrawal->created_at,
                    ];
                });

            return response()->json([
                'success' => true,
                'withdrawals' => $withdrawals
            ]);
        } catch (\Exception $e) {
            \Log::error('Get user withdrawals error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch withdrawals'
            ], 500);
        }
    }


    // Get withdrawal statistics
    public function statistics()
    {
        try {
            $stats = [
                'total' => Withdrawal::count(),
                'pending' => Withdrawal::pending()->count(),
                'approved' => Withdrawal::approved()->count(),
                'declined' => Withdrawal::declined()->count(),
                'completed' => Withdrawal::completed()->count(),
                'total_amount' => Withdrawal::approved()->sum('amount'),
                'pending_amount' => Withdrawal::pending()->sum('amount'),
            ];

            return response()->json($stats);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch statistics'
            ], 500);
        }
    }

    // Admin: Get all withdrawals (JSON for API)
    public function getAdminWithdrawals()
    {
        try {
            $withdrawals = Withdrawal::with(['user', 'paymentMethod'])
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($withdrawal) {
                    return [
                        'id' => $withdrawal->id,
                        'amount' => $withdrawal->amount,
                        'status' => $withdrawal->status,
                        'payment_method' => $withdrawal->paymentMethod->name ?? $withdrawal->payment_method ?? 'N/A',
                        'account_holder_name' => $withdrawal->account_holder_name,
                        'account_number' => $withdrawal->account_number,
                        'bank_name' => $withdrawal->bank_name,
                        'iban_number' => $withdrawal->iban_number,
                        'card_number' => $withdrawal->card_number,
                        'branch_code' => $withdrawal->branch_code,
                        'user' => [
                            'name' => $withdrawal->user->name ?? 'N/A',
                            'user_name' => $withdrawal->user->user_name ?? 'N/A',
                            'email' => $withdrawal->user->email ?? 'N/A',
                        ],
                        'created_at' => $withdrawal->created_at,
                    ];
                });

            return response()->json([
                'success' => true,
                'withdrawals' => $withdrawals
            ]);
        } catch (\Exception $e) {
            \Log::error('Get admin withdrawals error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch withdrawals'
            ], 500);
        }
    }
    // Admin: Get all withdrawals
    public function index()
    {
        try {
            $withdrawals = Withdrawal::with(['user', 'paymentMethod'])
                ->orderBy('created_at', 'desc')
                ->get();

            // Updated to match your file path: admin/pages/withdrawals/index.blade.php
            return view('admin.pages.withdrawals.index', compact('withdrawals'));
        } catch (\Exception $e) {
            \Log::error('Admin withdrawals index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load withdrawals');
        }
    }

    // Admin: Get single withdrawal details// Admin: Get single withdrawal details
    public function show($id)
    {
        try {
            $withdrawal = Withdrawal::with(['user', 'paymentMethod'])->find($id);
            if (!$withdrawal) {
                return response()->json([
                    'success' => false,
                    'message' => 'Withdrawal not found.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'withdrawal' => $withdrawal
            ]);
        } catch (\Exception $e) {
            \Log::error('Show withdrawal error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch withdrawal details'
            ], 500);
        }
    }
    // Admin: Update withdrawal status
    // Admin: Update withdrawal status
    public function updateStatus(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|in:pending,approved,declined,completed',
                'admin_notes' => 'nullable|string|max:1000',
            ]);

            $withdrawal = Withdrawal::find($id);
            if (!$withdrawal) {
                return response()->json([
                    'success' => false,
                    'message' => 'Withdrawal not found.'
                ], 404);
            }

            $withdrawal->status = $validated['status'];
            $withdrawal->admin_notes = $validated['admin_notes'] ?? $withdrawal->admin_notes;

            if ($validated['status'] === 'approved') {
                $withdrawal->approved_at = now();
                $withdrawal->declined_at = null;
                $withdrawal->completed_at = null;
            } elseif ($validated['status'] === 'declined') {
                $withdrawal->declined_at = now();
                $withdrawal->approved_at = null;
                $withdrawal->completed_at = null;
            } elseif ($validated['status'] === 'completed') {
                $withdrawal->completed_at = now();
                $withdrawal->approved_at = null;
                $withdrawal->declined_at = null;
            } elseif ($validated['status'] === 'pending') {
                $withdrawal->approved_at = null;
                $withdrawal->declined_at = null;
                $withdrawal->completed_at = null;
            }

            $withdrawal->save();

            return response()->json([
                'success' => true,
                'message' => 'Withdrawal status updated successfully!',
                'withdrawal' => $withdrawal
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Update withdrawal status error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }

    // Get pending withdrawals count for admin
    public function pendingCount()
    {
        try {
            $count = Withdrawal::pending()->count();
            return response()->json(['pending_count' => $count]);
        } catch (\Exception $e) {
            return response()->json(['pending_count' => 0]);
        }
    }
}