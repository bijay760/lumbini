<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <!-- Brand logo with better sizing control -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('backend/assets/images/login-images/logo%20(3).png') }}"
                 class="img-fluid me-2"
                 style="height: 40px; width: auto;"
                 alt="Company Logo">
        </a>

        <!-- Mobile toggle button with animation -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path stroke="black" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/>
            </svg>
        </button>

        <!-- Navbar content with improved structure -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                <li class="nav-item mx-1">
                    <a class="nav-link position-relative py-3 px-2 text-dark {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">
                        <i class="bi bi-house-door me-1 d-lg-none"></i>
                        Home
                        <span class="position-absolute bottom-0 start-0 end-0 mx-auto bg-black active-indicator"
                              style="height: 3px; width: 0; transition: width 0.3s ease;"></span>
                    </a>
                </li>

                <li class="nav-item mx-1">
                    <a class="nav-link position-relative py-3 px-2 text-dark {{ request()->routeIs('land.booking') ? 'active' : '' }}"
                       href="{{ route('land.booking') }}">
                        <i class="bi bi-map me-1 d-lg-none"></i>
                        Land Booking
                        <span class="position-absolute bottom-0 start-0 end-0 mx-auto bg-black active-indicator"
                              style="height: 3px; width: 0; transition: width 0.3s ease;"></span>
                    </a>
                </li>

                <li class="nav-item mx-1">
                    <a class="nav-link position-relative py-3 px-2 text-dark {{ request()->routeIs('reports') ? 'active' : '' }}"
                       href="{{ route('reports') }}">
                        <i class="bi bi-file-earmark-bar-graph me-1 d-lg-none"></i>
                        Reports
                        <span class="position-absolute bottom-0 start-0 end-0 mx-auto bg-black active-indicator"
                              style="height: 3px; width: 0; transition: width 0.3s ease;"></span>
                    </a>
                </li>
            </ul>

            <!-- Optional: User dropdown or CTA button -->
            <div class="d-flex ms-lg-3">
                <a href="#" class="btn btn-outline-light rounded-pill px-3">
                    <i class="bi bi-person-circle me-1"></i> Login
                </a>
            </div>
        </div>
    </div>
</nav>
