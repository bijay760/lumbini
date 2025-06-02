@extends('layouts.app')
@section('title', 'Sell Your Property | List with Lumbani Innovate')
@section('meta_description', 'Get the best value for your property in Nepal. List your home, land, or commercial property with Nepal\'s leading real estate platform.')
@section('meta_keywords', 'sell property Nepal, list home for sale, property valuation Nepal, real estate agents Kathmandu')

@section('og_title', 'Sell Your Property with Lumbani Innovate | Get Expert Valuation')
@section('og_description', 'Maximize your property value with our professional selling services. Connect with qualified buyers across Nepal.')
@section('og_image', 'https://lumbiniinnovate.com.np/backend/assets/images/login-images/logo%20(3).png')
@section('twitter_image','https://lumbiniinnovate.com.np/backend/assets/images/login-images/logo%20(3).png')

@push('styles')
    <style>
        .image-preview-container {
            position: relative;
            margin-bottom: 15px;
        }

        .image-preview-container img {
            object-fit: cover;
        }

        .object-fit-cover {
            object-fit: cover;
        }
    </style>
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
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
        <h2 class="mb-4 fw-bold text-center">Register your Property for sell</h2>
        <form id="propertyRegistrationForm" method="POST" action="{{ route('properties.store') }}"
              enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <!-- Basic Information -->
                <div class="col-md-6">
                    <h4 class="mb-3">Basic Information</h4>
                    <div class="form-group mb-3">
                        <label for="property_type" class="form-label">Property Type</label>
                        <select class="form-select @error('property_type') is-invalid @enderror" id="property_type"
                                name="property_type" required>
                            <option value="">Select Type</option>
                            <option value="house" @selected(old('property_type') == 'house')>House</option>
                            <option value="apartment" @selected(old('property_type') == 'apartment')>Apartment</option>
                            <option value="land" @selected(old('property_type') == 'land') selected>Land</option>
                            <option value="commercial" @selected(old('property_type') == 'commercial')>Commercial
                            </option>
                        </select>
                        @error('property_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Property Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                               name="title" value="{{ old('title') }}" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                  name="description" rows="3" required>{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Location Details -->
                <div class="col-md-6">
                    <h4 class="mb-3">Location Details</h4>
                    <div class="form-group mb-3">
                        <label for="address" class="form-label">Full Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                               name="address" value="{{ old('address') }}" required>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                                   name="city" value="{{ old('city') }}" required>
                            @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="state" class="form-label">State/Region</label>
                            <input type="text" class="form-control @error('state') is-invalid @enderror" id="state"
                                   name="state" value="{{ old('state') }}" required>
                            @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="zip_code" class="form-label">Zip/Postal Code</label>
                            <input type="text" class="form-control @error('zip_code') is-invalid @enderror"
                                   id="zip_code" name="zip_code" value="{{ old('zip_code') }}" required>
                            @error('zip_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control @error('country') is-invalid @enderror" id="country"
                                   name="country" value="{{ old('country') }}" required>
                            @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Coordinates Section -->
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                   id="latitude" name="latitude" value="{{ old('latitude') }}"
                                   pattern="-?\d{1,3}\.\d{4,8}" placeholder="e.g., 27.717245">
                            @error('latitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: XX.XXXXXX (decimal degrees)</small>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                                   id="longitude" name="longitude" value="{{ old('longitude') }}"
                                   pattern="-?\d{1,3}\.\d{4,8}" placeholder="e.g., 85.324036">
                            @error('longitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: XX.XXXXXX (decimal degrees)</small>
                        </div>
                    </div>
                </div>

                <!-- Owner/Contact Information -->
                <div class="col-md-6">
                    <h4 class="mb-3">Contact Information</h4>
                    <div class="form-group mb-3">
                        <label for="owner_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control @error('owner_name') is-invalid @enderror"
                               id="owner_name" name="owner_name" value="{{ old('owner_name') }}" required>
                        @error('owner_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="owner_email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('owner_email') is-invalid @enderror"
                               id="owner_email" name="owner_email" value="{{ old('owner_email') }}" required>
                        @error('owner_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="owner_phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control @error('owner_phone') is-invalid @enderror"
                               id="owner_phone" name="owner_phone" value="{{ old('owner_phone') }}" required>
                        @error('owner_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="preferred_contact" class="form-label">Preferred Contact Method</label>
                        <select class="form-select @error('preferred_contact') is-invalid @enderror"
                                id="preferred_contact" name="preferred_contact">
                            <option value="email" @selected(old('preferred_contact') == 'email')>Email</option>
                            <option value="phone" @selected(old('preferred_contact') == 'phone')>Phone</option>
                            <option value="both" @selected(old('preferred_contact') == 'both')>Both</option>
                        </select>
                        @error('preferred_contact')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Property Images -->
                <div class="col-md-6">
                    <h4 class="mb-3">Property Images</h4>
                    <div class="form-group mb-3">
                        <label for="property_images" class="form-label">Upload Images</label>
                        <input type="file"
                               class="form-control @error('property_images') is-invalid @enderror @error('property_images.*') is-invalid @enderror"
                               id="property_images" name="property_images[]" multiple accept="image/*">
                        @error('property_images')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('property_images.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Upload multiple images (JPEG, PNG, max 5MB each)</small>
                    </div>

                    <!-- Additional Features -->
                    <label for="property_images" class="form-label">Additional Features</label>
                    <div class="form-group mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="has_garage" name="features[]"
                                   value="garage" @checked(is_array(old('features')) && in_array('garage', old('features')))>
                            <label class="form-check-label" for="has_garage">Garage</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="has_garden" name="features[]"
                                   value="garden" @checked(is_array(old('features')) && in_array('garden', old('features')))>
                            <label class="form-check-label" for="has_garden">Garden</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="has_pool" name="features[]"
                                   value="pool" @checked(is_array(old('features')) && in_array('pool', old('features')))>
                            <label class="form-check-label" for="has_pool">Pool</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="has_fireplace" name="features[]"
                                   value="fireplace" @checked(is_array(old('features')) && in_array('fireplace', old('features')))>
                            <label class="form-check-label" for="has_fireplace">Fireplace</label>
                        </div>
                        @error('features')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="additional_info" class="form-label">Additional Information</label>
                    <textarea class="form-control @error('additional_info') is-invalid @enderror" id="additional_info"
                              name="additional_info" rows="2">{{ old('additional_info') }}</textarea>
                    @error('additional_info')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Terms and Submit -->
                <div class="col-12">
                    <div class="form-check mb-3">
                        <input class="form-check-input @error('agree_terms') is-invalid @enderror" type="checkbox"
                               id="agree_terms" name="agree_terms" @checked(old('agree_terms')) required>
                        <label class="form-check-label" for="agree_terms">
                            I agree to the terms and conditions
                        </label>
                        @error('agree_terms')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror"
                             data-sitekey="6LfjXkwrAAAAAIa5vRT4J3-Iej-U45n9Pvio11Z9"></div>
                        @error('g-recaptcha-response')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush
