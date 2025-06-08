@extends('admin.layouts.app')
@section('title', 'Plot Create | Lumbini Innovate')
@section('content')
    <div class="container-fluid py-3">
        <div class="mb-4 card-header">
            <h4 class="mb-0 text-muted" style="font-size: 12px;">
                <a href="" class="text-decoration-none text-muted">Plots | Create | #</a>
            </h4>
        </div>
        <form id="propertyRegistrationForm" method="POST" action="{{ route('admin.plots.store') }}"
              enctype="multipart/form-data">
            @csrf
            @include('admin.plots.form')
        </form>
    </div>
@endsection
