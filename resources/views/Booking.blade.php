@extends('layouts.app')

@php
    $company   = 'Lumbini Innovate Pvt. Ltd.';
    $phone     = '+977-9848023023';
    $phoneHref = 'tel:+9779848023023';

    $schema = [
        '@context'    => 'https://schema.org',
        '@type'       => 'WebPage',
        'name'        => $seoData['title'] ?? 'Available plots - ' . $company,
        'description' => $seoData['description'] ?? 'Residential plots for sale in Nepalgunj, Nepal',
        'url'         => $seoData['canonical'] ?? url()->current(),
        'mainEntity'  => [
            '@type' => 'RealEstateAgent',
            'name'  => $company,
        ],
    ];

    // Features may be stored as an array, a JSON string, or a JSON string encoded twice.
    $parseFeatures = function ($raw) {
        if (is_array($raw)) {
            return $raw;
        }
        for ($i = 0; $i < 2 && is_string($raw); $i++) {
            $raw = json_decode($raw, true);
        }
        return is_array($raw) ? $raw : [];
    };
@endphp

@push('structured_data')
<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
@endpush

@push('modals')
    @include('modals.share-sell-notice')
@endpush

@section('content')

{{-- ============ HERO ============ --}}
<header class="ls-hero ls-hero--page">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="ls-hero__title">Our available plots</h1>
                <p class="ls-hero__lead mx-auto mb-0">
                    Browse plots for sale and call us to choose, buy or book yours.
                </p>
            </div>
        </div>
    </div>
</header>

{{-- ============ PLOT LIST ============ --}}
<section class="ls-section ls-section--paper">
    <div class="container">
        <div class="row g-4">
            @forelse ($properties ?? [] as $property)
                @php $features = $parseFeatures($property->features ?? null); @endphp

                <div class="col-12 col-lg-6">
                    <article class="ls-listing">
                        <img class="ls-listing__image"
                             src="{{ asset($property->path) }}"
                             alt="{{ $property->title }}"
                             loading="lazy">

                        <div class="ls-listing__body">
                            <h2 class="ls-listing__title">{{ $property->title }}</h2>

                            @if (!empty($property->location))
                                <p class="ls-listing__location">{{ $property->location }}</p>
                            @endif

                            @if (!empty($property->address))
                                <p class="ls-listing__address">
                                    <i class="bi bi-geo-alt-fill" aria-hidden="true"></i> {{ $property->address }}
                                </p>
                            @endif

                            @if (!empty($property->additional_info))
                                <p class="ls-listing__info">{{ $property->additional_info }}</p>
                            @endif

                            @if (count($features))
                                <ul class="ls-listing__features">
                                    @foreach ($features as $feature)
                                        <li><i class="bi bi-check-circle-fill" aria-hidden="true"></i> {{ $feature }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="ls-listing__actions">
                            <a href="{{ route('contact') }}" class="btn ls-btn ls-btn--navy">Enquire now</a>
                            <a href="{{ $phoneHref }}" class="btn ls-btn ls-btn--outline">Call {{ $phone }}</a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="ls-empty">
                        <h2 class="ls-h2">No plots listed right now</h2>
                        <p class="ls-body mx-auto">New plots are added often. Call us to hear what is coming up.</p>
                        <a href="{{ $phoneHref }}" class="btn ls-btn ls-btn--navy">Call {{ $phone }}</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ============ FINAL CTA ============ --}}
<section class="ls-cta">
    <div class="container text-center">
        <h2 class="ls-cta__title">Can't find the right plot?</h2>
        <p class="ls-cta__text">Tell us your budget and preferred area and we will look for you.</p>
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
    /*
     * Shared with the home and about pages. Move the :root tokens and the generic .ls-* rules
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

    .ls-hero, .ls-section, .ls-cta { font-family: var(--ls-font-body); color: var(--ls-text); }

    /* Buttons */
    .ls-btn { font-weight: 700; padding: .75rem 1.3rem; border-radius: .5rem; border: 2px solid transparent; }
    .ls-btn--light { background: #fff; color: var(--ls-navy); }
    .ls-btn--light:hover { background: var(--ls-paper); color: var(--ls-navy); }
    .ls-btn--ghost { border-color: rgba(255,255,255,.55); color: #fff; }
    .ls-btn--ghost:hover { background: rgba(255,255,255,.12); color: #fff; }
    .ls-btn--navy { background: var(--ls-navy); color: #fff; }
    .ls-btn--navy:hover { background: var(--ls-navy-deep); color: #fff; }
    .ls-btn--outline { border-color: var(--ls-navy); color: var(--ls-navy); }
    .ls-btn--outline:hover { background: var(--ls-navy); color: #fff; }
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

    /* Sections and text */
    .ls-section { padding: 4rem 0; background: #fff; }
    .ls-section--paper { background: var(--ls-paper); }
    .ls-h2 { font-family: var(--ls-font-head); font-weight: 700; font-size: clamp(1.5rem, 2.6vw, 2rem); line-height: 1.15; color: var(--ls-navy); margin-bottom: 1rem; }
    .ls-body { font-size: 1.1rem; line-height: 1.65; max-width: 36rem; color: var(--ls-muted); margin-bottom: 1.5rem; }

    /* Plot listing */
    .ls-listing { height: 100%; display: flex; flex-direction: column; background: #fff; border: 1px solid var(--ls-line); border-radius: .75rem; overflow: hidden; }
    .ls-listing__image { display: block; width: 100%; aspect-ratio: 16 / 9; object-fit: cover; background: var(--ls-paper); }
    .ls-listing__body { flex: 1 1 auto; padding: 1.5rem 1.5rem 1rem; }
    .ls-listing__title { font-family: var(--ls-font-head); font-size: 1.4rem; font-weight: 700; line-height: 1.2; color: var(--ls-navy); margin: 0 0 .5rem; }
    .ls-listing__location { font-weight: 700; color: var(--ls-text); margin: 0 0 .25rem; }
    .ls-listing__address { color: var(--ls-muted); margin: 0 0 1rem; }
    .ls-listing__address i { color: var(--ls-available); margin-right: .25rem; }
    .ls-listing__info { line-height: 1.6; color: var(--ls-muted); margin-bottom: 1rem; }
    .ls-listing__features { list-style: none; margin: 0; padding: 1rem 0 0; border-top: 1px solid var(--ls-line); }
    .ls-listing__features li { display: flex; gap: .6rem; align-items: baseline; margin-bottom: .5rem; }
    .ls-listing__features i { color: var(--ls-available); }
    .ls-listing__actions { display: flex; flex-wrap: wrap; gap: .75rem; padding: 1rem 1.5rem 1.5rem; }

    .ls-empty { text-align: center; padding: 3rem 1rem; }

    /* Final CTA */
    .ls-cta { background: var(--ls-navy-deep); color: #fff; padding: 4.5rem 0; }
    .ls-cta__title { font-family: var(--ls-font-head); font-weight: 700; font-size: clamp(1.8rem, 3.4vw, 2.6rem); margin-bottom: .75rem; }
    .ls-cta__text { font-size: 1.15rem; color: rgba(255,255,255,.85); margin-bottom: 1.75rem; }

    @media (max-width: 767.98px) {
        .ls-hero { padding: 3.5rem 0; }
        .ls-section { padding: 3rem 0; }
    }
</style>
@endpush