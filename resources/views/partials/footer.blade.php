<footer class="text-white pt-5 pb-4"
        style="background: #20254d;">
    <div class="container">
        <div class="row">
            <!-- Company Info -->
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <a class="d-flex align-items-center mb-3"
                   href="{{ route('home') }}"
                   style="text-decoration: none;
    line-height: 22px;
    ">
                    <img src="{{ asset('backend/assets/images/login-images/logo(2312).png') }}"
                         class="img-fluid"
                         style="height: 77px; width: auto;"
                         alt="Company Logo">
                    <div>
                        <div style="color:#ffffff;
                 font-family: Montserrat, sans-serif;
                 font-weight: 800;
                 ">
                            LUMBINI INNOVATE
                        </div>
                        <div style="color:#ffffff;
                font-family: Montserrat, sans-serif;
                font-weight: 500;
                font-size: 10.3px;
                 ">A Complete Real Estate Solution
                        </div>
                    </div>
                </a>
                <div class="mt-4 text-md-start justify-content-md-start justify-content-lg-start">
                    <a href="https://www.facebook.com/lumbini.innovate"
                       target="_blank"
                       class="text-white me-3">
                        <i class="bi bi-facebook fs-5"></i></a>
                    <!-- <a href="https://cdn.pixabay.com/photo/2021/11/11/12/41/facebook-6786210_1280.png"></a> -->
                    <!-- <img src="{{ asset('backend/assets/images/facebook.png') }}"
                         class="me-2"
                         style="height: 30px; width: auto; display: flex;"
                         alt="Company Logo"> -->
                    <!-- </a> -->
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4 mb-md-0 justify- text-lg-left">
                <h5 class="text-uppercase fw-bold mb-4">Contact Us</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="bi bi-geo-alt-fill me-2"></i>
                        Chandragiri-13, Kathmandu, Nepal
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone-fill me-2"></i>
                        <a href="tel:+9779848023023" class="text-decoration-none text-white">+977-9848023023</a>
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-envelope-fill me-2"></i>
                        <a href="mailto:info@lumbiniinnovate.com.np" class="text-decoration-none text-white">info@lumbiniinnovate.com.np</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6 justify-start">
                <h5 class="text-uppercase fw-bold mb-4 text-lg-left">Connect With Us</h5>
                <p class="text-white text-lg-left">Be the first to know about our projects.</p>
                <form class="mb-3" id="subscriptionForm">
                    <div class="input-group mx-sm-auto ms-md-0">
                        <input type="email"
                               class="form-control"
                               id="emailInput"
                               placeholder="Your Email"
                               aria-label="Your Email">
                    </div>
                    <div class="input-group mx-sm-auto ms-md-0 mt-1">
                        <input type="tel"
                               class="form-control"
                               id="phoneInput"
                               placeholder="Your Phone Number"
                               aria-label="Your Phone Number">
                    </div>
                    <button class="btn btn-primary w-50 mt-1 text-start" type="submit">
                        Subscribe Now
                    </button>
                </form>
            </div>

        </div>

        <hr class="my-4 bg-secondary">

        <!-- Copyright -->
        <div class="row align-items-center">
            <div class="text-center text-md-center">
                <p class="small mb-0">&copy; {{ date('Y') }} Lumbini Innovate Ltd. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<!-- Back to Top Button -->
<a href="#"
   class="btn btn-primary btn-lg back-to-top rounded-circle position-fixed bottom-0 end-0 m-4 d-flex align-items-center justify-content-center"
   style="width: 50px; height: 50px;">
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
<script>
    document.getElementById('subscriptionForm').addEventListener('submit', function (event) {
        const email = document.getElementById('emailInput').value;
        const phone = document.getElementById('phoneInput').value;

        if (!email && !phone) {
            event.preventDefault();
            alert('Please fill in either email or phone number');
        }
    });
</script>

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
        window.scrollTo({top: 0, behavior: 'smooth'});
    });
</script>
