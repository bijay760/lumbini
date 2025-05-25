<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('backend/assets/images/login-images/logo%20(3).png') }}" class="img-fluid" style="height:50px" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('land.booking') ? 'active' : '' }}" href="{{ route('land.booking') }}">Land Booking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('share.application') ? 'active' : '' }}" href="{{ route('share.application') }}">Share Application</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('right.share') ? 'active' : '' }}" href="{{ route('right.share') }}">Right Share</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('reports') ? 'active' : '' }}" href="{{ route('reports') }}">Reports</a>
                </li>
            </ul>
            <form class="d-flex mb-0 search-form" action="{{ route('holder.searchToken') }}" method="POST" id="search_app_id_form">
                @csrf
                <input class="form-control rounded-0 me-2" type="search" name="oldtoken" id="old_auth_token"
                       placeholder="Enter your 13-digits Application ID" aria-label="Search" style="width:275px">
                <button onclick="search_appID()" class="btn btn-info rounded-0 text-white" type="button"
                        style="background: #0578B4" id="search_token">Search
                </button>
            </form>
        </div>
    </div>
</nav>
