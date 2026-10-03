@extends('layouts.app')

@section('title', 'Lumbini Innovate - Blog & Updates')

@push('modals')
    @include('modals.share-sell-notice')
@endpush

@section('content')
    <!-- Hero Section -->
    <header class="masthead" style="background: linear-gradient(rgba(32, 37, 77, 0.85), rgba(28, 52, 92, 0.85)), url('{{ asset('backend/assets/images/bg.png') }}') no-repeat center center / cover;">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="text-left text-white">
                        <h1 class="mb-4 fw-bold display-4">Lumbini Innovate Pvt. Ltd.</h1>
                        <p class="lead mb-4 text-justify">
                            <b>Your journey to the perfect property starts here.</b><br>
                            At Lumbini Innovate Pvt. Ltd., we believe that every home has a story and we're here to help you write yours. Whether you're looking to buy your dream house, sell your current property, or rent a space that fits your lifestyle, our dedicated team of experts is with you at every step.
                        </p>
                        <div class="d-flex flex-wrap gap-3 mt-4">
                            <a href="{{ route('about-us') }}" class="btn btn-light btn-lg px-4 py-3 fw-bold" style="background-color: #fff; color: #20254D;">Book Now</a>
                            <a href="{{ route('about-us') }}" class="btn btn-outline-light btn-lg px-4 py-3 fw-bold">About Us</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="position-relative">
                        <div class="rounded-4 overflow-hidden shadow-lg">
                            <img src="{{ asset('images/dream-home.jpg') }}" alt="Dream Home" class="img-fluid rounded-4" style="border: 4px solid rgba(255,255,255,0.2);">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Trusted Partner Section -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="row g-5 me-0">
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bold mb-4" style="color: #20254D;">Your Trusted Real Estate Partner</h2>
                    <p class="lead mb-4 text-muted lh-base">
                        Navigating the real estate market can feel overwhelming. That's why we've built our reputation on trust, transparency, and a deep understanding of the local market. With years of experience and a customer-first approach, we ensure that your experience is not only successful — but enjoyable too.
                    </p>
                    <div class="my-4">
                        <img src="{{ asset('images/partner-about.jpg') }}" class="img-fluid rounded-4 shadow-lg w-100" alt="About Us" style="max-height: 400px; object-fit: cover;">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ps-lg-5">
                        <h2 class="display-5 fw-bold mb-4" style="color: #20254D;">Why Choose Us?</h2>
                        <div class="benefits-list">
                            <div class="d-flex mb-4">
                                <div class="me-4">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #20254d;">
                                        <i class="bi bi-geo-alt-fill fs-4 text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="h5 fw-bold" style="color: #1C345C;">Prime Locations</h4>
                                    <p class="mb-0 text-muted">Exclusive properties in high-growth urban centers.</p>
                                </div>
                            </div>

                            <div class="d-flex mb-4">
                                <div class="me-4">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; background-color: #20254d; height: 50px;">
                                        <i class="bi bi-building-check fs-4 text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="h5 fw-bold" style="color: #1C345C;">Bank Financing</h4>
                                    <p class="mb-0 text-muted">Partnerships with top banks for competitive rates.</p>
                                </div>
                            </div>

                            <div class="d-flex mb-4">
                                <div class="me-4">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #20254d;">
                                        <i class="bi bi-shield-lock fs-4 text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="h5 fw-bold" style="color: #1C345C;">Private Financing</h4>
                                    <p class="mb-0 text-muted">Flexible financing options with discreet capital solutions.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section style="background: linear-gradient(135deg, #20254D 0%, #1C345C 100%);">
        <div class="container py-5">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 text-white">
                    <h2 class="display-5 fw-bold mb-2">Ready to Find Your Dream Property?</h2>
                    <p class="lead">Join hundreds of satisfied clients who found their perfect property with</p>
                    <p class="lead mb-3">Lumbini Innovate Pvt. Ltd.</p>

                    <div class="d-flex flex-wrap gap-3 justify-content-center">
                        <a href="{{ route('projects') }}" class="btn btn-light btn-lg px-4 py-3 fw-bold" style="color: #20254D;">Get Started</a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-4 py-3 fw-bold">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="bg-white">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 order-lg-2 ps-lg-5">
                    <h2 class="display-5 fw-bold mb-4" style="color: #20254D;">Our Mission & Vision</h2>
                    <p class="lead mb-4 text-muted lh-base text-justify">
                        Our mission is to simplify the real estate journey by offering exceptional service, expert guidance, and unwavering integrity. We strive to remove the stress from property decisions by managing every step with professionalism and care.
                    </p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-4 py-3 fw-bold" style="background-color: #1C345C; border-color: #1C345C;">Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="rounded-4 overflow-hidden shadow-lg">
                        <img src="{{ asset('images/our-vision.jpg') }}" alt="Our Vision" class="img-fluid w-100 rounded-4" style="max-height: 420px; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video & Featured Location -->
    <div class="container my-5">
        <div class="row align-items-stretch g-4">
            <div class="col-lg-7 col-md-12">
                <div class="bg-light p-4 p-md-5 rounded-4 shadow-sm border h-100 d-flex flex-column justify-content-between">
                    <div>
                        <h2 class="fw-bold mb-3" style="color: #20254D;">Lumbini Innovate - Hotel Siddhartha View, Karkando Nepalgunj</h2>
                        <p class="fs-5 text-muted mb-4">
                            We are offering attractive residential plots near Hotel Siddhartha in Karkando, Nepalgunj Sub-Metropolitan City.<br><br>
                            Includes facilities such as water supply, electricity, and paved roads.<br>
                            Please contact us in time for selection, purchase, or booking.
                        </p>
                    </div>
                    <div class="pt-3 border-top mt-auto">
                        <span class="fw-bold text-dark"><i class="bi bi-telephone-fill me-2 text-primary"></i> Mobile No.:</span> 
                        <a href="tel:+9779848023023" class="text-decoration-none fw-bold text-primary fs-5">+977-9848023023</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12">
                <div class="rounded-4 overflow-hidden shadow h-100 bg-dark d-flex align-items-center justify-content-center">
                    <video id="myVideo" class="w-100 h-100" style="object-fit: cover; min-height: 100%; border-radius: 1rem;" controls autoplay muted playsinline>
                        <source src="{{ asset('backend/video/video.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .masthead {
            position: relative;
            background-color: #343a40;
            background: url('{{ asset('backend/assets/images/bg.png') }}') no-repeat center center;
            background-size: cover;
            padding-top: 6rem;
            padding-bottom: 6rem;
        }

        .benefit-icon {
            display: inline-block;
            width: 30px;
            text-align: center;
            margin-right: 10px;
        }

        .rounded-4 {
            border-radius: 1rem !important;
        }

        .shadow-lg {
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        }

        @media (min-width: 992px) {
            .masthead {
                padding-top: 8rem;
                padding-bottom: 8rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        function unmuteVideo() {
            const video = document.getElementById("myVideo");
            if (video) {
                video.muted = false;
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            const video = document.getElementById("myVideo");
            if (video) {
                const observer = new IntersectionObserver(
                    (entries, observer) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                unmuteVideo();
                                observer.unobserve(video);
                            }
                        });
                    },
                    { threshold: 0.5 }
                );
                observer.observe(video);
            }
        });
    </script>
@endpush
