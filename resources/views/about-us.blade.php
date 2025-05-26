@extends('layouts.app')

@section('title', 'About Us - Lumbani Innovate')

@section('content')
    <div class="about-page">

        <!-- Hero Section -->
        <div class="row g-0">
            <section class="hero-section py-3">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-lg-6 text-white">
                            <h1 class="display-4 fw-bold mb-4">🏡 About Lumbani Innovate</h1>
                            <p class="lead">Transforming real estate through innovation and integrity</p>
                            <p class="mb-3">We're revolutionizing property solutions with cutting-edge technology and personalized service.</p>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-absolute h-100 bg-primary" style="width: 50%;"></div>
                            <img src="{{ asset('backend/assets/images/our_team.jpg') }}" alt="Our Team"
                                 class="img-fluid h-100 object-fit-cover rounded shadow w-100 position-relative">
                        </div>
                    </div>
                </div>
            </section>

        </div>


        <!-- Who We Are -->
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center">
                        <h2 class="fw-bold mb-4">👋 Who We Are</h2>
                        <p class="lead">Lumbani Innovate is a full-service real estate agency committed to helping individuals, families, and investors find the perfect place to call home. With over 15 years of experience in the real estate industry, we have built a reputation for reliability, transparency, and results.</p>
                        <p>We believe real estate is more than buying and selling properties — it's about building relationships, creating communities, and helping people take life-changing steps with confidence.</p>
                        <p>Our team is composed of passionate, licensed professionals who live and breathe real estate. We listen, we advise, and we act in your best interests — always.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission & Vision -->
        <section class="bg-light py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h3 class="fw-bold primary mb-4">🎯 Our Mission</h3>
                                <p>Our mission is simple: To simplify the real estate process by delivering exceptional service, expert guidance, and unmatched integrity.</p>
                                <p>We aim to take the stress out of property decisions by handling everything with professionalism and care. From the first showing to the final signature, we're here to make your real estate experience seamless and rewarding.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h3 class="fw-bold mb-4 primary">👁️ Our Vision</h3>
                                <p>We envision a world where finding a home — or selling one — is no longer complicated or stressful.</p>
                                <p>Our goal is to become the most trusted and innovative real estate brand in the region, known for delivering quality, value, and genuine care.</p>
                                <p>By combining cutting-edge technology with personalized service, we're setting a new standard for what clients should expect from a real estate agency.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why We Stand Out -->
        <section class="py-5">
            <div class="container">
                <h2 class="text-center fw-bold mb-5">🤝 Why We Stand Out</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="text-center p-4">
                            <div class="icon-box text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; background:#20254d;">
                                <i class="bi bi-geo-alt fs-4"></i>
                            </div>
                            <h4>Locally Rooted, Globally Connected</h4>
                            <p>Deep community ties with international expertise and connections</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-4">
                            <div class="icon-box text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; background:#20254d;">
                                <i class="bi bi-graph-up fs-4"></i>
                            </div>
                            <h4>Market Expertise</h4>
                            <p>Deep knowledge of neighborhoods, pricing, and trends</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-4">
                            <div class="icon-box text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; background:#20254d;">
                                <i class="bi bi-headset fs-4"></i>
                            </div>
                            <h4>End-to-End Support</h4>
                            <p>From listings to legal, we handle every detail</p>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <blockquote class="blockquote">
                        <p class="fs-4 fst-italic">"We don't just help you find a property — we help you find your place in the world."</p>
                        <footer class="blockquote-footer mt-3">Founder, Lumbani Innovate</footer>
                    </blockquote>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <style>
        .hero-section {
            background: linear-gradient(135deg, var(--bs-primary) 0%, #1a2b3e 100%);
        }

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
