@extends('layouts.app')

@section('title', 'Lumbani Innovate - Contact Us')

@push('modals')
    @include('modals.share-sell-notice')
@endpush

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 text-center">Contact Us</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="form-outline mb-4">
                        <label class="form-label"
                               for="formName">Name</label>
                        <input type="text"
                               id="formName" name="customer_name"
                               placeholder="Enter your name"
                               class="form-control" required/>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label"
                               for="formEmail">Email address</label>

                        <input type="email"
                               id="formEmail" name="customer_email"
                               placeholder="Enter your email"
                               class="form-control" required/>
                    </div>

                    <!-- Message input -->
                    <div class="form-outline mb-4">
                        <label class="form-label"
                               for="formMessage">Message</label>

                        <textarea class="form-control"
                                  id="formMessage" name="message"
                                  placeholder="Write your message here ..."
                                  rows="4" required></textarea>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" id="submitBtn" class="btn btn-primary btn-block mb-4 w-100">
                        Send
                    </button>
                </form>
            </div>

            <div class="col-md-6">
                <div class="shadow-sm p-4">
                    <h5>Corporate Office</h5>
                    <ul class="list-unstyled mb-3">
                        <li><strong>Chandragiri-13, Kathmandu, Nepal</strong></li>
                        <li>Phone: +977-9801104064</li>
                    </ul>
                </div>
                <div class="shadow-sm p-4 mt-2">
                    <h5>Field Office</h5>
                    <ul class="list-unstyled mb-3">
                        <li><strong>Karkado-18, Nepalgunj, Nepal</strong></li>
                        <li>Phone: +977-9848023023</li>
                    </ul>
                    <p><strong>Email:</strong>
                        <a class="text-decoration-none"
                           href="mailto:lumbiniinnovate@gmail.com">lumbiniinnovate@gmail.com</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
