@extends('layouts.app')

@section('title', 'Register Your Land')

@push('styles')
    <style>
        .form-section {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 2rem;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, .25);
        }

        #map {
            height: 300px;
            width: 100%;
        }
    </style>
@endpush

@section('content')
    <div class="container py-5">
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <h2 class="mb-4 fw-bold text-center">Register your Property for sell</h2>
        <form id="propertyRegistrationForm" method="POST" action="{{ route('properties.store') }}">
            @csrf
            <div class="row g-3">
                <!-- Basic Information -->
                <div class="col-md-6">
                    <h4 class="mb-3">Basic Information</h4>
                    <div class="form-group mb-3">
                        <label for="property_type" class="form-label">Property Type</label>
                        <select class="form-select" id="property_type" name="property_type" required>
                            <option value="">Select Type</option>
                            <option value="house">House</option>
                            <option value="apartment">Apartment</option>
                            <option value="land">Land</option>
                            <option value="commercial">Commercial</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Property Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                </div>

                <!-- Location Details -->
                <div class="col-md-6">
                    <h4 class="mb-3">Location Details</h4>
                    <div class="form-group mb-3">
                        <label for="address" class="form-label">Full Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="state" class="form-label">State/Region</label>
                            <input type="text" class="form-control" id="state" name="state" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="zip_code" class="form-label">Zip/Postal Code</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" name="country" required>
                        </div>
                    </div>
                </div>

                <!-- Property Specifications -->
                <div class="col-md-6">
                    <h4 class="mb-3">Property Specifications</h4>
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="bedrooms" class="form-label">Bedrooms</label>
                            <input type="number" class="form-control" id="bedrooms" name="bedrooms" min="0">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="bathrooms" class="form-label">Bathrooms</label>
                            <input type="number" class="form-control" id="bathrooms" name="bathrooms" min="0">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="area" class="form-label">Area (sq ft)</label>
                            <input type="number" class="form-control" id="area" name="area" min="0" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="price" class="form-label">Price ($)</label>
                            <input type="number" class="form-control" id="price" name="price" min="0" step="0.01"
                                   required>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="year_built" class="form-label">Year Built</label>
                        <input type="number" class="form-control" id="year_built" name="year_built" min="1800"
                               max="{{ date('Y') }}">
                    </div>
                </div>

                <!-- Owner/Contact Information -->
                <div class="col-md-6">
                    <h4 class="mb-3">Contact Information</h4>
                    <div class="form-group mb-3">
                        <label for="owner_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="owner_name" name="owner_name" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="owner_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="owner_email" name="owner_email" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="owner_phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="owner_phone" name="owner_phone" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="preferred_contact" class="form-label">Preferred Contact Method</label>
                        <select class="form-select" id="preferred_contact" name="preferred_contact">
                            <option value="email">Email</option>
                            <option value="phone">Phone</option>
                            <option value="both">Both</option>
                        </select>
                    </div>
                </div>

                <!-- Additional Features -->
                <div class="col-12">
                    <h4 class="mb-3">Additional Features</h4>
                    <div class="form-group mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="has_garage" name="features[]"
                                   value="garage">
                            <label class="form-check-label" for="has_garage">Garage</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="has_garden" name="features[]"
                                   value="garden">
                            <label class="form-check-label" for="has_garden">Garden</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="has_pool" name="features[]"
                                   value="pool">
                            <label class="form-check-label" for="has_pool">Pool</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="has_fireplace" name="features[]"
                                   value="fireplace">
                            <label class="form-check-label" for="has_fireplace">Fireplace</label>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="additional_info" class="form-label">Additional Information</label>
                        <textarea class="form-control" id="additional_info" name="additional_info" rows="2"></textarea>
                    </div>
                </div>

                <!-- Terms and Submit -->
                <div class="col-12">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="agree_terms" name="agree_terms" required>
                        <label class="form-check-label" for="agree_terms">
                            I agree to the terms and conditions
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <span id="submitText">Register Property</span>
                        <span id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                    <div id="formMessage" class="mt-3"></div>
                </div>
            </div>
        </form>

    </div>
@endsection

@push('scripts')

    <script>
        document.getElementById('propertyRegistrationForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = e.target;
            const submitBtn = form.querySelector('button[type="submit"]');
            const submitText = document.getElementById('submitText');
            const spinner = document.getElementById('submitSpinner');
            const messageDiv = document.getElementById('formMessage');

            // Show loading state
            submitBtn.disabled = true;
            submitText.textContent = 'Processing...';
            spinner.classList.remove('d-none');
            messageDiv.innerHTML = '';
            messageDiv.className = 'mt-3';

            // Submit form via AJAX
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        messageDiv.className = 'mt-3 alert alert-success';
                        messageDiv.innerHTML = data.message;
                        form.reset();

                        // Redirect or show success message
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        }
                    } else {
                        messageDiv.className = 'mt-3 alert alert-danger';
                        if (data.errors) {
                            let errors = '<ul>';
                            for (const [field, messages] of Object.entries(data.errors)) {
                                messages.forEach(message => {
                                    errors += `<li>${message}</li>`;
                                });
                            }
                            errors += '</ul>';
                            messageDiv.innerHTML = errors;
                        } else {
                            messageDiv.textContent = data.message || 'Form submission failed. Please try again.';
                        }
                    }
                })
                .catch(error => {
                    messageDiv.className = 'mt-3 alert alert-danger';
                    messageDiv.textContent = 'An error occurred. Please try again later.';
                    console.error('Error:', error);
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitText.textContent = 'Register Property';
                    spinner.classList.add('d-none');
                });
        });
    </script>
    <script src=""></script>
    <script>
        let map;
        let marker;

        function initMap() {
            const defaultLocation = {lat: 28.0500, lng: 81.6167}; // Default Nepalgunj

            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: defaultLocation,
            });

            marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true
            });

            google.maps.event.addListener(marker, 'dragend', function (evt) {
                document.getElementById('latitude').value = evt.latLng.lat().toFixed(6);
                document.getElementById('longitude').value = evt.latLng.lng().toFixed(6);
            });
        }

        window.initMap = initMap;
    </script>
    <script>
        window.addEventListener('load', function () {
            initMap();
        });
    </script>
@endpush
