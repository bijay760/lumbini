@extends('layouts.app')

@push('structured_data')
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "{{ $seoData['title'] }}",
        "description": "{{ $seoData['description'] }}",
        "url": "{{ $seoData['canonical'] }}"
    }
</script>
@endpush

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold text-primary">Our Services</h1>
                <p class="lead text-muted">Comprehensive Real Estate Solutions for All Your Property Needs</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-primary mb-3">
                                <i class="fas fa-home fa-3x"></i>
                            </div>
                            <h4>Property Buying</h4>
                            <p class="text-muted">Find your dream home with our extensive property listings and expert guidance.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-primary mb-3">
                                <i class="fas fa-handshake fa-3x"></i>
                            </div>
                            <h4>Property Selling</h4>
                            <p class="text-muted">Get the best value for your property with our professional selling services.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-primary mb-3">
                                <i class="fas fa-key fa-3x"></i>
                            </div>
                            <h4>Property Rental</h4>
                            <p class="text-muted">Rent quality properties or find tenants for your investment properties.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-primary mb-3">
                                <i class="fas fa-cogs fa-3x"></i>
                            </div>
                            <h4>Property Management</h4>
                            <p class="text-muted">Professional property management services to maximize your investment returns.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-primary mb-3">
                                <i class="fas fa-file-contract fa-3x"></i>
                            </div>
                            <h4>Legal Documentation</h4>
                            <p class="text-muted">Complete legal support for property transactions and documentation.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-primary mb-3">
                                <i class="fas fa-chart-line fa-3x"></i>
                            </div>
                            <h4>Investment Consulting</h4>
                            <p class="text-muted">Expert advice on real estate investments and market opportunities.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-4">Contact Us Today</a>
            </div>
        </div>
    </div>
</div>
@endsection