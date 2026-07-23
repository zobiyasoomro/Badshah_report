<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_name',
        'name',
        'email',
        'image',
        'password',
        'whatsapp_number',
        'city',
        'address',
        'state',
        'country',
        'linkedin_url',
        'instagram_url',
        'twitter_url',
        'facebook_url',
        'register_account',
        'unregister_account',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            // REMOVE password hashing cast
            // 'password' => 'hashed',
            'register_account' => 'boolean',
            'unregister_account' => 'boolean',
        ];
    }

    public function getAvatarAttribute()
    {
        if ($this->image) {
            return asset('users/' . $this->image);
        }
        return null;
    }

    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->name);
        $initials = '';
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper($word[0]);
            }
        }
        return substr($initials, 0, 2);
    }

    public function isAdmin()
    {
        return $this->user_name === 'betproadmin';
    }

    public function isRegistered()
    {
        return $this->register_account == 1;
    }

    public function isUnregistered()
    {
        return $this->unregister_account == 1;
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
}