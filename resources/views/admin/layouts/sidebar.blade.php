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
