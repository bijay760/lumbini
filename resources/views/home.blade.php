@extends('layouts.app')

@section('title', 'Lumbini Innovate - Home')

@push('modals')
    @include('modals.share-sell-notice')
@endpush

@section('content')
    <!-- Hero Section -->
    <header class="masthead"
            style="background-size: cover; background-position: center;">

        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="text-left text-white">
                        <h1 class="mb-4 fw-bold display-4">Lumbini Innovate Pvt. Ltd.</h1>

                        <p class="lead mb-4 text-justify ">
                            <b>Your journey to the perfect property starts here.</b><br>
                            At Lumbini Innovate Pvt. Ltd. we believe that every home has a story
                            and we're here to help you write yours. Whether you're looking to buy your dream house,
                            sell your current property, or rent a space that fits your lifestyle, our dedicated team
                            of experts is with you at every step.
                        </p>
                        <div class="d-flex flex-wrap gap-3 mt-4">

                            <a href="{{ route('about-us') }}"
                               class="btn btn-light btn-lg px-4 py-3 fw-bold"
                               style="background-color: #fff; color: #20254D;">Book Now</a>

                            <a href="{{ route('about-us') }}"
                               class="btn btn-outline-light btn-lg px-4 py-3 fw-bold">About Us</a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="position-relative">
                        <div class="rounded-4 overflow-hidden shadow-lg">
                            <img
                                src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1473&q=80"
                                alt="Dream Home"
                                class="img-fluid rounded-4"
                                style="border: 4px solid rgba(255,255,255,0.2);">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Trusted Partner Section -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="row g-5 mr-4">
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bold mb-4"
                        style="color: #20254D;">Your Trusted Real Estate Partner</h2>
                    <p class="lead mb-4 text-muted lh-base">
                        Navigating the real estate market can feel overwhelming. That's why we've built our reputation
                        on trust,
                        transparency, and a deep understanding of the local market. With years of experience and a
                        customer-first
                        approach, we ensure that your experience is not only successful — but enjoyable too.
                    </p>

                    <div class="my-4">
                        <img src="https://dam.buhlergroup.com/rendition/e54eab5b827e421988c998b19eeebdf2/-FJPG-TwebHeader_1x1-S1024x1024"
                             class="img-fluid rounded-4 shadow-lg w-100"
                             alt="About Us"
                             style="max-height: 400px; object-fit: cover;">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ps-lg-5">
                        <h2 class="display-5 fw-bold mb-4"
                            style="color: #20254D;">Why Choose us?</h2>
                        <div class="benefits-list">
                            <div class="d-flex mb-4">
                                <div class="me-4">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 50px; height: 50px;background-color: #20254d;">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="24"
                                             height="24"
                                             fill="white"
                                             viewBox="0 0 16 16">
                                            <path
                                                d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="h5 fw-bold" style="color: #1C345C;">Prime Locations</h4>
                                    <p class="mb-0 text-muted">
                                        Exclusive properties in high-growth urban centers.
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex mb-4">
                                <div class="me-4">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 50px; background-color: #20254d; height: 50px;">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="24"
                                             height="24"
                                             fill="white"
                                             viewBox="0 0 16 16">
                                            <path
                                                d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="h5 fw-bold"
                                        style="color: #1C345C;">Bank Financing</h4>
                                    <p class="mb-0 text-muted">
                                        Preferred partnerships with top Banks for competitive rates.
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex mb-4">
                                <div class="me-4">
                                    <div class=" rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 50px; height: 50px; background-color: #20254d;">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="24"
                                             height="24"
                                             fill="white"
                                             viewBox="0 0 16 16">
                                            <path
                                                d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="h5 fw-bold"
                                        style="color: #1C345C;">Private Financing</h4>

                                    <p class="mb-0 text-muted">
                                        Flexible Financing options with discreet capital solutions.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Shareholder Benefits Section -->
    <section class=""
             style="background: linear-gradient(135deg, #20254D 0%, #1C345C 100%);">
        <div class="container py-5">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 text-white">
                    <h2 class="display-5 fw-bold  mb-2">Ready to Find Your Dream Property?</h2>
                    <p class="lead ">Join thousands of satisfied clients who found their perfect home with</p>
                    <p class="lead mb-2">Lumbini Innovate Pvt. Ltd.</p>

                    <div class="d-flex flex-wrap gap-3 justify-content-center">
                        <a href="{{ route('about-us') }}"
                           class="btn btn-light btn-lg px-4 py-3 fw-bold"
                           style="color: #20254D;">Get Started</a>
                        <a href="{{ route('contact') }}"
                           class="btn btn-outline-light btn-lg px-4 py-3 fw-bold">Contact us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 order-lg-2 ps-lg-5">
                    <h2 class="display-5 fw-bold mb-4"
                        style="color: #20254D;">Our Mission & Vision</h2>
                    <p class="lead mb-4 text-muted lh-base text-justify">
                        Our mission is to simplify the real estate journey by offering exceptional service, expert
                        guidance,
                        and unwavering integrity. We strive to remove the stress from property decisions by managing
                        every step
                        with professionalism and care. From the first showing to the final signature, we’re committed to
                        making your
                        experience smooth, rewarding, and hassle-free. We envision a future where buying or selling a
                        home is no
                        longer complicated, but instead an exciting and positive experience.
                    </p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="{{ route('contact') }}"
                           class="btn btn-primary btn-lg px-4 py-3 fw-bold"
                           style="background-color: #1C345C; border-color: #1C345C;">Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="">
                        <div style="height: 100%;">
                            <img src="https://merlionbuilders.com/wp-content/uploads/2021/06/ourvisionq.png"
                                 alt=""
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-9">
                <div class=" bg-opacity-10 p-4 rounded shadow">
                    <h2 class="fw-bold mb-3">Lumbini Innovate - A Real Estate Solution is at Hotel Siddhartha View,
                        Karkando Nepalgunj</h2>
                    <p class="fs-5">
                        हामीले ल्याएका छौ नेपालगंज उप-महानगरपालिका कारकाँदो होटेल सिद्धार्थको नजिकै आकर्षक आवासीय
                        घडेरीहरु ।<br><br>
                        पानी, बत्ति र पक्की सडकको सुबिधा सहित<br>
                        रोजेर खरिद एवं बुकिङ्ग को लागि समयमै सम्पर्क गर्नुहोस्<br><br>
                        <i class="bi bi-telephone-fill me-2"></i>
                        मोबाईल नं. : ९८५८०२५२४१
                    </p>
                </div>
            </div>
            <div class="col-lg-3 mt-2">
                <video id="myVideo" width="auto" height="370" controls autoplay muted playsinline>
                    <source src="{{ asset('backend/video/video.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .masthead {
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
    <script>
        function unmuteVideo() {
            const video = document.getElementById("myVideo");
            if (video) {
                video.muted = false;
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            const video = document.getElementById("myVideo");

            const observer = new IntersectionObserver(
                (entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            unmuteVideo();
                            observer.unobserve(video); // Unobserve after first unmute
                        }
                    });
                },
                {
                    threshold: 0.5
                }
            );

            if (video) {
                observer.observe(video);
            }
        });
    </script>
@endpush
