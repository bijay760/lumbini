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
        'latitude',
        'longitude',
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
        'user_agent',
        'featured_image_id'
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:2',
        'area' => 'decimal:2'
    ];

    // Relationships
    public function images()
    {
        return $this->hasMany(PropertyImage::class)->orderBy('order');
    }

    public function featuredImage()
    {
        return $this->belongsTo(PropertyImage::class, 'featured_image_id');
    }

    // Helper methods
    public function setFeaturedImage(PropertyImage $image)
    {
        $this->featured_image_id = $image->id;
        $this->save();

        // Ensure only one featured image
        PropertyImage::where('property_id', $this->id)
            ->where('id', '!=', $image->id)
            ->update(['is_featured' => false]);

        $image->is_featured = true;
        $image->save();
    }
}
