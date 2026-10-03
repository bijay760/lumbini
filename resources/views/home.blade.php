@extends('layouts.app')

@php
    $company   = 'Lumbini Innovate Pvt. Ltd.';
    $phone     = '+977-9848023023';
    $phoneHref = 'tel:+9779848023023';

    // Set to true to show the interactive plot site plan in the hero.
    $showSitePlan = false;

    // Hero image shown while the site plan is hidden. Swap for your plot/site photo.
    $heroImage = asset('images/dream-home.jpg');

    $schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'WebPage',
        'name'        => $seoData['title'] ?? $company,
        'description' => $seoData['description'] ?? 'Residential plots for sale in Nepalgunj, Nepal',
        'url'         => $seoData['canonical'] ?? url()->current(),
        'mainEntity'  => [
            '@type'       => 'RealEstateAgent',
            'name'        => $company,
            'telephone'   => $phone,
            'description' => 'Real estate company in Nepal offering plots, property buying, selling, renting and management.',
            'address'     => [
                '@type'           => 'PostalAddress',
                'addressCountry'  => 'NP',
                'addressLocality' => 'Kathmandu',
            ],
        ],
    ];
@endphp

@push('structured_data')
<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
@endpush

@push('modals')
    @include('modals.share-sell-notice')
@endpush

@section('content')

{{-- ============ HERO: headline + live site plan ============ --}}
<header class="ls-hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h1 class="ls-hero__title">Residential plots in Karkando, Nepalgunj</h1>
                <p class="ls-hero__lead">
                    Ready-to-build land near Hotel Siddhartha, with water, electricity and paved road access.
                    @if($showSitePlan)
                        Pick a plot on the site plan, then call us to book it.
                    @else
                        Call us to choose, buy or book your plot.
                    @endif
                </p>

                <div class="d-flex flex-wrap gap-3 mb-5">
                    <a href="{{ $phoneHref }}" class="btn ls-btn ls-btn--light">Call {{ $phone }}</a>
                    <a href="{{ route('projects') }}" class="btn ls-btn ls-btn--ghost">See all projects</a>
                </div>

                <ul class="ls-facts">
                    <li><i class="bi bi-droplet-half" aria-hidden="true"></i> Water supply</li>
                    <li><i class="bi bi-lightning-charge" aria-hidden="true"></i> Electricity</li>
                    <li><i class="bi bi-sign-turn-right" aria-hidden="true"></i> Paved roads</li>
                </ul>
            </div>

            @if($showSitePlan)
            <div class="col-lg-6">
                <section class="ls-plan" aria-labelledby="planTitle">
                    <div class="ls-plan__head">
                        <h2 id="planTitle" class="ls-plan__title">Karkando-18 site plan</h2>
                        <ul class="ls-legend" aria-label="Plot status key">
                            <li><span class="ls-dot ls-dot--available"></span><span id="countAvailable">0</span> available</li>
                            <li><span class="ls-dot ls-dot--booked"></span><span id="countBooked">0</span> booked</li>
                            <li><span class="ls-dot ls-dot--sold"></span><span id="countSold">0</span> sold</li>
                        </ul>
                    </div>

                    <div class="ls-plan__grid" id="planGrid" role="group" aria-label="Plots"></div>

                    <div class="ls-plan__detail" id="planDetail" aria-live="polite">
                        Select a plot to see its status and size.
                    </div>
                </section>
            </div>
            @else
            <div class="col-lg-6">
                <div class="ls-hero__image">
                    <img src="{{ $heroImage }}" alt="Residential plots at Karkando-18, Nepalgunj" fetchpriority="high">
                </div>
            </div>
            @endif
        </div>
    </div>
</header>

{{-- ============ LOCATION + VIDEO ============ --}}
<section class="ls-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h2 class="ls-h2">Karkando-18, near Siddhartha Hotel</h2>
                <p class="ls-body">
                    Residential plots in Nepalgunj Sub-Metropolitan City, with water supply, electricity and paved roads already in place.
                    Contact us early to choose, buy or book your plot.
                </p>
                <a href="{{ $phoneHref }}" class="ls-phone">
                    <i class="bi bi-telephone-fill" aria-hidden="true"></i> {{ $phone }}
                </a>
            </div>
            <div class="col-lg-6">
                <div class="ls-media">
                    <video id="siteVideo" controls muted playsinline preload="metadata">
                        <source src="{{ asset('backend/video/video.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ WHY BUY WITH US ============ --}}
<section class="ls-section ls-section--paper">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5">
                <h2 class="ls-h2">Buying land, without the guesswork</h2>
                <p class="ls-body">
                    We have worked in the local market for years. You get clear paperwork, honest answers and help with payment.
                </p>
                <img src="{{ asset('images/partner-about.jpg') }}" alt="Our team meeting a client" class="ls-photo" loading="lazy">
            </div>

            <div class="col-lg-7">
                <dl class="ls-rows">
                    <div class="ls-row">
                        <dt><i class="bi bi-geo-alt-fill" aria-hidden="true"></i> Prime locations</dt>
                        <dd>Plots in growing urban areas, close to roads and services.</dd>
                    </div>
                    <div class="ls-row">
                        <dt><i class="bi bi-building-check" aria-hidden="true"></i> Bank financing</dt>
                        <dd>We work with leading banks so you can get competitive loan rates.</dd>
                    </div>
                    <div class="ls-row">
                        <dt><i class="bi bi-shield-lock" aria-hidden="true"></i> Private financing</dt>
                        <dd>Flexible payment options, handled privately.</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</section>

{{-- ============ RECENT PROJECTS ============ --}}
<section class="ls-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="{{ asset('images/our-vision.jpg') }}" alt="One of our recent projects" class="ls-photo" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h2 class="ls-h2">Our recent projects</h2>
                <p class="ls-body">
                    See what we have built and sold lately, from plotted land to finished homes.
                </p>
                <a href="{{ route('projects') }}" class="btn ls-btn ls-btn--navy">View all projects</a>
            </div>
        </div>
    </div>
</section>

{{-- ============ FINAL CTA ============ --}}
<section class="ls-cta">
    <div class="container text-center">
        <h2 class="ls-cta__title">Ready to book a plot?</h2>
        <p class="ls-cta__text">Call {{ $company }} and we will confirm availability and arrange a site visit.</p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <a href="{{ $phoneHref }}" class="btn ls-btn ls-btn--light">Call {{ $phone }}</a>
            <a href="{{ route('contact') }}" class="btn ls-btn ls-btn--ghost">Send an enquiry</a>
        </div>
    </div>
</section>

@endsection

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700&family=Hanken+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --ls-navy: #1c2452;
        --ls-navy-deep: #141a3d;
        --ls-paper: #f3f5f8;
        --ls-line: #d9dee6;
        --ls-text: #2b3150;
        --ls-muted: #5d6580;
        --ls-available: #2e7d55;
        --ls-booked: #d08a12;
        --ls-sold: #98a1b3;
        --ls-font-head: "Bricolage Grotesque", "Segoe UI", sans-serif;
        --ls-font-body: "Hanken Grotesk", "Segoe UI", sans-serif;
    }

    .ls-hero, .ls-section, .ls-cta { font-family: var(--ls-font-body); color: var(--ls-text); }

    /* ---------- Buttons ---------- */
    .ls-btn {
        font-weight: 700;
        padding: .8rem 1.4rem;
        border-radius: .5rem;
        border: 2px solid transparent;
    }
    .ls-btn--light { background: #fff; color: var(--ls-navy); }
    .ls-btn--light:hover { background: var(--ls-paper); color: var(--ls-navy); }
    .ls-btn--ghost { border-color: rgba(255,255,255,.55); color: #fff; }
    .ls-btn--ghost:hover { background: rgba(255,255,255,.12); color: #fff; }
    .ls-btn--navy { background: var(--ls-navy); color: #fff; }
    .ls-btn--navy:hover { background: var(--ls-navy-deep); color: #fff; }
    .ls-btn:focus-visible, .ls-plot:focus-visible, .ls-phone:focus-visible {
        outline: 3px solid #7fb4ff;
        outline-offset: 2px;
    }

    /* ---------- Hero ---------- */
    .ls-hero {
        color: #fff;
        padding: 5rem 0;
        background:
            linear-gradient(105deg, rgba(20,26,61,.96) 0%, rgba(28,52,92,.88) 100%),
            url("{{ asset('backend/assets/images/bg.png') }}") center / cover no-repeat;
    }
    .ls-hero__title {
        font-family: var(--ls-font-head);
        font-weight: 700;
        font-size: clamp(2.2rem, 4.6vw, 3.4rem);
        line-height: 1.08;
        letter-spacing: -.02em;
        margin-bottom: 1.25rem;
    }
    .ls-hero__lead { font-size: 1.15rem; line-height: 1.6; max-width: 34rem; color: rgba(255,255,255,.88); margin-bottom: 2rem; }
    .ls-facts { list-style: none; padding: 0; margin: 0; display: flex; flex-wrap: wrap; gap: .75rem 1.75rem; }
    .ls-facts li { display: flex; align-items: center; gap: .5rem; font-weight: 600; }
    .ls-facts i { color: #8fd3ad; font-size: 1.15rem; }

    .ls-hero__image { border-radius: 1rem; overflow: hidden; box-shadow: 0 1.25rem 3rem rgba(0,0,0,.28); border: 4px solid rgba(255,255,255,.18); }
    .ls-hero__image img { display: block; width: 100%; height: auto; max-height: 460px; object-fit: cover; }

    /* ---------- Site plan ---------- */
    .ls-plan { background: #fff; color: var(--ls-text); border-radius: 1rem; padding: 1.25rem; box-shadow: 0 1.25rem 3rem rgba(0,0,0,.28); }
    .ls-plan__head { display: flex; flex-wrap: wrap; justify-content: space-between; gap: .5rem 1rem; margin-bottom: 1rem; }
    .ls-plan__title { font-family: var(--ls-font-head); font-size: 1.15rem; font-weight: 700; margin: 0; color: var(--ls-navy); }
    .ls-legend { list-style: none; padding: 0; margin: 0; display: flex; gap: 1rem; font-size: .85rem; color: var(--ls-muted); }
    .ls-legend li { display: flex; align-items: center; gap: .35rem; }
    .ls-dot { width: .7rem; height: .7rem; border-radius: 50%; display: inline-block; }
    .ls-dot--available { background: var(--ls-available); }
    .ls-dot--booked { background: var(--ls-booked); }
    .ls-dot--sold { background: var(--ls-sold); }

    .ls-plan__grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr) 2rem repeat(3, 1fr);
        gap: .4rem;
        padding: .75rem;
        background: var(--ls-paper);
        border-radius: .6rem;
    }
    .ls-road {
        background: repeating-linear-gradient(to bottom, #aeb5c4 0 .5rem, transparent .5rem 1rem) center / 3px 100% no-repeat, #e4e8ee;
        border-radius: .25rem;
    }
    .ls-plot {
        aspect-ratio: 1 / 1.1;
        border: 2px solid transparent;
        border-radius: .35rem;
        font-weight: 700;
        font-size: .9rem;
        color: #fff;
        cursor: pointer;
        padding: 0;
    }
    .ls-plot[data-status="available"] { background: var(--ls-available); }
    .ls-plot[data-status="booked"]    { background: var(--ls-booked); }
    .ls-plot[data-status="sold"]      { background: var(--ls-sold); }
    .ls-plot[aria-pressed="true"]     { border-color: var(--ls-navy); box-shadow: 0 0 0 2px #fff inset; }

    .ls-plan__detail { margin-top: 1rem; padding: .9rem 1rem; border: 1px solid var(--ls-line); border-radius: .6rem; min-height: 5.5rem; color: var(--ls-muted); }
    .ls-plan__detail strong { color: var(--ls-navy); font-size: 1.05rem; }
    .ls-plan__detail .ls-actions { display: flex; flex-wrap: wrap; gap: .6rem; margin-top: .75rem; }
    .ls-plan__detail .btn { padding: .45rem .9rem; font-size: .9rem; }
    .ls-badge { display: inline-block; margin-left: .5rem; padding: .1rem .55rem; border-radius: 99px; font-size: .78rem; font-weight: 700; color: #fff; }
    .ls-badge[data-status="available"] { background: var(--ls-available); }
    .ls-badge[data-status="booked"]    { background: var(--ls-booked); }
    .ls-badge[data-status="sold"]      { background: var(--ls-sold); }

    /* ---------- Sections ---------- */
    .ls-section { padding: 5rem 0; background: #fff; }
    .ls-section--paper { background: var(--ls-paper); }
    .ls-h2 { font-family: var(--ls-font-head); font-weight: 700; font-size: clamp(1.7rem, 3vw, 2.3rem); line-height: 1.15; letter-spacing: -.01em; color: var(--ls-navy); margin-bottom: 1rem; }
    .ls-body { font-size: 1.1rem; line-height: 1.65; max-width: 36rem; color: var(--ls-muted); margin-bottom: 1.5rem; }
    .ls-phone { display: inline-flex; align-items: center; gap: .6rem; font-size: 1.25rem; font-weight: 700; color: var(--ls-navy); text-decoration: none; }
    .ls-phone i { color: var(--ls-available); }
    .ls-photo { width: 100%; max-height: 380px; object-fit: cover; border-radius: .75rem; }
    .ls-media { border-radius: .75rem; overflow: hidden; background: #000; }
    .ls-media video { display: block; width: 100%; max-height: 340px; object-fit: cover; }

    .ls-rows { margin: 0; }
    .ls-row { display: grid; grid-template-columns: 13rem 1fr; gap: .5rem 2rem; padding: 1.5rem 0; border-top: 1px solid var(--ls-line); }
    .ls-row:last-child { border-bottom: 1px solid var(--ls-line); }
    .ls-row dt { font-family: var(--ls-font-head); font-size: 1.15rem; color: var(--ls-navy); display: flex; align-items: center; gap: .6rem; }
    .ls-row dt i { color: var(--ls-available); }
    .ls-row dd { margin: 0; color: var(--ls-muted); line-height: 1.6; }

    /* ---------- Final CTA ---------- */
    .ls-cta { background: #276b49; color: #fff; padding: 4.5rem 0; }
    .ls-cta__title { font-family: var(--ls-font-head); font-weight: 700; font-size: clamp(1.8rem, 3.4vw, 2.6rem); margin-bottom: .75rem; }
    .ls-cta__text { font-size: 1.15rem; color: #fff; margin-bottom: 1.75rem; }

    @media (max-width: 767.98px) {
        .ls-hero { padding: 3.5rem 0; }
        .ls-section { padding: 3.5rem 0; }
        .ls-row { grid-template-columns: 1fr; }
        .ls-plan__grid { grid-template-columns: repeat(3, 1fr) 1.25rem repeat(3, 1fr); }
    }
</style>
@endpush

@if($showSitePlan)
@push('scripts')
<script>
    /*
     * SAMPLE PLOT DATA - replace with real data.
     * Ideally pass the plots from the controller as JSON and use that instead of this array.
     * Each plot: { no, status: 'available' | 'booked' | 'sold', area, facing }
     */
    const plots = [
        { no: 1,  status: 'available', area: '4 aana', facing: 'East' },
        { no: 2,  status: 'sold',      area: '4 aana', facing: 'East' },
        { no: 3,  status: 'available', area: '4 aana', facing: 'East' },
        { no: 4,  status: 'booked',    area: '4 aana', facing: 'East' },
        { no: 5,  status: 'available', area: '4 aana', facing: 'East' },
        { no: 6,  status: 'sold',      area: '4 aana', facing: 'East' },
        { no: 7,  status: 'available', area: '4 aana', facing: 'East' },
        { no: 8,  status: 'available', area: '4 aana', facing: 'East' },
        { no: 9,  status: 'booked',    area: '4 aana', facing: 'East' },
        { no: 10, status: 'sold',      area: '4 aana', facing: 'East' },
        { no: 11, status: 'available', area: '4 aana', facing: 'East' },
        { no: 12, status: 'available', area: '4 aana', facing: 'East' },
        { no: 13, status: 'sold',      area: '4 aana', facing: 'West' },
        { no: 14, status: 'available', area: '4 aana', facing: 'West' },
        { no: 15, status: 'available', area: '4 aana', facing: 'West' },
        { no: 16, status: 'booked',    area: '4 aana', facing: 'West' },
        { no: 17, status: 'available', area: '4 aana', facing: 'West' },
        { no: 18, status: 'sold',      area: '4 aana', facing: 'West' },
        { no: 19, status: 'available', area: '4 aana', facing: 'West' },
        { no: 20, status: 'available', area: '4 aana', facing: 'West' },
        { no: 21, status: 'sold',      area: '4 aana', facing: 'West' },
        { no: 22, status: 'available', area: '4 aana', facing: 'West' },
        { no: 23, status: 'booked',    area: '4 aana', facing: 'West' },
        { no: 24, status: 'available', area: '4 aana', facing: 'West' },
    ];

    const phoneHref  = @json($phoneHref);
    const contactUrl = @json(route('contact'));
    const labels = { available: 'Available', booked: 'Booked', sold: 'Sold' };

    const grid   = document.getElementById('planGrid');
    const detail = document.getElementById('planDetail');

    function showDetail(plot) {
        const actions = plot.status === 'sold'
            ? ''
            : `<div class="ls-actions">
                   <a class="btn ls-btn ls-btn--navy" href="${phoneHref}">Call about plot ${plot.no}</a>
                   <a class="btn ls-btn" style="border-color:#1c2452;color:#1c2452" href="${contactUrl}?plot=${plot.no}">Send enquiry</a>
               </div>`;

        detail.innerHTML = `
            <strong>Plot ${plot.no}</strong>
            <span class="ls-badge" data-status="${plot.status}">${labels[plot.status]}</span>
            <div>${plot.area} &middot; ${plot.facing}-facing</div>
            ${actions}`;
    }

    function selectPlot(button, plot) {
        grid.querySelectorAll('.ls-plot').forEach(b => b.setAttribute('aria-pressed', 'false'));
        button.setAttribute('aria-pressed', 'true');
        showDetail(plot);
    }

    function renderPlan() {
        const rows = plots.length / 6;
        for (let r = 0; r < rows; r++) {
            const make = plot => {
                const b = document.createElement('button');
                b.type = 'button';
                b.className = 'ls-plot';
                b.dataset.status = plot.status;
                b.setAttribute('aria-pressed', 'false');
                b.setAttribute('aria-label', `Plot ${plot.no}, ${labels[plot.status]}`);
                b.textContent = plot.no;
                b.addEventListener('click', () => selectPlot(b, plot));
                return b;
            };

            for (let c = 0; c < 3; c++) grid.appendChild(make(plots[r * 3 + c]));

            const road = document.createElement('div');
            road.className = 'ls-road';
            road.setAttribute('aria-hidden', 'true');
            grid.appendChild(road);

            for (let c = 0; c < 3; c++) grid.appendChild(make(plots[plots.length / 2 + r * 3 + c]));
        }

        ['available', 'booked', 'sold'].forEach(status => {
            const id = 'count' + status.charAt(0).toUpperCase() + status.slice(1);
            document.getElementById(id).textContent = plots.filter(p => p.status === status).length;
        });
    }

    document.addEventListener('DOMContentLoaded', renderPlan);
</script>
@endpush
@endif