@extends('layouts.app')

@section('title', 'About Us - Lumbini Innovate')
@section('meta_description', 'Learn about our mission to transform real estate in Nepal through innovation and integrity. Discover our story and values.')
@section('meta_keywords', 'real estate Nepal, about Lumbini Innovate, property solutions Nepal, real estate company')
@section('og_title', 'About Lumbini Innovate - Transforming Nepal\'s Real Estate')
@section('og_description', 'Discover how we\'re revolutionizing property solutions in Nepal with affordable, tech-driven services')
@section('og_image', 'https://lumbiniinnovate.com.np/backend/assets/images/login-images/logo%20(3).png')
@section('og_type', 'article')
@section('twitter_image', 'https://lumbiniinnovate.com.np/backend/assets/images/login-images/logo%20(3).png')

@php
$phone = '+977-9848023023';
$phoneHref = 'tel:+9779848023023';

$team = [
['name' => 'Ashok Gautam', 'role' => 'Chairperson', 'photo' => 'backend/team/team3.jpg'],
['name' => 'Rizwan Ali Ansari', 'role' => 'Chief Executive Officer', 'photo' => 'backend/team/team1.jpg'],
['name' => 'Nirmal Sharma', 'role' => 'Director', 'photo' => 'backend/team/team2.jpg'],
];
@endphp

@section('content')

{{-- ============ HERO ============ --}}
<header class="ls-hero ls-hero--page">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="ls-hero__title">Real estate built on innovation and integrity</h1>
                <p class="ls-hero__lead mx-auto mb-0">
                    We offer affordable, tech-driven and personal property services across Nepal,
                    with a current focus on Nepalgunj.
                </p>
            </div>
        </div>
    </div>
</header>

{{-- ============ WHO WE ARE + TEAM ============ --}}
<section class="ls-section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <h2 class="ls-h2">Who we are</h2>
                <p class="ls-body">
                    Lumbini Innovate is a full-service real estate company providing complete property solutions across Nepal.
                    Our current focus is Nepalgunj, where we help people buy a first home, invest in high-growth property or find rental assets.
                </p>
                <p class="ls-body">
                    We offer prime-location properties with flexible financing, either through a bank or privately, depending on your needs.
                </p>
                <p class="ls-body mb-0">
                    Our experienced team is committed to transparency, timeliness and results, so every step of your property journey is smooth and reliable.
                </p>
            </div>

            <div class="col-lg-6">
                <h2 class="ls-h2">Our team</h2>
                <ul class="ls-team">
                    @foreach ($team as $member)
                    <li class="ls-team__member">
                        <img src="{{ asset($member['photo']) }}" alt="{{ $member['name'] }}" width="72" height="72" loading="lazy">
                        <div>
                            <div class="ls-team__name">{{ $member['name'] }}</div>
                            <div class="ls-team__role">{{ $member['role'] }}</div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ============ WHY WE STAND OUT ============ --}}
<section class="ls-section ls-section--paper">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5">
                <h2 class="ls-h2">Why we stand out</h2>
                <p class="ls-body mb-0">
                    Good locations, and a choice of ways to pay for them.
                </p>
            </div>

            <div class="col-lg-7">
                <dl class="ls-rows">
                    <div class="ls-row">
                        <dt><i class="bi bi-geo-alt-fill" aria-hidden="true"></i> Prime locations</dt>
                        <dd>Exclusive properties in high-growth urban centers.</dd>
                    </div>
                    <div class="ls-row">
                        <dt><i class="bi bi-building-check" aria-hidden="true"></i> Bank financing</dt>
                        <dd>Partnerships with top banks for competitive rates.</dd>
                    </div>
                    <div class="ls-row">
                        <dt><i class="bi bi-shield-lock" aria-hidden="true"></i> Private financing</dt>
                        <dd>Flexible financing options with discreet capital solutions.</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</section>

{{-- ============ MISSION & VISION ============ --}}
<section class="ls-section">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-6">
                <div class="ls-statement">
                    <h2 class="ls-h2">Our mission</h2>
                    <p class="ls-body mb-0">
                        To provide complete, trusted real estate solutions that help individuals and investors across Nepal
                        reach their property goals with ease, transparency and value. We build long-term relationships through
                        quality service, timely delivery and integrity.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="ls-statement">
                    <h2 class="ls-h2">Our vision</h2>
                    <p class="ls-body mb-0">
                        To become a leading name in Nepal's real estate industry: a Rs. 100 crore company that eventually goes public
                        and welcomes retail investors over time. We plan to expand into land development, construction and essential
                        equipment, and to be the No. 1 name in Nepal's real estate sector.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ FINAL CTA ============ --}}
<section class="ls-cta">
    <div class="container text-center">
        <h2 class="ls-cta__title">Talk to our team</h2>
        <p class="ls-cta__text">Tell us what you are looking for and we will help you find it.</p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <a href="{{ $phoneHref }}" class="btn ls-btn ls-btn--light">Call {{ $phone }}</a>
            <a href="{{ route('projects') }}" class="btn ls-btn ls-btn--ghost">See our projects</a>
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
     * Shared with the home page. Move the :root tokens and the generic .ls-* rules
     * into one stylesheet (e.g. public/css/ls.css) to avoid keeping two copies.
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

    .ls-hero,
    .ls-section,
    .ls-cta {
        font-family: var(--ls-font-body);
        color: var(--ls-text);
    }

    /* Buttons */
    .ls-btn {
        font-weight: 700;
        padding: .8rem 1.4rem;
        border-radius: .5rem;
        border: 2px solid transparent;
    }

    .ls-btn--light {
        background: #fff;
        color: var(--ls-navy);
    }

    .ls-btn--light:hover {
        background: var(--ls-paper);
        color: var(--ls-navy);
    }

    .ls-btn--ghost {
        border-color: rgba(255, 255, 255, .55);
        color: #fff;
    }

    .ls-btn--ghost:hover {
        background: rgba(255, 255, 255, .12);
        color: #fff;
    }

    .ls-btn:focus-visible {
        outline: 3px solid #7fb4ff;
        outline-offset: 2px;
    }

    /* Hero */
    .ls-hero {
        color: #fff;
        padding: 5rem 0;
        background: linear-gradient(105deg, rgba(20, 26, 61, .96) 0%, rgba(28, 52, 92, .88) 100%),
        url("{{ asset('backend/assets/images/bg.png') }}") center / cover no-repeat;
    }

    .ls-hero--page {
        padding: 4.5rem 0;
    }

    .ls-hero__title {
        font-family: var(--ls-font-head);
        font-weight: 700;
        font-size: clamp(2.1rem, 4.2vw, 3.1rem);
        line-height: 1.1;
        letter-spacing: -.02em;
        margin-bottom: 1.25rem;
    }

    .ls-hero__lead {
        font-size: 1.15rem;
        line-height: 1.6;
        max-width: 36rem;
        color: rgba(255, 255, 255, .88);
    }

    /* Sections and text */
    .ls-section {
        padding: 5rem 0;
        background: #fff;
    }

    .ls-section--paper {
        background: var(--ls-paper);
    }

    .ls-h2 {
        font-family: var(--ls-font-head);
        font-weight: 700;
        font-size: clamp(1.6rem, 2.8vw, 2.1rem);
        line-height: 1.15;
        letter-spacing: -.01em;
        color: var(--ls-navy);
        margin-bottom: 1rem;
    }

    .ls-body {
        font-size: 1.1rem;
        line-height: 1.65;
        max-width: 36rem;
        color: var(--ls-muted);
        margin-bottom: 1.25rem;
    }

    /* Team */
    .ls-team {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .ls-team__member {
        display: flex;
        align-items: center;
        gap: 1.1rem;
        padding: 1.1rem 0;
        border-top: 1px solid var(--ls-line);
    }

    .ls-team__member:last-child {
        border-bottom: 1px solid var(--ls-line);
    }

    .ls-team__member img {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }

    .ls-team__name {
        font-family: var(--ls-font-head);
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--ls-navy);
    }

    .ls-team__role {
        color: var(--ls-muted);
    }

    /* Rows (why we stand out) */
    .ls-rows {
        margin: 0;
    }

    .ls-row {
        display: grid;
        grid-template-columns: 13rem 1fr;
        gap: .5rem 2rem;
        padding: 1.5rem 0;
        border-top: 1px solid var(--ls-line);
    }

    .ls-row:last-child {
        border-bottom: 1px solid var(--ls-line);
    }

    .ls-row dt {
        font-family: var(--ls-font-head);
        font-size: 1.15rem;
        color: var(--ls-navy);
        display: flex;
        align-items: center;
        gap: .6rem;
    }

    .ls-row dt i {
        color: var(--ls-available);
    }

    .ls-row dd {
        margin: 0;
        color: var(--ls-muted);
        line-height: 1.6;
    }

    /* Mission and vision */
    .ls-statement {
        border-top: 3px solid var(--ls-navy);
        padding-top: 1.5rem;
    }

    /* Final CTA */
    .ls-cta {
        background: #276b49;
        color: #fff;
        padding: 4.5rem 0;
    }

    .ls-cta__title {
        font-family: var(--ls-font-head);
        font-weight: 700;
        font-size: clamp(1.8rem, 3.4vw, 2.6rem);
        margin-bottom: .75rem;
    }

    .ls-cta__text {
        font-size: 1.15rem;
        color: #fff;
        margin-bottom: 1.75rem;
    }

    @media (max-width: 767.98px) {

        .ls-hero,
        .ls-hero--page {
            padding: 3.5rem 0;
        }

        .ls-section {
            padding: 3.5rem 0;
        }

        .ls-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush