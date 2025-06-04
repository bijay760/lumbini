<footer class="text-white pt-5 pb-4"
        style="background: #20254d;">
    <div class="container">
        <div class="row">
            <!-- Company Info -->
            <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
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
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-geo-alt-fill me-2"></i>
                            Chandragiri-13, Kathmandu, Nepal
                        </li>

                        <li class="mb-2">
                            <i class="bi bi-envelope-fill me-2"></i>
                            <a href="mailto:info@lumbiniinnovate.com.np" class="text-decoration-none text-white">info@lumbiniinnovate.com.np</a>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-telephone-fill me-2"></i>
                            <a href="tel:+9779848023023" class="text-decoration-none text-white">+977-9848023023</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 justify-start">
                <h5 class="text-uppercase fw-bold mb-4 text-lg-left">Connect With Us</h5>
                <p class="text-white text-lg-left">Be the first to know about our projects.</p>
                <form class="mb-3" id="subscriptionForm" method="POST" action="{{ route('subscribe') }}">
                    @csrf
                    <div class="input-group mx-sm-auto ms-md-0">
                        <input type="email"
                               class="form-control"
                               id="emailInput"
                               name="email"
                               placeholder="Your Email"
                               aria-label="Your Email">
                    </div>
                    <div class="input-group mx-sm-auto ms-md-0 mt-1">
                        <input type="tel"
                               class="form-control"
                               id="phoneInput"
                               name="phone"
                               placeholder="Your Phone Number"
                               aria-label="Your Phone Number">
                    </div>
                    <button class="btn btn-primary w-50 mt-1 text-start" type="submit">
                        Subscribe Now
                    </button>
                </form>

                <div id="subscriptionMessage" class="mt-2"></div>
            </div>

        </div>

        <hr class="my-4 bg-secondary">

        <!-- Copyright -->
        <div class="row align-items-center">
            <div class="text-center text-md-center">
                <p class="small mb-0">&copy; {{ date('Y') }} Lumbini Innovate Ltd. All rights reserved. &nbsp &nbsp | &nbsp &nbsp Developed by : <a href="https://365itservice.com/" target="_blank" class="text-decoration-none text-white">365 ENTERPRISES</a> </p>
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
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);
        const messageDiv = document.getElementById('subscriptionMessage');
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.innerHTML;

        // Clear previous messages
        messageDiv.innerHTML = '';
        messageDiv.className = 'mt-2';

        // Client-side validation - check if both fields are empty
        const email = form.querySelector('#emailInput').value.trim();
        const phone = form.querySelector('#phoneInput').value.trim();

        if (!email && !phone) {
            messageDiv.className = 'mt-2 alert alert-danger';
            messageDiv.textContent = 'Please provide either email or phone number';
            return; // Stop the form submission
        }

        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Subscribing...
        `;

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    messageDiv.className = 'mt-2 alert alert-success';
                    messageDiv.textContent = data.message;
                    form.reset();
                } else {
                    messageDiv.className = 'mt-2 alert alert-danger';
                    if (data.errors) {
                        let errors = '';
                        for (const [key, value] of Object.entries(data.errors)) {
                            errors += `${value.join('<br>')}<br>`;
                        }
                        messageDiv.innerHTML = errors;
                    } else {
                        messageDiv.textContent = data.message || 'Subscription failed. Please try again.';
                    }
                }
            })
            .catch(error => {
                messageDiv.className = 'mt-2 alert alert-danger';
                messageDiv.textContent = 'An error occurred. Please try again later.';
                console.error('Error:', error);
            })
            .finally(() => {
                // Restore button state
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            });
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
