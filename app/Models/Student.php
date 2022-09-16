<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use Notifiable;
    use HasFactory;

    protected $casts = [
        'active' => 'boolean',
        'complete' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verification_token',
    ];

    public function scopeActive($query) {
        return $query->where('active', true);
    }

    public function scopeComplete($query) {
        return $query->where('complete', true);
    }

    protected function password(): Attribute {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }
}
