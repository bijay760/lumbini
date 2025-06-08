<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plot extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'land_parcel_id', 'parent_plot_id', 'plot_number', 'area',
        'dimensions', 'facing_direction', 'status', 'price_per_unit',
        'total_price', 'is_subdividable', 'is_subdivided', 'features', 'remarks'
    ];

    protected $casts = [
        'area' => 'decimal:2',
        'price_per_unit' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function landParcel()
    {
        return $this->belongsTo(LandParcel::class);
    }

    public function parentPlot()
    {
        return $this->belongsTo(Plot::class, 'parent_plot_id');
    }

    public function childPlots()
    {
        return $this->hasMany(Plot::class, 'parent_plot_id');
    }

    public function subdivision()
    {
        return $this->belongsTo(PlotSubdivision::class, 'subdivision_id');
    }

    public function sales()
    {
        return $this->hasMany(PlotSale::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function activeSale()
    {
        return $this->hasOne(PlotSale::class)->whereNotIn('sale_status', ['cancelled']);
    }
}
