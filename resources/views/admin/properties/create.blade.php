@extends('admin.layouts.app')
@section('title', 'Properties Create | Lumbini Innovate')
@section('content')
    <div class="container-fluid py-3">
        <div class="mb-4 card-header">
            <h4 class="mb-0 text-muted" style="font-size: 12px;">
                <a href="" class="text-decoration-none text-muted">Properties</a>
            </h4>
        </div>
        <form id="propertyRegistrationForm" method="POST" action="{{ route('admin.properties.store') }}"
              enctype="multipart/form-data">
        @csrf
            @include('admin.properties.form')
        </form>
    </div>
    <script>
        // Make sure to include this script in your layout or at the bottom of the page
        document.addEventListener('DOMContentLoaded', function() {
            window.features = [];

            // Initialize with existing features
            const existingFeatures = document.getElementById('featuresJson').value;
            if (existingFeatures && existingFeatures !== '[]') {
                window.features = JSON.parse(existingFeatures);
                // No need to call updateFeaturesDisplay() here as they're already rendered server-side
            }

            window.addFeature = function() {
                const input = document.getElementById('featureInput');
                const feature = input.value.trim();

                if (feature && !window.features.includes(feature)) {
                    window.features.push(feature);
                    updateFeaturesDisplay();
                    input.value = '';
                }
            };

            window.removeFeature = function(feature) {
                window.features = window.features.filter(f => f !== feature);
                updateFeaturesDisplay();
            };

            function updateFeaturesDisplay() {
                const container = document.getElementById('featuresContainer');
                const jsonInput = document.getElementById('featuresJson');

                // Update hidden input
                jsonInput.value = JSON.stringify(window.features);

                // Update visual display
                container.innerHTML = window.features.map(f => `
            <span class="badge bg-primary me-2 mb-2 feature-badge">
                ${f.replace(/</g, '&lt;').replace(/>/g, '&gt;')}
                <button type="button" class="btn-close btn-close-white ms-1"
                        onclick="removeFeature('${f.replace(/'/g, "\\'")}')"></button>
            </span>
        `).join('');
            }

            // Allow adding features with Enter key
            document.getElementById('featureInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    addFeature();
                    e.preventDefault();
                }
            });
        });
    </script>

@endsection
