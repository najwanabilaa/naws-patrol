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
        'image_path'
    ];

    public function fosters()
    {
        return $this->hasMany(Foster::class);
    }
} 