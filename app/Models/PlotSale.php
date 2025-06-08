<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlotSale extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'plot_id', 'customer_id', 'agent_id', 'sale_number', 'sale_date',
        'sale_price', 'discount', 'total_amount', 'paid_amount', 'due_amount',
        'payment_type', 'installment_period', 'down_payment', 'payment_status',
        'sale_status', 'contract_number', 'contract_date', 'handover_date',
        'commission_rate', 'commission_amount', 'terms_conditions', 'remarks'
    ];

    protected $casts = [
        'sale_date' => 'date',
        'contract_date' => 'date',
        'handover_date' => 'date',
        'sale_price' => 'decimal:2',
        'discount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'due_amount' => 'decimal:2',
        'down_payment' => 'decimal:2',
        'commission_rate' => 'decimal:2',
        'commission_amount' => 'decimal:2',
    ];

    public function plot()
    {
        return $this->belongsTo(Plot::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

}
