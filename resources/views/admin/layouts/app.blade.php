<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - Lumbini Innovate')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="icon" href="{{ asset('backend/assets/images/login-images/LHF.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Default (non-selected) menu item style */
        .nav-link {
            color: #6c757d; /* Gray color */
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            transition: all 0.3s ease;
        }

        /* Hover effect for non-selected items */
        .nav-link:hover {
            color: #495057;
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* Selected/Active menu item style */
        .nav-link.active {
            color: #fff;
            background-color: #007bff; /* Blue background */
            font-weight: 500;
        }

        /* Icon color for active item */
        .nav-link.active i {
            color: #fff;
        }

        .sidebar {
            width: 220px;
            min-height: calc(100vh - 56px);
        }

        .navbar-toggler {
            border: none;
            padding: 0;
        }

        .navbar-brand {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
        }

        @media (min-width: 768px) {
            .navbar-brand {
                max-width: none;
            }
        }

        @media (max-width: 767.98px) {
            .sidebar {
                width: 100%;
                position: static;
                min-height: auto;
            }
        }
    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <!-- Left side - brand and menu toggle -->
            <div class="d-flex align-items-center">
                <button class="navbar-toggler mr-2" type="button" data-toggle="collapse" data-target="#sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand font-weight-bold" href="{{ url('/admin') }}">
                    Lumbini Innovate
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Right side - user dropdown -->
            <div class="d-flex align-items-center">
                <!-- Desktop View - Full Email Dropdown -->
                <div class="dropdown d-none d-md-block">
                    <a class="nav-link dropdown-toggle" href="#" role="button"
                       id="desktopDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::guard('admin')->user()->email ?? 'Admin' }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="desktopDropdown">
                        <div class="px-4 py-2">
                            <div class="font-weight-bold">Dashboard</div>
                            <div class="text-muted small">{{ Auth::guard('admin')->user()->email ?? 'Admin' }}</div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('admin.logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>

                <!-- Mobile View - First Letter Dropdown -->
                <div class="dropdown d-md-none">
                    <a class="nav-link p-0" href="#" role="button"
                       id="mobileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span
                        class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white"
                        style="width: 36px; height: 36px; font-weight: bold;">
                        {{ strtoupper(substr(Auth::guard('admin')->user()->email ?? 'A', 0, 1)) }}
                    </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="mobileDropdown">
                        <div class="px-4 py-2">
                            <div class="font-weight-bold">Dashboard</div>
                            <div class="text-muted small">{{ Auth::guard('admin')->user()->email ?? 'Admin' }}</div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('admin.logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar bg-light border-right d-none d-md-block">
            <div class="p-2">
                <h5 class="text-center">Menu</h5>
                <hr>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/dashboard') || request()->is('admin/dashboard/*') ? ' active' : '' }}"
                       href="{{route('admin.dashboard')}}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/buy-sale') || request()->is('admin/buy-sale/*') ? ' active' : '' }}"
                       href="{{route('admin.buy-sale')}}">
                        <i class="fas fa-handshake"></i></i> BuySale List
                        {{--                        <i class="fas fa-landmark"></i> BuySale List--}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/properties') || request()->is('admin/properties/*') ? ' active' : '' }}"
                       href="{{route('admin.properties')}}">
                        <i class="fas fa-landmark"></i> Properties
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/plots') || request()->is('admin/plots/*') ? ' active' : '' }}"
                       href="{{route('admin.plots')}}">
                        <i class="fas fa-map-marked-alt"></i> Plots
                    </a>
                </li>
            </ul>
        </div>

        <!-- Mobile Sidebar -->
        <div class="collapse d-md-none" id="sidebar">
            <div class="bg-light p-3">
                <ul class="nav flex-column mobile-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/dashboard') || request()->is('admin/dashboard/*') ? ' active' : '' }}"
                           href="{{route('admin.dashboard')}}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/buy-sale') || request()->is('admin/buy-sale/*') ? ' active' : '' }}"
                           href="{{route('admin.buy-sale')}}">
                            <i class="fas fa-handshake"></i>BuySale List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/properties') || request()->is('admin/properties/*') ? ' active' : '' }}"
                           href="{{route('admin.properties')}}">
                            <i class="fas fa-landmark"></i>Properties
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/plots') || request()->is('admin/plots/*') ? ' active' : '' }}"
                           href="{{route('admin.plots')}}">
                            <i class="fas fa-map-marked-alt"></i>Plots
                        </a>
                    </li>
                </ul>
            </div>
        </div> @yield('content')
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const currentPath = window.location.pathname.toLowerCase();
        const navLinks = document.querySelectorAll('#mainNav .nav-link');

        navLinks.forEach(link => {
            const patterns = link.getAttribute('data-active-patterns').split(',');
            let isActive = false;

            patterns.forEach(pattern => {
                // Convert pattern to regex (replace * with .*)
                const regexPattern = pattern.trim()
                    .replace(/\*/g, '.*')
                    .replace(/\//g, '\\/');
                const regex = new RegExp(`^${regexPattern}$`);

                if (regex.test(currentPath)) {
                    isActive = true;
                }
            });

            if (isActive) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
