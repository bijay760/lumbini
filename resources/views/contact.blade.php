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
                <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow">
                    <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215390701341!2d-73.98784468459382!3d40.75798597932697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDQ1JzI4LjciTiA3M8KwNTknMTMuNyJX!5e0!3m2!1sen!2sus!4v1620000000000!5m2!1sen!2sus"
                            width="600"
                            height="450"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
{{--                <div class="shadow-sm p-4">--}}
{{--                    <h5>Registered Address</h5>--}}
{{--                    <ul class="list-unstyled mb-3">--}}
{{--                        <li><strong>Chandragiri-13, Kathmandu, Nepal</strong></li>--}}
{{--                        <li>Phone: +977-9801104064</li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--                <div class="shadow-sm p-4 mt-2">--}}
{{--                    <h5>Field Office</h5>--}}
{{--                    <ul class="list-unstyled mb-3">--}}
{{--                        <li><strong>Karkado-18, Nepalgunj, Nepal</strong></li>--}}
{{--                        <li>Phone: +977-9848023023</li>--}}
{{--                    </ul>--}}
{{--                    <p><strong>Email:</strong>--}}
{{--                        <a class="text-decoration-none"--}}
{{--                           href="mailto:lumbiniinnovate@gmail.com">lumbiniinnovate@gmail.com</a></p>--}}
{{--                </div>--}}

        </div>
    </div>
@endsection
