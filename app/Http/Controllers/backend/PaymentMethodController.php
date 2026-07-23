<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the payment methods.
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::orderBy('sort_order')->get();
        return view('admin.pages.accounts.index', compact('paymentMethods'));
    }

    /**
     * Show the form for creating a new payment method.
     */
    public function create()
    {
        return view('admin.pages.accounts.create');
    }

    /**
     * Store a newly created payment method in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:mobile_wallet,bank',
            'account_holder_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_iban' => 'nullable|string|max:255',
            'branch_code' => 'nullable|string|max:50',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deep_link_scheme' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->all();
        
        // Handle logo upload to accounts_logo directory
        if ($request->hasFile('logo_path')) {
            $logoFile = $request->file('logo_path');
            $logoName = time() . '_' . $logoFile->getClientOriginalName();
            $logoFile->move(public_path('accounts_logo'), $logoName);
            $data['logo_path'] = 'accounts_logo/' . $logoName;
        }

        // Set default values
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['sort_order'] = $request->sort_order ?? PaymentMethod::max('sort_order') + 1;

        PaymentMethod::create($data);

        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Payment method created successfully!');
    }

    /**
     * Show the form for editing the specified payment method.
     */
    public function edit($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        return view('admin.pages.accounts.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified payment method in storage.
     */
    public function update(Request $request, $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:mobile_wallet,bank',
            'account_holder_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_iban' => 'nullable|string|max:255',
            'branch_code' => 'nullable|string|max:50',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deep_link_scheme' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->all();

        // Handle logo upload to accounts_logo directory
        if ($request->hasFile('logo_path')) {
            // Delete old logo if exists
            if ($paymentMethod->logo_path && file_exists(public_path($paymentMethod->logo_path))) {
                unlink(public_path($paymentMethod->logo_path));
            }
            
            $logoFile = $request->file('logo_path');
            $logoName = time() . '_' . $logoFile->getClientOriginalName();
            $logoFile->move(public_path('accounts_logo'), $logoName);
            $data['logo_path'] = 'accounts_logo/' . $logoName;
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $paymentMethod->update($data);

        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Payment method updated successfully!');
    }

    /**
     * Remove the specified payment method from storage.
     */
    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        
        // Delete logo if exists
        if ($paymentMethod->logo_path && file_exists(public_path($paymentMethod->logo_path))) {
            unlink(public_path($paymentMethod->logo_path));
        }
        
        $paymentMethod->delete();

        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Payment method deleted successfully!');
    }
}