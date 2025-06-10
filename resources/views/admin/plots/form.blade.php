{{-- Combined form for create and update --}}
<div class="card mb-3">
    <div class="card-header">
        <h5 class="mb-0">Basic Information</h5>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <label for="land_parcel_id" class="col-md-4 col-form-label text-md-end">{{ __('Land Parcel') }}</label>
            <div class="col-md-8">
                <select id="land_parcel_id" class="form-control @error('land_parcel_id') is-invalid @enderror" name="land_parcel_id" required>
                    <option value="">Select Land Parcel</option>
                    @foreach($landParcels as $landParcel)
                        <option value="{{ $landParcel->id }}"
                                {{ (old('land_parcel_id', isset($plot) ? $plot->land_parcel_id : '') == $landParcel->id) ? 'selected' : '' }}
                                data-available-area="{{ $landParcel->available_area }}">
                            {{ $landParcel->title }} (Available area: {{ $landParcel->available_area }} sq.meter)
                        </option>

                    @endforeach
                </select>
                @error('land_parcel_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>
            <div class="col-md-8">
                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                       value="{{ old('title', isset($plot) ? $plot->title : '') }}" required>
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="plot_number" class="col-md-4 col-form-label text-md-end">{{ __('Plot Number') }}</label>
            <div class="col-md-8">
                <input id="plot_number" type="text" class="form-control @error('plot_number') is-invalid @enderror"
                       name="plot_number" value="{{ old('plot_number', isset($plot) ? $plot->plot_number : '') }}" required>
                @error('plot_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="plot_number" class="col-md-4 col-form-label text-md-end">{{ __('Area (Sq.M)') }}</label>
            <div class="col-md-8">
                <input id="area" type="number" step="0.01" class="form-control @error('area') is-invalid @enderror"
                       name="area" value="{{ old('area', isset($plot) ? $plot->area : '') }}" max="" required>
                @error('area')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="dimensions" class="col-md-4 col-form-label text-md-end">{{ __('Dimensions') }}</label>
            <div class="col-md-8">
                <input id="dimensions" type="text" class="form-control @error('dimensions') is-invalid @enderror"
                       name="dimensions" value="{{ old('dimensions', isset($plot) ? $plot->dimensions : '') }}">
                @error('dimensions')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="facing_direction" class="col-md-4 col-form-label text-md-end">{{ __('Facing Direction') }}</label>
            <div class="col-md-8">
                <select id="facing_direction" class="form-control @error('facing_direction') is-invalid @enderror" name="facing_direction">
                    <option value="">Select Direction</option>
                    <option value="North" {{ old('facing_direction', isset($plot) ? $plot->facing_direction : '') == 'North' ? 'selected' : '' }}>North</option>
                    <option value="South" {{ old('facing_direction', isset($plot) ? $plot->facing_direction : '') == 'South' ? 'selected' : '' }}>South</option>
                    <option value="East" {{ old('facing_direction', isset($plot) ? $plot->facing_direction : '') == 'East' ? 'selected' : '' }}>East</option>
                    <option value="West" {{ old('facing_direction', isset($plot) ? $plot->facing_direction : '') == 'West' ? 'selected' : '' }}>West</option>
                    <option value="North-East" {{ old('facing_direction', isset($plot) ? $plot->facing_direction : '') == 'North-East' ? 'selected' : '' }}>North-East</option>
                    <option value="North-West" {{ old('facing_direction', isset($plot) ? $plot->facing_direction : '') == 'North-West' ? 'selected' : '' }}>North-West</option>
                    <option value="South-East" {{ old('facing_direction', isset($plot) ? $plot->facing_direction : '') == 'South-East' ? 'selected' : '' }}>South-East</option>
                    <option value="South-West" {{ old('facing_direction', isset($plot) ? $plot->facing_direction : '') == 'South-West' ? 'selected' : '' }}>South-West</option>
                </select>
                @error('facing_direction')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>
            <div class="col-md-8">
                <select id="status" class="form-control @error('status') is-invalid @enderror" name="status">
                    <option value="available" {{ old('status', isset($plot) ? $plot->status : 'available') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="reserved" {{ old('status', isset($plot) ? $plot->status : '') == 'reserved' ? 'selected' : '' }}>Reserved</option>
                    <option value="sold" {{ old('status', isset($plot) ? $plot->status : '') == 'sold' ? 'selected' : '' }}>Sold</option>
                    <option value="blocked" {{ old('status', isset($plot) ? $plot->status : '') == 'blocked' ? 'selected' : '' }}>Blocked</option>
                </select>
                @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="price_per_unit" class="col-md-4 col-form-label text-md-end">{{ __('Price Per Unit') }}</label>
            <div class="col-md-8">
                <input id="price_per_unit" type="number" step="0.01" class="form-control @error('price_per_unit') is-invalid @enderror"
                       name="price_per_unit" value="{{ old('price_per_unit', isset($plot) ? $plot->price_per_unit : '') }}" required>
                @error('price_per_unit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="total_price" class="col-md-4 col-form-label text-md-end">{{ __('Total Price') }}</label>
            <div class="col-md-8">
                <input id="total_price" type="number" step="0.01" class="form-control @error('total_price') is-invalid @enderror"
                       name="total_price" value="{{ old('total_price', isset($plot) ? $plot->total_price : '') }}" required>
                @error('total_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="features" class="col-md-4 col-form-label text-md-end">{{ __('Features') }}</label>
            <div class="col-md-8">
                <textarea id="features" class="form-control @error('features') is-invalid @enderror" name="features" rows="3">{{ old('features', isset($plot) ? $plot->features : '') }}</textarea>
                @error('features')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="remarks" class="col-md-4 col-form-label text-md-end">{{ __('Remarks') }}</label>
            <div class="col-md-8">
                <textarea id="remarks" class="form-control @error('remarks') is-invalid @enderror" name="remarks" rows="3">{{ old('remarks', isset($plot) ? $plot->remarks : '') }}</textarea>
                @error('remarks')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
</div>

<!-- Expenses Section -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Expenses</h5>
                <button type="button" class="btn btn-sm btn-secondary" id="add-expense">
                    <i class="fas fa-plus"></i> Add Expense
                </button>
            </div>
            <div class="card-body">
                <div id="expenses-container">
                    @if(isset($expenses) && count($expenses) > 0)
                        @foreach($expenses as $index => $expense)
                            <div class="expense-item mb-4 border p-3" data-index="{{ $index }}">
                                <input type="hidden" name="expenses[{{ $index }}][id]" value="{{ $expense->id }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date*</label>
                                            <input type="date" class="form-control" name="expenses[{{ $index }}][date]"
                                                   value="{{ old('expenses.'.$index.'.date', $expense->date) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Subject*</label>
                                            <input type="text" class="form-control" name="expenses[{{ $index }}][subject]"
                                                   value="{{ old('expenses.'.$index.'.subject', $expense->subject) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Amount*</label>
                                            <input type="number" step="0.01" class="form-control" name="expenses[{{ $index }}][amount]"
                                                   value="{{ old('expenses.'.$index.'.amount', $expense->amount) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <input type="text" class="form-control" name="expenses[{{ $index }}][remarks]"
                                                   value="{{ old('expenses.'.$index.'.remarks', $expense->remarks) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-sm remove-expense">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Document (JPG, PNG, PDF, JPEG)</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="expenses[{{ $index }}][document]"
                                                       accept=".jpg,.jpeg,.png,.pdf">
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                            @if($expense->file_path)
                                                <small class="text-muted mt-1 d-block">
                                                    Current file:
                                                    <a href="{{ asset($expense->file_path) }}" target="_blank">
                                                        {{ basename($expense->file_path) }}
                                                    </a>
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Template for new expense (hidden by default) -->
                        <div class="expense-item mb-4 border p-3" data-index="0" style="display: none;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date*</label>
                                        <input type="date" class="form-control" name="expenses[0][date]">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Subject*</label>
                                        <input type="text" class="form-control" name="expenses[0][subject]">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Amount*</label>
                                        <input type="number" step="0.01" class="form-control" name="expenses[0][amount]">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <input type="text" class="form-control" name="expenses[0][remarks]">
                                    </div>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-sm remove-expense">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Document (JPG, PNG, PDF, JPEG)</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="expenses[0][document]"
                                                   accept=".jpg,.jpeg,.png,.pdf">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Legal Documents Section -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Legal Documents</h5>
                <button type="button" class="btn btn-sm btn-secondary" id="add-legal-doc">
                    <i class="fas fa-plus"></i> Add Document
                </button>
            </div>
            <div class="card-body">
                <div id="legal-docs-container">
                    @if(isset($legal_documents) && count($legal_documents) > 0)
                        @foreach($legal_documents as $index => $document)
                            <div class="legal-doc-item mb-4 border p-3" data-index="{{ $index }}">
                                <input type="hidden" name="legal_documents[{{ $index }}][id]" value="{{ $document->id }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Document Type*</label>
                                            <input type="text" class="form-control" name="legal_documents[{{ $index }}][type]"
                                                   value="{{ old('legal_documents.'.$index.'.type', $document->title) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="legal_documents[{{ $index }}][description]">{{ old('legal_documents.'.$index.'.description', $document->description) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-sm remove-legal-doc">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Upload Document (JPG, PNG, PDF, JPEG)*</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="legal_documents[{{ $index }}][document]"
                                                       accept=".jpg,.jpeg,.png,.pdf" {{ $document->file_path ? '' : 'required' }}>
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                            @if($document->file_path)
                                                <small class="text-muted mt-1 d-block">
                                                    Current file:
                                                    <a href="{{ asset($document->file_path) }}" target="_blank">
                                                        {{ basename($document->file_path) }}
                                                    </a>
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Template for new legal document (hidden by default) -->
                        <div class="legal-doc-item mb-4 border p-3" data-index="0" style="display: none;">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Document Type*</label>
                                        <input type="text" class="form-control" name="legal_documents[0][type]" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="legal_documents[0][description]"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-sm remove-legal-doc">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Upload Document (JPG, PNG, PDF, JPEG)*</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="legal_documents[0][document]"
                                                   accept=".jpg,.jpeg,.png,.pdf">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ isset($plot) ? __('Update Plot') : __('Save Plot') }}
        </button>
        <a href="{{ route('admin.plots') }}" class="btn btn-secondary">
            {{ __('Cancel') }}
        </a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Expenses functionality
        const expensesContainer = document.getElementById('expenses-container');
        const addExpenseBtn = document.getElementById('add-expense');

        // Add new expense
        addExpenseBtn.addEventListener('click', function () {
            const expenseItems = document.querySelectorAll('.expense-item');
            const lastIndex = expenseItems.length > 0 ?
                parseInt(expenseItems[expenseItems.length - 1].getAttribute('data-index')) : -1;
            const newIndex = lastIndex + 1;

            // Clone the template (first item)
            const template = expensesContainer.querySelector('.expense-item');
            const newExpense = template.cloneNode(true);
            newExpense.setAttribute('data-index', newIndex);
            newExpense.style.display = 'block';

            // Update all the names in the inputs
            newExpense.querySelectorAll('input, textarea, select').forEach(element => {
                if (element.name) {
                    element.name = element.name.replace('[0]', `[${newIndex}]`);
                    element.value = '';
                }
            });

            // Update file input label
            newExpense.querySelectorAll('.custom-file-input').forEach(input => {
                input.nextElementSibling.textContent = 'Choose file';
            });

            expensesContainer.appendChild(newExpense);
        });

        // Remove expense
        expensesContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-expense')) {
                const expenseItem = e.target.closest('.expense-item');
                if (document.querySelectorAll('.expense-item').length > 1) {
                    expenseItem.remove();
                } else {
                    // If it's the last one, just clear the values
                    expenseItem.querySelectorAll('input, textarea').forEach(element => {
                        element.value = '';
                    });
                    expenseItem.querySelectorAll('.custom-file-input').forEach(input => {
                        input.nextElementSibling.textContent = 'Choose file';
                    });
                }
            }
        });

        // Legal Documents functionality
        const legalDocsContainer = document.getElementById('legal-docs-container');
        const addLegalDocBtn = document.getElementById('add-legal-doc');

        // Add new legal document
        addLegalDocBtn.addEventListener('click', function () {
            const legalDocItems = document.querySelectorAll('.legal-doc-item');
            const lastIndex = legalDocItems.length > 0 ?
                parseInt(legalDocItems[legalDocItems.length - 1].getAttribute('data-index')) : -1;
            const newIndex = lastIndex + 1;

            // Clone the template (first item)
            const template = legalDocsContainer.querySelector('.legal-doc-item');
            const newLegalDoc = template.cloneNode(true);
            newLegalDoc.setAttribute('data-index', newIndex);
            newLegalDoc.style.display = 'block';

            // Update all the names in the inputs
            newLegalDoc.querySelectorAll('input, textarea, select').forEach(element => {
                if (element.name) {
                    element.name = element.name.replace('[0]', `[${newIndex}]`);
                    element.value = '';
                }
            });

            // Update file input label
            newLegalDoc.querySelectorAll('.custom-file-input').forEach(input => {
                input.nextElementSibling.textContent = 'Choose file';
            });

            legalDocsContainer.appendChild(newLegalDoc);
        });

        // Remove legal document
        legalDocsContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-legal-doc')) {
                const legalDocItem = e.target.closest('.legal-doc-item');
                if (document.querySelectorAll('.legal-doc-item').length > 1) {
                    legalDocItem.remove();
                } else {
                    // If it's the last one, just clear the values
                    legalDocItem.querySelectorAll('input, textarea').forEach(element => {
                        element.value = '';
                    });
                    legalDocItem.querySelectorAll('.custom-file-input').forEach(input => {
                        input.nextElementSibling.textContent = 'Choose file';
                    });
                }
            }
        });

        // File input label update for both sections
        const fileInputs = document.querySelectorAll('.custom-file-input');
        fileInputs.forEach(input => {
            input.addEventListener('change', function () {
                const label = this.nextElementSibling;
                const files = this.files;
                if (files.length > 0) {
                    label.textContent = files[0].name;
                } else {
                    label.textContent = 'Choose file';
                }
            });
        });

        // Initialize existing items
        document.querySelectorAll('.expense-item').forEach(item => {
            if (item.style.display !== 'none') {
                item.style.display = 'block';
            }
        });

        document.querySelectorAll('.legal-doc-item').forEach(item => {
            if (item.style.display !== 'none') {
                item.style.display = 'block';
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Calculate total price when area or price per unit changes
        const areaInput = document.getElementById('area');
        const pricePerUnitInput = document.getElementById('price_per_unit');
        const totalPriceInput = document.getElementById('total_price');

        function calculateTotalPrice() {
            const area = parseFloat(areaInput.value) || 0;
            const pricePerUnit = parseFloat(pricePerUnitInput.value) || 0;
            totalPriceInput.value = (area * pricePerUnit).toFixed(2);
        }

        areaInput.addEventListener('change', calculateTotalPrice);
        pricePerUnitInput.addEventListener('change', calculateTotalPrice);
    });
</script>

<script>
    document.getElementById('land_parcel_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const availableArea = selectedOption.getAttribute('data-available-area');

        // Update the max attribute of the area input
        document.getElementById('area').max = availableArea;

        // Optional: Reset the area value if it exceeds the new max
        const areaInput = document.getElementById('area');
        if (parseFloat(areaInput.value) > parseFloat(availableArea)) {
            areaInput.value = availableArea;
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const landParcelSelect = document.getElementById('land_parcel_id');
        if (landParcelSelect.value) {
            const event = new Event('change');
            landParcelSelect.dispatchEvent(event);
        }
    });
</script>
