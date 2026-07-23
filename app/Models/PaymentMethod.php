<?php
// app/Models/PaymentMethod.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'account_holder_name',
        'account_number',
        'account_iban',
        'branch_code',
        'logo_path',
        'deep_link_scheme',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeMobileWallets($query)
    {
        return $query->where('type', 'mobile_wallet');
    }

    public function scopeBanks($query)
    {
        return $query->where('type', 'bank');
    }

    public function getLogoUrlAttribute()
    {
        if ($this->logo_path && file_exists(public_path($this->logo_path))) {
            return asset($this->logo_path);
        }
        return null;
    }

    public function generateDeepLink($amount, $transactionId = null)
    {
        if (!$this->deep_link_scheme) {
            return null;
        }

        if ($this->type === 'mobile_wallet') {
            if (strpos($this->deep_link_scheme, 'easypaisa') !== false) {
                return $this->deep_link_scheme . 'sendmoney?phonenumber=' . $this->account_number . '&amount=' . $amount;
            }
            if (strpos($this->deep_link_scheme, 'jazzcash') !== false) {
                return $this->deep_link_scheme . 'sendmoney?mobile=' . $this->account_number . '&amount=' . $amount;
            }
            return $this->deep_link_scheme . 'sendmoney?phonenumber=' . $this->account_number . '&amount=' . $amount;
        }

        return null;
    }
}