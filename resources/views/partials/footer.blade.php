<footer class="ls-footer">
    <div class="container">
        <div class="row g-5">

            {{-- Company --}}
            <div class="col-lg-5">
                <a class="ls-footer__brand" href="{{ route('home') }}">
                    <img src="{{ asset('backend/assets/images/login-images/logo(2312).png') }}" alt="Lumbini Innovate logo">
                    <span>
                        <span class="ls-footer__brand-name">LUMBINI INNOVATE</span>
                        <span class="ls-footer__brand-tag">A Complete Real Estate Solution</span>
                    </span>
                </a>

                <ul class="ls-footer__contact">
                    <li>
                        <i class="bi bi-geo-alt-fill" aria-hidden="true"></i>
                        <span>Chandragiri-13, Kathmandu, Nepal</span>
                    </li>
                    <li>
                        <i class="bi bi-envelope-fill" aria-hidden="true"></i>
                        <a href="mailto:info@lumbiniinnovate.com.np">info@lumbiniinnovate.com.np</a>
                    </li>
                    <li>
                        <i class="bi bi-telephone-fill" aria-hidden="true"></i>
                        <a href="tel:+9779848023023">+977-9848023023</a>
                    </li>
                </ul>
            </div>

            {{-- Links --}}
            <div class="col-6 col-lg-3">
                <h2 class="ls-footer__heading">Explore</h2>
                <ul class="ls-footer__links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('projects') }}">Available plots</a></li>
                    <li><a href="{{ route('about-us') }}">About us</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            {{-- Subscribe --}}
            <div class="col-lg-4">
                <h2 class="ls-footer__heading">Project updates</h2>
                <p class="ls-footer__text">Be the first to know about our projects.</p>

                <form id="subscriptionForm" method="POST" action="{{ route('subscribe') }}">
                    @csrf
                    <label for="emailInput" class="visually-hidden">Your email</label>
                    <input type="email" class="form-control" id="emailInput" name="email" placeholder="Your email" autocomplete="email">

                    <label for="phoneInput" class="visually-hidden">Your phone number</label>
                    <input type="tel" class="form-control" id="phoneInput" name="phone" placeholder="Your phone number" autocomplete="tel">

                    <button class="btn ls-footer__submit" type="submit">Subscribe now</button>
                </form>

                <div id="subscriptionMessage" class="ls-footer__message" aria-live="polite"></div>
            </div>
        </div>

        <div class="ls-footer__bottom">
            <p>&copy; {{ date('Y') }} Lumbini Innovate Pvt. Ltd. All rights reserved.</p>
            <p>Developed by <a href="https://365itservice.com/" target="_blank" rel="noopener">365 Enterprises</a></p>
        </div>
    </div>
</footer>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<!-- Back to top -->
<a href="#" class="back-to-top" aria-label="Back to top">
    <i class="bi bi-arrow-up" aria-hidden="true"></i>
</a>

<style>
    .ls-footer {
        --f-navy-deep: #141a3d;
        --f-line: rgba(255,255,255,.16);
        --f-muted: rgba(255,255,255,.78);
        --f-accent: #8fd3ad;
        background: var(--f-navy-deep);
        color: #fff;
        padding: 4rem 0 1.5rem;
        font-family: "Hanken Grotesk", "Segoe UI", sans-serif;
    }
    .ls-footer a { color: #fff; text-decoration: none; }
    .ls-footer a:hover { text-decoration: underline; text-underline-offset: 3px; }
    .ls-footer a:focus-visible, .ls-footer__submit:focus-visible { outline: 3px solid #7fb4ff; outline-offset: 2px; }

    .ls-footer__brand { display: inline-flex; align-items: center; gap: .9rem; margin-bottom: 1.75rem; }
    .ls-footer__brand:hover { text-decoration: none !important; }
    .ls-footer__brand img { height: 72px; width: auto; }
    .ls-footer__brand-name { display: block; font-family: Montserrat, sans-serif; font-weight: 800; line-height: 1.2; }
    .ls-footer__brand-tag { display: block; font-family: Montserrat, sans-serif; font-weight: 500; font-size: .7rem; line-height: 1.4; }

    .ls-footer__contact, .ls-footer__links { list-style: none; margin: 0; padding: 0; }
    .ls-footer__contact li { display: flex; gap: .75rem; align-items: baseline; margin-bottom: .75rem; color: var(--f-muted); }
    .ls-footer__contact i { color: var(--f-accent); }
    .ls-footer__contact a { color: #fff; }
    .ls-footer__links li { margin-bottom: .6rem; }

    .ls-footer__heading { font-family: "Bricolage Grotesque", "Segoe UI", sans-serif; font-size: 1.15rem; font-weight: 700; margin-bottom: 1rem; }
    .ls-footer__text { color: var(--f-muted); margin-bottom: 1rem; }

    .ls-footer form .form-control { border: 0; border-radius: .5rem; padding: .65rem .85rem; margin-bottom: .6rem; }
    .ls-footer__submit { width: 100%; background: #fff; color: #1c2452; font-weight: 700; border-radius: .5rem; padding: .65rem 1rem; }
    .ls-footer__submit:hover { background: #e7ebf3; color: #1c2452; }
    .ls-footer__submit:disabled { opacity: .75; }

    .ls-footer__message { margin-top: .75rem; }
    .ls-footer__message:empty { display: none; }
    .ls-footer__message.is-ok, .ls-footer__message.is-error { padding: .7rem .9rem; border-radius: .5rem; font-size: .95rem; }
    .ls-footer__message.is-ok { background: #e8f4ee; color: #1d5a3c; }
    .ls-footer__message.is-error { background: #fdeceb; color: #8a2a21; }

    .ls-footer__bottom { display: flex; flex-wrap: wrap; justify-content: space-between; gap: .5rem 2rem; margin-top: 3rem; padding-top: 1.25rem; border-top: 1px solid var(--f-line); font-size: .9rem; color: var(--f-muted); }
    .ls-footer__bottom p { margin: 0; }

    @media (max-width: 575.98px) {
        .ls-footer { padding-top: 3rem; }
        .ls-footer__bottom { flex-direction: column; text-align: center; }
    }

    /* Back to top */
    .back-to-top {
        position: fixed;
        right: 1.5rem;
        bottom: 1.5rem;
        z-index: 1030;
        width: 48px;
        height: 48px;
        display: none;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #1c2452;
        color: #fff;
        border: 2px solid #fff;
        box-shadow: 0 .25rem 1rem rgba(0,0,0,.25);
        text-decoration: none;
    }
    .back-to-top.show { display: flex; }
    .back-to-top:hover { background: #141a3d; color: #fff; }
    .back-to-top:focus-visible { outline: 3px solid #7fb4ff; outline-offset: 2px; }
</style>

<script>
    document.getElementById('subscriptionForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);
        const messageDiv = document.getElementById('subscriptionMessage');
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.innerHTML;

        function showMessage(text, ok) {
            messageDiv.className = 'ls-footer__message ' + (ok ? 'is-ok' : 'is-error');
            messageDiv.textContent = text;
        }

        messageDiv.className = 'ls-footer__message';
        messageDiv.textContent = '';

        const email = form.querySelector('#emailInput').value.trim();
        const phone = form.querySelector('#phoneInput').value.trim();

        if (!email && !phone) {
            showMessage('Please provide either an email or a phone number.', false);
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Subscribing...';

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
                    showMessage(data.message, true);
                    form.reset();
                } else if (data.errors) {
                    const lines = Object.values(data.errors).flat();
                    showMessage(lines.join(' '), false);
                } else {
                    showMessage(data.message || 'Subscription failed. Please try again.', false);
                }
            })
            .catch(error => {
                showMessage('An error occurred. Please try again later.', false);
                console.error('Error:', error);
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            });
    });
</script>

<script>
    const backToTopButton = document.querySelector('.back-to-top');
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

    window.addEventListener('scroll', () => {
        backToTopButton.classList.toggle('show', window.scrollY > 300);
    });

    backToTopButton.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: reduceMotion.matches ? 'auto' : 'smooth' });
    });
</script>