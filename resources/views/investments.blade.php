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
            "@type": "FinancialProduct",
            "name": "Real Estate Investment Opportunities",
            "description": "Lucrative real estate investment opportunities in Nepal",
            "provider": {
                "@type": "Organization",
                "name": "Lumbani Innovate Pvt. Ltd."
            }
        }
    }
</script>
@endpush

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold text-primary">Investment Opportunities</h1>
                <p class="lead text-muted">Discover Profitable Real Estate Investment Options in Nepal</p>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-primary mb-3">
                                <i class="fas fa-building fa-3x"></i>
                            </div>
                            <h4>Commercial Properties</h4>
                            <p class="text-muted">High-yield commercial real estate investments in prime locations.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-primary mb-3">
                                <i class="fas fa-home fa-3x"></i>
                            </div>
                            <h4>Residential Projects</h4>
                            <p class="text-muted">Invest in upcoming residential developments with guaranteed returns.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <div class="text-primary mb-3">
                                <i class="fas fa-map fa-3x"></i>
                            </div>
                            <h4>Land Development</h4>
                            <p class="text-muted">Strategic land investments in rapidly developing areas.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-light p-5 rounded mb-5">
                <h3 class="text-center mb-4">Why Invest in Nepal Real Estate?</h3>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Growing economy and urbanization</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Increasing property values</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Government support for development</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Strategic location for trade</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Rising middle class population</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Tourism and hospitality growth</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Get Investment Consultation</h4>
                    <p class="card-text">Our investment experts will help you identify the best opportunities based on your budget and goals.</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="text-primary me-3">
                                    <i class="fas fa-chart-line fa-2x"></i>
                                </div>
                                <div>
                                    <h6>Market Analysis</h6>
                                    <small class="text-muted">Detailed market insights and trends analysis</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="text-primary me-3">
                                    <i class="fas fa-calculator fa-2x"></i>
                                </div>
                                <div>
                                    <h6>ROI Calculation</h6>
                                    <small class="text-muted">Expected returns and investment calculations</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="text-primary me-3">
                                    <i class="fas fa-shield-alt fa-2x"></i>
                                </div>
                                <div>
                                    <h6>Risk Assessment</h6>
                                    <small class="text-muted">Comprehensive risk analysis and mitigation</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="text-primary me-3">
                                    <i class="fas fa-handshake fa-2x"></i>
                                </div>
                                <div>
                                    <h6>End-to-End Support</h6>
                                    <small class="text-muted">Complete support from purchase to management</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-5">Schedule Investment Consultation</a>
            </div>
        </div>
    </div>
</div>
@endsection