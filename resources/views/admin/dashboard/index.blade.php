@extends('admin.layouts.app')

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
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title text-muted">New Orders</h6>
                        <h3 class="font-weight-bold">328</h3>
                        <p class="mb-0 text-danger"><i class="fas fa-arrow-down"></i> 5% this week</p>
                    </div>
                </div>
            </div>

            <!-- Add more cards as needed -->
        </div>

        <div class="row">
            <!-- Example Placeholder for Chart or Table -->
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h6 class="mb-0">Recent Activity</h6>
                    </div>
                    <div class="card-body">
                        <p>Chart or activity log placeholder.</p>
                        {{-- You can embed a chart library or table here --}}
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h6 class="mb-0">Quick Links</h6>
                    </div>
                    <div class="card-body">
                        <a href="#" class="btn btn-outline-primary btn-block mb-2">Manage Users</a>
                        <a href="#" class="btn btn-outline-secondary btn-block">View Reports</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
