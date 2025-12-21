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
            "@type": "RealEstateAgent",
            "name": "Lumbani Innovate Pvt. Ltd."
        }
    }
</script>
@endpush

@push('modals')
@include('modals.share-sell-notice')
@endpush

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Our Available Plots</h2>
        <!-- <a href="{{ route('land-register') }}" class="btn btn-primary rounded" style="width:130px;text-decoration: none;">
            + Sell
        </a> -->
    </div>
    <div class="mb-4">
        <div class="row g-4">
            @if($properties)
            @foreach($properties as $property)
            <div class="col-12 col-lg-6" style="max-height: 650px;">
                <div class="card h-100 d-flex flex-column">
                    <div class="bg-white p-3">
                        <div class="d-flex align-items-center">
                            <strong>{{$property->title}}</strong>
                        </div>
                    </div>
                    <div class="text-center flex-grow-0" style="height: 200px; overflow: hidden;">
                        <img src="{{asset($property->path)}}"
                            alt="Karkando Residential Plots"
                            class="img-fluid rounded shadow h-100 object-fit-cover">
                    </div>
                    <div class="card-body flex-grow-1 overflow-auto">
                        <h5 class="text-danger">{{$property->location}}</h5>
                        <p class="text-muted mb-2">
                            <i class="bi bi-geo-alt-fill"></i>{{$property->address}}
                        </p>
                        <p class="mb-3">{{$property->additional_info??''}}</p>
                        @php
                        $propertyFeatures = [];
                        if (isset($property->features)) {
                        if (is_string($property->features)) {
                        $cleaned = trim($property->features, '"');
                        $propertyFeatures = json_decode($property->features, true) ?? [];
                        $propertyFeatures = json_decode($propertyFeatures, true) ?? [];
                        } elseif (is_array($property->features)) {
                        $propertyFeatures = $property->features;
                        }
                        }
                        $selectedFeatures = $propertyFeatures;
                        $selectedFeatures = is_array($selectedFeatures) ? $selectedFeatures : [];
                        @endphp
                        <ul class="list-unstyled mb-3">
                            @foreach($selectedFeatures as $feature)
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i>
                                {{$feature}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <div class="d-grid gap-2">
                            <a href="{{ route('contact') }}" class="btn btn-primary">Enquire Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @endif

        </div>
    </div>
</div>
@endsection