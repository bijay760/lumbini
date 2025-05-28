@extends('layouts.app')

@section('title', 'Lumbini Innovate - Projects')

@push('modals')
    @include('modals.share-sell-notice')
@endpush

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-5">Our Real Estate Projects</h1>
        <div class="row">
            <div class="col-12">
                <!-- Project 1 - -->
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <button class="btn btn-link text-decoration-none w-100 text-start d-flex justify-content-between align-items-center"
                                data-bs-toggle="collapse"
                                data-bs-target="#projectKarkando"
                                aria-expanded="false">
                            <div>
                                <span class="badge bg-success me-2">Residential</span>
                                <strong>Karkando, Near Siddhartha Hotel</strong>
                            </div>
                            <i class="bi bi-chevron-down collapse-icon"></i>
                        </button>
                    </div>
                    <div class="collapse show" id="projectKarkando">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <img src="{{asset('backend/assets/images/project1.png')}}"
                                         alt="Karkando Residential Plots"
                                         class="img-fluid rounded shadow">
                                </div>
                                <div class="col-md-6">
                                    <h2 class="text-danger mb-3">Karkando, Near Siddhartha Hotel</h2>
                                    <p class="text-muted mb-3">
                                        <i class="bi bi-geo-alt-fill"></i> Nepalgunj Sub-Metropolitan City
                                    </p>
                                    <div class="mb-4">
                                        <p>Premium residential plots with all modern amenities near Siddhartha Hotel.</p>
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> पानी, बत्ति र पक्की सडकको सुबिधा</li>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> 24/7 security</li>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Near schools and hospitals</li>
                                        </ul>
                                    </div>
                                    <div class="bg-light p-3 rounded mb-4">
                                        <p class="mb-0">
                                            <i class="bi bi-telephone-fill"></i> Contact: +977-9848023023
                                        </p>
                                    </div>
                                    <div class="d-grid gap-2 d-md-block">
                                        <button class="btn btn-primary me-md-2 mb-2">Enquire Now</button>
                                        <button class="btn btn-outline-secondary mb-2" data-bs-toggle="modal" data-bs-target="#shareSellNoticeModal">
                                            Share Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project 2 - Indrapur -->
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <button class="btn btn-link text-decoration-none w-100 text-start d-flex justify-content-between align-items-center"
                                data-bs-toggle="collapse"
                                data-bs-target="#projectIndrapur"
                                aria-expanded="false">
                            <div>
                                <span class="badge bg-warning text-dark me-2">Commercial</span>
                                <strong>Indrapur, Near Pauwa Hotel</strong>
                            </div>
                            <i class="bi bi-chevron-down collapse-icon"></i>
                        </button>
                    </div>
                    <div class="collapse show" id="projectIndrapur">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <img src="{{asset('backend/assets/images/project1.png')}}"
                                         alt="Indrapur Commercial Complex"
                                         class="img-fluid rounded shadow">
                                </div>
                                <div class="col-md-6">
                                    <h2 class="text-danger mb-3">Indrapur, Near Pauwa Hotel</h2>
                                    <p class="text-muted mb-3">
                                        <i class="bi bi-geo-alt-fill"></i> Nepalgunj Sub-Metropolitan City
                                    </p>
                                    <div class="mb-4">
                                        <p>Modern commercial complex with retail shops and office spaces.</p>
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Prime business location</li>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Ample parking space</li>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> High foot traffic area</li>
                                        </ul>
                                    </div>
                                    <div class="bg-light p-3 rounded mb-4">
                                        <p class="mb-0">
                                            <i class="bi bi-telephone-fill"></i> Contact: +977-9848023023
                                        </p>
                                    </div>
                                    <div class="d-grid gap-2 d-md-block">
                                        <button class="btn btn-primary me-md-2 mb-2">Enquire Now</button>
                                        <button class="btn btn-outline-secondary mb-2" data-bs-toggle="modal" data-bs-target="#shareSellNoticeModal">
                                            Share Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project 3 - Kanthepur -->
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <button class="btn btn-link text-decoration-none w-100 text-start d-flex justify-content-between align-items-center"
                                data-bs-toggle="collapse"
                                data-bs-target="#projectKanthepur"
                                aria-expanded="false">
                            <div>
                                <span class="badge bg-info me-2">Mixed Development</span>
                                <strong>Kanthepur</strong>
                            </div>
                            <i class="bi bi-chevron-down collapse-icon"></i>
                        </button>
                    </div>
                    <div class="collapse" id="projectKanthepur">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <img src="{{asset('backend/assets/images/project1.png')}}"
                                         alt="Kanthepur Development"
                                         class="img-fluid rounded shadow">
                                </div>
                                <div class="col-md-6">
                                    <h2 class="text-danger mb-3">Kanthepur Mixed Development</h2>
                                    <p class="text-muted mb-3">
                                        <i class="bi bi-geo-alt-fill"></i> Nepalgunj Sub-Metropolitan City
                                    </p>
                                    <div class="mb-4">
                                        <p>Residential and commercial plots with modern infrastructure in prime location.</p>
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Mixed-use zoning</li>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Modern drainage system</li>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Close to transportation hub</li>
                                        </ul>
                                    </div>
                                    <div class="bg-light p-3 rounded mb-4">
                                        <p class="mb-0">
                                            <i class="bi bi-telephone-fill"></i> Contact: +977-9848023023
                                        </p>
                                    </div>
                                    <div class="d-grid gap-2 d-md-block">
                                        <button class="btn btn-primary me-md-2 mb-2">Enquire Now</button>
                                        <button class="btn btn-outline-secondary mb-2" data-bs-toggle="modal" data-bs-target="#shareSellNoticeModal">
                                            Share Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project 4 - Kantital -->
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <button class="btn btn-link text-decoration-none w-100 text-start d-flex justify-content-between align-items-center"
                                data-bs-toggle="collapse"
                                data-bs-target="#projectKantital"
                                aria-expanded="false">
                            <div>
                                <span class="badge bg-success me-2">Residential</span>
                                <strong>Kantital</strong>
                            </div>
                            <i class="bi bi-chevron-down collapse-icon"></i>
                        </button>
                    </div>
                    <div class="collapse" id="projectKantital">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <img src="{{asset('backend/assets/images/project1.png')}}"
                                         alt="Kantital Residential"
                                         class="img-fluid rounded shadow">
                                </div>
                                <div class="col-md-6">
                                    <h2 class="text-danger mb-3">Kantital Gated Community</h2>
                                    <p class="text-muted mb-3">
                                        <i class="bi bi-geo-alt-fill"></i> Nepalgunj Sub-Metropolitan City
                                    </p>
                                    <div class="mb-4">
                                        <p>Premium gated community with luxury amenities and 24/7 security.</p>
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Clubhouse with gym</li>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Landscaped gardens</li>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Children's play area</li>
                                        </ul>
                                    </div>
                                    <div class="bg-light p-3 rounded mb-4">
                                        <p class="mb-0">
                                            <i class="bi bi-telephone-fill"></i> Contact: +977-9848023023
                                        </p>
                                    </div>
                                    <div class="d-grid gap-2 d-md-block">
                                        <button class="btn btn-primary me-md-2 mb-2">Enquire Now</button>
                                        <button class="btn btn-outline-secondary mb-2" data-bs-toggle="modal" data-bs-target="#shareSellNoticeModal">
                                            Share Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project 5 - Near Solti Hotel -->
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <button class="btn btn-link text-decoration-none w-100 text-start d-flex justify-content-between align-items-center"
                                data-bs-toggle="collapse"
                                data-bs-target="#projectSolti"
                                aria-expanded="false">
                            <div>
                                <span class="badge bg-warning text-dark me-2">Commercial</span>
                                <strong>Near Solti Hotel</strong>
                            </div>
                            <i class="bi bi-chevron-down collapse-icon"></i>
                        </button>
                    </div>
                    <div class="collapse" id="projectSolti">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <img src="{{asset('backend/assets/images/project1.png')}}"
                                         alt="Near Solti Hotel"
                                         class="img-fluid rounded shadow">
                                </div>
                                <div class="col-md-6">
                                    <h2 class="text-danger mb-3">Commercial Spaces Near Solti Hotel</h2>
                                    <p class="text-muted mb-3">
                                        <i class="bi bi-geo-alt-fill"></i> Nepalgunj Sub-Metropolitan City
                                    </p>
                                    <div class="mb-4">
                                        <p>Retail shops and office spaces in prime commercial location.</p>
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> High visibility location</li>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Flexible space configurations</li>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Competitive lease rates</li>
                                        </ul>
                                    </div>
                                    <div class="bg-light p-3 rounded mb-4">
                                        <p class="mb-0">
                                            <i class="bi bi-telephone-fill"></i> Contact: +977-9848023023
                                        </p>
                                    </div>
                                    <div class="d-grid gap-2 d-md-block">
                                        <button class="btn btn-primary me-md-2 mb-2">Enquire Now</button>
                                        <button class="btn btn-outline-secondary mb-2" data-bs-toggle="modal" data-bs-target="#shareSellNoticeModal">
                                            Share Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project 6 - Traffic Chowk -->
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <button class="btn btn-link text-decoration-none w-100 text-start d-flex justify-content-between align-items-center"
                                data-bs-toggle="collapse"
                                data-bs-target="#projectTrafficChowk"
                                aria-expanded="false">
                            <div>
                                <span class="badge bg-danger me-2">Premium</span>
                                <strong>Traffic Chowk</strong>
                            </div>
                            <i class="bi bi-chevron-down collapse-icon"></i>
                        </button>
                    </div>
                    <div class="collapse" id="projectTrafficChowk">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <img src="{{asset('backend/assets/images/project1.png')}}"
                                         alt="Traffic Chowk Premium"
                                         class="img-fluid rounded shadow">
                                </div>
                                <div class="col-md-6">
                                    <h2 class="text-danger mb-3">Traffic Chowk Luxury Apartments</h2>
                                    <p class="text-muted mb-3">
                                        <i class="bi bi-geo-alt-fill"></i> Nepalgunj Sub-Metropolitan City
                                    </p>
                                    <div class="mb-4">
                                        <p>High-end apartments with panoramic city views in the heart of Nepalgunj.</p>
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Penthouse options available</li>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Smart home technology</li>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> Rooftop garden</li>
                                        </ul>
                                    </div>
                                    <div class="bg-light p-3 rounded mb-4">
                                        <p class="mb-0">
                                            <i class="bi bi-telephone-fill"></i> Contact: +977-9848023023
                                        </p>
                                    </div>
                                    <div class="d-grid gap-2 d-md-block">
                                        <button class="btn btn-primary me-md-2 mb-2">Enquire Now</button>
                                        <button class="btn btn-outline-secondary mb-2" data-bs-toggle="modal" data-bs-target="#shareSellNoticeModal">
                                            Share Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact CTA -->
        <div class="text-lg-center text-sm-left py-5 mt-4 bg-light rounded">
            <h3 class="mb-3">Ready to invest in your future?</h3>
            <p class="lead mb-4">Our team is ready to assist you with all property inquiries</p>
            <div class="d-flex justify-content-center gap-3">
                <button class="btn btn-danger btn-lg">
                    <i class="bi bi-telephone"></i> Call Now: +977-9848023023
                </button>
                <button class="btn btn-outline-primary btn-lg">
                    <i class="bi bi-whatsapp"></i> WhatsApp Us
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Add click event to all collapse buttons
                document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(button => {
                    button.addEventListener('click', function() {
                        const target = this.getAttribute('data-bs-target');
                        const icon = this.querySelector('.collapse-icon');

                        if (document.querySelector(target).classList.contains('show')) {
                            icon.classList.remove('bi-chevron-up');
                            icon.classList.add('bi-chevron-down');
                        } else {
                            icon.classList.remove('bi-chevron-down');
                            icon.classList.add('bi-chevron-up');
                        }
                    });
                });
            });
        </script>
    @endpush

    <style>
        .collapse-icon {
            transition: transform 0.3s ease;
        }
        .card-header button:not(.collapsed) .collapse-icon {
            transform: rotate(180deg);
        }
    </style>
@endsection
