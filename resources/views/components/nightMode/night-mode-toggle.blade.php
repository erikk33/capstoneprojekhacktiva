{{--
    Component mandiri untuk tombol Night Mode.
    Mengelola tampilan ikon, logika, dan penyimpanan preferensi pengguna.
--}}

@push('styles')
<style>
    .night-mode-toggle {
        position: fixed;
        top: 1.5rem;
        right: 1.5rem;
        width: 45px;
        height: 45px;
        background-color: #fff;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        z-index: 1060;
        overflow: hidden; /* Sembunyikan ikon yang tidak aktif */
    }

    .night-mode-toggle i {
        font-size: 1.25rem;
        position: absolute;
        transition: transform 0.4s ease-in-out, opacity 0.4s ease-in-out;
        color: #6c757d;
    }

    /* Posisi Awal Ikon */
    .night-mode-toggle .bi-sun-fill {
        transform: translateY(-50px);
        opacity: 0;
    }
    .night-mode-toggle .bi-moon-stars-fill {
        transform: translateY(0);
        opacity: 1;
    }

    /* Posisi saat Dark Mode Aktif */
    body.dark-mode .night-mode-toggle .bi-sun-fill {
        transform: translateY(0);
        opacity: 1;
    }
    body.dark-mode .night-mode-toggle .bi-moon-stars-fill {
        transform: translateY(50px);
        opacity: 0;
    }
</style>
@endpush

<!-- HTML untuk Tombol Toggle -->
<div class="night-mode-toggle" id="nightModeToggle">
    <i class="bi bi-moon-stars-fill"></i>
    <i class="bi bi-sun-fill"></i>
</div>


@push('scripts')
<script>
    // Pastikan skrip ini berjalan setelah DOM dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('nightModeToggle');
        const body = document.body;

        // Fungsi untuk menerapkan tema berdasarkan localStorage
        function applyTheme() {
            if (localStorage.getItem('theme') === 'dark') {
                body.classList.add('dark-mode');
            } else {
                body.classList.remove('dark-mode');
            }
        }

        // Fungsi untuk beralih tema
        function toggleTheme() {
            body.classList.toggle('dark-mode');

            // Simpan preferensi tema
            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        }

        // Tambahkan event listener ke tombol
        if (toggleButton) {
            toggleButton.addEventListener('click', toggleTheme);
        }

        // Terapkan tema saat halaman dimuat
        applyTheme();
    });
</script>
@endpush
