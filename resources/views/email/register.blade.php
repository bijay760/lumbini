<!-- resources/views/emails/property/registered.blade.php -->
@extends('email.layouts.master')

@section('title', 'Property Listing Received')

@section('content')
    <h1>Hello {{ $property->owner_name }},</h1>

    <p>Thank you for listing your property with us. We've received the following details:</p>

    <h2>Property Information</h2>
    <table class="details-table">
        <tr>
            <td><strong>Title:</strong></td>
            <td>{{ $property->title }}</td>
        </tr>
        <tr>
            <td><strong>Type:</strong></td>
            <td>{{ ucfirst($property->property_type) }}</td>
        </tr>
        <tr>
            <td><strong>Address:</strong></td>
            <td>
                {{ $property->address }}<br>
                {{ $property->city }}, {{ $property->state }} {{ $property->zip_code }}<br>
                {{ $property->country }}
            </td>
        </tr>
        <tr>
            <td><strong>Price:</strong></td>
            <td>${{ number_format($property->price, 2) }}</td>
        </tr>
        <tr>
            <td><strong>Area:</strong></td>
            <td>{{ number_format($property->area) }} sq ft</td>
        </tr>
    </table>

    <p>Our team will review your listing and contact you within 2 business days. In the meantime, you can add photos or update your listing by logging into your account.</p>

    <p>If you have any questions, please don't hesitate to contact us at <a href="mailto:support@example.com">support@example.com</a> or call us at +1 (555) 123-4567.</p>

    <p>Best regards,<br>The Property Team</p>
@endsection
