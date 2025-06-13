<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pet_name',
        'pet_breed',
        'pet_location',
        'pet_age',
        'pet_color',
        'pet_gender',
        'pet_description',
        'pet_image',
        'pet_category',
        'full_name',
        'age',
        'address',
        'house_type',
        'daily_activity',
        'reason',
        'status',
        'submitted_at',
        'approved_at',
        'admin_notes'
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'approved_at' => 'datetime',
        'age' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function getFormattedSubmittedAtAttribute()
    {
        return $this->submitted_at ? $this->submitted_at->format('d M Y') : $this->created_at->format('d M Y');
    }

    public function getFormattedApprovedAtAttribute()
    {
        return $this->approved_at ? $this->approved_at->format('d M Y') : '-';
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="badge badge-warning">Menunggu</span>',
            'approved' => '<span class="badge badge-success">Disetujui</span>',
            'rejected' => '<span class="badge badge-danger">Ditolak</span>',
            default => '<span class="badge badge-secondary">Unknown</span>'
        };
    }

    public function approve()
    {
        $this->update([
            'status' => 'approved',
            'approved_at' => now()
        ]);
    }

    public function reject($notes = null)
    {
        $this->update([
            'status' => 'rejected',
            'admin_notes' => $notes
        ]);
    }
}
