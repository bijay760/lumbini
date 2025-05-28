@extends('layouts.app')

@section('title', 'Lumbini Innovate - Projects')

@push('modals')
    @include('modals.share-sell-notice')
@endpush

@section('content')
            <div class="container py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h1 class="mb-0">Book our valuable land today</h1>
                    </div>
                    <div>
                        <a href="{{ route('land-register') }}" class="btn btn-outline-primary">
                            Register Your Land
                        </a>
                    </div>
                </div>

                {{-- Blog Preview Section --}}
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="container">
                
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="text-center mb-0">Our Featured Properties</h1>
                    <a href="#" class="btn btn-outline-primary">View All Properties <i class="bi bi-arrow-right"></i></a>
                </div>

                <!-- Blog Posts Grid - Always Visible -->
                <div class="row g-4">
                    <!-- Property 1 - Karkando -->
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-header bg-white border-bottom">
                                <div class="d-flex align-items-center">
                                    <!-- <span class="badge bg-success me-2">Residential</span> -->
                                    <strong>Karkando Plots</strong>
                                </div>
                            </div>
                            <div class="card-body">
                                <img src="{{asset('backend/assets/images/project1.png')}}" 
                                    alt="Karkando Residential Plots" 
                                    class="img-fluid rounded mb-3">
                                <h5 class="text-danger">Karkando, Near Siddhartha Hotel</h5>
                                <p class="text-muted mb-2">
                                    <i class="bi bi-geo-alt-fill"></i> Nepalgunj Sub-Metropolitan City
                                </p>
                                <p class="mb-3">Premium residential plots with modern amenities.</p>
                                <ul class="list-unstyled mb-3">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> पानी, बत्ति र पक्की सडक</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> 24/7 Security</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Near schools & hospitals</li>
                                </ul>
                                <div class="bg-light p-3 rounded mb-3">
                                    <p class="mb-0">
                                        <i class="bi bi-telephone-fill"></i> Contact: +977-9848023023
                                    </p>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary">Enquire Now</button>
                                    <!-- <button class="btn btn-outline-secondary">Share Details</button> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Property 2 - Indrapur -->
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-header bg-white border-bottom">
                                <div class="d-flex align-items-center">
                                    <!-- <span class="badge bg-warning text-dark me-2">Commercial</span> -->
                                    <strong>Indrapur Complex</strong>
                                </div>
                            </div>
                            <div class="card-body">
                                <img src="{{asset('backend/assets/images/project1.png')}}" 
                                    alt="Indrapur Commercial Complex" 
                                    class="img-fluid rounded mb-3">
                                <h5 class="text-danger">Indrapur, Near Pauwa Hotel</h5>
                                <p class="text-muted mb-2">
                                    <i class="bi bi-geo-alt-fill"></i> Nepalgunj Sub-Metropolitan City
                                </p>
                                <p class="mb-3">Prime commercial spaces for businesses.</p>
                                <ul class="list-unstyled mb-3">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> High foot traffic</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Ample parking</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Prime business location</li>
                                </ul>
                                <div class="bg-light p-3 rounded mb-3">
                                    <p class="mb-0">
                                        <i class="bi bi-telephone-fill"></i> Contact: +977-9848023023
                                    </p>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary">Enquire Now</button>
                                    <!-- <button class="btn btn-outline-secondary">Share Details</button> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Property 3 - Kanthepur -->
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-header bg-white border-bottom">
                                <div class="d-flex align-items-center">
                                    <!-- <span class="badge bg-info me-2">Mixed Use</span> -->
                                    <strong>Kanthepur Plots</strong>
                                </div>
                            </div>
                            <div class="card-body">
                                <img src="{{asset('backend/assets/images/project1.png')}}" 
                                    alt="Kanthepur Development" 
                                    class="img-fluid rounded mb-3">
                                <h5 class="text-danger">Kanthepur Mixed Development</h5>
                                <p class="text-muted mb-2">
                                    <i class="bi bi-geo-alt-fill"></i> Nepalgunj Sub-Metropolitan City
                                </p>
                                <p class="mb-3">Residential + commercial opportunities.</p>
                                <ul class="list-unstyled mb-3">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Modern drainage</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Transport hub</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Mixed-use zoning</li>
                                </ul>
                                <div class="bg-light p-3 rounded mb-3">
                                    <p class="mb-0">
                                        <i class="bi bi-telephone-fill"></i> Contact: +977-9848023023
                                    </p>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary">Enquire Now</button>
                                    <!-- <button class="btn btn-outline-secondary">Share Details</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-end">
                <a href="{{ route('blog') }}" class="btn btn-sm btn-secondary">See More</a>
            </div>
        </div>
    </div>
@endsection
