<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'property_type',
        'title',
        'description',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'location',
        'bedrooms',
        'bathrooms',
        'area',
        'price',
        'year_built',
        'features',
        'owner_name',
        'owner_email',
        'owner_phone',
        'preferred_contact',
        'additional_info',
        'status',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:2',
        'area' => 'decimal:2'
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }
}
