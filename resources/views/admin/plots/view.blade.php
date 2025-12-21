@extends('admin.layouts.app')
@section('title', 'Plot Sale Details | Lumbini Innovate')
@section('content')
<div class="container-fluid py-3">
    <div class="mb-3 card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-muted" style="font-size: 12px;">
                <a href="{{route('admin.plots')}}" class="text-decoration-none text-muted">Plots</a> / Sale Details
            </h4>
            <div>
                @if($sale->payment_status == 'partial')
                <a href="{{route('admin.plots.payment',['id'=>$plot->id])}}" class="btn btn-sm btn-warning me-2">
                    <i class="fas fa-money-bill-wave"></i> Add Payment
                </a>
                @endif
                <a href="{{route('admin.plots')}}" class="btn btn-sm btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>

    <!-- Plot Information -->
    <div class="card shadow-sm mb-3">
        <div class="card-header bg-primary text-white">
            <h6 class="mb-0"><i class="fas fa-th"></i> Plot Information</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <strong>Plot Title:</strong><br>{{ $plot->title }}
                </div>
                <div class="col-md-2">
                    <strong>Plot Number:</strong><br>{{ $plot->plot_number }}
                </div>
                <div class="col-md-2">
                    <strong>Area:</strong><br>{{ $plot->area }} {{ $plot->landParcel->area_unit ?? 'sq.m' }}
                </div>
                <div class="col-md-2">
                    <strong>Price per Unit:</strong><br>Rs. {{ number_format($plot->price_per_unit, 2) }}
                </div>
                <div class="col-md-3">
                    <strong>Total Price:</strong><br><span class="text-primary">Rs. {{ number_format($plot->total_price, 2) }}</span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <strong>Parent Property:</strong><br>{{ $plot->landParcel->title ?? 'N/A' }}
                </div>
                <div class="col-md-3">
                    <strong>Status:</strong><br><span class="badge bg-success">{{ ucfirst($plot->status) }}</span>
                </div>
                <div class="col-md-3">
                    <strong>Direction:</strong><br>{{ $plot->direction ?? 'N/A' }}
                </div>
            </div>
            @if($plot->remarks)
            <div class="row mt-3">
                <div class="col-md-12">
                    <strong>Remarks:</strong><br>{{ $plot->remarks }}
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Customer Information -->
    <div class="card shadow-sm mb-3">
        <div class="card-header bg-info text-white">
            <h6 class="mb-0"><i class="fas fa-user"></i> Customer Information</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <strong>Name:</strong><br>{{ optional($customer)->name ?? $sale->customer_name ?? 'N/A' }}
                </div>
                <div class="col-md-3">
                    <strong>Phone:</strong><br>{{ optional($customer)->phone ?? $sale->customer_phone ?? 'N/A' }}
                </div>
                <div class="col-md-3">
                    <strong>Email:</strong><br>{{ optional($customer)->email ?? $sale->customer_email ?? 'N/A' }}
                </div>
                <div class="col-md-3">
                    <strong>Customer Type:</strong><br>{{ optional($customer)->customer_type ? ucfirst(optional($customer)->customer_type) : (isset($sale->customer_type) && $sale->customer_type ? ucfirst($sale->customer_type) : 'Individual') }}
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <strong>Address:</strong><br>{{ optional($customer)->address ?? $sale->customer_address ?? 'N/A' }}
                </div>
                <div class="col-md-4">
                    <strong>Citizenship Number:</strong><br>{{ optional($customer)->citizenship_number ?? 'N/A' }}
                </div>
                <div class="col-md-4">
                    <strong>PAN Number:</strong><br>{{ optional($customer)->pan_number ?? 'N/A' }}
                </div>
            </div>
        </div>
    </div>

    <!-- Sale Summary -->
    <div class="card shadow-sm mb-3">
        <div class="card-header bg-success text-white">
            <h6 class="mb-0"><i class="fas fa-file-invoice-dollar"></i> Sale Summary</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <strong>Sale Number:</strong><br>{{ $sale->sale_number }}
                </div>
                <div class="col-md-3">
                    <strong>Sale Date:</strong><br>{{ \Carbon\Carbon::parse($sale->sale_date)->format('F d, Y') }}
                </div>
                <div class="col-md-3">
                    <strong>Sale Price:</strong><br><span class="text-success h5">Rs. {{ number_format($sale->sale_price, 2) }}</span>
                </div>
                <div class="col-md-3">
                    <strong>Payment Type:</strong><br><span class="badge bg-{{ $sale->payment_type == 'full' ? 'success' : 'warning' }}">{{ ucfirst($sale->payment_type) }}</span>
                </div>
            </div>
            @if($sale->payment_type == 'installment')
            <div class="row mt-3">
                <div class="col-md-4">
                    <strong>Down Payment:</strong><br>Rs. {{ number_format($sale->down_payment ?? 0, 2) }}
                </div>
                <div class="col-md-4">
                    <strong>Installment Period:</strong><br>{{ $sale->installment_period ?? 'N/A' }} months
                </div>
                <div class="col-md-4">
                    <strong>Next Payment Date:</strong><br>{{ $sale->next_payment_date ? \Carbon\Carbon::parse($sale->next_payment_date)->format('F d, Y') : 'N/A' }}
                </div>
            </div>
            @endif
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <tr>
                                <td width="70%"><strong>Sale Price</strong></td>
                                <td class="text-end"><strong>Rs. {{ number_format($sale->sale_price, 2) }}</strong></td>
                            </tr>
                            <tr class="table-success">
                                <td><strong>Paid Amount</strong></td>
                                <td class="text-end"><strong class="text-success">Rs. {{ number_format($sale->paid_amount, 2) }}</strong></td>
                            </tr>
                            <tr class="{{ $sale->due_amount > 0 ? 'table-danger' : 'table-light' }}">
                                <td><strong>Due Amount</strong></td>
                                <td class="text-end"><strong class="{{ $sale->due_amount > 0 ? 'text-danger' : '' }}">Rs. {{ number_format($sale->due_amount, 2) }}</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Payment Status</strong></td>
                                <td class="text-end">
                                    <span class="badge bg-{{ $sale->payment_status == 'paid' ? 'success' : 'warning' }}">
                                        {{ ucfirst($sale->payment_status) }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            @if($sale->remarks)
            <div class="row mt-3">
                <div class="col-md-12">
                    <strong>Remarks:</strong><br>{{ $sale->remarks }}
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Payment History -->
    @if($payments->count() > 0)
    <div class="card shadow-sm mb-3">
        <div class="card-header bg-secondary text-white">
            <h6 class="mb-0"><i class="fas fa-history"></i> Payment Transaction History ({{ $payments->count() }} Payments)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">SN</th>
                            <th width="12%">Payment Date</th>
                            <th width="15%">Amount</th>
                            <th width="12%">Method</th>
                            <th width="15%">Reference</th>
                            <th width="25%">Remarks</th>
                            <th width="10%">Receipt</th>
                            <th width="6%">Added On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $index => $payment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') }}</td>
                            <td><strong class="text-success">Rs. {{ number_format($payment->amount, 2) }}</strong></td>
                            <td>
                                <span class="badge bg-primary">
                                    {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                                </span>
                            </td>
                            <td>{{ $payment->transaction_reference ?? '-' }}</td>
                            <td>{{ $payment->remarks ?? '-' }}</td>
                            <td class="text-center">
                                @if($payment->document_path)
                                @php
                                $ext = pathinfo($payment->document_path, PATHINFO_EXTENSION);
                                $isImg = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                @endphp
                                @if($isImg)
                                <a href="{{ asset($payment->document_path) }}" target="_blank">
                                    <img src="{{ asset($payment->document_path) }}" alt="Receipt" style="width:50px;height:50px;object-fit:cover;" class="rounded" />
                                </a>
                                @else
                                <a href="{{ asset($payment->document_path) }}" target="_blank" class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-download"></i> View
                                </a>
                                @endif
                                @else
                                -
                                @endif
                            </td>
                            <td><small>{{ \Carbon\Carbon::parse($payment->created_at)->format('M d, Y') }}</small></td>
                        </tr>
                        @endforeach
                        <tr class="table-success">
                            <td colspan="2" class="text-end"><strong>Total Paid (via Payments):</strong></td>
                            <td colspan="6"><strong>Rs. {{ number_format($payments->sum('amount'), 2) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i> No payment transactions recorded yet. Initial payment of Rs. {{ number_format($sale->paid_amount, 2) }} was made at the time of sale.
    </div>
    @endif

    <!-- Sale Related Expenses -->
    @if($expenses->count() > 0)
    <div class="card shadow-sm mb-3">
        <div class="card-header bg-warning text-dark">
            <h6 class="mb-0"><i class="fas fa-receipt"></i> Sale Related Expenses ({{ $expenses->count() }} Items)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">SN</th>
                            <th width="15%">Date</th>
                            <th width="25%">Subject</th>
                            <th width="15%">Amount</th>
                            <th width="25%">Remarks</th>
                            <th width="15%">Document</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expenses as $index => $expense)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($expense->date)->format('M d, Y') }}</td>
                            <td>{{ $expense->subject }}</td>
                            <td><strong class="text-danger">Rs. {{ number_format($expense->amount, 2) }}</strong></td>
                            <td>{{ $expense->remarks ?? '-' }}</td>
                            <td class="text-center">
                                @if($expense->file_path)
                                @php
                                $ext = pathinfo($expense->file_path, PATHINFO_EXTENSION);
                                $isImg = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                @endphp
                                @if($isImg)
                                <a href="{{ asset($expense->file_path) }}" target="_blank">
                                    <img src="{{ asset($expense->file_path) }}" alt="Doc" style="width:50px;height:50px;object-fit:cover;" class="rounded" />
                                </a>
                                @else
                                <a href="{{ asset($expense->file_path) }}" target="_blank" class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-download"></i> View
                                </a>
                                @endif
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        <tr class="table-danger">
                            <td colspan="3" class="text-end"><strong>Total Expenses:</strong></td>
                            <td colspan="3"><strong>Rs. {{ number_format($expenses->sum('amount'), 2) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- Legal Documents -->
    @if($legalDocuments->count() > 0)
    <div class="card shadow-sm mb-3">
        <div class="card-header bg-dark text-white">
            <h6 class="mb-0"><i class="fas fa-file-contract"></i> Legal Documents ({{ $legalDocuments->count() }} Documents)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">SN</th>
                            <th width="25%">Document Type</th>
                            <th width="40%">Description</th>
                            <th width="15%">File</th>
                            <th width="15%">Uploaded On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($legalDocuments as $index => $doc)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $doc->title }}</strong></td>
                            <td>{{ $doc->description ?? '-' }}</td>
                            <td class="text-center">
                                @if($doc->file_path)
                                @php
                                $ext = pathinfo($doc->file_path, PATHINFO_EXTENSION);
                                $isImg = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                $isPdf = strtolower($ext) == 'pdf';
                                @endphp
                                @if($isImg)
                                <a href="{{ asset($doc->file_path) }}" target="_blank">
                                    <img src="{{ asset($doc->file_path) }}" alt="Doc" style="width:60px;height:60px;object-fit:cover;" class="rounded" />
                                </a>
                                @elseif($isPdf)
                                <a href="{{ asset($doc->file_path) }}" target="_blank" class="btn btn-sm btn-danger">
                                    <i class="fas fa-file-pdf"></i> View PDF
                                </a>
                                @else
                                <a href="{{ asset($doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-download"></i> Download
                                </a>
                                @endif
                                @else
                                -
                                @endif
                            </td>
                            <td><small>{{ \Carbon\Carbon::parse($doc->created_at)->format('M d, Y') }}</small></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- Financial Summary -->
    <div class="card shadow-sm mb-3 border-primary">
        <div class="card-header bg-gradient text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <h6 class="mb-0"><i class="fas fa-chart-line"></i> Financial Summary</h6>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-light">
                        <h6 class="text-muted mb-2">Total Sale Value</h6>
                        <h4 class="text-primary mb-0">Rs. {{ number_format($sale->sale_price, 2) }}</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-light">
                        <h6 class="text-muted mb-2">Total Received</h6>
                        <h4 class="text-success mb-0">Rs. {{ number_format($sale->paid_amount, 2) }}</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded bg-light">
                        <h6 class="text-muted mb-2">Total Expenses</h6>
                        <h4 class="text-danger mb-0">Rs. {{ number_format($expenses->sum('amount'), 2) }}</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3 border rounded {{ $sale->due_amount > 0 ? 'bg-warning' : 'bg-success' }}">
                        <h6 class="mb-2" style="color: {{ $sale->due_amount > 0 ? '#000' : '#fff' }};">Outstanding Balance</h6>
                        <h4 class="mb-0" style="color: {{ $sale->due_amount > 0 ? '#000' : '#fff' }};">Rs. {{ number_format($sale->due_amount, 2) }}</h4>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="p-3 border rounded bg-info text-white">
                        <h6 class="mb-2">Net Profit from Sale</h6>
                        <h3 class="mb-0">Rs. {{ number_format($sale->paid_amount - $expenses->sum('amount'), 2) }}</h3>
                        <small>Based on received payments minus expenses</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection