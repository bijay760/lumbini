@extends('layouts.app')

@push('structured_data')
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "{{ $seoData['title'] }}",
        "description": "{{ $seoData['description'] }}",
        "url": "{{ $seoData['canonical'] }}",
        "mainEntity": {
            "@type": "ItemList",
            "name": "Properties for Rent in Nepal",
            "description": "Quality rental properties across Nepal",
            "numberOfItems": "{{ $properties->total() ?? 0 }}"
        }
    }
</script>
@endpush

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold text-primary">Properties for Rent</h1>
                <p class="lead text-muted">Find Quality Rental Properties Across Nepal</p>
            </div>

            @if(isset($properties) && $properties->count() > 0)
            <div class="row g-4">
                @foreach($properties as $property)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        @if($property->featured_image)
                        <img src="{{ asset('storage/'.$property->featured_image) }}"
                            class="card-img-top"
                            alt="{{ $property->title }}"
                            style="height: 250px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $property->title }}</h5>
                            <p class="text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ $property->location }}
                            </p>
                            <p class="card-text">{{ Str::limit($property->description, 100) }}</p>
                            @if($property->monthly_rent)
                            <div class="h5 text-primary mb-3">
                                NPR {{ number_format($property->monthly_rent) }}/month
                            </div>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('contact') }}" class="btn btn-primary w-100">
                                Inquire About Rental
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $properties->links() }}
            </div>
            @else
            <div class="text-center py-5">
                <div class="text-muted mb-4">
                    <i class="fas fa-key fa-4x"></i>
                </div>
                <h4>No Rental Properties Available</h4>
                <p class="text-muted">Check back soon for new rental listings.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us for Rental Inquiries</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection