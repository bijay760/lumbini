@extends('layouts.app')

@section('title', 'Lumbani Innovate - Home')

@push('modals')
    @include('modals.share-sell-notice')
@endpush

@section('content')
    <header class="masthead">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-left text-white">
                        <h1 class="mb-3 ">Lumbini Innovate Pvt. Ltd.</h1>
                        
                        <p class= "">
                            Your journey to the perfect home starts here.<br>
                           At Lumbini Innovate Pvt. Ltd.  we believe that every home has a story — 
                           and we’re here to help you write yours. Whether you're looking to buy your dream house, 
                           sell your current property, or rent a space that fits your lifestyle, our dedicated team 
                           of experts is with you at every step.
                        </p>
                        <form class="form-subscribe" id="contactForm">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="{{ route('land.booking') }}" class="btn btn-lg" id="submitButton" type="submit">Book Now</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <section class="showcase">
        <div class="container-fluid">
            <div class="row g-0">
                <div class="col-lg-4 order-2 order-lg- text-white showcase-img"
                     style="background-image: url('https://www.bflexion.com/themes/custom/bflexion/images/background-home.png')">
                </div>
                <div class="col-lg-7 ms-auto order-1 order-lg- my-auto showcase-text">
                    <h2>🧭 Your Trusted Real Estate Partner</h2>
                    <p class="lead mb-4 text-justify">
                        Navigating the real estate market can feel overwhelming. That's why we’ve built our reputation on trust,
                         transparency, and a deep understanding of the local market. With years of experience and a customer-first
                          approach, we ensure that your experience is not only successful — but enjoyable too.
                    </p>

                    <!-- <div class="abt-img"><img src="{{ asset('backend/assets/images/abt.jpg') }}"></div> -->
                    <img src="{{ asset('backend/assets/images/abt.jpg') }}" class="img-fluid d-block m-auto" alt="">

                    <h2 class= "mt-4"> Why Choose umbini Innovate Pvt. Ltd.</h2>
                    <p class="lead mb-0 text-justify">
                       <p class="mb-2">
                        ✔️ Verified Listings <br>
                        <span class= "pl-3">
                            We ensure that every property listed on our platform is thoroughly verified for authenticity and legal compliance — no surprises, 
                        just peace of mind.<br>
                        </span>
                            </p>
                       <p class="mb-2">

                        ✔️ Local Market Expertise <br>
                        <span class= "pl-3">
                        Our agents know the neighborhoods, the trends, and the opportunities. We provide insights that go beyond square footage — like school zones, 
                        commute times, and lifestyle fit.<br>
                        </span>
                        </p>
                       <p class="mb-2">

                        ✔️ Trusted by Thousands <br>
                        <span class= "pl-3">
                        With hundreds of successful transactions and glowing client testimonials, we’ve built a community that speaks for itself. Join the thousands who 
                        have found their perfect property with us. <br>
                        </span>
                        </p>
                       <p class="mb-2">

                        ✔️ Hassle-Free Transactions <br>
                        <span class= "pl-3">
                        From property visits to paperwork, we handle everything. Our end-to-end service means fewer headaches and more confidence in every decision.
                        </span>
                        </p>
                                            </p>
                </div>
            </div>
            <div class="row g-0">
                <div class="col-lg-5 order-lg- text-white showcase-img"
                     style="background-image: url('https://static.wixstatic.com/media/12316e44d26649c69a935420b4dbb784.jpg/v1/fill/w_640,h_500,fp_0.50_0.50,q_80,usm_0.66_1.00_0.01,enc_auto/12316e44d26649c69a935420b4dbb784.jpg')">
                </div>
                <div class="col-lg-6 me-auto my-auto showcase-text">
                    <h2>Super Benefit for Shareholders</h2>
                    <p class="lead mb-0">
                        All the shareholders are owners of the company. Therefore, providing maximum benefit to the
                        shareholders is always in top priority of the company. Therefore both our old shareholders and
                        new coming shareholders will get a direct discount on land purchase. Therefore, we invite people
                        to be our shareholders.
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
