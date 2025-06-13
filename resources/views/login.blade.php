<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Commerce</title>
    <x-bootstrap-installer />
    <x-google-font-main />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('/style/style.css') }}">
</head>

<style>
    .login-body {
        font-family: {{ $mainFont }};
        background-color: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: 100vh;
        padding: 1rem;
        transition: background-color 0.4s;
    }
    @media (min-width: 992px) {
        .login-body {
            align-items: center;
        }
    }
</style>

<body class="login-body">

    <!-- Tombol Night Mode -->
    <x-nightMode.night-mode-toggle/>

    <div class="auth-wrapper py-4">

        <div class="welcome-header">
            <img src="{{ asset('assets/personicon.png') }}" alt="Welcome" class="icon-img">
            <h2 class="text">Welcome Back!</h2>
        </div>

        <div class="card auth-card">
            <div class="row g-0">
                <!-- Kolom Kiri (Form) -->
                <div class="col-lg-7 auth-form-section order-lg-1">
                    <h1 class="auth-title">Login to Your Account</h1>

                    {{-- Menampilkan Pesan Error dan Sukses --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form id="login-form" method="post" action="{{-- route('login.post') --}}">
                        @csrf

                        <div class="auth-input-group">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                        </div>

                        <div class="auth-input-group">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            <i class="bi bi-eye-slash-fill password-toggle-icon" id="togglePassword"></i>
                        </div>

                        <!-- ==== Fitur Remember Me & Forgot Password (BARU) ==== -->
                        <div class="login-options">
                             <div class="form-check remember-me-group">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    Remember Me
                                </label>
                            </div>
                            <a href="#" class="forgot-password-link">Forgot Password?</a>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary auth-btn">
                                <span class="button-text">Login</span>
                                <div class="dot-loader"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div>
                            </button>
                        </div>

                        <p class="text-center mt-4">
                            Belum punya akun? <a href="{{-- route('register') --}}" class="auth-link">Register disini</a>
                        </p>
                    </form>
                </div>

                <!-- Kolom Kanan (Gambar) -->
                <div class="col-lg-5 auth-image-section order-lg-2">
                    <div class="auth-flip-card" id="flipCard">
                        <div class="auth-flip-card-inner">
                            <div class="auth-flip-card-front"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.25,7.25a4.75,4.75,0,0,1,9.5,0" stroke="#2ca02c" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12,14.5a3.25,3.25,0,0,1,3.25-3.25" stroke="#2ca02c" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M18.5,8.75h-13L4.25,19.5a2,2,0,0,0,2,2.25h11.5a2,2,0,0,0,2-2.25Z" fill="#2ca02c" fill-opacity="0.1" stroke="#2ca02c" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>
                            <div class="auth-flip-card-back"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JQuery & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

    <script>
        $(document).ready(function() {
            // Logika animasi tombol
            $('#login-form').on('submit', function() {
                const $button = $(this).find('.auth-btn');
                if ($button.hasClass('loading')) { return false; }
                $button.addClass('loading').prop('disabled', true);
            });

            // Logika kartu flip
            $('#flipCard').on('click', function() { $(this).toggleClass('flipped'); });

            // Logika show/hide password
            $('#togglePassword').on('click', function() {
                const passwordInput = $('#password');
                const icon = $(this);
                icon.addClass('toggled');
                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    icon.removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
                } else {
                    passwordInput.attr('type', 'password');
                    icon.removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
                }
                setTimeout(() => { icon.removeClass('toggled'); }, 200);
            });
        });
    </script>
</body>
</html>
