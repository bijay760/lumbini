@extends('layouts.app')

@section('title', 'Contact Us | Lumbini Innovate Real Estate')
@section('meta_description', 'Get in touch with Nepal\'s leading real estate experts. Contact Lumbini Innovate for property inquiries, partnerships, or customer support.')
@section('meta_keywords', 'contact real estate Nepal, property inquiry Kathmandu, real estate support Nepal, Lumbini Innovate contact')

@section('og_title', 'Contact Our Real Estate Experts | Lumbini Innovate')
@section('og_description', 'Reach out to our team for property inquiries, investment opportunities, or any real estate services in Nepal.')
@section('og_image', 'https://lumbiniinnovate.com.np/backend/assets/images/login-images/logo%20(3).png')
@section('twitter_image', 'https://lumbiniinnovate.com.np/backend/assets/images/login-images/logo%20(3).png')

@php
    $phone     = '+977-9848023023';
    $phoneHref = 'tel:+9779848023023';
@endphp

@section('content')

{{-- ============ HERO ============ --}}
<header class="ls-hero ls-hero--page">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="ls-hero__title">Contact us</h1>
                <p class="ls-hero__lead mx-auto mb-0">
                    Ask about a plot, a visit or a partnership. We reply as soon as we can.
                </p>
            </div>
        </div>
    </div>
</header>

{{-- ============ FORM + MAP ============ --}}
<section class="ls-section ls-section--paper">
    <div class="container">

        @if (session('success'))
            <div class="alert ls-alert" role="status">{{ session('success') }}</div>
        @endif

        <div class="row g-5">
            <div class="col-lg-6">
                <form action="{{ route('contact.store') }}" method="POST" id="contactForm" class="ls-form">
                    @csrf

                    <div class="ls-field">
                        <label for="formName">Name</label>
                        <input type="text" id="formName" name="customer_name"
                               placeholder="Enter your name" autocomplete="name"
                               class="form-control @error('customer_name') is-invalid @enderror"
                               value="{{ old('customer_name') }}" required>
                        @error('customer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="ls-field">
                        <label for="formEmail">Email address</label>
                        <input type="email" id="formEmail" name="customer_email"
                               placeholder="Enter your email" autocomplete="email"
                               class="form-control @error('customer_email') is-invalid @enderror"
                               value="{{ old('customer_email') }}" required>
                        @error('customer_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="ls-field">
                        <label for="formMessage">Message</label>
                        <textarea id="formMessage" name="message" rows="5"
                                  placeholder="Write your message here"
                                  class="form-control @error('message') is-invalid @enderror"
                                  required>{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="ls-field">
                        <div class="g-recaptcha" data-sitekey="6LfjXkwrAAAAAIa5vRT4J3-Iej-U45n9Pvio11Z9"></div>
                        @error('g-recaptcha-response')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" id="submitBtn" class="btn ls-btn ls-btn--navy ls-submit">Send message</button>
                </form>
            </div>

            <div class="col-lg-6">
                <div class="ls-map">
                    <iframe
                        title="Lumbini Innovate office on Google Maps"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.263151370148!2d81.6485712!3d28.0889795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39986700742bac1d%3A0xcd25d8050edf7aa0!2sLumbini%20Innovate%20(%E0%A4%B2%E0%A5%81%E0%A4%AE%E0%A5%8D%E0%A4%AC%E0%A4%BF%E0%A4%A8%E0%A5%80%20%E0%A4%87%E0%A4%A8%E0%A5%8D%E0%A4%A8%E0%A5%8B%E0%A4%AD%E0%A5%87%E0%A4%9F)!5e0!3m2!1sen!2sus!4v1716820000000!5m2!1sen!2sus"
                        width="600"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <div class="ls-callbox">
                    <div class="ls-callbox__label">Prefer to talk?</div>
                    <a href="{{ $phoneHref }}" class="ls-phone">
                        <i class="bi bi-telephone-fill" aria-hidden="true"></i> {{ $phone }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700&family=Hanken+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    /*
     * Shared with the home, about, projects and booking pages. Move the :root tokens and the
     * generic .ls-* rules into one stylesheet (e.g. public/css/ls.css) to avoid several copies.
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
    .ls-btn:focus-visible, .ls-phone:focus-visible { outline: 3px solid #7fb4ff; outline-offset: 2px; }

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

    /* Success message */
    .ls-alert { background: #e8f4ee; border: 1px solid #b9dcc8; border-left: 4px solid var(--ls-available); color: #1d5a3c; border-radius: .5rem; margin-bottom: 2rem; }

    /* Form */
    .ls-form { background: #fff; border: 1px solid var(--ls-line); border-radius: .75rem; padding: 2rem; }
    .ls-field { margin-bottom: 1.25rem; }
    .ls-field label { display: block; font-weight: 600; margin-bottom: .35rem; }
    .ls-form .form-control { border-color: var(--ls-line); border-radius: .5rem; padding: .65rem .85rem; color: var(--ls-text); }
    .ls-form .form-control:focus { border-color: var(--ls-navy); box-shadow: 0 0 0 .2rem rgba(28,36,82,.15); }
    .ls-form .form-control.is-invalid { border-color: #c0392b; }
    .ls-submit { width: 100%; font-size: 1.05rem; margin-top: .25rem; }

    /* Map + phone */
    .ls-map { position: relative; aspect-ratio: 16 / 10; border-radius: .75rem; overflow: hidden; border: 1px solid var(--ls-line); background: #fff; }
    .ls-map iframe { position: absolute; inset: 0; width: 100%; height: 100%; }
    .ls-callbox { margin-top: 1.5rem; padding: 1.25rem 1.5rem; border-top: 3px solid var(--ls-navy); background: #fff; border-radius: 0 0 .5rem .5rem; }
    .ls-callbox__label { color: var(--ls-muted); margin-bottom: .25rem; }
    .ls-phone { display: inline-flex; align-items: center; gap: .6rem; font-size: 1.3rem; font-weight: 700; color: var(--ls-navy); text-decoration: none; }
    .ls-phone i { color: var(--ls-available); }

    @media (max-width: 575.98px) {
        .ls-hero { padding: 3.5rem 0; }
        .ls-section { padding: 2.5rem 0; }
        .ls-form { padding: 1.25rem; }
    }
</style>
@endpush