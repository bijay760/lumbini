@extends('admin.layouts.app')
@section('title', 'Properties Create | Lumbini Innovate')
@section('content')
<div class="container-fluid py-3">
    <div class="mb-4 card-header">
        <h4 class="mb-0 text-muted" style="font-size: 12px;">
            <a href="" class="text-decoration-none text-muted">Properties | Create | #</a>
        </h4>
    </div>
    <form id="propertyRegistrationForm" method="POST" action="{{ route('admin.buy-sale.store') }}"
        enctype="multipart/form-data">
        @csrf
        @include('admin.buy-sale.form')
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

        window.removeFeatureByIndex = function(index) {
            window.features.splice(index, 1);
            updateFeaturesDisplay();
        };

        function updateFeaturesDisplay() {
            const container = document.getElementById('featuresContainer');
            const jsonInput = document.getElementById('featuresJson');

            // Update hidden input
            jsonInput.value = JSON.stringify(window.features);

            // Update visual display
            container.innerHTML = window.features.map((f, index) => `
            <span class="badge bg-primary text-white me-2 mb-2 feature-badge">
                ${f.replace(/</g, '&lt;').replace(/>/g, '&gt;')}
                <span class="ms-1" style="cursor: pointer; font-weight: bold;"
                        onclick="removeFeatureByIndex(${index})">×</span>
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