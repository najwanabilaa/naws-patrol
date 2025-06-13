<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FosterRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'animal_id',
        'duration',
        'location',
        'notes',
        'commitments',
        'status',
        'submitted_at',
        'approved_at',
        'admin_notes'
    ];

    protected $casts = [
        'commitments' => 'array',
        'submitted_at' => 'datetime',
        'approved_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
