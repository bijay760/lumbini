<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LandParcel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'description', 'district', 'municipality', 'ward_no',
        'kitta_no', 'dhoor', 'location', 'map_coordinates', 'total_area',
        'area_unit', 'government_value', 'market_value', 'thali_amount',
        'purchase_date', 'purchase_price', 'purchase_from', 'has_loan',
        'loan_amount', 'loan_institution', 'government_tax',
        'non_government_charges', 'tax_remarks', 'registration_number',
        'land_type', 'ownership_type', 'is_subdivided', 'total_plots',
        'area_used', 'remarks', 'is_approved','available_area'
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'total_area' => 'decimal:2',
        'available_area' => 'decimal:2',
        'government_value' => 'decimal:2',
        'market_value' => 'decimal:2',
        'thali_amount' => 'decimal:2',
        'purchase_price' => 'decimal:2',
        'loan_amount' => 'decimal:2',
        'government_tax' => 'decimal:2',
        'non_government_charges' => 'decimal:2',
        'area_used' => 'decimal:2',
        'has_loan' => 'boolean',
        'is_subdivided' => 'boolean',
        'is_approved' => 'boolean',
    ];

    // Relationships
    public function taxDetails()
    {
        return $this->hasMany(LandTaxDetail::class);
    }

    public function plots()
    {
        return $this->hasMany(Plot::class);
    }

    public function subdivisions()
    {
        return $this->hasMany(PlotSubdivision::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    // Accessors
    public function getAvailableAreaAttribute()
    {
        return $this->total_area - $this->area_used;
    }

    public function getTotalChargesAttribute()
    {
        return $this->government_tax + $this->non_government_charges;
    }

    public function getFullLocationAttribute()
    {
        return "{$this->district}, {$this->municipality}, Ward {$this->ward_no}, Kitta {$this->kitta_no}";
    }
}

class LandTaxDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'land_parcel_id', 'tax_name', 'amount', 'category', 'description'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function landParcel()
    {
        return $this->belongsTo(LandParcel::class);
    }
}
