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
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25);
        }

        #map {
            height: 300px;
            width: 100%;
        }
    </style>
@endpush

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">Sell Your Land</h2>

    <form 
    
    method="POST" 
    enctype="multipart/form-data" 
    class="form-section">
        @csrf
        <div class="mb-3">
            <label for="topic" 
            class="form-label">Plot title </label>

            <input type="text" 
            class="form-control" 
            id="topic" 
            name="topic" 
            placeholder="Enter Your plot name" 
            required>
        </div>

       
        <div class="mb-3">
            <label for="location" 
            class="form-label">Land Location</label>

            <input type="text" 
            class="form-control" 
            id="location" 
            name="location" 
            placeholder="Near Siddhartha Hotel" required>
        </div>

        
        <div class="mb-3">
            <label for="facilities" 
            class="form-label">Facilities Nearby</label>

            <textarea class="form-control" 
            id="facilities" 
            name="facilities" 
            rows="3" 
            placeholder="Schools, Hospitals, Market, Bus Stops" required></textarea>
        </div>

        
        <div class="mb-3">
            <label for="photo" 
            class="form-label">Upload Photo of Land Image</label>

            <input type="file" 
            class="form-control" 
            id="photo" 
            name="photo[]" 
            multiple 
            accept="image/*" required>
        </div>

        <div class="mb-3">
            <label for="photo" 
            class="form-label">Map of Land</label>

            <input type="file" 
            class="form-control" 
            id="photo" 
            name="photo[]" 
            multiple 
            accept="image/*" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Land Location on Map</label>

            <!-- <div id="map"></div>
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude"> -->

             <input type="text"
             placeholder ="Past your google map location"
            class="form-control" required>
        </div>

        <!-- Owner Details -->
        <h5 class="mt-4 mb-3 ">Owner Details</h5>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="owner_name" 
                class="form-label">Full Name</label>
                <input type="text" 
                class="form-control" 
                placeholder ="Enter your full name"
                id="owner_name" 
                name="owner_name" required>
            </div>

            <div class="col-md-6">
                <label for="owner_phone" 
                class="form-label">Phone Number</label>

                <input type="tel" 
                class="form-control" 
                id="owner_phone" 
                placeholder ="Enter your Phone"
                name="owner_phone" required>
            </div>

            <div class="col-md-6">
                <label for="owner_email" 
                class="form-label">Email</label>

                <input type="email" 
                placeholder ="Enter your email"
                class="form-control" 
                id="owner_email" 
                name="owner_email">
            </div>

            <!-- <div class="col-md-6">
                <label for="nid" 
                class="form-label">National ID / Citizenship No.</label>

                <input type="text" 
                class="form-control" i
                d="nid" 
                name="nid" 
                required>
            </div> -->
        </div>

        <!-- Additional Notes -->
        <div class="mb-3 mt-4">
            <label for="notes" class="form-label">Additional Notes (Optional)</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="d-grid">
    <button type="submit" 
            class="btn btn-lg text-white font-bold rounded"
            style="background-color: #1c345c; 
            border: none;">
        Submit for Review
    </button>
</div>
    </form>
</div>
@endsection

@push('scripts')

<script src=""></script>
<script>
    let map;
    let marker;

    function initMap() {
        const defaultLocation = { lat: 28.0500, lng: 81.6167 }; // Default Nepalgunj

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
