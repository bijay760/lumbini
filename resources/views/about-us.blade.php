@extends('layouts.app')

@section('title', 'About Us - Lumbani Innovate')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section py-5">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-lg-12 mb-4 mb-lg-0">
                    <h1 class="display-4 fw-bold">A Real Estate Solution </h1>
                    <p class="lead">Transforming real estate through innovation and integrity.</p>
                    <p>We are revolutionizing property solutions in Nepal with affordable, tech-driven, and personalized services.</p>
                </div>
{{--                <div class="col-lg-6">--}}
{{--                    <div class="position-relative overflow-hidden rounded-4 shadow"--}}
{{--                         style="height: 100%;">--}}
{{--                        <div class="position-absolute top-0 start-0 h-100 bg-primary"--}}
{{--                             style="width: 50%; border-radius: 25px 0 0 25px; z-index: 0;"></div>--}}
{{--                        <img src="{{ asset('backend/assets/images/our_team.jpg') }}"--}}
{{--                             alt="Our Team"--}}
{{--                             class="img-fluid h-100 object-fit-cover position-relative rounded-4"--}}
{{--                             style="z-index: 1;">--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </section>


    <!-- Who We Are -->
    <section class="hero-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 ">
                    <h3 class="fw-bold"> Who We Are</h3>
                    <p style="text-align: justify;">Lumbini Innovate is a full-service real estate agency providing
                        complete property solutions throughout Nepal. While we operate nationally, our exclusive focus
                        is currently in Nepalgunj city, where we specialize in fulfilling your dreams—whether it’s
                        buying your first home, securing high-growth investment properties, or finding rental
                        assets.</p>
                    <p style="text-align: justify;">

                        We offer prime location properties with flexible financing options, including bank financing or
                        private financing, based on your needs.
                    </p>
                    <p style="text-align: justify;">
                        With a commitment to transparency, timeliness, and results, our experienced team ensures every
                        step of your real estate journey is smooth, reliable, and rewarding.</p>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative overflow-hidden rounded-4 shadow" style="height: 100%;">
                        <div class="position-absolute top-0 start-0 h-100"
                             style="width: 50%; border-radius: 25px 0 0 25px; z-index: 0;">
                        </div>
                        <div class="position-relative z-1 h-100 p-4">
                            <div class="h-100 d-flex flex-column justify-content-center">
                                <!-- Chairperson -->
                                <div class="d-flex align-items-center mb-4">
                                    <div class="me-3" style="width: 80px; height: 80px;">
                                        <img src="{{asset('backend/team/team3.jpg')}}"
                                             class="img-fluid rounded-circle border border-3 border-white"
                                             alt="Chairperson">
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Ashok Gautam</h5>
                                        <p class="mb-0 text-muted">Chairperson</p>
                                    </div>
                                </div>

                                <!-- Director -->
                                <div class="d-flex align-items-center mb-4">
                                    <div class="me-3" style="width: 80px; height: 80px;">
                                        <img src="{{asset('backend/team/team1.jpg')}}"
                                             class="img-fluid rounded-circle border border-3 border-white"
                                             alt="Director">
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Rizwan Ali Ansari</h5>
                                        <p class="mb-0 text-muted">Executive Director</p>
                                    </div>
                                </div>

                                <!-- Normal Member -->
                                <div class="d-flex align-items-center">
                                    <div class="me-3" style="width: 80px; height: 80px;">
                                        <img src="{{asset('backend/team/team2.jpg')}}"
                                             class="img-fluid rounded-circle border-white"
                                             alt="Member">
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Nirmal Sharma</h5>
                                        <p class="mb-0 text-muted">Director</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Why We Stand Out -->
    <section class="py-3"
             style="background-color: #20254d;">
        <div class="container">
            <h2 class="text-center text-white fw-bold mb-4">Why We Stand Out</h2>
            <div class="row g-4">
                <!-- Prime Locations -->
                <div class="col-md-4">
                    <div class="text-center text-white">
                        <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width: 70px; height: 70px;">
                            <i class="bi bi-geo-alt-fill fs-4"></i>  <!-- Filled location icon -->
                        </div>
                        <h5 class="fw-semibold">Prime Locations</h5>
                        <p class="mb-0">Exclusive properties in high-growth urban centers.</p>
                    </div>
                </div>

                <!-- Bank Financing -->
                <div class="col-md-4">
                    <div class="text-center text-white">
                        <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width: 70px; height: 70px;">
                            <i class="bi bi-building-check fs-4"></i>  <!-- Bank building icon -->
                        </div>
                        <h5 class="fw-semibold">Bank Financing</h5>
                        <p class="mb-0">Preferred partnerships with top Banks for competitive rates.</p>
                    </div>
                </div>

                <!-- Private Financing -->
                <div class="col-md-4">
                    <div class="text-center text-white">
                        <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width: 70px; height: 70px;">
                            <i class="bi bi-shield-lock fs-4"></i>  <!-- Secure private financing icon -->
                        </div>
                        <h5 class="fw-semibold">Private Financing</h5>
                        <p class="mb-0">Flexible Financing options with discreet capital solutions.</p>
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
                            <h3 class="fw-bold text-black mb-3">Our Mission</h3>
                            <p class="justify-content-center">
                                To provide complete and trusted real estate solutions, helping individuals and investors
                                across Nepal achieve their property goals with ease, transparency, and value. We aim to
                                build long-term relationships through quality service, timely delivery, and integrity.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="fw-bold text-black mb-3">Our Vision</h3>
                            <p class="justify-content-center">To become a leading player in Nepal’s real estate
                                industry, growing into a ₹100 Crore company and eventually going public by bringing in
                                retail investors over time. We envision expanding into land development, construction,
                                and acquiring essential equipment, establishing ourselves as the No. 1 name in Nepal’s
                                real estate sector.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }
    </style>
@endpush
