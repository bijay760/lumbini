@extends('layouts.app')

@section('title', 'Lumbani Innovate - land Booking')


@section('content')
    <header class="masthead">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-md-7 col-lg-6">
                    <div class="text-left text-white">
                        <h1 class="mb-5">Our first project - a real estate project in Nepalgunj-Kohalpur road.</h1>
                        <form class="form-subscribe" id="contactForm">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="{{ route('land.booking') }}" class="btn btn-lg" id="submitButton"
                                       type="submit">Book Now</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-7 col-lg-6">
                    <div class="my-3">
                        <a href="{{ asset('backend/assets/images/land%20(1).jpg') }}" data-lightbox="land">
                            <img src="{{ asset('backend/assets/images/landimg.png') }}" class="img-fluid" alt="">
                        </a>
                        <a href="{{ asset('backend/assets/images/land%20(2).jpg') }}" data-lightbox="land"></a>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div class="page">
        <div class="container">
            <div class="alert alert-dismissible fade show p-0" role="alert">
                <div class="popover position-relative rounded-0 w-100 popover-1"
                     style="max-width: 100% ; z-index:999 !important" role="tooltip">
                    <div class="popover-arrow"></div>
                    <h3 class="popover-header d-flex align-items-center"><i
                            class="bx bx-burst-hover bxs-info-square bx-sm  me-2 "></i> Notice <small>
                            <button type="button"
                                    class="btn-close p-2 mt-1 me-2" data-bs-dismiss="alert" aria-label="Close"></button>
                        </small>
                    </h3>
                    <div class="popover-body"><b>10% Discount</b> to Lakshya Holdings'/Capital's Shareholders</div>
                </div>
            </div>

            <form action="https://www.lakshyashare.com/landbookings/store" method="POST" enctype="multipart/form-data"
                  class="formdes shadow-sm" id="application-form">


                <h1 class="form-title">Lakshya Capital Land Booking Form</h1>
                <input type="hidden" name="_token" value="whq95bZipqwPHroDWdFzMZyhfvQLuHYA1Pu1RZ3p">
                <div class="form-group">


                    <div> Are you shareholder of Lakshya Holdings/Capital Ltd?</div>
                    <div class="input-group mb-3">
                        <div class="form-check mr-3">
                            <!-- <div class="input-group-text"> -->
                            <input type="radio" name="is_exisiting_shareholder" id="exist-yes" value="1"
                                   autocomplete="off">
                            <label for="exist-yes">Yes</label>
                            <!-- </div> -->
                        </div>
                        <div class="form-check">
                            <!-- <div class="input-group-text"> -->
                            <input type="radio" name="is_exisiting_shareholder" id="exist-no" value="0"
                                   autocomplete="off" checked>
                            <label for="exist-no">No</label>
                            <!-- </div> -->
                        </div>
                    </div>

                </div>

                <div class="form-group" id="applicationIdContainer">
                    <label for="oldtoken">
                        <span class="material-symbols-outlined">
                            fingerprint
                        </span>
                        Application ID</label>
                    <input type="text" class="form-control" id="oldtoken" name="oldtoken"
                           placeholder="Enter your Application ID">
                </div>
                <div class="form-group">
                    <label for="full_name">
                        <span class="material-symbols-outlined">
                            account_circle
                        </span>
                        Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name"
                           placeholder="Enter your Full Name">
                </div>
                <div class="form-group">
                    <label for="permanent_address">
                        <span class="material-symbols-outlined">
                            home
                        </span>
                        Permanent Address</label>
                    <input type="text" class="form-control" id="permanent_address" name="permanent_address"
                           placeholder="Enter your Permanent Address">
                </div>
                <div class="form-group">
                    <label for="temporary_address">
                        <span class="material-symbols-outlined">
                            home
                        </span>
                        Temporary Address</label>
                    <input type="text" class="form-control" id="temporary_address" name="temporary_address"
                           placeholder="Enter your Temporary Address">
                </div>
                <div class="form-group">
                    <label for="email"><span class="material-symbols-outlined">
                            mail
                        </span>Email address</label>
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="Enter your Email address">
                </div>
                <div class="form-group">
                    <label for="mobile_number">
                        <span class="material-symbols-outlined">
                            call
                        </span>
                        Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" name="mobile_number"
                           placeholder="Enter your Mobile Number">
                </div>

                <div class="form-group">
                    <label for="land_category"><span class="material-symbols-outlined">
                            fact_check
                        </span>Land Category</label>
                    <select class="form-control" id="land_category" name="land_category">
                        <option value="" disabled selected>Choose a Land Category</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
                </div>
                <div class="information_div" id="information_div">
                    <p id="info"></p>
                </div>
                <div class="form-group">
                    <label for="plot_number"><span class="material-symbols-outlined">
                            fact_check
                        </span>Plot Number</label>
                    <select class="form-control" id="plot_number" name="plot_number">
                        <option value="" disabled selected>Choose the Plot Number</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="total_amount">
                        <span class="material-symbols-outlined">
                            money
                        </span>
                        Total Amount</label>
                    <input type="text" class="form-control" id="total_amount" name="total_amount"
                           placeholder="Enter your Total Amount" readonly>
                </div>
                <div class="form-group">
                    <label for="booking_amount">
                        <span class="material-symbols-outlined">
                            money
                        </span>
                        Booking Amount</label>
                    <input type="text" class="form-control" id="booking_amount" name="booking_amount"
                           placeholder="Enter your Booking Amount" readonly>
                </div>

                <div class="form-group">

                    <div> Have you deposited at least 30% of the Residential Land (ghaderi) price as booking amount?
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-check mr-3">

                            <input type="radio" name="has_deposited" id="deposit-yes" value="1"
                                   autocomplete="off">
                            <label for="deposit-yes">Yes</label>
                        </div>
                        <div class="form-check mr-3">

                            <input type="radio" name="has_deposited" id="deposit-no" value="0"
                                   autocomplete="off" checked>
                            <label for="deposit-no" selected>No</label>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="voucherContainer">
                    <label for="voucher">Upload voucher</label>
                    <input type="file" class="form-control border-0 d-block ms-auto" id="voucher" name="voucher[]"
                           multiple accept="image/*">
                </div>

                <input type="text" name="is_submittable" id="is_submittable" hidden>
                <input type="text" name="l_holder_id" id="holder_id" hidden>
                <input type="text" name="from_LC" id="from_LC" hidden>
                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                <button type="submit" class="btn btn-primary" id="lb_sub">Submit</button>
            </form>
        </div>
    </div>
@endsection
