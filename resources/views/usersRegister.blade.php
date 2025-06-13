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
        align-items: flex-start; /* Rata atas untuk mobile */
        min-height: 100vh;
        padding: 1rem;
        transition: background-color 0.4s;
    }
    /* Pada layar besar, kembali ke tengah secara vertikal */
    @media (min-width: 992px) {
        .register-body {
            align-items: center;
        }
    }
</style>

<body class="register-body">

    <!-- Tombol Night Mode -->
    <div class="night-mode-toggle" id="nightModeToggle">
        <i class="bi bi-moon-stars-fill"></i>
        <i class="bi bi-sun-fill"></i>
    </div>

    <!-- Wrapper untuk semua konten, dengan padding atas-bawah untuk mobile -->
    <div class="register-wrapper py-4">

        <div class="welcome-header">
            <img src="{{ asset('assets/personicon.png') }}" alt="Welcome" class="icon-img">
            <h2 class="text">Welcome!</h2>
        </div>

        <div class="card register-card">
            <div class="row g-0">
                <!-- Kolom Kiri (Form) -->
                <div class="col-lg-7 register-form-section order-lg-1">
                    <h1 class="register-title">Create Account</h1>

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
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form id="register-form" method="post" action="{{-- route('nama.rute.register') --}}" name="sendData" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 register-input-group"><i class="bi bi-person input-icon"></i><input type="text" class="form-control" name="firstName" placeholder="First Name" required></div>
                            <div class="col-md-6 register-input-group"><i class="bi bi-person input-icon"></i><input type="text" class="form-control" name="lastName" placeholder="Last Name" required></div>
                        </div>
                        <div class="register-input-group"><i class="bi bi-person-badge input-icon"></i><input type="text" class="form-control" name="fullName" placeholder="Full Name" required></div>
                        <div class="register-input-group"><i class="bi bi-calendar-event input-icon"></i><input type="text" class="form-control" id="birth" name="birth" placeholder="Birth Date" onfocus="(this.type='date')" onblur="(this.type='text')" required></div>
                        <div class="register-input-group"><i class="bi bi-envelope input-icon"></i><input type="email" class="form-control" name="email" placeholder="Email Address" required></div>
                        <div class="register-input-group"><i class="bi bi-lock input-icon"></i><input type="password" class="form-control" id="password" name="password" placeholder="Password" required><i class="bi bi-eye-slash-fill password-toggle-icon" id="togglePassword"></i></div>

                        <div class="mb-3"><label for="profile_photo" class="form-label">Foto Profil (Opsional)</label><input class="form-control" type="file" id="profile_photo" name="profile_photo" accept="image/*"></div>
                        <div class="profile-preview-container" id="imagePreviewContainer"><img src="#" id="imagePreview" alt="Preview Foto Profil" class="profile-preview-image"/></div>

                        <div class="form-check register-terms-group mb-4">
                            <input class="form-check-input" type="checkbox" value="1" id="terms" name="terms">
                            <label class="form-check-label" for="terms">
                                I agree to the
                                <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">
                                    Terms and Conditions
                                </a>
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary register-btn">
                                <span class="button-text">Register Account</span>
                                <div class="dot-loader"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div>
                            </button>
                        </div>
                        <p class="text-center mt-4">Sudah punya akun? <a href="#" class="register-link">Login disini</a></p>
                    </form>
                </div>

                <!-- Kolom Kanan (Gambar) -->
                <div class="col-lg-5 register-image-section order-lg-2">
                    <div class="register-flip-card" id="flipCard">
                        <div class="register-flip-card-inner">
                            <div class="register-flip-card-front"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.25,7.25a4.75,4.75,0,0,1,9.5,0" stroke="#2ca02c" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12,14.5a3.25,3.25,0,0,1,3.25-3.25" stroke="#2ca02c" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M18.5,8.75h-13L4.25,19.5a2,2,0,0,0,2,2.25h11.5a2,2,0,0,0,2-2.25Z" fill="#2ca02c" fill-opacity="0.1" stroke="#2ca02c" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>
                            <div class="register-flip-card-back"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Zoom -->
    <div class="image-zoom-modal" id="imageZoomModal"><span class="close-zoom-btn" id="closeZoomBtn">&times;</span><img src="#" id="zoomedImage" alt="Zoomed Profile Photo"/></div>

    <!-- Modal untuk Terms and Conditions -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Syarat dan Ketentuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-body-scrollable" id="termsModalBody">
                    <div class="terms-section"><h6>1. Penerimaan Syarat</h6><p>Dengan membuat akun di platform e-commerce kami ("Layanan"), Anda setuju untuk terikat oleh Syarat dan Ketentuan ini. Jika Anda tidak setuju dengan bagian mana pun dari syarat ini, Anda tidak boleh menggunakan Layanan.</p></div>
                    <div class="terms-section"><h6>2. Akun Pengguna</h6><p>Anda bertanggung jawab untuk menjaga kerahasiaan akun dan kata sandi Anda. Anda setuju untuk menerima tanggung jawab atas semua aktivitas yang terjadi di bawah akun Anda. Anda harus segera memberitahu kami jika mengetahui adanya pelanggaran keamanan atau penggunaan akun Anda yang tidak sah.</p></div>
                    <div class="terms-section"><h6>3. Pembelian</h6><p>Jika Anda ingin membeli produk apa pun yang tersedia melalui Layanan ("Pembelian"), Anda mungkin akan diminta untuk memberikan informasi tertentu yang relevan dengan Pembelian Anda termasuk, namun tidak terbatas pada, nomor kartu kredit Anda, tanggal kedaluwarsa kartu kredit Anda, alamat penagihan Anda, dan informasi pengiriman Anda. Anda menyatakan dan menjamin bahwa Anda memiliki hak hukum untuk menggunakan kartu kredit atau metode pembayaran lainnya sehubungan dengan Pembelian apa pun.</p></div>
                    <div class="terms-section"><h6>4. Ketersediaan, Kesalahan, dan Ketidakakuratan</h6><p>Kami terus memperbarui penawaran produk dan layanan kami. Produk atau layanan yang tersedia di Layanan kami mungkin salah harga, dijelaskan secara tidak akurat, atau tidak tersedia, dan kami mungkin mengalami keterlambatan dalam memperbarui informasi di Layanan dan dalam iklan kami di situs web lain.</p></div>
                    <div class="terms-section"><h6>5. Kebijakan Pengembalian Dana</h6><p>Produk yang telah dibeli tidak dapat dikembalikan atau ditukar, kecuali jika produk yang diterima rusak atau tidak sesuai dengan deskripsi. Klaim harus diajukan dalam waktu 3x24 jam setelah barang diterima dengan menyertakan bukti video unboxing.</p></div>
                    <div class="terms-section"><h6>6. Perubahan</h6><p>Kami berhak, atas kebijakan kami sendiri, untuk mengubah atau mengganti Syarat ini kapan saja. Jika revisi bersifat material, kami akan berusaha memberikan pemberitahuan setidaknya 30 hari sebelum syarat baru berlaku.</p></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="agreeTermsBtn" data-bs-dismiss="modal">Saya Mengerti</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JQuery & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Logika Night Mode
            const nightModeToggle = document.getElementById('nightModeToggle');
            const body = document.body;

            function applyTheme() {
                if (localStorage.getItem('theme') === 'dark') {
                    body.classList.add('dark-mode');
                } else {
                    body.classList.remove('dark-mode');
                }
            }
            nightModeToggle.addEventListener('click', () => {
                body.classList.toggle('dark-mode');
                localStorage.setItem('theme', body.classList.contains('dark-mode') ? 'dark' : 'light');
            });
            applyTheme();

            // Validasi T&C dan Animasi Tombol
            $('#register-form').on('submit', function(e) {
                if (!$('#terms').is(':checked')) {
                    e.preventDefault();
                    alert('Anda harus menyetujui Syarat dan Ketentuan untuk mendaftar.');
                    return;
                }
                const $button = $(this).find('.register-btn');
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

            // Logika preview & zoom
            const photoInput = document.getElementById('profile_photo');
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const imagePreview = document.getElementById('imagePreview');

            photoInput.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    imagePreviewContainer.classList.add('visible');
                    reader.onload = function(e) { imagePreview.setAttribute('src', e.target.result); }
                    reader.readAsDataURL(file);
                } else {
                    imagePreviewContainer.classList.remove('visible');
                }
            });

            const imageZoomModal = document.getElementById('imageZoomModal');
            const zoomedImage = document.getElementById('zoomedImage');
            const closeZoomBtn = document.getElementById('closeZoomBtn');

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

            // Logika untuk Terms and Conditions Modal
            const termsModalEl = document.getElementById('termsModal');
            const termsModalInstance = new bootstrap.Modal(termsModalEl);
            const termsBody = document.getElementById('termsModalBody');
            const termsSections = termsBody.querySelectorAll('.terms-section');

            termsModalEl.addEventListener('shown.bs.modal', function () {
                termsSections.forEach(section => section.classList.remove('visible'));
                if (termsSections.length > 0) {
                    termsSections[0].classList.add('visible');
                }
            });

            termsBody.addEventListener('scroll', function() {
                termsSections.forEach(section => {
                    const rect = section.getBoundingClientRect();
                    if (rect.top <= termsBody.getBoundingClientRect().bottom - 50) {
                        section.classList.add('visible');
                    }
                });
            });

            $('#agreeTermsBtn').on('click', function() {
                $('#terms').prop('checked', true);
                termsModalInstance.hide();
            });
        });
    </script>
</body>
</html>
