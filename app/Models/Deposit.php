<?php
// app/Models/Deposit.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_method_id',
        'account_holder_name',
        'user_account_number',
        'amount',
        'payment_method',
        'bank_name',
        'account_number',
        'branch_code',
        'transaction_id',
        'screenshot_path',
        'receipt_path',
        'receipt_submitted_at',
        'expires_at',
        'is_receipt_required',
        'status',
        'admin_notes',
        'approved_at',
        'declined_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'approved_at' => 'datetime',
        'declined_at' => 'datetime',
        'receipt_submitted_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_receipt_required' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    // ============================================================
    // HELPER METHODS FOR IMAGES
    // ============================================================
    
    /**
     * Get the image path (whichever exists)
     */
    public function getImagePathAttribute()
    {
        return $this->screenshot_path ?? $this->receipt_path;
    }

    /**
     * Get the image URL (whichever exists)
     */
    public function getImageUrlAttribute()
    {
        $path = $this->getImagePathAttribute();
        return $path ? asset($path) : null;
    }

    /**
     * Get screenshot URL
     */
    public function getScreenshotUrlAttribute()
    {
        return $this->screenshot_path ? asset($this->screenshot_path) : null;
    }

    /**
     * Get receipt URL
     */
    public function getReceiptUrlAttribute()
    {
        return $this->receipt_path ? asset($this->receipt_path) : null;
    }

    /**
     * Check if deposit has any image
     */
    public function hasImage()
    {
        return !is_null($this->screenshot_path) || !is_null($this->receipt_path);
    }

    /**
     * Get the image type (screenshot or receipt)
     */
    public function getImageTypeAttribute()
    {
        if ($this->screenshot_path) {
            return 'screenshot';
        }
        if ($this->receipt_path) {
            return 'receipt';
        }
        return null;
    }

    // ============================================================
    // SCOPES
    // ============================================================

    public function scopeNeedsReceipt($query)
    {
        return $query->where('status', 'pending')
            ->where('is_receipt_required', true)
            ->whereNull('receipt_submitted_at')
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'pending')
            ->where('is_receipt_required', true)
            ->whereNull('receipt_submitted_at')
            ->where('expires_at', '<', now());
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeDeclined($query)
    {
        return $query->where('status', 'declined');
    }

    public function isReceiptRequired()
    {
        return $this->is_receipt_required && $this->status === 'pending' && !$this->receipt_submitted_at;
    }

    public function isExpired()
    {
        return $this->expires_at && $this->expires_at < now();
    }
}