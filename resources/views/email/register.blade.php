<!-- resources/views/emails/property/registered.blade.php -->
@extends('email.layouts.master')

@section('title', 'Property Listing Received')

@section('content')
    <h4>Hello {{$data['owner_email'] }},</h4>

    <p>Thank you for listing your property with us. We've received the following details:</p>

    <p>Our team will review your listing and contact you within 2 business days. In the meantime, you can add photos or update your listing by logging into your account.</p>

    <p>If you have any questions, please don't hesitate to contact us at <a href="mailto:support@lumbiniinnovate.com.np">support@lumbiniinnovate.com.np</a> or call us at +977-9848023023</p>

    <p>Best regards,<br>Lumbini Innovate team</p>
@endsection
