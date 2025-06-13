<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FosterHome extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'animal_types',
        'capacity',
        'experience',
        'status',
        'approved_at'
    ];

    protected $casts = [
        'animal_types' => 'array',
        'approved_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fosterRequests(): HasMany
    {
        return $this->hasMany(FosterRequest::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function getFormattedApprovedAtAttribute()
    {
        return $this->approved_at ? $this->approved_at->format('d M Y') : '-';
    }

    public function getAnimalTypesStringAttribute()
    {
        return $this->animal_types ? implode(', ', $this->animal_types) : '-';
    }
}
