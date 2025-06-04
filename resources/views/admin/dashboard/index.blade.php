@extends('admin.layouts.app')
@section('title', 'Dashboard | Lumbini Innovate')
@section('content')
    <div class="container-fluid py-3">

        <!-- Page Indicator -->
        <div class="mb-4 card-header">
            <h4 class="mb-0 text-muted" style="font-size: 12px;">
                <a href="#" class="text-decoration-none text-muted">Dashboard</a>
            </h4>
        </div>

        <!-- Your dashboard content here -->
        <div class="row">
            <!-- Example Stat Card 1 -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted">Total Users</h6>
                        <h3 class="font-weight-bold">1,245</h3>
                        <p class="mb-0 text-success"><i class="fas fa-arrow-up"></i> 12% this month</p>
                    </div>
                </div>
            </div>

            <!-- Example Stat Card 2 -->

            <!-- Add more cards as needed -->
        </div>
    </div>
@endsection
