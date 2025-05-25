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
                        <h1 class="mb-2 ">Lumbini Innovate Ltd. is a subsidiary company of Lumbini Innovate Ltd.</h1>
                        <p class= "col-md-7 col-lg-6">
                           Established by aiming
                            to invest in share market, derivative market, real estate and other innovative means of investment.
                            Its authorized capital is NPR. 1 Billion.
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
                    <h2>About Us</h2>
                    <p class="lead mb-4 text-justify">
                        <b>Lumbini Innovate Ltd.</b> is a subsidiary company of Lumbini Innovate Ltd. established by aiming
                        to invest in share market, derivative market, real estate and other innovative means of investment. Its
                        authorized capital is NPR. 1 Billion.
                        Being a subsidiary company of Lumbini Innovate Ltd. we have provided opportunity to the shareholders
                        of Lumbini Innovate Ltd. to take share ownership at first instance. We will open the opportunities
                        for others as well fulfilling the legal requirements.
                    </p>

                    <!-- <div class="abt-img"><img src="{{ asset('backend/assets/images/abt.jpg') }}"></div> -->
                    <img src="{{ asset('backend/assets/images/abt.jpg') }}" class="img-fluid d-block m-auto" alt="">

                    <h2 class= "mt-4">Our Projects</h2>
                    <p class="lead mb-0 text-justify">
                        Our <b>first project</b> has been developed with a real estate project in Nepalgunj. It is a 44
                        kattha land development project situated in Nepalgunj-Kohalpur road. We are planning to develop 6000 Square feet
                        for vehicle showrooms which can accommodate 4 large showrooms consisting spare parts and servicing
                        areas for the four wheel or two wheeler automobile brands. Then 16,000 square feet area for the godam. All
                        these developed commercial properties will be rented out.
                        From the day of incorporation, we have already started investing into share market. Since the market
                        gone down, it is good time of entry in the share market.
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
