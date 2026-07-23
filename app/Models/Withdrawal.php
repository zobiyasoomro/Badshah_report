<?php
// app/Models/Withdrawal.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_method_id',
        'user_name',
        'full_name',
        'email',
        'whatsapp_number',
        'account_holder_name',
        'account_number',
        'amount',
        'payment_method',
        'bank_name',
        'iban_number',
        'card_number',
        'branch_code',
        'status',
        'admin_notes',
        'approved_at',
        'declined_at',
        'completed_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'approved_at' => 'datetime',
        'declined_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    // Scopes
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

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Helper methods
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isDeclined()
    {
        return $this->status === 'declined';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    // Get the display status with badge
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'warning',
            'approved' => 'info',
            'declined' => 'danger',
            'completed' => 'success',
        ];
        return $badges[$this->status] ?? 'secondary';
    }

    // Get the status text
    public function getStatusTextAttribute()
    {
        return ucfirst($this->status);
    }
}