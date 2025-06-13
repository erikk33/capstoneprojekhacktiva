<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - E-Commerce</title>
    <x-bootstrap-installer />
    <x-google-font-main />
    {{-- Menambahkan library ikon Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Memanggil file CSS eksternal --}}
    <link rel="stylesheet" href="{{ asset('/style/style.css') }}">
</head>

<style>
    /* Style ini spesifik untuk font, jadi tetap di sini */
    .register-body {
        font-family: {{ $mainFont }};
        background-color: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 1rem;
    }
</style>

<body class="register-body">

    <div class="card register-card my-5 my-lg-0">
        <div class="row g-0">
            <!-- Kolom Kanan (Gambar) -->
            <div class="col-lg-5 register-image-section order-lg-2">
                <div class="register-flip-card" id="flipCard">
                    <div class="register-flip-card-inner">
                        <div class="register-flip-card-front">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.25,7.25a4.75,4.75,0,0,1,9.5,0" stroke="#2ca02c" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M12,14.5a3.25,3.25,0,0,1,3.25-3.25" stroke="#2ca02c" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M18.5,8.75h-13L4.25,19.5a2,2,0,0,0,2,2.25h11.5a2,2,0,0,0,2-2.25Z" fill="#2ca02c" fill-opacity="0.1" stroke="#2ca02c" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                        <div class="register-flip-card-back"></div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kiri (Form) -->
            <div class="col-lg-7 register-form-section order-lg-1">
                <h1 class="register-title">Create Account</h1>

                {{-- Alert-alert --}}
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif (session('failed'))
                    <div class="alert alert-danger">{{ session('failed') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <form id="register-form" method="post" action="{{-- route('nama.rute.register') --}}" name="sendData" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 register-input-group">
                            <i class="bi bi-person input-icon"></i>
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
                        </div>
                        <div class="col-md-6 register-input-group">
                             <i class="bi bi-person input-icon"></i>
                            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="register-input-group">
                         <i class="bi bi-person-badge input-icon"></i>
                        <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Full Name" required>
                    </div>
                    <div class="register-input-group">
                         <i class="bi bi-calendar-event input-icon"></i>
                        <input type="text" class="form-control" id="birth" name="birth" placeholder="Birth Date" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                    </div>
                    <div class="register-input-group">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                    </div>

                    <div class="register-input-group">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        <i class="bi bi-eye-slash-fill password-toggle-icon" id="togglePassword"></i>
                    </div>

                    <!-- Input foto profil -->
                    <div class="mb-3">
                        <label for="profile_photo" class="form-label">Foto Profil (Opsional)</label>
                        <input class="form-control" type="file" id="profile_photo" name="profile_photo" accept="image/*">
                    </div>
                    <div class="profile-preview-container" id="imagePreviewContainer">
                        <img src="#" id="imagePreview" alt="Preview Foto Profil" class="profile-preview-image"/>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary register-btn">
                            <span class="button-text">Register Account</span>
                            <div class="dot-loader">
                                <div class="dot"></div> <div class="dot"></div> <div class="dot"></div>
                            </div>
                        </button>
                    </div>

                    <p class="text-center mt-4">
                        Sudah punya akun? <a href="#" class="register-link">Login disini</a>
                    </p>
                </form>
            </div>

        </div>
    </div>

    <!-- Modal Zoom -->
    <div class="image-zoom-modal" id="imageZoomModal">
        <span class="close-zoom-btn" id="closeZoomBtn">&times;</span>
        <img src="#" id="zoomedImage" alt="Zoomed Profile Photo"/>
    </div>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- JavaScript -->
    <script>
        $(document).ready(function() {
            // Logika animasi tombol
            $('#register-form').on('submit', function() {
                const $button = $(this).find('.register-btn');
                if ($button.hasClass('loading')) { return false; }
                $button.addClass('loading').prop('disabled', true);
            });

            // Logika kartu flip
            $('#flipCard').on('click', function() {
                $(this).toggleClass('flipped');
            });

            // Logika untuk Show/Hide Password
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

                setTimeout(() => {
                    icon.removeClass('toggled');
                }, 200);
            });

            // Logika preview & zoom
            const photoInput = document.getElementById('profile_photo');
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const imagePreview = document.getElementById('imagePreview');
            const imageZoomModal = document.getElementById('imageZoomModal');
            const zoomedImage = document.getElementById('zoomedImage');
            const closeZoomBtn = document.getElementById('closeZoomBtn');

            photoInput.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    imagePreviewContainer.style.display = 'block';
                    reader.onload = function(e) { imagePreview.setAttribute('src', e.target.result); }
                    reader.readAsDataURL(file);
                } else {
                    imagePreviewContainer.style.display = 'none';
                }
            });

            function openModal() {
                zoomedImage.setAttribute('src', imagePreview.src);
                imageZoomModal.classList.add('active');
            }

            function closeModal() {
                closeZoomBtn.classList.add('bubble-effect');
                imageZoomModal.classList.remove('active');
                setTimeout(() => { closeZoomBtn.classList.remove('bubble-effect'); }, 400);
            }

            imagePreview.addEventListener('click', openModal);
            closeZoomBtn.addEventListener('click', closeModal);
            imageZoomModal.addEventListener('click', function(event) {
                if (event.target === imageZoomModal) { closeModal(); }
            });
        });
    </script>
</body>
</html>
