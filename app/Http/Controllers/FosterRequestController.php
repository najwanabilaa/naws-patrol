<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
    
    public function getFormattedSubmittedAtAttribute()
    {
        return $this->submitted_at ? $this->submitted_at->format('d M Y') : $this->created_at->format('d M Y');
    }

    public function getFormattedApprovedAtAttribute()
    {
        return $this->approved_at ? $this->approved_at->format('d M Y') : '-';
    }

    public function getCommitmentsStringAttribute()
    {
        return $this->commitments ? implode(', ', $this->commitments) : '-';
    }
}
