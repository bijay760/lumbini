<div class="container-fluid">
    <!-- Basic Information Section -->
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
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
                        <label for="ownership_type">Ownership Type*</label>
                        <select class="form-control @error('ownership_type') is-invalid @enderror" id="ownership_type" name="ownership_type" required>
                            <option value="">Select Type</option>
                            <option value="freehold" {{ old('ownership_type', $landParcel->ownership_type ?? '') == 'freehold' ? 'selected' : '' }}>Freehold</option>
                            <option value="leasehold" {{ old('ownership_type', $landParcel->ownership_type ?? '') == 'leasehold' ? 'selected' : '' }}>Leasehold</option>
                            <option value="government" {{ old('ownership_type', $landParcel->ownership_type ?? '') == 'government' ? 'selected' : '' }}>Government</option>
                        </select>
                        @error('ownership_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <!-- Location Details Card -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Location Details</h5>
                </div>
                <div class="card-body">
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
                        <input type="text" class="form-control @error('ward_no') is-invalid @enderror" id="ward_no" name="ward_no" value="{{ old('ward_no', $landParcel->ward_no ?? '') }}" required>
                        @error('ward_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kitta_no">Kitta No*</label>
                        <input type="text" class="form-control @error('kitta_no') is-invalid @enderror" id="kitta_no" name="kitta_no" value="{{ old('kitta_no', $landParcel->kitta_no ?? '') }}" required>
                        @error('kitta_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="dhoor">Dhoor (Traditional Measurement)</label>
                        <input type="text" class="form-control @error('dhoor') is-invalid @enderror" id="dhoor" name="dhoor" value="{{ old('dhoor', $landParcel->dhoor ?? '') }}">
                        @error('dhoor')
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
                </div>
            </div>
        </div>
    </div>

    <!-- Area and Valuation Section -->
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Area Details</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="total_area">Total Area (sq.metre)*</label>
                        <input type="number" step="0.01" class="form-control @error('total_area') is-invalid @enderror" id="total_area" name="total_area"
                               value="{{ old('total_area', $landParcel->total_area ?? '') }}" required>
                        @error('total_area')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <!-- Financial Details Card -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Valuation Details</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="government_value">Government Value*</label>
                        <input type="number" step="0.01" class="form-control @error('government_value') is-invalid @enderror" id="government_value"
                               name="government_value" value="{{ old('government_value', $landParcel->government_value ?? '') }}" required>
                        @error('government_value')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="market_value">Market Value</label>
                        <input type="number" step="0.01" class="form-control @error('market_value') is-invalid @enderror" id="market_value" name="market_value" value="{{ old('market_value', $landParcel->market_value ?? '') }}">
                        @error('market_value')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="thali_amount">Thali Amount</label>
                        <input type="number" step="0.01" class="form-control @error('thali_amount') is-invalid @enderror" id="thali_amount" name="thali_amount" value="{{ old('thali_amount', $landParcel->thali_amount ?? '') }}">
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
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Transaction Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="purchase_date">Purchase Date*</label>
                                <input type="date" class="form-control @error('purchase_date') is-invalid @enderror" id="purchase_date" name="purchase_date"
                                       value="{{ old('purchase_date', isset($landParcel->purchase_date) ? $landParcel->purchase_date : '') }}" required>

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
                    <div class="form-group">
                        <label for="registration_number">Registration Number</label>
                        <input type="text" class="form-control @error('registration_number') is-invalid @enderror" id="registration_number" name="registration_number" value="{{ old('registration_number', $landParcel->registration_number ?? '') }}">
                        @error('registration_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-check mb-3">
                        <!-- Hidden input to send 0 if checkbox is unchecked -->
                        <input type="hidden" name="has_loan" value="0">

                        <!-- Checkbox input to send 1 if checked -->
                        <input class="form-check-input" type="checkbox" id="has_loan" name="has_loan" value="1"
                            {{ old('has_loan', $landParcel->has_loan ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="has_loan">
                            Has Loan?
                        </label>
                    </div>

                    <div class="row" id="loan-details" style="display: none;">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="loan_amount">Loan Amount</label>
                                <input type="number" step="0.01" class="form-control @error('loan_amount') is-invalid @enderror" id="loan_amount"
                                       name="loan_amount" value="{{ old('loan_amount', $landParcel->loan_amount ?? '') }}">
                                @error('loan_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="loan_institution">Loan Institution</label>
                                <input type="text" class="form-control @error('loan_institution') is-invalid @enderror" id="loan_institution" name="loan_institution" value="{{ old('loan_institution', $landParcel->loan_institution ?? '') }}">
                                @error('loan_institution')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tax and Charges</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="government_tax">Government Tax*</label>
                                <input type="number" step="0.01" class="form-control @error('government_tax') is-invalid @enderror" id="government_tax"
                                       name="government_tax" value="{{ old('government_tax', $landParcel->government_tax ?? '') }}" required>
                                @error('government_tax')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="non_government_charges">Non-Government Charges*</label>
                                <input type="number" step="0.01" class="form-control @error('non_government_charges') is-invalid @enderror" id="non_government_charges"
                                       name="non_government_charges" value="{{ old('non_government_charges', $landParcel->non_government_charges ?? '') }}" required>
                                @error('non_government_charges')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tax_remarks">Tax Remarks</label>
                        <textarea class="form-control @error('tax_remarks') is-invalid @enderror" id="tax_remarks" name="tax_remarks" rows="2">{{ old('tax_remarks', $landParcel->tax_remarks ?? '') }}</textarea>
                        @error('tax_remarks')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Supporting Document (PDF, JPG, PNG)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('tax_files') is-invalid @enderror" name="tax_files"
                                   accept=".pdf,.jpg,.jpeg,.png">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                        @error('tax_files')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if(isset($landParcel) && $landParcel->tax_files)
                            <small class="text-muted">Current file: {{ $landParcel->tax_files }}</small>
                        @endif

                        <!-- Display existing documents -->
                        @if(isset($images) && $images->count() > 0)
                            <div class="mt-3">
                                <h6>Existing Documents:</h6>
                                <div class="row">
                                    @foreach($images as $image)
                                        @if($image->type=='tax')
                                            <div class="col-md-3 mb-3">
                                                <div class="document-thumbnail">
                                                    @if(in_array(pathinfo($image->image_name, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                        <img src="{{ asset($image->image_name) }}" class="img-thumbnail" alt="Document Image">
                                                    @else
                                                        <div class="document-placeholder">
                                                            <i class="fas fa-file-pdf fa-3x"></i>
                                                        </div>
                                                    @endif
                                                    <div class="document-actions mt-2">
                                                        <a href="{{ asset($image->image_name) }}" target="_blank" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i> View
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger delete-document" data-id="{{ $image->id }}">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Document Upload Section -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Document Upload</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Upload Supporting Documents (PDF, JPG, JPEG, PNG)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('documents') is-invalid @enderror" id="documents" name="documents" multiple
                                   accept=".pdf,.jpg,.jpeg,.png">
                            <label class="custom-file-label" for="documents">Choose files</label>
                        </div>
                        @error('documents')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Display existing documents -->
                    @if(isset($images) && $images->count() > 0)
                        <div class="mt-3">
                            <h6>Existing Documents:</h6>
                            <div class="row">
                                @foreach($images as $image)
                                    @if($image->type=='purchase')
                                        <div class="col-md-3 mb-3">
                                            <div class="document-thumbnail">
                                                @if(in_array(pathinfo($image->image_name, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ asset($image->image_name) }}" class="img-thumbnail" alt="Document Image">
                                                @else
                                                    <div class="document-placeholder">
                                                        <i class="fas fa-file-pdf fa-3x"></i>
                                                    </div>
                                                @endif
                                                <div class="document-actions mt-2">
                                                    <a href="{{ asset($image->image_name) }}" target="_blank" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger delete-document" data-id="{{ $image->id }}">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Preview of newly uploaded files -->
                    <div class="uploaded-files-preview mt-3">
                        <h6>Selected Files:</h6>
                        <ul class="list-group file-list"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
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
                    <div class="form-check">
                        <!-- Hidden input to ensure '0' is submitted when unchecked -->
                        <input type="hidden" name="is_approved" value="0">

                        <!-- Checkbox to submit '1' when checked -->
                        <input class="form-check-input" type="checkbox" id="is_approved" name="is_approved" value="1"
                            {{ old('is_approved', $landParcel->is_approved ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_approved">
                            Is Approved
                        </label>
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
</script>


