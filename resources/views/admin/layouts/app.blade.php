<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
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
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white"
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
            <div class="p-3">
                <h5 class="text-center">Menu</h5>
                <hr>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-users mr-2"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-cog mr-2"></i> Settings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-file-alt mr-2"></i> Reports
                    </a>
                </li>
            </ul>
        </div>

        <!-- Mobile Sidebar -->
        <div class="collapse d-md-none" id="sidebar">
            <div class="bg-light p-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users mr-2"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-cog mr-2"></i> Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-file-alt mr-2"></i> Reports
                        </a>
                    </li>
                </ul>
            </div>
        </div> @yield('content')
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
