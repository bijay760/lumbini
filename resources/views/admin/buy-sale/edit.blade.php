@extends('admin.layouts.app')
@section('title', 'Properties Edit | Lumbini Innovate')
@section('content')
<div class="container-fluid py-3">
    <div class="mb-4 card-header">
        <h4 class="mb-0 text-muted" style="font-size: 12px;">
            <a href="" class="text-decoration-none text-muted">Properties | Edit | #</a>
        </h4>
    </div>
    <form id="propertyRegistrationForm" method="POST" action="{{ route('admin.buy-sale.update',['id'=>$property->id]) }}"
        enctype="multipart/form-data">
        @csrf
        @include('admin.buy-sale.form')
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize features as an array
        window.features = [];

        // Get existing features from hidden input
        const featuresJson = document.getElementById('featuresJson').value;
        console.log('Raw featuresJson:', featuresJson);

        // Safely parse existing features
        try {
            const parsedFeatures = JSON.parse(featuresJson);
            window.features = Array.isArray(parsedFeatures) ? parsedFeatures : [];
            console.log('Parsed features:', window.features);
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
        window.removeFeatureByIndex = function(index) {
            // Ensure we're working with an array
            if (!Array.isArray(window.features)) {
                window.features = [];
                return;
            }
            // Remove the feature at the specific index
            window.features.splice(index, 1);
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
            container.innerHTML = window.features.map((f, index) => {
                const escapedFeature = f.toString()
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');

                return `
                <span class="badge bg-primary text-white me-2 mb-2 feature-badge">
                    ${escapedFeature}
                    <span class="ms-1" style="cursor: pointer; font-weight: bold;"
                            onclick="removeFeatureByIndex(${index})">×</span>
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

        // Toggle advertisement form
        const postAdCheckbox = document.getElementById('post_advertisement');
        if (postAdCheckbox) {
            postAdCheckbox.addEventListener('change', function() {
                const adSection = document.getElementById('advertisement-section');
                const requiredFields = document.querySelectorAll('.ad-required-field');

                if (this.checked) {
                    adSection.style.display = 'block';
                    // Add required attribute to all advertisement fields
                    requiredFields.forEach(field => {
                        field.setAttribute('required', 'required');
                    });
                } else {
                    adSection.style.display = 'none';
                    // Remove required attribute from all advertisement fields
                    requiredFields.forEach(field => {
                        field.removeAttribute('required');
                    });
                }
            });
        }

        // Image deletion function
        window.confirmImageDelete = function(imageId) {
            if (confirm('Are you sure you want to delete this image?')) {
                fetch(`/admin/property-images/${imageId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove the image element from DOM
                            const imageElement = document.querySelector(`[onclick="confirmImageDelete(${imageId})"]`).closest('.position-relative');
                            imageElement.remove();
                        } else {
                            alert('Error deleting image: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the image.');
                    });
            }
        };
    });
</script>

@endsection