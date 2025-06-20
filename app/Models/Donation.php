<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'payment_method',
        'payment_type',
        'payment_provider',
        'virtual_account',
        'qr_code',
        'payment_expiry',
        'status',
        'transaction_id'
    ];

    protected $dates = [
        'payment_expiry'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 