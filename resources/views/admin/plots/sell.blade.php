@extends('admin.layouts.app')
@section('title', 'Sell Plot | Lumbini Innovate')
@section('content')
<div class="container-fluid py-3">
    <div class="mb-3 card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-muted" style="font-size: 12px;">
                <a href="{{route('admin.plots')}}" class="text-decoration-none text-muted">Plots</a> / Sell Plot
            </h4>
            <a href="{{route('admin.plots')}}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.plots.sell.store', ['id' => $plot->id]) }}">
        @csrf

        <!-- Plot Information -->
        <div class="card shadow-sm mb-3">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0"><i class="fas fa-th"></i> Plot Information</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <strong>Plot Title:</strong> {{ $plot->title }}
                    </div>
                    <div class="col-md-2">
                        <strong>Plot Number:</strong> {{ $plot->plot_number }}
                    </div>
                    <div class="col-md-2">
                        <strong>Area:</strong> {{ $plot->area }} {{ $plot->landParcel->area_unit ?? 'sq.m' }}
                    </div>
                    <div class="col-md-2">
                        <strong>Price per Unit:</strong> Rs. {{ number_format($plot->price_per_unit, 2) }}
                    </div>
                    <div class="col-md-3">
                        <strong>Total Price:</strong> <span class="text-primary">Rs. {{ number_format($plot->total_price, 2) }}</span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <strong>Parent Property:</strong> {{ $plot->landParcel->title ?? 'N/A' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-user"></i> Customer Information</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label>Select Customer *</label>
                            <select class="form-control" id="customer_select" name="customer_id">
                                <option value="">-- Select Existing Customer --</option>
                                <option value="new">+ Add New Customer</option>
                                @foreach($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    data-name="{{ $customer->name }}"
                                    data-phone="{{ $customer->phone }}"
                                    data-email="{{ $customer->email }}"
                                    data-address="{{ $customer->address }}"
                                    {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }} - {{ $customer->phone }}
                                </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div id="new_customer_fields" style="display: none;">
                    <div class="alert alert-info">
                        <small><i class="fas fa-info-circle"></i> Fill in the details to create a new customer</small>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Customer Name *</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name') }}">
                                @error('customer_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label>Phone Number *</label>
                                <input type="text" class="form-control" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}">
                                @error('customer_phone')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{ old('customer_email') }}">
                                @error('customer_email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Address</label>
                                <textarea class="form-control" id="customer_address" name="customer_address" rows="2">{{ old('customer_address') }}</textarea>
                                @error('customer_address')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label>Citizenship No.</label>
                                <input type="text" class="form-control" name="citizenship_number" value="{{ old('citizenship_number') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label>PAN No.</label>
                                <input type="text" class="form-control" name="pan_number" value="{{ old('pan_number') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="existing_customer_info" style="display: none;">
                    <div class="alert alert-success">
                        <div class="row">
                            <div class="col-md-4"><strong>Name:</strong> <span id="info_name"></span></div>
                            <div class="col-md-4"><strong>Phone:</strong> <span id="info_phone"></span></div>
                            <div class="col-md-4"><strong>Email:</strong> <span id="info_email"></span></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12"><strong>Address:</strong> <span id="info_address"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sale Details -->
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-money-bill-wave"></i> Sale Details</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label>Sale Date *</label>
                            <input type="date" class="form-control" name="sale_date" value="{{ old('sale_date', date('Y-m-d')) }}" required>
                            @error('sale_date')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label>Sale Price (Rs.) *</label>
                            <input type="number" step="0.01" class="form-control" id="sale_price" name="sale_price" value="{{ old('sale_price', $plot->total_price) }}" required>
                            @error('sale_price')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label>Paid Amount (Rs.) *</label>
                            <input type="number" step="0.01" class="form-control" id="paid_amount" name="paid_amount" value="{{ old('paid_amount') }}" required>
                            @error('paid_amount')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label>Due Amount (Rs.)</label>
                            <input type="number" step="0.01" class="form-control bg-light" id="due_amount" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label>Payment Type *</label>
                            <select class="form-control" id="payment_type" name="payment_type" required>
                                <option value="full" {{ old('payment_type') == 'full' ? 'selected' : '' }}>Full Payment</option>
                                <option value="installment" {{ old('payment_type') == 'installment' ? 'selected' : '' }}>Installment</option>
                            </select>
                            @error('payment_type')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label>Remarks</label>
                            <textarea class="form-control" name="remarks" rows="2">{{ old('remarks') }}</textarea>
                            @error('remarks')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div id="installment_fields" style="display: none;">
                    <div class="alert alert-warning">
                        <small><i class="fas fa-exclamation-triangle"></i> Installment payment selected. Specify down payment and schedule.</small>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Down Payment (Rs.)</label>
                                <input type="number" step="0.01" class="form-control" name="down_payment" id="down_payment" value="{{ old('down_payment') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Installment Period (Months)</label>
                                <input type="number" class="form-control" name="installment_period" value="{{ old('installment_period') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Next Payment Date</label>
                                <input type="date" class="form-control" name="next_payment_date" value="{{ old('next_payment_date') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sale Expenses -->
        <div class="card shadow-sm mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><i class="fas fa-receipt"></i> Sale Related Expenses</h6>
                <button type="button" class="btn btn-xs btn-secondary" id="add-expense">
                    <i class="fas fa-plus"></i> Add Expense
                </button>
            </div>
            <div class="card-body">
                <div id="expenses-container">
                    <!-- Expenses will be added here -->
                </div>
            </div>
        </div>

        <!-- Legal Documents -->
        <div class="card shadow-sm mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><i class="fas fa-file-contract"></i> Legal Documents</h6>
                <button type="button" class="btn btn-xs btn-secondary" id="add-document">
                    <i class="fas fa-plus"></i> Add Document
                </button>
            </div>
            <div class="card-body">
                <div id="documents-container">
                    <!-- Documents will be added here -->
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-end mb-3">
            <button type="submit" class="btn btn-success btn-lg">
                <i class="fas fa-check"></i> Complete Sale
            </button>
        </div>
    </form>
</div>

<script>
    let expenseIndex = 0;
    let documentIndex = 0;

    // Customer selection handler
    document.getElementById('customer_select').addEventListener('change', function() {
        const value = this.value;
        const newCustomerFields = document.getElementById('new_customer_fields');
        const existingCustomerInfo = document.getElementById('existing_customer_info');

        if (value === 'new') {
            newCustomerFields.style.display = 'block';
            existingCustomerInfo.style.display = 'none';
            // Make new customer fields required
            document.getElementById('customer_name').setAttribute('required', 'required');
            document.getElementById('customer_phone').setAttribute('required', 'required');
        } else if (value !== '') {
            // Existing customer selected
            const option = this.options[this.selectedIndex];
            document.getElementById('info_name').textContent = option.dataset.name;
            document.getElementById('info_phone').textContent = option.dataset.phone;
            document.getElementById('info_email').textContent = option.dataset.email || 'N/A';
            document.getElementById('info_address').textContent = option.dataset.address || 'N/A';

            newCustomerFields.style.display = 'none';
            existingCustomerInfo.style.display = 'block';
            // Remove required from new customer fields
            document.getElementById('customer_name').removeAttribute('required');
            document.getElementById('customer_phone').removeAttribute('required');
        } else {
            newCustomerFields.style.display = 'none';
            existingCustomerInfo.style.display = 'none';
        }
    });

    // Payment type handler
    document.getElementById('payment_type').addEventListener('change', function() {
        const installmentFields = document.getElementById('installment_fields');
        if (this.value === 'installment') {
            installmentFields.style.display = 'block';
        } else {
            installmentFields.style.display = 'none';
        }
    });

    // Calculate due amount automatically
    document.getElementById('sale_price').addEventListener('input', calculateDue);
    document.getElementById('paid_amount').addEventListener('input', calculateDue);

    function calculateDue() {
        const salePrice = parseFloat(document.getElementById('sale_price').value) || 0;
        const paidAmount = parseFloat(document.getElementById('paid_amount').value) || 0;
        const dueAmount = salePrice - paidAmount;
        document.getElementById('due_amount').value = dueAmount.toFixed(2);
    }

    // Add Expense
    document.getElementById('add-expense').addEventListener('click', function() {
        const container = document.getElementById('expenses-container');
        const html = `
            <div class="expense-item border rounded p-3 mb-2 bg-light" data-index="${expenseIndex}">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group mb-0">
                            <label>Date</label>
                            <input type="date" class="form-control form-control-sm" name="expenses[${expenseIndex}][date]">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <label>Subject</label>
                            <input type="text" class="form-control form-control-sm" name="expenses[${expenseIndex}][subject]" placeholder="e.g., Registration Fee">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-0">
                            <label>Amount (Rs.)</label>
                            <input type="number" step="0.01" class="form-control form-control-sm" name="expenses[${expenseIndex}][amount]">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-0">
                            <label>Remarks</label>
                            <input type="text" class="form-control form-control-sm" name="expenses[${expenseIndex}][remarks]">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-0">
                            <label>Document</label>
                            <input type="file" class="form-control form-control-sm" name="expenses[${expenseIndex}][document]" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label>&nbsp;</label>
                        <button type="button" class="btn btn-sm btn-danger d-block remove-expense">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        expenseIndex++;

        // Add remove listener
        container.querySelector('.expense-item:last-child .remove-expense').addEventListener('click', function() {
            this.closest('.expense-item').remove();
        });
    });

    // Add Document
    document.getElementById('add-document').addEventListener('click', function() {
        const container = document.getElementById('documents-container');
        const html = `
            <div class="document-item border rounded p-3 mb-2 bg-light" data-index="${documentIndex}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <label>Document Type *</label>
                            <input type="text" class="form-control form-control-sm" name="legal_documents[${documentIndex}][type]" placeholder="e.g., Sale Agreement" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label>Description</label>
                            <textarea class="form-control form-control-sm" name="legal_documents[${documentIndex}][description]" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label>Upload File *</label>
                            <input type="file" class="form-control form-control-sm" name="legal_documents[${documentIndex}][document]" accept=".jpg,.jpeg,.png,.pdf" required>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label>&nbsp;</label>
                        <button type="button" class="btn btn-sm btn-danger d-block remove-document">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        documentIndex++;

        // Add remove listener
        container.querySelector('.document-item:last-child .remove-document').addEventListener('click', function() {
            this.closest('.document-item').remove();
        });
    });

    // Initialize on page load
    calculateDue();
</script>
@endsection