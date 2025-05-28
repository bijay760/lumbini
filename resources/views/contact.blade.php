@extends('layouts.app')

@section('title', 'Lumbini Innovate - Contact Us')

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
                    <div class="g-recaptcha mb-4" data-sitekey="6LfjXkwrAAAAAIa5vRT4J3-Iej-U45n9Pvio11Z9"></div>
                    <!-- Submit button -->
                    <button type="submit" id="submitBtn" class="btn btn-primary btn-block mb-4 w-100">
                        Send
                    </button>
                </form>
            </div>

            <div class="col-md-6">
                <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.263151370148!2d81.6485712!3d28.0889795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39986700742bac1d%3A0xcd25d8050edf7aa0!2sLumbini%20Innovate%20(%E0%A4%B2%E0%A5%81%E0%A4%AE%E0%A5%8D%E0%A4%AC%E0%A4%BF%E0%A4%A8%E0%A5%80%20%E0%A4%87%E0%A4%A8%E0%A5%8D%E0%A4%A8%E0%A5%8B%E0%A4%AD%E0%A5%87%E0%A4%9F)!5e0!3m2!1sen!2sus!4v1716820000000!5m2!1sen!2sus"
                        width="600"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endpush
@endsection
