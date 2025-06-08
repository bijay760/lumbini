@extends('admin.layouts.app')
@section('title', 'Properties Edit | Lumbini Innovate')
@section('content')
    <style>
        .document-thumbnail {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .document-placeholder {
            padding: 20px;
            background-color: #f8f9fa;
            color: #dc3545;
        }
        .document-actions {
            display: flex;
            justify-content: space-around;
        }
    </style>
    <div class="container-fluid py-3">
        <div class="mb-4 card-header">
            <h4 class="mb-0 text-muted" style="font-size: 12px;">
                <a href="" class="text-decoration-none text-muted">Properties</a>
            </h4>
        </div>
        <form id="propertyRegistrationForm" method="POST" action="{{ route('admin.properties.update',['id'=>$landParcel->id]) }}"
              enctype="multipart/form-data">
            @csrf
            @include('admin.properties.form')
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize features as an array
            window.features = [];

            // Get existing features from hidden input
            const featuresJson = document.getElementById('featuresJson').value;

            // Safely parse existing features
            try {
                const parsedFeatures = JSON.parse(featuresJson);
                window.features = Array.isArray(parsedFeatures) ? parsedFeatures : [];
            } catch (e) {
                console.error('Error parsing features:', e);
                window.features = [];
            }

            // Ensure features is always an array
            if (!Array.isArray(window.features)) {
                window.features = [];
            }

            // Add feature function
            window.addFeature = function() {
                const input = document.getElementById('featureInput');
                const feature = input.value.trim();

                if (feature && !window.features.includes(feature)) {
                    // Ensure we're working with an array
                    if (!Array.isArray(window.features)) {
                        window.features = [];
                    }
                    window.features.push(feature);
                    updateFeaturesDisplay();
                    input.value = '';
                }
            };

            // Remove feature function
            window.removeFeature = function(feature) {
                // Ensure we're working with an array
                if (!Array.isArray(window.features)) {
                    window.features = [];
                }
                window.features = window.features.filter(f => f !== feature);
                updateFeaturesDisplay();
            };

            // Update features display
            function updateFeaturesDisplay() {
                const container = document.getElementById('featuresContainer');
                const jsonInput = document.getElementById('featuresJson');

                // Ensure we're working with an array
                if (!Array.isArray(window.features)) {
                    window.features = [];
                }

                // Update hidden input
                jsonInput.value = JSON.stringify(window.features);

                // Update visual display
                container.innerHTML = window.features.map(f => {
                    const escapedFeature = f.toString()
                        .replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/"/g, '&quot;')
                        .replace(/'/g, '&#039;');

                    return `
                <span class="badge bg-primary me-2 mb-2 feature-badge">
                    ${escapedFeature}
                    <button type="button" class="btn-close btn-close-white ms-1"
                            onclick="removeFeature('${escapedFeature.replace(/'/g, "\\'")}')"></button>
                </span>
            `;
                }).join('');
            }

            // Enter key handler
            document.getElementById('featureInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    addFeature();
                    e.preventDefault();
                }
            });
        });
    </script>

@endsection
