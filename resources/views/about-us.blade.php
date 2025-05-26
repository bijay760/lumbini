@extends('layouts.app')

@section('title', 'About Us - Lumbani Innovate')

@section('content')
   <!-- Hero Section -->
<section class="hero-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-4 fw-bold">About Lumbani Innovate</h1>
                <p class="lead">Transforming real estate through innovation and integrity.</p>
                <p>We're revolutionizing property solutions with cutting-edge technology and personalized service.</p>
            </div>
            <div class="col-lg-6">
                <div class="position-relative overflow-hidden rounded-4 shadow" 
                style="height: 100%;">
                    <div class="position-absolute top-0 start-0 h-100 bg-primary" 
                    style="width: 50%; border-radius: 25px 0 0 25px; z-index: 0;"></div>
                    <img src="{{ asset('backend/assets/images/our_team.jpg') }}" 
                    alt="Our Team" 
                    class="img-fluid h-100 object-fit-cover position-relative rounded-4" 
                    style="z-index: 1;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="bg-light py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="fw-bold text-primary mb-3">🎯 Our Mission</h3>
                        <p>Our mission is simple: To simplify the real estate process by delivering exceptional service, expert guidance, and unmatched integrity.</p>
                        <p>We aim to take the stress out of property decisions by handling everything with professionalism and care—from the first showing to the final signature.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="fw-bold text-primary mb-3">👁️ Our Vision</h3>
                        <p>We envision a world where finding or selling a home is no longer complicated or stressful.</p>
                        <p>Our goal is to be the most trusted and innovative real estate brand in the region, delivering value and genuine care.</p>
                        <p>By merging technology with personal service, we're setting a new standard for what real estate service should feel like.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why We Stand Out -->
<section class="py-5" 
        style="background-color: #20254d;">
    <div class="container">
        <h2 class="text-center text-white fw-bold mb-5">Why We Stand Out</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center text-white">
                    <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                    style="width: 70px; height: 70px;">
                        <i class="bi bi-geo-alt fs-4"></i>
                    </div>
                    <h5 class="fw-semibold">Locally Rooted, Globally Connected</h5>
                    <p class="mb-0">Deep community ties with international expertise and reach.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center text-white">
                    <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                    style="width: 70px; height: 70px;">
                        <i class="bi bi-graph-up fs-4"></i>
                    </div>
                    <h5 class="fw-semibold">Market Expertise</h5>
                    <p class="mb-0">In-depth knowledge of neighborhoods, pricing, and trends.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center text-white">
                    <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                    style="width: 70px; height: 70px;">
                        <i class="bi bi-headset fs-4"></i>
                    </div>
                    <h5 class="fw-semibold">End-to-End Support</h5>
                    <p class="mb-0">From listings to legal—we manage every detail with care.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Who We Are -->
<section class="hero-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0 ">
                <h3 class="fw-bold">👋 Who We Are</h3>
                 <p style="text-align: justify;">Lumbani Innovate is a full-service real estate agency helping individuals, families, and investors find their perfect place 
                to call home. With over 15 years of experience, we’ve built a reputation for reliability, transparency, and results.
                Real estate is more than transactions — it’s about building relationships and guiding people through life-changing decisions with confidence.
                Our passionate, licensed professionals are here to listen, advise, and act in your best interests—every step of the way.</p>
            </div>
            <div class="col-lg-6">
                <div class="position-relative overflow-hidden rounded-4 shadow" 
                style="height: 100%;">
                    <div class="position-absolute top-0 start-0 h-100 bg-primary" 
                    style="width: 50%; border-radius: 25px 0 0 25px; z-index: 0;"></div>
                    <img src="{{ asset('backend/assets/images/our_team.jpg') }}" 
                    alt="Our Team" 
                    class="img-fluid h-100 object-fit-cover position-relative rounded-4" 
                    style="z-index: 1;">
                </div>
            </div>
        </div>
    </div>
</section>


<!-- <section class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h3 class="fw-bold">👋 Who We Are</h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="lead">Lumbani Innovate is a full-service real estate agency helping individuals, families, and investors find their perfect place to call home. With over 15 years of experience, we’ve built a reputation for reliability, transparency, and results.</p>
                <p>Real estate is more than transactions — it’s about building relationships and guiding people through life-changing decisions with confidence.</p>
                <p>Our passionate, licensed professionals are here to listen, advise, and act in your best interests—every step of the way.</p>
            </div>
        </div>
    </div>
</section> -->


@endsection

@push('styles')
    <style>
        /* .hero-section {
            background: linear-gradient(135deg, var(--bs-primary) 0%, #1a2b3e 100%);
        } */

        .icon-box {
            transition: transform 0.3s ease;
        }

        .icon-box:hover {
            transform: translateY(-5px) scale(1.05);
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
    </style>
@endpush
