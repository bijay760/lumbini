@extends('layouts.app')

@section('content')

{{-- ============ HERO ============ --}}
<header class="ls-hero ls-hero--page">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="ls-hero__title">Land booking form</h1>
                <p class="ls-hero__lead mx-auto mb-0">
                    Fill in your details, choose a plot and upload your deposit voucher to book.
                </p>
            </div>
        </div>
    </div>
</header>

{{-- ============ FORM ============ --}}
<section class="ls-section ls-section--paper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">

                <form action="https://www.lakshyashare.com/landbookings/store" method="POST" enctype="multipart/form-data"
                      class="ls-form" id="application-form">

                    <input type="hidden" name="_token" value="">

                    {{-- Existing applicant --}}
                    <fieldset class="ls-fieldset">
                        <legend>Existing applicant</legend>

                        <p class="ls-question" id="existingQuestion">Are you an existing shareholder?</p>
                        <div class="ls-choices" role="radiogroup" aria-labelledby="existingQuestion">
                            <input type="radio" name="is_exisiting_shareholder" id="exist-yes" value="1" autocomplete="off">
                            <label for="exist-yes">Yes</label>

                            <input type="radio" name="is_exisiting_shareholder" id="exist-no" value="0" autocomplete="off" checked>
                            <label for="exist-no">No</label>
                        </div>

                        <div class="ls-field" id="applicationIdContainer">
                            <label for="oldtoken">Application ID</label>
                            <input type="text" class="form-control" id="oldtoken" name="oldtoken" placeholder="Enter your application ID">
                        </div>
                    </fieldset>

                    {{-- Personal details --}}
                    <fieldset class="ls-fieldset">
                        <legend>Your details</legend>

                        <div class="ls-field">
                            <label for="full_name">Full name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter your full name" autocomplete="name">
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6 ls-field">
                                <label for="permanent_address">Permanent address</label>
                                <input type="text" class="form-control" id="permanent_address" name="permanent_address" placeholder="Enter your permanent address">
                            </div>
                            <div class="col-md-6 ls-field">
                                <label for="temporary_address">Temporary address</label>
                                <input type="text" class="form-control" id="temporary_address" name="temporary_address" placeholder="Enter your temporary address">
                            </div>
                            <div class="col-md-6 ls-field">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" autocomplete="email">
                            </div>
                            <div class="col-md-6 ls-field">
                                <label for="mobile_number">Mobile number</label>
                                <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter your mobile number" inputmode="tel" autocomplete="tel">
                            </div>
                        </div>
                    </fieldset>

                    {{-- Plot --}}
                    <fieldset class="ls-fieldset">
                        <legend>Choose your plot</legend>

                        <div class="row g-3">
                            <div class="col-md-6 ls-field">
                                <label for="land_category">Land category</label>
                                <select class="form-control" id="land_category" name="land_category">
                                    <option value="" disabled selected>Choose a land category</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                            </div>
                            <div class="col-md-6 ls-field">
                                <label for="plot_number">Plot number</label>
                                <select class="form-control" id="plot_number" name="plot_number">
                                    <option value="" disabled selected>Choose the plot number</option>
                                </select>
                            </div>
                        </div>

                        <div class="information_div ls-note" id="information_div">
                            <p id="info"></p>
                        </div>
                    </fieldset>

                    {{-- Payment --}}
                    <fieldset class="ls-fieldset">
                        <legend>Payment</legend>

                        <div class="row g-3">
                            <div class="col-md-6 ls-field">
                                <label for="total_amount">Total amount</label>
                                <input type="text" class="form-control" id="total_amount" name="total_amount" placeholder="Filled in when you choose a plot" readonly>
                            </div>
                            <div class="col-md-6 ls-field">
                                <label for="booking_amount">Booking amount</label>
                                <input type="text" class="form-control" id="booking_amount" name="booking_amount" placeholder="Filled in when you choose a plot" readonly>
                            </div>
                        </div>

                        <p class="ls-question" id="depositQuestion">
                            Have you deposited at least 30% of the residential land (ghaderi) price as the booking amount?
                        </p>
                        <div class="ls-choices" role="radiogroup" aria-labelledby="depositQuestion">
                            <input type="radio" name="has_deposited" id="deposit-yes" value="1" autocomplete="off">
                            <label for="deposit-yes">Yes</label>

                            <input type="radio" name="has_deposited" id="deposit-no" value="0" autocomplete="off" checked>
                            <label for="deposit-no">No</label>
                        </div>

                        <div class="ls-field" id="voucherContainer">
                            <label for="voucher">Upload deposit voucher</label>
                            <input type="file" class="form-control" id="voucher" name="voucher[]" multiple accept="image/*">
                            <div class="ls-hint">You can select more than one image.</div>
                        </div>
                    </fieldset>

                    <input type="text" name="is_submittable" id="is_submittable" hidden>
                    <input type="text" name="l_holder_id" id="holder_id" hidden>
                    <input type="text" name="from_LC" id="from_LC" hidden>
                    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">

                    <button type="submit" class="btn ls-btn ls-btn--navy ls-submit" id="lb_sub">Submit booking</button>
                </form>

            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700&family=Hanken+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    /*
     * Shared with the home, about and projects pages. Move the :root tokens and the generic .ls-* rules
     * into one stylesheet (e.g. public/css/ls.css) to avoid keeping several copies.
     */
    :root {
        --ls-navy: #1c2452;
        --ls-navy-deep: #141a3d;
        --ls-paper: #f3f5f8;
        --ls-line: #d9dee6;
        --ls-text: #2b3150;
        --ls-muted: #5d6580;
        --ls-available: #2e7d55;
        --ls-font-head: "Bricolage Grotesque", "Segoe UI", sans-serif;
        --ls-font-body: "Hanken Grotesk", "Segoe UI", sans-serif;
    }

    .ls-hero, .ls-section { font-family: var(--ls-font-body); color: var(--ls-text); }

    /* Buttons */
    .ls-btn { font-weight: 700; padding: .8rem 1.4rem; border-radius: .5rem; border: 2px solid transparent; }
    .ls-btn--navy { background: var(--ls-navy); color: #fff; }
    .ls-btn--navy:hover { background: var(--ls-navy-deep); color: #fff; }
    .ls-btn:focus-visible { outline: 3px solid #7fb4ff; outline-offset: 2px; }

    /* Hero */
    .ls-hero {
        color: #fff;
        padding: 4.5rem 0;
        background:
            linear-gradient(105deg, rgba(20,26,61,.96) 0%, rgba(28,52,92,.88) 100%),
            url("{{ asset('backend/assets/images/bg.png') }}") center / cover no-repeat;
    }
    .ls-hero__title { font-family: var(--ls-font-head); font-weight: 700; font-size: clamp(2.1rem, 4.2vw, 3.1rem); line-height: 1.1; letter-spacing: -.02em; margin-bottom: 1.25rem; }
    .ls-hero__lead { font-size: 1.15rem; line-height: 1.6; max-width: 36rem; color: rgba(255,255,255,.88); }

    .ls-section { padding: 4rem 0; background: #fff; }
    .ls-section--paper { background: var(--ls-paper); }

    /* Form */
    .ls-form { background: #fff; border: 1px solid var(--ls-line); border-radius: .75rem; padding: 2rem; }
    .ls-fieldset { border: 0; padding: 0; margin: 0 0 2rem; min-width: 0; }
    .ls-fieldset legend {
        float: none;
        width: 100%;
        font-family: var(--ls-font-head);
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--ls-navy);
        padding-bottom: .6rem;
        margin-bottom: 1.25rem;
        border-bottom: 1px solid var(--ls-line);
    }
    .ls-field { margin-bottom: 1.1rem; }
    .ls-field label { display: block; font-weight: 600; margin-bottom: .35rem; }
    .ls-form .form-control { border-color: var(--ls-line); border-radius: .5rem; padding: .65rem .85rem; color: var(--ls-text); }
    .ls-form .form-control:focus { border-color: var(--ls-navy); box-shadow: 0 0 0 .2rem rgba(28,36,82,.15); }
    .ls-form .form-control[readonly] { background: var(--ls-paper); }
    .ls-hint { font-size: .9rem; color: var(--ls-muted); margin-top: .35rem; }

    .ls-question { font-weight: 600; margin-bottom: .6rem; }

    /* Yes / No choices */
    .ls-choices { display: flex; gap: .6rem; margin-bottom: 1.25rem; position: relative; }
    .ls-choices input { position: absolute; opacity: 0; width: 1px; height: 1px; }
    .ls-choices label {
        min-width: 5.5rem;
        text-align: center;
        padding: .55rem 1.1rem;
        border: 1px solid var(--ls-line);
        border-radius: .5rem;
        font-weight: 600;
        cursor: pointer;
        color: var(--ls-text);
        margin: 0;
    }
    .ls-choices input:checked + label { background: var(--ls-navy); border-color: var(--ls-navy); color: #fff; }
    .ls-choices input:focus-visible + label { outline: 3px solid #7fb4ff; outline-offset: 2px; }

    /* Plot info message (hidden while empty) */
    .ls-note { margin-top: .25rem; padding: .85rem 1rem; border-left: 4px solid var(--ls-available); background: var(--ls-paper); border-radius: .25rem; }
    .ls-note p { margin: 0; line-height: 1.55; }
    .ls-note:has(#info:empty) { display: none; }

    .ls-submit { width: 100%; font-size: 1.05rem; }

    @media (max-width: 575.98px) {
        .ls-hero { padding: 3.5rem 0; }
        .ls-section { padding: 2.5rem 0; }
        .ls-form { padding: 1.25rem; }
    }
</style>
@endpush