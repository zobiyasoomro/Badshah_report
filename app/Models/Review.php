<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rating',
        'description',
        'image',
        'status'
    ];

    // Get the image URL - FIXED to use public_path
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            // Check if file exists in public/reviews directory
            if (file_exists(public_path('reviews/' . $this->image))) {
                return asset('reviews/' . $this->image);
            }
        }
        return null;
    }

    // Get rating as stars
    public function getStarsAttribute()
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    // Get initials from name
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

    // Scope for approved reviews
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    // Scope for pending reviews
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}