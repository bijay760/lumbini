<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Llumbini Innovate | Admin Login</title>
    <link rel="icon" href="{{ asset('backend/assets/images/login-images/LHF.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-login-image {
            background: url({{asset('backend/assets/admin/login.jpg')}});
            background-position: center;
            background-size: cover;
        }

        .btn-user {
            font-size: 0.8rem;
            border-radius: 5px;
            padding: 0.75rem 1rem;
        }

        .form-control-user {
            font-size: 0.8rem;
            border-radius: 5px;
            padding: 1.5rem 1rem;
        }

        .custom-checkbox .custom-control-label::before {
            border-radius: 0.35rem;
        }

        .custom-checkbox .custom-control-input:checked ~ .custom-control-label::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26l2.974 2.99L8 2.193z'/%3e%3c/svg%3e");
        }
    </style>
</head>
<body class="bg-light">

<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5 text-center">
                                <img src="{{ asset('backend/assets/images/login-images/logo%20(3).png') }}"
                                     class="img-fluid"
                                     style="height: 77px; width: auto;"
                                     alt="Company Logo">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>

                                <form class="user" method="POST" action="{{route('admin.login')}}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text"
                                               class="form-control form-control-user @error('login') is-invalid @enderror"
                                               id="login"
                                               name="login"
                                               value="{{ old('login') }}"
                                               placeholder="Enter Email or Username"
                                               required
                                               autofocus>

                                        @error('login')
                                        <span class="invalid-feedback d-block text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                               id="password" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="form-group text-left">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="remember"
                                                   name="remember">
                                            <label class="custom-control-label" for="remember">Remember Me</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
