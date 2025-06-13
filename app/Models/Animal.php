<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'breed',
        'description',
        'gender',
        'age',
        'status',
        'image_path',
        'location',
        'color'
    ];

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function fosters()
    {
        return $this->hasMany(FosterHome::class);
    }

    public function adoptions()
    {
        return $this->hasMany(Adoption::class);
    }

    public function getImageAttribute()
    {
        return $this->image_path;
    }
}