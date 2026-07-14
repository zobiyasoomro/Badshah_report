<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'name',
        'email',
        'image',
        'password',
        'whatsapp_number',
        'city',
        'register_account',
        'unregister_account',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'register_account' => 'boolean',
            'unregister_account' => 'boolean',
        ];
    }

    /**
     * Get user's avatar URL
     */
    public function getAvatarAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }

    /**
     * Get user's initials from name
     */
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

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->user_name === 'betproadmin';
    }

    /**
     * Check if user is registered
     */
    public function isRegistered()
    {
        return $this->register_account == 1;
    }

    /**
     * Check if user is unregistered
     */
    public function isUnregistered()
    {
        return $this->unregister_account == 1;
    }
}