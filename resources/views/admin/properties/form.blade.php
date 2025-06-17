<div class="container-fluid">
    <!-- Basic Information Section -->
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-gray text-black">
                    <h5 class="mb-0">Basic Information</h5>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title*</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $landParcel->title ?? '') }}" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="2">{{ old('description', $landParcel->description ?? '') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="land_type">Land Type*</label>
                        <select class="form-control @error('land_type') is-invalid @enderror" id="land_type" name="land_type" required>
                            <option value="">Select Type</option>
                            <option value="residential" {{ old('land_type', $landParcel->land_type ?? '') == 'residential' ? 'selected' : '' }}>Residential</option>
                            <option value="commercial" {{ old('land_type', $landParcel->land_type ?? '') == 'commercial' ? 'selected' : '' }}>Commercial</option>
                            <option value="agricultural" {{ old('land_type', $landParcel->land_type ?? '') == 'agricultural' ? 'selected' : '' }}>Agricultural</option>
                            <option value="industrial" {{ old('land_type', $landParcel->land_type ?? '') == 'industrial' ? 'selected' : '' }}>Industrial</option>
                        </select>
                        @error('land_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="district">District*</label>
                        <input type="text" class="form-control @error('district') is-invalid @enderror" id="district" name="district" value="{{ old('district', $landParcel->district ?? '') }}" required>
                        @error('district')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="municipality">Municipality*</label>
                        <input type="text" class="form-control @error('municipality') is-invalid @enderror" id="municipality" name="municipality" value="{{ old('municipality', $landParcel->municipality ?? '') }}" required>
                        @error('municipality')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="ward_no">Ward No*</label>
                        <input type="number" class="form-control @error('ward_no') is-invalid @enderror" id="ward_no" name="ward_no" value="{{ old('ward_no', $landParcel->ward_no ?? '') }}" required>
                        @error('ward_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <!-- Location Details Card -->
            <div class="card mb-4">
                <div class="card-header bg-gray text-black">
                    <h5 class="mb-0">Location Details</h5>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="kitta_no">Kitta No*</label>
                        <input type="number" class="form-control @error('kitta_no') is-invalid @enderror" id="kitta_no" name="kitta_no" value="{{ old('kitta_no', $landParcel->kitta_no ?? '') }}" required>
                        @error('kitta_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="dhoor">Dhoor (Traditional Measurement)</label>
                        <input type="number" class="form-control @error('dhoor') is-invalid @enderror" id="dhoor" name="dhoor" value="{{ old('dhoor', $landParcel->dhoor ?? '') }}">
                        @error('dhoor')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="total_area">Sq.Meter</label>
                        <input type="number" class="form-control @error('total_area') is-invalid @enderror" id="total_area" name="total_area" value="{{ old('total_area', $landParcel->total_area ?? '') }}">
                        @error('total_area')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="location">Location Address</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $landParcel->location ?? '') }}">
                        @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="map_coordinates">Map Coordinates</label>
                        <input type="text" class="form-control @error('map_coordinates') is-invalid @enderror" id="map_coordinates" name="map_coordinates"
                               placeholder="e.g., 27.7172° N, 85.3240° E" value="{{ old('map_coordinates', $landParcel->map_coordinates ?? '') }}">
                        @error('map_coordinates')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="thali_amount">Thali Amount</label>
                        <input type="number" class="form-control @error('thali_amount') is-invalid @enderror" id="thali_amount" name="thali_amount"
                               placeholder="12380" value="{{ old('thali_amount', $landParcel->thali_amount ?? '') }}">
                        @error('thali_amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Transaction Details Section -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header bg-gray text-black">
                    <h5 class="mb-0">Transaction Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="purchase_date">Purchase Date*</label>
                                <input type="date" class="form-control @error('purchase_date') is-invalid @enderror" id="purchase_date" name="purchase_date"
                                       value="{{ old('purchase_date', isset($landParcel->purchase_date) ? \Carbon\Carbon::parse($landParcel->purchase_date)->format('Y-m-d') : '') }}" required>
                                @error('purchase_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="purchase_price">Purchase Price*</label>
                                <input type="number" step="0.01" class="form-control @error('purchase_price') is-invalid @enderror" id="purchase_price"
                                       name="purchase_price" value="{{ old('purchase_price', $landParcel->purchase_price ?? '') }}" required>
                                @error('purchase_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="purchase_from">Purchased From*</label>
                        <input type="text" class="form-control @error('purchase_from') is-invalid @enderror" id="purchase_from" name="purchase_from" value="{{ old('purchase_from', $landParcel->purchase_from ?? '') }}" required>
                        @error('purchase_from')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
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
                                                       value="{{ old('expenses.'.$index.'.date', \Carbon\Carbon::parse($expense->date)->format('Y-m-d')) }}" required>
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

    <!-- Additional Information -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header bg-gray text-black">
                    <h5 class="mb-0">Additional Information</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="remarks">Remarks</label>
                        <textarea class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks" rows="3">{{ old('remarks', $landParcel->remarks ?? '') }}</textarea>
                        @error('remarks')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Submission -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary btn-lg">{{ isset($landParcel) ? 'Update' : 'Save' }} Land Parcel</button>
            <button type="reset" class="btn btn-secondary btn-lg ml-2">Reset Form</button>
            @if(isset($landParcel))
                <a href="{{ route('admin.properties') }}" class="btn btn-outline-danger btn-lg ml-2">Cancel</a>
            @endif
        </div>
    </div>
</div>

<!-- JavaScript for dynamic fields -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle loan details
        const hasLoanCheckbox = document.getElementById('has_loan');
        const loanDetails = document.getElementById('loan-details');

        function toggleLoanDetails() {
            loanDetails.style.display = hasLoanCheckbox.checked ? 'flex' : 'none';
        }

        hasLoanCheckbox.addEventListener('change', toggleLoanDetails);
        toggleLoanDetails(); // Initialize on page load

        // File input label update
        const fileInputs = document.querySelectorAll('.custom-file-input');
        fileInputs.forEach(input => {
            input.addEventListener('change', function() {
                const label = this.nextElementSibling;
                const files = this.files;
                if (files.length > 0) {
                    if (files.length === 1) {
                        label.textContent = files[0].name;
                    } else {
                        label.textContent = files.length + ' files selected';
                    }
                } else {
                    label.textContent = 'Choose file';
                }
            });
        });

        // Preview selected files
        const documentsInput = document.getElementById('documents');
        const fileList = document.querySelector('.file-list');

        if (documentsInput) {
            documentsInput.addEventListener('change', function() {
                fileList.innerHTML = '';
                Array.from(this.files).forEach(file => {
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                    listItem.innerHTML = `
                        ${file.name}
                        <span class="badge badge-primary badge-pill">${(file.size / 1024 / 1024).toFixed(2)} MB</span>
                    `;
                    fileList.appendChild(listItem);
                });
            });
        }

        // Handle document deletion
        const deleteButtons = document.querySelectorAll('.delete-document');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this document?')) {
                    const documentId = this.getAttribute('data-id');
                    fetch(`/admin/properties/delete-document/${documentId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.closest('.col-md-3').remove();
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    });


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


