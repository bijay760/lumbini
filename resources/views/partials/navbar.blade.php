<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">
        <!-- Brand logo with better sizing control -->
        <!-- <a class="d-flex align-items-center justify-content-center justify-content-md-start justify-content-lg-start mb-3" style ="text-decoration: none;"
        href="{{ route('home') }}">
            <img src="{{ asset('backend/assets/images/login-images/logo (3).png') }}"
                         class="img-fluid me-2"
                         style="height: 77px; width: auto;"
                         alt="Company Logo">A Complete Real-estate solution.
                 
        </a> -->

        <a class="navbar-brand d-flex align-items-center" style="text-decoration: none;" href="{{ route('home') }}">
    <img src="{{ asset('backend/assets/images/login-images/logo%20(3).png') }}"
         class="img-fluid me-2"
         style="height: 77px; width: auto;"
         alt="Company Logo">
    <!-- <span style="font-size: 0.875rem; font-weight: bold; color: #20254d;">
        A Complete Real <br>State Solution
    </span> -->
</a>


        <!-- <div class="d-flex align-items-center justify-content-center justify-content-md-start justify-content-lg-start mb-3">
                    <img src="{{ asset('backend/assets/images/login-images/logo(2312).png') }}"
                         class="img-fluid me-2"
                         style="height: 77px; width: auto;"
                         alt="Company Logo">A Complete Real-estate solution.
                </div> -->


        <!-- Mobile toggle button with animation -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar content with improved structure -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <!-- Home -->
                <li class="nav-item mx-1">
                    <a class="nav-link position-relative py-3 px-2 text-dark {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}" style="text-decoration: none;">
                        <i class="bi bi-house-door me-1 d-lg-none"></i>
                        <span class="d-lg-inline">Home</span>
                        <span class="position-absolute bottom-0 start-0 end-0 mx-auto bg-black {{ request()->routeIs('home') ? 'active-indicator' : '' }}"
                              style="height: 3px; width: {{ request()->routeIs('home') ? '100%' : '0' }}; transition: width 0.3s ease;"></span>
                    </a>
                </li>

                <!-- About Us -->
                <li class="nav-item mx-1">
                    <a class="nav-link position-relative py-3 px-2 text-dark {{ request()->routeIs('about-us') ? 'active' : '' }}"
                       href="{{ route('about-us') }}" style="text-decoration: none;">
                        <i class="bi bi-info-circle me-1 d-lg-none"></i>
                        <span class="d-lg-inline">About Us</span>
                        <span class="position-absolute bottom-0 start-0 end-0 mx-auto bg-black {{ request()->routeIs('about-us') ? 'active-indicator' : '' }}"
                              style="height: 3px; width: {{ request()->routeIs('about-us') ? '100%' : '0' }}; transition: width 0.3s ease;"></span>
                    </a>
                </li>

                <!-- Projects -->
                <li class="nav-item mx-1">
                    <a class="nav-link position-relative py-3 px-2 text-dark {{ request()->routeIs('projects') ? 'active' : '' }}"
                       href="{{ route('projects') }}" style="text-decoration: none;">
                        <i class="bi bi-folder me-1 d-lg-none"></i>
                        <span class="d-lg-inline">Projects</span>
                        <span class="position-absolute bottom-0 start-0 end-0 mx-auto bg-black {{ request()->routeIs('projects') ? 'active-indicator' : '' }}"
                              style="height: 3px; width: {{ request()->routeIs('projects') ? '100%' : '0' }}; transition: width 0.3s ease;"></span>
                    </a>
                </li>

                <!-- Contact -->
                <li class="nav-item mx-1">
                    <a class="nav-link position-relative py-3 px-2 text-dark {{ request()->routeIs('contact') ? 'active' : '' }}"
                       href="{{ route('contact') }}" style="text-decoration: none;">
                        <i class="bi bi-envelope me-1 d-lg-none"></i>
                        <span class="d-lg-inline">Contact</span>
                        <span class="position-absolute bottom-0 start-0 end-0 mx-auto bg-black {{ request()->routeIs('contact') ? 'active-indicator' : '' }}"
                              style="height: 3px; width: {{ request()->routeIs('contact') ? '100%' : '0' }}; transition: width 0.3s ease;"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
/* Make navbar-toggler-icon black on mobile */
@media (max-width: 991.98px) {
    .navbar-toggler .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(0,0,0,1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
}
</style>
