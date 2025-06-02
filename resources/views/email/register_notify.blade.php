<!-- resources/views/emails/property/registered.blade.php -->
@extends('email.layouts.master')

@section('title', 'Property Listing Received')

@section('content')
    <h4>Hello admin ,</h4>
    <p>Your have receive a new property listing from {{$data['owner_email'] }}. Please verify and update accordingly.</p>
    <p>Best regards,<br>Lumbini Innovate team</p>
@endsection
