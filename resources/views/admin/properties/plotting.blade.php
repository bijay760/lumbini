@extends('admin.layouts.app')
@section('title', 'Plot Division | Lumbini Innovate')
@section('content')
<div class="container-fluid py-3">
    <div class="mb-3 card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-muted" style="font-size: 12px;">
                <a href="{{route('admin.properties')}}" class="text-decoration-none text-muted">Properties</a> / Plotting
            </h4>
            <a href="{{route('admin.properties')}}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <form id="plottingForm" method="POST" action="{{ route('admin.properties.plotting.store', ['id' => $landParcel->id]) }}" enctype="multipart/form-data">
        @csrf

        <!-- Land Parcel Information -->
        <div class="card shadow-sm mb-3">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0"><i class="fas fa-info-circle"></i> Land Parcel Information</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <strong>Title:</strong> {{ $landParcel->title }}
                    </div>
                    <div class="col-md-2">
                        <strong>Kitta:</strong> {{ $landParcel->kitta_no }}
                    </div>
                    <div class="col-md-2">
                        <strong>Total Area:</strong> <span class="text-primary">{{ $landParcel->total_area }} {{ $landParcel->area_unit ?? 'sq.m' }}</span>
                    </div>
                    <div class="col-md-2">
                        <strong>Available:</strong> <span class="text-success">{{ $landParcel->available_area }} {{ $landParcel->area_unit ?? 'sq.m' }}</span>
                    </div>
                    <div class="col-md-3">
                        <strong>Location:</strong> {{ $landParcel->municipality }}, Ward {{ $landParcel->ward_no }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Deductions -->
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-minus-circle"></i> Area Deductions</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Road Area ({{ $landParcel->area_unit ?? 'sq.m' }})</label>
                            <input type="number" step="0.01" class="form-control" name="road_area" id="road_area" value="{{ $roadArea }}" onchange="calculateRemaining()">
                            <small class="text-muted">Area reserved for roads</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Other Deductions ({{ $landParcel->area_unit ?? 'sq.m' }})</label>
                            <input type="number" step="0.01" class="form-control" name="other_deductions" id="other_deductions" value="{{ $otherDeductions }}" onchange="calculateRemaining()">
                            <small class="text-muted">Parks, common areas, etc.</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Total Deductions</label>
                            <input type="text" class="form-control bg-light" id="total_deductions" value="0" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Area for Plotting</label>
                            <input type="text" class="form-control bg-light" id="area_for_plotting" value="{{ $landParcel->available_area }}" readonly>
                            <small id="plot_area_warning" class="text-danger" style="display:none;">Warning: Exceeds available area!</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Plots Section -->
        <div class="card shadow-sm mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><i class="fas fa-th"></i> Plot Division</h6>
                <button type="button" class="btn btn-sm btn-success" id="add-plot">
                    <i class="fas fa-plus"></i> Add Plot
                </button>
            </div>
            <div class="card-body">
                <div id="plots-container">
                    @if($existingPlots->count() > 0)
                    @foreach($existingPlots as $index => $existingPlot)
                    <div class="plot-item card mb-3" data-existing="true" data-plot-index="{{ $index + 1 }}" data-plot-id="{{ $existingPlot->id }}">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Plot #<span class="plot-number-display">{{ $index + 1 }}</span> (Existing)</h6>
                            <button type="button" class="btn btn-sm btn-danger remove-plot">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="plots[{{ $index + 1 }}][id]" value="{{ $existingPlot->id }}">
                            <!-- Basic Plot Info -->
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Plot Title*</label>
                                        <input type="text" class="form-control form-control-sm" name="plots[{{ $index + 1 }}][title]" value="{{ $existingPlot->title }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Plot Number*</label>
                                        <input type="text" class="form-control form-control-sm" name="plots[{{ $index + 1 }}][plot_number]" value="{{ $existingPlot->plot_number }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Status*</label>
                                        <select class="form-control form-control-sm" name="plots[{{ $index + 1 }}][status]" required>
                                            <option value="available" {{ $existingPlot->status == 'available' ? 'selected' : '' }}>Available</option>
                                            <option value="reserved" {{ $existingPlot->status == 'reserved' ? 'selected' : '' }}>Reserved</option>
                                            <option value="sold" {{ $existingPlot->status == 'sold' ? 'selected' : '' }}>Sold</option>
                                            <option value="blocked" {{ $existingPlot->status == 'blocked' ? 'selected' : '' }}>Blocked</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Area ({{ $landParcel->area_unit ?? 'sq.m' }})*</label>
                                        <input type="number" step="0.01" class="form-control form-control-sm plot-area" name="plots[{{ $index + 1 }}][area]" value="{{ $existingPlot->area }}" required onchange="calculateTotals()">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Dimensions</label>
                                        <input type="text" class="form-control form-control-sm" name="plots[{{ $index + 1 }}][dimensions]" value="{{ $existingPlot->dimensions }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Facing Direction</label>
                                        <select class="form-control form-control-sm" name="plots[{{ $index + 1 }}][facing_direction]">
                                            <option value="">Select</option>
                                            <option value="North" {{ $existingPlot->facing_direction == 'North' ? 'selected' : '' }}>North</option>
                                            <option value="South" {{ $existingPlot->facing_direction == 'South' ? 'selected' : '' }}>South</option>
                                            <option value="East" {{ $existingPlot->facing_direction == 'East' ? 'selected' : '' }}>East</option>
                                            <option value="West" {{ $existingPlot->facing_direction == 'West' ? 'selected' : '' }}>West</option>
                                            <option value="North-East" {{ $existingPlot->facing_direction == 'North-East' ? 'selected' : '' }}>North-East</option>
                                            <option value="North-West" {{ $existingPlot->facing_direction == 'North-West' ? 'selected' : '' }}>North-West</option>
                                            <option value="South-East" {{ $existingPlot->facing_direction == 'South-East' ? 'selected' : '' }}>South-East</option>
                                            <option value="South-West" {{ $existingPlot->facing_direction == 'South-West' ? 'selected' : '' }}>South-West</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Price per Unit (Rs.)*</label>
                                        <input type="number" step="0.01" class="form-control form-control-sm plot-price" name="plots[{{ $index + 1 }}][price_per_unit]" value="{{ $existingPlot->price_per_unit }}" required onchange="calculateTotals()">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Total Price (Rs.)</label>
                                        <input type="text" class="form-control form-control-sm bg-light plot-total-price" value="{{ $existingPlot->total_price }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Features</label>
                                        <input type="text" class="form-control form-control-sm" name="plots[{{ $index + 1 }}][features]" value="{{ $existingPlot->features }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <input type="text" class="form-control form-control-sm" name="plots[{{ $index + 1 }}][remarks]" value="{{ $existingPlot->remarks }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Plot Expenses -->
                            <div class="border-top pt-3 mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0"><i class="fas fa-receipt"></i> Plot Expenses</h6>
                                    <button type="button" class="btn btn-xs btn-secondary add-plot-expense" data-plot-index="{{ $index + 1 }}">
                                        <i class="fas fa-plus"></i> Add Expense
                                    </button>
                                </div>
                                <div class="plot-expenses-container" data-plot-index="{{ $index + 1 }}">
                                    @foreach($existingPlot->expenses as $expIndex => $expense)
                                    <div class="expense-item border rounded p-2 mb-2 bg-light" data-expense-index="{{ $expIndex }}">
                                        <input type="hidden" name="plots[{{ $index + 1 }}][expenses][{{ $expIndex }}][id]" value="{{ $expense->id }}">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input type="date" class="form-control form-control-sm" name="plots[{{ $index + 1 }}][expenses][{{ $expIndex }}][date]" value="{{ $expense->date }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control form-control-sm" name="plots[{{ $index + 1 }}][expenses][{{ $expIndex }}][subject]" value="{{ $expense->subject }}">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" step="0.01" class="form-control form-control-sm" name="plots[{{ $index + 1 }}][expenses][{{ $expIndex }}][amount]" value="{{ $expense->amount }}">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control form-control-sm" name="plots[{{ $index + 1 }}][expenses][{{ $expIndex }}][remarks]" value="{{ $expense->remarks }}">
                                            </div>
                                            <div class="col-md-2">
                                                @if($expense->file_path)
                                                <a href="{{ asset($expense->file_path) }}" target="_blank" class="btn btn-xs btn-info">View</a>
                                                @endif
                                                <input type="file" class="form-control form-control-sm" name="plots[{{ $index + 1 }}][expenses][{{ $expIndex }}][document]" accept=".jpg,.jpeg,.png,.pdf">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-sm btn-danger remove-expense"><i class="fas fa-times"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Plot Legal Documents -->
                            <div class="border-top pt-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0"><i class="fas fa-file-contract"></i> Legal Documents</h6>
                                    <button type="button" class="btn btn-xs btn-secondary add-plot-document" data-plot-index="{{ $index + 1 }}">
                                        <i class="fas fa-plus"></i> Add Document
                                    </button>
                                </div>
                                <div class="plot-documents-container" data-plot-index="{{ $index + 1 }}">
                                    @foreach($existingPlot->legal_documents as $docIndex => $document)
                                    <div class="document-item border rounded p-2 mb-2 bg-light" data-document-index="{{ $docIndex }}">
                                        <input type="hidden" name="plots[{{ $index + 1 }}][legal_documents][{{ $docIndex }}][id]" value="{{ $document->id }}">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" class="form-control form-control-sm" name="plots[{{ $index + 1 }}][legal_documents][{{ $docIndex }}][type]" value="{{ $document->title }}" required>
                                            </div>
                                            <div class="col-md-4">
                                                <textarea class="form-control form-control-sm" name="plots[{{ $index + 1 }}][legal_documents][{{ $docIndex }}][description]" rows="1">{{ $document->description }}</textarea>
                                            </div>
                                            <div class="col-md-4">
                                                @if($document->file_path)
                                                <a href="{{ asset($document->file_path) }}" target="_blank" class="btn btn-xs btn-info">View</a>
                                                @endif
                                                <input type="file" class="form-control form-control-sm" name="plots[{{ $index + 1 }}][legal_documents][{{ $docIndex }}][document]" accept=".jpg,.jpeg,.png,.pdf">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-sm btn-danger remove-document"><i class="fas fa-times"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

                <!-- Summary -->
                <div class="alert alert-info mt-3">
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Total Plots:</strong> <span id="total_plots_count">0</span>
                        </div>
                        <div class="col-md-3">
                            <strong>Total Plot Area:</strong> <span id="total_plot_area">0</span> {{ $landParcel->area_unit ?? 'sq.m' }}
                        </div>
                        <div class="col-md-3">
                            <strong>Remaining Area:</strong> <span id="remaining_area" class="text-success">{{ $landParcel->available_area }}</span> {{ $landParcel->area_unit ?? 'sq.m' }}
                        </div>
                        <div class="col-md-3">
                            <strong>Total Plot Value:</strong> Rs. <span id="total_plot_value">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="text-end mb-3">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save"></i> Save Plotting
            </button>
        </div>
    </form>
</div>

<!-- Plot Template (Hidden) -->
<template id="plot-template">
    <div class="plot-item card mb-3" data-plot-index="__INDEX__">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Plot #<span class="plot-number-display">__INDEX__</span></h6>
            <button type="button" class="btn btn-sm btn-danger remove-plot">
                <i class="fas fa-trash"></i> Remove
            </button>
        </div>
        <div class="card-body">
            <!-- Basic Plot Info -->
            <div class="row mb-2">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Plot Title*</label>
                        <input type="text" class="form-control form-control-sm" name="plots[__INDEX__][title]" placeholder="Plot Title" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Plot Number*</label>
                        <input type="text" class="form-control form-control-sm" name="plots[__INDEX__][plot_number]" placeholder="e.g., P-001" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Status*</label>
                        <select class="form-control form-control-sm" name="plots[__INDEX__][status]" required>
                            <option value="available">Available</option>
                            <option value="reserved">Reserved</option>
                            <option value="sold">Sold</option>
                            <option value="blocked">Blocked</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Area ({{ $landParcel->area_unit ?? 'sq.m' }})*</label>
                        <input type="number" step="0.01" class="form-control form-control-sm plot-area" name="plots[__INDEX__][area]" required onchange="calculateTotals()">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Dimensions</label>
                        <input type="text" class="form-control form-control-sm" name="plots[__INDEX__][dimensions]" placeholder="e.g., 20x30">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Facing Direction</label>
                        <select class="form-control form-control-sm" name="plots[__INDEX__][facing_direction]">
                            <option value="">Select</option>
                            <option value="North">North</option>
                            <option value="South">South</option>
                            <option value="East">East</option>
                            <option value="West">West</option>
                            <option value="North-East">North-East</option>
                            <option value="North-West">North-West</option>
                            <option value="South-East">South-East</option>
                            <option value="South-West">South-West</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Price per Unit (Rs.)*</label>
                        <input type="number" step="0.01" class="form-control form-control-sm plot-price" name="plots[__INDEX__][price_per_unit]" required onchange="calculateTotals()">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Total Price (Rs.)</label>
                        <input type="text" class="form-control form-control-sm bg-light plot-total-price" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Features</label>
                        <input type="text" class="form-control form-control-sm" name="plots[__INDEX__][features]" placeholder="e.g., Corner plot, Road access">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Remarks</label>
                        <input type="text" class="form-control form-control-sm" name="plots[__INDEX__][remarks]" placeholder="Additional notes">
                    </div>
                </div>
            </div>

            <!-- Plot Expenses -->
            <div class="border-top pt-3 mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0"><i class="fas fa-receipt"></i> Plot Expenses</h6>
                    <button type="button" class="btn btn-xs btn-secondary add-plot-expense" data-plot-index="__INDEX__">
                        <i class="fas fa-plus"></i> Add Expense
                    </button>
                </div>
                <div class="plot-expenses-container" data-plot-index="__INDEX__">
                    <!-- Expenses will be added here -->
                </div>
            </div>

            <!-- Plot Legal Documents -->
            <div class="border-top pt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0"><i class="fas fa-file-contract"></i> Legal Documents</h6>
                    <button type="button" class="btn btn-xs btn-secondary add-plot-document" data-plot-index="__INDEX__">
                        <i class="fas fa-plus"></i> Add Document
                    </button>
                </div>
                <div class="plot-documents-container" data-plot-index="__INDEX__">
                    <!-- Legal documents will be added here -->
                </div>
            </div>
        </div>
    </div>
</template>

<!-- Expense Template (Hidden) -->
<template id="expense-template">
    <div class="expense-item border rounded p-2 mb-2 bg-light" data-expense-index="__EXP_INDEX__">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group mb-0">
                    <input type="date" class="form-control form-control-sm" name="plots[__PLOT_INDEX__][expenses][__EXP_INDEX__][date]" placeholder="Date">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-0">
                    <input type="text" class="form-control form-control-sm" name="plots[__PLOT_INDEX__][expenses][__EXP_INDEX__][subject]" placeholder="Subject">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group mb-0">
                    <input type="number" step="0.01" class="form-control form-control-sm" name="plots[__PLOT_INDEX__][expenses][__EXP_INDEX__][amount]" placeholder="Amount">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group mb-0">
                    <input type="text" class="form-control form-control-sm" name="plots[__PLOT_INDEX__][expenses][__EXP_INDEX__][remarks]" placeholder="Remarks">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group mb-0">
                    <input type="file" class="form-control form-control-sm" name="plots[__PLOT_INDEX__][expenses][__EXP_INDEX__][document]" accept=".jpg,.jpeg,.png,.pdf">
                </div>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-sm btn-danger remove-expense">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<!-- Legal Document Template (Hidden) -->
<template id="document-template">
    <div class="document-item border rounded p-2 mb-2 bg-light" data-document-index="__DOC_INDEX__">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group mb-0">
                    <input type="text" class="form-control form-control-sm" name="plots[__PLOT_INDEX__][legal_documents][__DOC_INDEX__][type]" placeholder="Document Type" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-0">
                    <textarea class="form-control form-control-sm" name="plots[__PLOT_INDEX__][legal_documents][__DOC_INDEX__][description]" placeholder="Description" rows="1"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-0">
                    <input type="file" class="form-control form-control-sm" name="plots[__PLOT_INDEX__][legal_documents][__DOC_INDEX__][document]" accept=".jpg,.jpeg,.png,.pdf" required>
                </div>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-sm btn-danger remove-document">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    let plotIndex = @json($existingPlots->count());
    const availableArea = parseFloat(@json($landParcel->available_area));
    const totalAreaFromServer = parseFloat(@json($landParcel->total_area));
    const initialRoadArea = parseFloat(@json($roadArea));
    const initialOtherDeductions = parseFloat(@json($otherDeductions));
    const hasExistingPlots = @json($existingPlots->count() > 0);
    const initialTotalPlotArea = @json($existingPlots->sum('area') ?? 0);

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize existing plots first
        initializeExistingPlots();

        // Only add first plot automatically if no existing plots
        if (!hasExistingPlots) {
            addPlot();
        }

        // Add plot button
        document.getElementById('add-plot').addEventListener('click', addPlot);

        // Calculate
        calculateRemaining();
        calculateTotals();
    });

    function addPlot() {
        plotIndex++;
        const template = document.getElementById('plot-template');
        const clone = template.content.cloneNode(true);

        // Replace placeholders
        const html = clone.querySelector('.plot-item').outerHTML
            .replaceAll('__INDEX__', plotIndex);

        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = html;

        document.getElementById('plots-container').appendChild(tempDiv.firstElementChild);

        // Add event listeners
        attachPlotListeners(plotIndex);
        calculateTotals();
    }

    function attachPlotListeners(index) {
        const allPlots = document.querySelectorAll('.plot-item');
        const plotItem = allPlots[allPlots.length - 1]; // Get the last added plot

        // Remove plot
        const removeBtn = plotItem.querySelector('.remove-plot');
        if (removeBtn) {
            removeBtn.addEventListener('click', function() {
                if (confirm('Remove this plot?')) {
                    plotItem.remove();
                    calculateTotals();
                }
            });
        }

        // Add expense
        plotItem.querySelector('.add-plot-expense').addEventListener('click', function() {
            addExpense(index);
        });

        // Add legal document
        plotItem.querySelector('.add-plot-document').addEventListener('click', function() {
            addDocument(index);
        });
    }

    function addExpense(plotIndex) {
        const container = document.querySelector(`.plot-expenses-container[data-plot-index="${plotIndex}"]`);
        const expenseIndex = container.children.length;

        const template = document.getElementById('expense-template');
        const clone = template.content.cloneNode(true);

        const html = clone.querySelector('.expense-item').outerHTML
            .replaceAll('__PLOT_INDEX__', plotIndex)
            .replaceAll('__EXP_INDEX__', expenseIndex);

        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = html;
        const expenseItem = tempDiv.firstElementChild;

        container.appendChild(expenseItem);

        // Remove expense
        expenseItem.querySelector('.remove-expense').addEventListener('click', function() {
            expenseItem.remove();
        });
    }

    function addDocument(plotIndex) {
        const container = document.querySelector(`.plot-documents-container[data-plot-index="${plotIndex}"]`);
        const documentIndex = container.children.length;

        const template = document.getElementById('document-template');
        const clone = template.content.cloneNode(true);

        const html = clone.querySelector('.document-item').outerHTML
            .replaceAll('__PLOT_INDEX__', plotIndex)
            .replaceAll('__DOC_INDEX__', documentIndex);

        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = html;
        const documentItem = tempDiv.firstElementChild;

        container.appendChild(documentItem);

        // Remove document
        documentItem.querySelector('.remove-document').addEventListener('click', function() {
            documentItem.remove();
        });
    }

    function calculateRemaining() {
        const roadArea = parseFloat(document.getElementById('road_area').value) || 0;
        const otherDeductions = parseFloat(document.getElementById('other_deductions').value) || 0;

        // Calculate the CHANGE in deductions (new - initial)
        const roadAreaChange = roadArea - initialRoadArea;
        const otherDeductionsChange = otherDeductions - initialOtherDeductions;
        const totalDeductionChange = roadAreaChange + otherDeductionsChange;

        document.getElementById('total_deductions').value = (roadArea + otherDeductions).toFixed(2);
        // Available area already accounts for initial deductions, only subtract the CHANGE
        document.getElementById('area_for_plotting').value = (availableArea - totalDeductionChange).toFixed(2);

        calculateTotals();
    }

    function calculateTotals() {
        const plots = document.querySelectorAll('.plot-item');
        let totalPlots = plots.length;
        let totalArea = 0;
        let totalValue = 0;

        plots.forEach(plot => {
            const area = parseFloat(plot.querySelector('.plot-area').value) || 0;
            const price = parseFloat(plot.querySelector('.plot-price').value) || 0;
            const total = area * price;

            plot.querySelector('.plot-total-price').value = total.toFixed(2);

            totalArea += area;
            totalValue += total;
        });

        document.getElementById('total_plots_count').textContent = totalPlots;
        document.getElementById('total_plot_area').textContent = totalArea.toFixed(2);
        document.getElementById('total_plot_value').textContent = totalValue.toFixed(2);

        // Calculate remaining
        // Formula: remaining = totalArea - initialTotalPlotArea - roadAreaChange - otherDeductionsChange - currentTotalPlotArea
        // Simplified: remaining = availableArea - (currentTotalPlotArea - initialTotalPlotArea) - deductionChanges
        const areaForPlotting = parseFloat(document.getElementById('area_for_plotting').value) || availableArea;
        const plotAreaChange = totalArea - initialTotalPlotArea;
        const remaining = areaForPlotting - plotAreaChange;

        document.getElementById('remaining_area').textContent = remaining.toFixed(2);

        // Warning if exceeds
        const warning = document.getElementById('plot_area_warning');
        if (remaining < 0) {
            warning.style.display = 'block';
            document.getElementById('remaining_area').className = 'text-danger';
        } else {
            warning.style.display = 'none';
            document.getElementById('remaining_area').className = 'text-success';
        }
    }

    // Initialize existing plots
    function initializeExistingPlots() {
        const existingPlots = document.querySelectorAll('.plot-item[data-existing="true"]');

        existingPlots.forEach(plotItem => {
            const plotIndex = plotItem.dataset.plotIndex;

            // Remove plot
            plotItem.querySelector('.remove-plot').addEventListener('click', function() {
                if (confirm('Remove this plot?')) {
                    plotItem.remove();
                    calculateTotals();
                }
            });

            // Add expense
            plotItem.querySelector('.add-plot-expense').addEventListener('click', function() {
                addExpense(plotIndex);
            });

            // Add legal document
            plotItem.querySelector('.add-plot-document').addEventListener('click', function() {
                addDocument(plotIndex);
            });

            // Remove existing expenses
            plotItem.querySelectorAll('.remove-expense').forEach(btn => {
                btn.addEventListener('click', function() {
                    btn.closest('.expense-item').remove();
                });
            });

            // Remove existing documents
            plotItem.querySelectorAll('.remove-document').forEach(btn => {
                btn.addEventListener('click', function() {
                    btn.closest('.document-item').remove();
                });
            });
        });
    }

    // Form validation before submit
    document.getElementById('plottingForm').addEventListener('submit', function(e) {
        const remaining = parseFloat(document.getElementById('remaining_area').textContent);

        if (remaining < 0) {
            e.preventDefault();
            alert('Total plot area exceeds available area! Please adjust plot sizes.');
            return false;
        }

        if (document.querySelectorAll('.plot-item').length === 0) {
            e.preventDefault();
            alert('Please add at least one plot!');
            return false;
        }

        return true;
    });
</script>

<style>
    .plot-item {
        border-left: 4px solid #28a745;
    }

    .expense-item {
        background-color: #f8f9fa;
    }
</style>

@endsection