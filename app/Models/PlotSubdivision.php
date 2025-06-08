<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlotSubdivision extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'land_parcel_id',
        'parent_plot_id',
        'subdivision_reference',
        'subdivision_date',
        'survey_details',
        'approval_number',
        'approval_date',
        'remarks'
    ];

    protected $casts = [
        'subdivision_date' => 'date',
        'approval_date' => 'date',
    ];

    /**
     * Relationships
     */
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
        return $this->hasMany(Plot::class, 'subdivision_id');
    }

    /**
     * Accessors
     */
    public function getTotalPlotsAttribute()
    {
        return $this->childPlots()->count();
    }

    public function getTotalAreaAttribute()
    {
        return $this->childPlots()->sum('area');
    }

    /**
     * Scopes
     */
    public function scopeApproved($query)
    {
        return $query->whereNotNull('approval_number');
    }

    public function scopePendingApproval($query)
    {
        return $query->whereNull('approval_number');
    }

    /**
     * Business Logic
     */
    public function approve($approvalNumber, $approvalDate = null)
    {
        $this->update([
            'approval_number' => $approvalNumber,
            'approval_date' => $approvalDate ?? now(),
        ]);

        return $this;
    }
}
