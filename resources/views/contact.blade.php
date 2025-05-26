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
            <form>
                <!-- Name input -->
                <div class="form-outline mb-4">
                    <label class="form-label" 
                    for="formName">Name</label>
                    <input type="text" 
                    id="formName" 
                    placeholder="Enter your name"
                    class="form-control"/>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" 
                    for="formEmail">Email address</label>

                    <input type="email" 
                    id="formEmail" 
                    placeholder="Enter your email"
                    class="form-control" />
                </div>

                <!-- Message input -->
                <div class="form-outline mb-4">
                    <label class="form-label"
                     for="formMessage">Message</label>

                    <textarea class="form-control" 
                    id="formMessage"
                    placeholder="Write your message here ..."
                     rows="4"></textarea>
                </div>
                <!-- Submit button -->
                <button type="submit" 
                class="btn btn-primary btn-block mb-4 w-100">Send</button>
            </form>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm p-4">
                <h5>Our Offices</h5>
                <ul class="list-unstyled mb-3">
                    <li><strong>Chandragiri-13, Kathmandu, Nepal</strong></li>
                    <li>Phone: +977-9801104064</li>
                </ul>
                <ul class="list-unstyled mb-3">
                    <li><strong>Karkado, Nepalgunj, Nepal</strong></li>
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

@push('styles')

@endpush
