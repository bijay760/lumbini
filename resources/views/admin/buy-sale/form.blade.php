<div class="row g-3">
    <!-- Basic Information -->
    <div class="col-md-6">
        <h4 class="mb-3">Basic Information</h4>
        <div class="form-group mb-3">
            <label for="property_type" class="form-label">Property Type</label>
            <select class="form-select @error('property_type') is-invalid @enderror" id="property_type"
                    name="property_type" required>
                <option value="">Select Type</option>
                <option value="house" @selected((old('property_type') ?? $property->property_type ?? '') == 'house')>House</option>
                <option value="apartment" @selected((old('property_type') ?? $property->property_type ?? '') == 'apartment')>Apartment</option>
                <option value="land" @selected((old('property_type') ?? $property->property_type ?? '') == 'land')>Land</option>
                <option value="commercial" @selected((old('property_type') ?? $property->property_type ?? '') == 'commercial')>Commercial</option>
            </select>
            @error('property_type')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="status" class="form-label">Property Status</label>
            <select class="form-select @error('status') is-invalid @enderror" id="status"
                    name="status" required>
                <option value="">Select Status</option>
                <option value="pending" @selected((old('status') ?? $property->status ?? '') == 'pending')>Pending</option>
                <option value="approved" @selected((old('status') ?? $property->status ?? '') == 'approved')>Approved</option>
                <option value="rejected" @selected((old('status') ?? $property->status ?? '') == 'rejected')>Rejected</option>
            </select>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="title" class="form-label">Property Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                   name="title" value="{{ old('title') ?? $property->title ?? '' }}" required>
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                      name="description" rows="3" required>{{ old('description') ?? $property->description ?? '' }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="location" class="form-label">Location</label>
            <textarea class="form-control @error('location') is-invalid @enderror" id="location"
                      name="location" rows="3" required>{{ old('location') ?? $property->location ?? '' }}</textarea>
            @error('location')
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
                   name="address" value="{{ old('address') ?? $property->address ?? '' }}" required>
            @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                       name="city" value="{{ old('city') ?? $property->city ?? '' }}" required>
                @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="state" class="form-label">State/Region</label>
                <input type="text" class="form-control @error('state') is-invalid @enderror" id="state"
                       name="state" value="{{ old('state') ?? $property->state ?? '' }}" required>
                @error('state')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label for="zip_code" class="form-label">Zip/Postal Code</label>
                <input type="text" class="form-control @error('zip_code') is-invalid @enderror"
                       id="zip_code" name="zip_code" value="{{ old('zip_code') ?? $property->zip_code ?? '' }}" required>
                @error('zip_code')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" class="form-control @error('country') is-invalid @enderror" id="country"
                       name="country" value="{{ old('country') ?? $property->country ?? '' }}" required>
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
                       id="latitude" name="latitude" value="{{ old('latitude') ?? $property->latitude ?? '' }}"
                       pattern="-?\d{1,3}\.\d{4,8}" placeholder="e.g., 27.717245">
                @error('latitude')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Format: XX.XXXXXX (decimal degrees)</small>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                       id="longitude" name="longitude" value="{{ old('longitude') ?? $property->longitude ?? '' }}"
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
                   id="owner_name" name="owner_name" value="{{ old('owner_name') ?? $property->owner_name ?? '' }}" required>
            @error('owner_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="owner_email" class="form-label">Email</label>
            <input type="email" class="form-control @error('owner_email') is-invalid @enderror"
                   id="owner_email" name="owner_email" value="{{ old('owner_email') ?? $property->owner_email ?? '' }}" required>
            @error('owner_email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="owner_phone" class="form-label">Phone Number</label>
            <input type="tel" class="form-control @error('owner_phone') is-invalid @enderror"
                   id="owner_phone" name="owner_phone" value="{{ old('owner_phone') ?? $property->owner_phone ?? '' }}" required>
            @error('owner_phone')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="preferred_contact" class="form-label">Preferred Contact Method</label>
            <select class="form-select @error('preferred_contact') is-invalid @enderror"
                    id="preferred_contact" name="preferred_contact">
                <option value="email" @selected((old('preferred_contact') ?? $property->preferred_contact ?? '') == 'email')>Email</option>
                <option value="phone" @selected((old('preferred_contact') ?? $property->preferred_contact ?? '') == 'phone')>Phone</option>
                <option value="both" @selected((old('preferred_contact') ?? $property->preferred_contact ?? '') == 'both')>Both</option>
            </select>
            @error('preferred_contact')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Property Images -->
    <div class="col-md-6">
        <h4 class="mb-3">Property Images</h4>

        @if(isset($images) && $images->count() > 0)
            <div class="mb-3">
                <label class="form-label">Current Images</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($images as $image)
                        <div class="position-relative" style="width: 100px; height: 100px;">
                            <img src="{{ asset( $image->path) }}" class="img-thumbnail h-100 w-100" alt="Property image">
                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                    onclick="confirmImageDelete({{ $image->id }})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="form-group mb-3">
            <label for="property_images" class="form-label">Upload New Images</label>
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
        <div class="form-group mb-3">
            <label for="property_features" class="form-label">Additional Features</label>

            <!-- Hidden input to store all features as JSON -->
            <input type="hidden" name="features" id="featuresJson"
                   value="{{ isset($property) ? $property->features : (is_array(old('features')) ? old('features') : '[]') }}">

            <!-- Container for displaying added features -->
            <div id="featuresContainer" class="mb-3">
                @if(isset($property) && $property->features)
                    @foreach(json_decode(json_decode($property->features)) as $feature)
                        <span class="badge bg-primary me-2 mb-2 feature-badge">
                    {{ $feature }}
                    <button type="button" class="btn-close btn-close-white ms-1"
                            onclick="removeFeature('{{ addslashes($feature) }}')"></button>
                </span>
                    @endforeach
                @elseif(is_array(old('features')))
                    @foreach(old('features') as $feature)
                        <span class="badge bg-primary me-2 mb-2 feature-badge">
                    {{ $feature }}
                    <button type="button" class="btn-close btn-close-white ms-1"
                            onclick="removeFeature('{{ addslashes($feature) }}')"></button>
                </span>
                    @endforeach
                @endif
            </div>

            <!-- Input for adding new features -->
            <div class="input-group">
                <input type="text" id="featureInput" class="form-control" placeholder="Add a feature (e.g. garage, pool)">
                <button class="btn btn-primary" type="button" onclick="addFeature()">Add</button>
            </div>

            @error('features')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="additional_info" class="form-label">Additional Information</label>
        <textarea class="form-control @error('additional_info') is-invalid @enderror" id="additional_info"
                  name="additional_info" rows="2">{{ old('additional_info') ?? $property->additional_info ?? '' }}</textarea>
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

        <button type="submit" class="btn btn-primary">
            <span id="submitText">{{ isset($property) ? 'Update Property' : 'Register Property' }}</span>
            <span id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
        </button>

        <div id="formMessage" class="mt-3"></div>
    </div>
</div>
