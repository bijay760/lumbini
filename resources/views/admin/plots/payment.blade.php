@extends('admin.layouts.app')
@section('title', 'Add Payment | Lumbini Innovate')
@section('content')
<div class="container-fluid py-3">
    <div class="mb-3 card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-muted" style="font-size: 12px;">
                <a href="{{route('admin.plots')}}" class="text-decoration-none text-muted">Plots</a> / Add Payment
            </h4>
            <a href="{{route('admin.plots')}}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.plots.payment.store', ['id' => $plot->id]) }}" enctype="multipart/form-data">
        @csrf

        <!-- Sale Information -->
        <div class="card shadow-sm mb-3">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0"><i class="fas fa-info-circle"></i> Sale Information</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <strong>Plot Title:</strong> {{ $plot->title }}
                    </div>
                    <div class="col-md-2">
                        <strong>Plot Number:</strong> {{ $plot->plot_number }}
                    </div>
                    <div class="col-md-3">
                        <strong>Customer:</strong> {{ $sale->customer_name }}
                    </div>
                    <div class="col-md-2">
                        <strong>Sale Price:</strong> <span class="text-primary">Rs. {{ number_format($sale->sale_price, 2) }}</span>
                    </div>
                    <div class="col-md-2">
                        <strong>Sale Date:</strong> {{ \Carbon\Carbon::parse($sale->sale_date)->format('Y-m-d') }}
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="alert alert-success mb-0">
                            <strong>Paid Amount:</strong> Rs. {{ number_format($sale->paid_amount, 2) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-danger mb-0">
                            <strong>Due Amount:</strong> Rs. {{ number_format($sale->due_amount, 2) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-warning mb-0">
                            <strong>Status:</strong> {{ ucfirst($sale->payment_status) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Details -->
        <div class="card shadow-sm mb-3">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0"><i class="fas fa-money-bill-wave"></i> New Payment</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label>Payment Date *</label>
                            <input type="date" class="form-control" name="payment_date" value="{{ old('payment_date', date('Y-m-d')) }}" required>
                            @error('payment_date')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label>Amount (Rs.) *</label>
                            <input type="number" step="0.01" class="form-control" name="amount" id="payment_amount" value="{{ old('amount') }}" max="{{ $sale->due_amount }}" required>
                            <small class="text-muted">Max: Rs. {{ number_format($sale->due_amount, 2) }}</small>
                            @error('amount')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label>Payment Method *</label>
                            <select class="form-control" name="payment_method" required>
                                <option value="">Select Method</option>
                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="cheque" {{ old('payment_method') == 'cheque' ? 'selected' : '' }}>Cheque</option>
                                <option value="online" {{ old('payment_method') == 'online' ? 'selected' : '' }}>Online Payment</option>
                            </select>
                            @error('payment_method')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label>Transaction Reference</label>
                            <input type="text" class="form-control" name="transaction_reference" value="{{ old('transaction_reference') }}" placeholder="Check/Txn ID">
                            @error('transaction_reference')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group mb-3">
                            <label>Remarks</label>
                            <textarea class="form-control" name="remarks" rows="2">{{ old('remarks') }}</textarea>
                            @error('remarks')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label>Receipt/Document</label>
                            <input type="file" class="form-control" name="document" accept="image/*,.pdf,.doc,.docx">
                            @error('document')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment History -->
        @if($payments->count() > 0)
        <div class="card shadow-sm mb-3">
            <div class="card-header bg-secondary text-white">
                <h6 class="mb-0"><i class="fas fa-history"></i> Payment History</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr class="table-light">
                                <th>SN</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Reference</th>
                                <th>Remarks</th>
                                <th>Receipt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $index => $payment)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') }}</td>
                                <td><strong>Rs. {{ number_format($payment->amount, 2) }}</strong></td>
                                <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
                                <td>{{ $payment->transaction_reference ?? '-' }}</td>
                                <td>{{ $payment->remarks ?? '-' }}</td>
                                <td class="text-center">
                                    @if($payment->document_path)
                                    <a href="{{ asset($payment->document_path) }}" target="_blank" class="btn btn-xs btn-outline-primary">
                                        <i class="fas fa-file"></i>
                                    </a>
                                    @else
                                    -
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            <tr class="table-success">
                                <td colspan="2" class="text-end"><strong>Total Paid:</strong></td>
                                <td colspan="5"><strong>Rs. {{ number_format($sale->paid_amount, 2) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <!-- Submit -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <a href="{{route('admin.plots')}}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Add Payment
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentAmountInput = document.getElementById('payment_amount');
        const maxAmount = {
            {
                $sale - > due_amount
            }
        };

        paymentAmountInput.addEventListener('input', function() {
            if (parseFloat(this.value) > maxAmount) {
                this.value = maxAmount;
                alert('Payment amount cannot exceed due amount of Rs. ' + maxAmount.toFixed(2));
            }
        });
    });
</script>
@endsection