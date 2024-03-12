<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPack extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'agio',
        'ceiling',
        'user_id',
    ];

    // Relation with the user owning this subscription pack
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
