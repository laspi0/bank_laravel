<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'account_number',
        'branch_number',
        'function',
        'address',
        'first_name',
        'last_name',
        'phone',
        'national_id',
        'email',
        'password',
        'account_type',
        'account_status',
        'profile_type',
        'balance',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
