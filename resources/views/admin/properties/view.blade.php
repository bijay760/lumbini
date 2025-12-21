@extends('admin.layouts.app')
@section('title', 'Property Details | Lumbini Innovate')
@section('content')
<div class="container-fluid py-3">
    <div class="mb-3 card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-muted" style="font-size: 12px;">
                <a href="{{route('admin.properties')}}" class="text-decoration-none text-muted">Properties</a> / View
            </h4>
            <div style="gap: 8px;" class="d-flex">
                <a href="{{route('admin.properties.edit',['id'=>$landParcel->id])}}" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{route('admin.properties')}}" class="btn btn-sm btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>

    <!-- Property Overview -->
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0">Basic Info</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td width="40%" class="text-muted">Title:</td>
                            <td><strong>{{ $landParcel->title }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Reg. Number:</td>
                            <td>{{ $landParcel->registration_number ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Land Type:</td>
                            <td><span class="badge bg-info">{{ $landParcel->land_type ?? 'N/A' }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Status:</td>
                            <td>
                                @if($landParcel->is_approved)
                                <span class="badge bg-success">Approved</span>
                                @else
                                <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0">Location</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td width="40%" class="text-muted">District:</td>
                            <td>{{ $landParcel->district }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Municipality:</td>
                            <td>{{ $landParcel->municipality }}, Ward {{ $landParcel->ward_no }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Kitta No:</td>
                            <td><strong>{{ $landParcel->kitta_no }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Location:</td>
                            <td>{{ $landParcel->location ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0">Area Details</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td width="40%" class="text-muted">Dhoor:</td>
                            <td><strong>{{ $landParcel->dhoor }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Total Area:</td>
                            <td><strong>{{ $landParcel->total_area }} {{ $landParcel->area_unit ?? 'sq.m' }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Area Used:</td>
                            <td>{{ $landParcel->area_used ?? 0 }} {{ $landParcel->area_unit ?? 'sq.m' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Available:</td>
                            <td class="text-success"><strong>{{ $landParcel->available_area }} {{ $landParcel->area_unit ?? 'sq.m' }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0">Financial</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td width="40%" class="text-muted">Gov. Value:</td>
                            <td>Rs. {{ number_format($landParcel->government_value, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Market Value:</td>
                            <td>Rs. {{ number_format($landParcel->market_value, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Thali Amount:</td>
                            <td class="text-primary"><strong>Rs. {{ number_format($landParcel->thali_amount, 2) }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Purchase Price:</td>
                            <td>Rs. {{ number_format($landParcel->purchase_price, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if($landParcel->description || $landParcel->has_loan || $landParcel->remarks)
    <div class="card shadow-sm mb-3">
        <div class="card-header">
            <h6 class="mb-0">Additional Details</h6>
        </div>
        <div class="card-body">
            @if($landParcel->description)
            <p><strong>Description:</strong> {{ $landParcel->description }}</p>
            @endif
            @if($landParcel->has_loan)
            <p class="mb-0"><strong class="text-danger">Loan:</strong> Rs. {{ number_format($landParcel->loan_amount, 2) }} from {{ $landParcel->loan_institution ?? 'N/A' }}</p>
            @endif
            @if($landParcel->remarks)
            <p class="mb-0"><strong>Remarks:</strong> {{ $landParcel->remarks }}</p>
            @endif
        </div>
    </div>
    @endif

    <!-- Expenses -->
    <div class="card shadow-sm mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Expenses Ledger</h6>
            <span class="badge bg-danger" style="font-size: 0.95rem;">Total: Rs. {{ number_format($totalExpenses, 2) }}</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 4%;">SN</th>
                            <th style="width: 10%;">Date</th>
                            <th style="width: 30%;">Particular</th>
                            <th style="width: 12%;" class="text-end">Dr (Debit)</th>
                            <th style="width: 12%;" class="text-end">Cr (Credit)</th>
                            <th style="width: 20%;">Remarks</th>
                            <th style="width: 12%;" class="text-center">Files</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $sn = 1; @endphp
                        <tr>
                            <td>{{ $sn++ }}</td>
                            <td>{{ $landParcel->purchase_date ? $landParcel->purchase_date->format('Y-m-d') : '-' }}</td>
                            <td><strong>Property Purchase</strong> <small class="text-muted">(from {{ $landParcel->purchase_from ?? 'N/A' }})</small></td>
                            <td class="text-end"><strong class="text-danger">Rs. {{ number_format($landParcel->purchase_price, 2) }}</strong></td>
                            <td class="text-end">-</td>
                            <td>Initial purchase</td>
                            <td class="text-center">-</td>
                        </tr>
                        @if($landParcel->thali_amount && $landParcel->thali_amount > 0)
                        <tr>
                            <td>{{ $sn++ }}</td>
                            <td>{{ $landParcel->purchase_date ? $landParcel->purchase_date->format('Y-m-d') : '-' }}</td>
                            <td><strong>Thali Amount</strong> <small class="text-muted">(Registration/Stamp Duty)</small></td>
                            <td class="text-end"><strong class="text-danger">Rs. {{ number_format($landParcel->thali_amount, 2) }}</strong></td>
                            <td class="text-end">-</td>
                            <td>Registration fees</td>
                            <td class="text-center">-</td>
                        </tr>
                        @endif
                        @foreach($allExpenses as $expense)
                        <tr>
                            <td>{{ $sn++ }}</td>
                            <td>{{ \Carbon\Carbon::parse($expense->date)->format('Y-m-d') }}</td>
                            <td>
                                {{ $expense->subject }}
                                @if(!empty($expense->plot_title))
                                <br><small class="text-primary"><i class="fas fa-th"></i> {{ $expense->plot_title }}</small>
                                @endif
                            </td>
                            <td class="text-end"><strong>Rs. {{ number_format($expense->amount, 2) }}</strong></td>
                            <td class="text-end">-</td>
                            <td>{{ $expense->remarks ?? '-' }}</td>
                            <td class="text-center">
                                @if(!empty($expense->file_path))
                                @php
                                $ext = pathinfo($expense->file_path, PATHINFO_EXTENSION);
                                $isImg = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                @endphp
                                @if($isImg)
                                <a href="{{ asset($expense->file_path) }}" target="_blank">
                                    <img src="{{ asset($expense->file_path) }}" alt="Doc" style="width:40px;height:40px;object-fit:cover;" class="rounded" />
                                </a>
                                @else
                                <a href="{{ asset($expense->file_path) }}" target="_blank" class="btn btn-xs btn-outline-primary"><i class="fas fa-download"></i></a>
                                @endif
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @if($plotSales->count() > 0)
                        @foreach($plotSales as $sale)
                        {{-- Sale related expenses (render before sale row) --}}
                        @if(!empty($sale->sale_expenses) && $sale->sale_expenses->count() > 0)
                        @foreach($sale->sale_expenses as $sExp)
                        <tr>
                            <td>{{ $sn++ }}</td>
                            <td>{{ \Carbon\Carbon::parse($sExp->date)->format('Y-m-d') }}</td>
                            <td>
                                Sale Expense: {{ $sExp->subject }}
                                @if(!empty($sale->plot_title))
                                <br><small class="text-primary"><i class="fas fa-th"></i> {{ $sale->plot_title }}</small>
                                @endif
                            </td>
                            <td class="text-end"><strong>Rs. {{ number_format($sExp->amount, 2) }}</strong></td>
                            <td class="text-end">-</td>
                            <td>{{ $sExp->remarks ?? '-' }}</td>
                            <td class="text-center">
                                @if(!empty($sExp->file_path))
                                @php
                                $ext = pathinfo($sExp->file_path, PATHINFO_EXTENSION);
                                $isImg = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                @endphp
                                @if($isImg)
                                <a href="{{ asset($sExp->file_path) }}" target="_blank">
                                    <img src="{{ asset($sExp->file_path) }}" alt="Doc" style="width:40px;height:40px;object-fit:cover;" class="rounded" />
                                </a>
                                @else
                                <a href="{{ asset($sExp->file_path) }}" target="_blank" class="btn btn-xs btn-outline-primary"><i class="fas fa-download"></i></a>
                                @endif
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif

                        {{-- Plot Sale row --}}
                        <tr class="">
                            <td>{{ $sn++ }}</td>
                            <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('Y-m-d') }}</td>
                            <td>
                                <strong>Plot Sale</strong> @if($sale->payment_status == 'partial')<span class="badge bg-warning text-dark">Partial</span>@endif
                                @if(!empty($sale->plot_title))
                                <br><small class="text-success"><i class="fas fa-th"></i> {{ $sale->plot_title }}</small>
                                @endif
                                <br><small class="text-muted">Customer: {{ $sale->customer_name ?? 'N/A' }}</small>
                                @if($sale->payment_status == 'partial')
                                <br><small class="text-danger">Paid: Rs. {{ number_format($sale->paid_amount, 2) }} | Due: Rs. {{ number_format($sale->due_amount, 2) }}</small>
                                @endif
                            </td>
                            <td class="text-end">-</td>
                            <td class="text-end"><strong class="text-success">Rs. {{ number_format($sale->paid_amount ?? $sale->sale_price, 2) }}</strong></td>
                            <td>{{ $sale->remarks ?? '-' }}</td>
                            <td class="text-center">-</td>
                        </tr>

                        @endforeach
                        @endif
                        <tr class="table-secondary fw-bold">
                            <td colspan="3" class="text-end">Total:</td>
                            <td class="text-end text-danger"><strong>Rs. {{ number_format($totalExpenses, 2) }}</strong></td>
                            <td class="text-end text-success"><strong>Rs. {{ number_format($totalSales, 2) }}</strong></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr class="table-info fw-bold">
                            <td colspan="3" class="text-end">Net Profit/Loss:</td>
                            <td colspan="2" class="text-end">
                                @php
                                $netProfit = $totalSales - $totalExpenses;
                                @endphp
                                <strong class="{{ $netProfit >= 0 ? 'text-success' : 'text-danger' }}">
                                    Rs. {{ number_format(abs($netProfit), 2) }} {{ $netProfit >= 0 ? '(Profit)' : '(Loss)' }}
                                </strong>
                            </td>
                            <td colspan="2"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Legal Documents -->
    @if($legalDocuments->count() > 0)
    <div class="card shadow-sm mb-3">
        <div class="card-header">
            <h6 class="mb-0">Legal Documents</h6>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($legalDocuments as $doc)
                <div class="col-md-4 mb-2">
                    <div class="border rounded p-2">
                        <strong class="d-block mb-1">{{ $doc->title }}</strong>
                        @if($doc->description)<small class="text-muted d-block mb-2">{{ $doc->description }}</small>@endif
                        @if($doc->file_path)
                        @php
                        $ext = pathinfo($doc->file_path, PATHINFO_EXTENSION);
                        $isImg = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                        @endphp
                        @if($isImg)
                        <a href="{{ asset($doc->file_path) }}" target="_blank">
                            <img src="{{ asset($doc->file_path) }}" alt="{{ $doc->title }}" class="img-fluid rounded" style="max-height:150px;object-fit:cover;width:100%;" />
                        </a>
                        @else
                        <a href="{{ asset($doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100">
                            <i class="fas fa-download"></i> Download
                        </a>
                        @endif
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection