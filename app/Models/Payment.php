<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'plot_sale_id', 'received_by', 'payment_number', 'payment_date',
        'amount', 'payment_method', 'bank_name', 'branch_name',
        'account_number', 'cheque_number', 'cheque_date', 'transaction_id',
        'installment_number', 'due_date', 'status', 'verification_date',
        'verified_by', 'remarks'
    ];

    protected $casts = [
        'payment_date' => 'date',
        'cheque_date' => 'date',
        'due_date' => 'date',
        'verification_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function sale()
    {
        return $this->belongsTo(PlotSale::class, 'plot_sale_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
