<footer class="bg-dark text-white pt-5 pb-4">
    <div class="container">
        <div class="row">
            <!-- Company Info -->
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('backend/assets/images/login-images/logo(2312).png') }}"
                         class="img-fluid me-2"
                         style="height: 40px;"
                         alt="Company Logo">
                    <!-- <h5 class="mb-0 fw-bold">Your Brand</h5> -->
                </div>
                <p class="text-white">Providing quality land booking services with transparency and efficiency.</p>
                <div class="social-icons mt-4">
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-5 text-white"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-twitter fs-5 text-white"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-linkedin fs-5 text-white"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-5 text-white"></i></a>
                </div>

            </div>

            <!-- Quick Links -->
            <!-- <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase fw-bold mb-4">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-white text-decoration-none">Home</a></li>
                    <li class="mb-2"><a href="{{ route('land.booking') }}" class="text-white text-decoration-none">Land Booking</a></li>
                    <li class="mb-2"><a href="{{ route('reports') }}" class="text-white text-decoration-none">Reports</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">About Us</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">Contact</a></li>
                </ul>
            </div> -->

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase fw-bold mb-4">Contact Us</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="bi bi-geo-alt-fill me-2"></i>
                         Chandragiri-13, Kathmandu, Nepal
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone-fill me-2"></i>
                          +977-9801104064
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-geo-alt-fill me-2"></i>
                         Karkado, Nepalgunj, Nepal
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone-fill me-2"></i>
                          +977-9848023023
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-envelope-fill me-2"></i>
                        lumbiniinnovate@gmail.com
                    </li>
                    
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-uppercase fw-bold mb-4">Connect With Us</h5>
                <p class="text-white">Subscribe to our mail for the latest updates.</p>
                <form class="mb-3">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Your Email" aria-label="Your Email">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-send-fill"></i>
                        </button>
                    </div>
                </form>
                <div class="payment-methods mt-3">
                    <p class="small text-white mb-2">We accept:</p>
                    <div class="flex gap-4 items-center">
                        <img src="https://esewa.com.np/common/images/esewa_logo.png" alt="eSewa" class="h-6 mb-3">
                        <img src="https://fonepay.com/images/logo.png" alt="Fonepay" class="h-6">
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4 bg-secondary">

        <!-- Copyright -->
        <div class="row align-items-center">
            <div class="text-center text-md-start">
                <p class="small mb-0">&copy; {{ date('Y') }} Lumbini Innovate Ltd.  All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<!-- Back to Top Button -->
<a href="#" class="btn btn-primary btn-lg back-to-top rounded-circle position-fixed bottom-0 end-0 m-4 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
    <i class="bi bi-arrow-up"></i>
</a>

<!-- Footer CSS -->
<style>
    footer a {
        transition: all 0.3s ease;
    }

    footer a:hover {
        color: var(--bs-primary) !important;
        padding-left: 5px;
    }

    .social-icons a {
        display: inline-block;
        transition: transform 0.3s ease;
    }

    .social-icons a:hover {
        transform: translateY(-3px);
    }

    .back-to-top {
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .back-to-top.show {
        display: flex;
        opacity: 1;
    }
</style>

<!-- Back to Top JavaScript -->
<script>
    // Back to top button
    const backToTopButton = document.querySelector('.back-to-top');

    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('show');
        } else {
            backToTopButton.classList.remove('show');
        }
    });

    backToTopButton.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>
