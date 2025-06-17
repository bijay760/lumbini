@extends('admin.layouts.app')
@section('title', 'Properties Merge | Lumbini Innovate')
<style>
    .dropdown-menu {
        max-height: 300px;
        overflow-y: auto;
    }
</style>
@section('content')
    <div class="container-fluid py-3">
        <div class="mb-4 card-header">
            <h4 class="mb-0 text-muted" style="font-size: 12px;">
                <a href="" class="text-decoration-none text-muted">Properties | Merge | #</a>
            </h4>
        </div>
        <form id="propertyRegistrationForm" method="POST" action="{{ route('admin.properties.mergeStore') }}"
              enctype="multipart/form-data">
            @csrf
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header bg-gray text-black">
                                <h5 class="mb-0">Merger Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="merging_properties">Select Property*</label>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle w-100 text-left" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <span id="selected-text">None selected</span>
                                        </button>
                                        <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                            <div class="px-3 py-2">
                                                <!-- INSERT THE FOREACH LOOP HERE -->
                                                @foreach($landParcels as $landParcel)
                                                    <div class="form-check">
                                                        <input class="form-check-input property-checkbox"
                                                               type="checkbox"
                                                               name="merging_properties[]"
                                                               id="prop-{{ $landParcel['id'] }}"
                                                               value="{{ $landParcel['id'] }}"
                                                               data-dhoor="{{ $landParcel['dhoor'] }}"
                                                               data-area="{{ $landParcel['total_area'] }}" required
                                                            {{ (collect(old('merging_properties', $selectedProperties ?? []))->contains($landParcel['id'])) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                               for="prop-{{ $landParcel['id'] }}">
                                                            {{ $landParcel['title'] }}
                                                            (Dhoor: {{ $landParcel['dhoor'] }},
                                                            Area: {{ $landParcel['total_area'] }} sq.m)
                                                        </label>
                                                    </div>
                                                @endforeach
                                                <!-- END OF FOREACH LOOP -->
                                            </div>
                                        </div>
                                    </div>
                                    <div id="selection-error" class="text-danger small mt-2" style="display: none;">
                                        Please select at least 2 properties
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card mb-4">
                            <div class="card-header bg-gray text-black">
                                <h5 class="mb-0">Basic Information</h5>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title*</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title"
                                           name="title" value="{{ old('title', $landParcel->title ?? '') }}" required>
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description" name="description"
                                              rows="2">{{ old('description', $landParcel->description ?? '') }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="land_type">Land Type*</label>
                                    <select class="form-control @error('land_type') is-invalid @enderror" id="land_type"
                                            name="land_type" required>
                                        <option value="">Select Type</option>
                                        <option
                                            value="residential" {{ old('land_type', $landParcel->land_type ?? '') == 'residential' ? 'selected' : '' }}>
                                            Residential
                                        </option>
                                        <option
                                            value="commercial" {{ old('land_type', $landParcel->land_type ?? '') == 'commercial' ? 'selected' : '' }}>
                                            Commercial
                                        </option>
                                        <option
                                            value="agricultural" {{ old('land_type', $landParcel->land_type ?? '') == 'agricultural' ? 'selected' : '' }}>
                                            Agricultural
                                        </option>
                                        <option
                                            value="industrial" {{ old('land_type', $landParcel->land_type ?? '') == 'industrial' ? 'selected' : '' }}>
                                            Industrial
                                        </option>
                                    </select>
                                    @error('land_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="district">District*</label>
                                    <input type="text" class="form-control @error('district') is-invalid @enderror"
                                           id="district" name="district"
                                           value="{{ old('district', $landParcel->district ?? '') }}" required>
                                    @error('district')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="municipality">Municipality*</label>
                                    <input type="text" class="form-control @error('municipality') is-invalid @enderror"
                                           id="municipality" name="municipality"
                                           value="{{ old('municipality', $landParcel->municipality ?? '') }}" required>
                                    @error('municipality')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="ward_no">Ward No*</label>
                                    <input type="number" class="form-control @error('ward_no') is-invalid @enderror"
                                           id="ward_no" name="ward_no"
                                           value="{{ old('ward_no', $landParcel->ward_no ?? '') }}" required>
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
                                    <input type="number" class="form-control @error('kitta_no') is-invalid @enderror"
                                           id="kitta_no" name="kitta_no"
                                           value="{{ old('kitta_no', $landParcel->kitta_no ?? '') }}" required>
                                    @error('kitta_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="dhoor">Dhoor (Traditional Measurement)</label>
                                    <input type="number" class="form-control @error('dhoor') is-invalid @enderror"
                                           id="dhoor" name="dhoor" readonly>
                                    @error('dhoor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="total_area">Sq.Meter</label>
                                    <input type="number" class="form-control @error('total_area') is-invalid @enderror"
                                           id="total_area" name="total_area" readonly>
                                    @error('total_area')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="thali_amount">Thali Amount</label>
                                    <input type="number" class="form-control @error('thali_amount') is-invalid @enderror"
                                           id="thali_amount" name="thali_amount" readonly>
                                    @error('thali_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="location">Location Address</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                           id="location" name="location"
                                           value="{{ old('location', $landParcel->location ?? '') }}">
                                    @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="map_coordinates">Map Coordinates</label>
                                    <input type="text"
                                           class="form-control @error('map_coordinates') is-invalid @enderror"
                                           id="map_coordinates" name="map_coordinates"
                                           placeholder="e.g., 27.7172° N, 85.3240° E"
                                           value="{{ old('map_coordinates', $landParcel->map_coordinates ?? '') }}">
                                    @error('map_coordinates')
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
                                                <input type="hidden" name="expenses[{{ $index }}][id]"
                                                       value="{{ $expense->id }}">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Date*</label>
                                                            <input type="date" class="form-control"
                                                                   name="expenses[{{ $index }}][date]"
                                                                   value="{{ old('expenses.'.$index.'.date', \Carbon\Carbon::parse($expense->date)->format('Y-m-d')) }}"
                                                                   required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Subject*</label>
                                                            <input type="text" class="form-control"
                                                                   name="expenses[{{ $index }}][subject]"
                                                                   value="{{ old('expenses.'.$index.'.subject', $expense->subject) }}"
                                                                   required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Amount*</label>
                                                            <input type="number" step="0.01" class="form-control"
                                                                   name="expenses[{{ $index }}][amount]"
                                                                   value="{{ old('expenses.'.$index.'.amount', $expense->amount) }}"
                                                                   required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Remarks</label>
                                                            <input type="text" class="form-control"
                                                                   name="expenses[{{ $index }}][remarks]"
                                                                   value="{{ old('expenses.'.$index.'.remarks', $expense->remarks) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 d-flex align-items-end">
                                                        <button type="button"
                                                                class="btn btn-danger btn-sm remove-expense">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Document (JPG, PNG, PDF, JPEG)</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                       name="expenses[{{ $index }}][document]"
                                                                       accept=".jpg,.jpeg,.png,.pdf">
                                                                <label class="custom-file-label">Choose file</label>
                                                            </div>
                                                            @if($expense->file_path)
                                                                <small class="text-muted mt-1 d-block">
                                                                    Current file:
                                                                    <a href="{{ asset($expense->file_path) }}"
                                                                       target="_blank">
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
                                                        <input type="date" class="form-control"
                                                               name="expenses[0][date]">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Subject*</label>
                                                        <input type="text" class="form-control"
                                                               name="expenses[0][subject]">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Amount*</label>
                                                        <input type="number" step="0.01" class="form-control"
                                                               name="expenses[0][amount]">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Remarks</label>
                                                        <input type="text" class="form-control"
                                                               name="expenses[0][remarks]">
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
                                                            <input type="file" class="custom-file-input"
                                                                   name="expenses[0][document]"
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
                                                <input type="hidden" name="legal_documents[{{ $index }}][id]"
                                                       value="{{ $document->id }}">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Document Type*</label>
                                                            <input type="text" class="form-control"
                                                                   name="legal_documents[{{ $index }}][type]"
                                                                   value="{{ old('legal_documents.'.$index.'.type', $document->title) }}"
                                                                   required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea class="form-control"
                                                                      name="legal_documents[{{ $index }}][description]">{{ old('legal_documents.'.$index.'.description', $document->description) }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 d-flex align-items-end">
                                                        <button type="button"
                                                                class="btn btn-danger btn-sm remove-legal-doc">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Upload Document (JPG, PNG, PDF, JPEG)*</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                       name="legal_documents[{{ $index }}][document]"
                                                                       accept=".jpg,.jpeg,.png,.pdf" {{ $document->file_path ? '' : 'required' }}>
                                                                <label class="custom-file-label">Choose file</label>
                                                            </div>
                                                            @if($document->file_path)
                                                                <small class="text-muted mt-1 d-block">
                                                                    Current file:
                                                                    <a href="{{ asset($document->file_path) }}"
                                                                       target="_blank">
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
                                        <div class="legal-doc-item mb-4 border p-3" data-index="0"
                                             style="display: none;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Document Type*</label>
                                                        <input type="text" class="form-control"
                                                               name="legal_documents[0][type]">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea class="form-control"
                                                                  name="legal_documents[0][description]"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    <button type="button"
                                                            class="btn btn-danger btn-sm remove-legal-doc">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Upload Document (JPG, PNG, PDF, JPEG)*</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   name="legal_documents[0][document]"
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
                                    <textarea class="form-control @error('remarks') is-invalid @enderror" id="remarks"
                                              name="remarks"
                                              rows="3">{{ old('remarks', $landParcel->remarks ?? '') }}</textarea>
                                    @error('remarks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Submission -->
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{__('Save') }}
                        </button>
                        <a href="{{ route('admin.plots') }}" class="btn btn-secondary">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        $(document).ready(function () {
            // Keep dropdown open when clicking checkboxes
            $('.dropdown-menu').on('click', function (e) {
                e.stopPropagation();
            });

            // Update on checkbox change
            $(document).on('change', '.property-checkbox', function () {
                updateSelectedText();
                calculateTotals();
                validateSelection();
            });

            function updateSelectedText() {
                const count = $('.property-checkbox:checked').length;
                $('#selected-text').text(count === 0 ? 'None selected' : `${count} selected`);
            }

            function calculateTotals() {
                let totalDhoor = 0, totalArea = 0, total_thali=0;
                $('.property-checkbox:checked').each(function () {
                    totalDhoor += parseFloat($(this).data('dhoor')) || 0;
                    totalArea += parseFloat($(this).data('area')) || 0;
                    total_thali += parseFloat($(this).data('thali_amount')) || 0;
                });
                $('#dhoor').val(totalDhoor.toFixed(2));
                $('#total_area').val(totalArea.toFixed(2));
                $('#thali_amount').val(total_thali.toFixed(2));
            }

            function validateSelection() {
                const count = $('.property-checkbox:checked').length;
                if (count < 2) {
                    $('#selection-error').show();
                    // Disable form submission
                    $('form').find('button[type="submit"]').prop('disabled', true);
                } else {
                    $('#selection-error').hide();
                    // Enable form submission
                    $('form').find('button[type="submit"]').prop('disabled', false);
                }
            }

            // Form submission validation
            $('form').on('submit', function (e) {
                const count = $('.property-checkbox:checked').length;
                if (count < 2) {
                    e.preventDefault();
                    $('#selection-error').show();
                    return false;
                }
                return true;
            });

            // Initialize if any checkboxes are pre-checked
            updateSelectedText();
            calculateTotals();
            validateSelection(); // Check on page load
        });
    </script>
@endsection
