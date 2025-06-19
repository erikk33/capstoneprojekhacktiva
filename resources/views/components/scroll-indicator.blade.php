{{--
    Component Indikator Scroll Halaman.
    Menampilkan sebuah bar di bagian atas yang akan terisi sesuai dengan posisi scroll pengguna.
    Komponen ini mandiri (self-contained) dan menyisipkan style serta script-nya sendiri.
--}}

@push('styles')
<style>
    /* Wadah untuk progress bar */
    .scroll-indicator-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px; /* Atur ketebalan bar di sini */
        background-color: transparent; /* Latar belakang bar yang kosong */
        z-index: 2000; /* Pastikan selalu di atas elemen lain */
    }

    /* Progress bar yang akan terisi */
    .scroll-indicator-bar {
        height: 100%;
        width: 0%; /* Mulai dari 0% */
        background-color: var(--primary, #4361ee); /* Menggunakan variabel warna --primary jika ada */
        border-radius: 0 2px 2px 0;
        transition: width 0.1s linear; /* Transisi halus agar tidak patah-patah */
    }
</style>
@endpush


<div class="scroll-indicator-container">
    <div class="scroll-indicator-bar" id="scrollIndicatorBar"></div>
</div>


@push('scripts')
<script>
    // Pastikan skrip ini berjalan setelah seluruh halaman dimuat
    window.addEventListener('DOMContentLoaded', (event) => {
        const scrollIndicatorBar = document.getElementById('scrollIndicatorBar');

        // Fungsi yang akan dipanggil setiap kali ada event scroll
        function updateScrollIndicator() {
            // Ambil total tinggi halaman yang bisa di-scroll
            const scrollableHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;

            // Ambil posisi scroll saat ini
            const scrolled = window.scrollY;

            // Hitung persentase scroll
            // Hindari pembagian dengan nol jika halaman tidak bisa di-scroll
            const scrollPercentage = scrollableHeight > 0 ? (scrolled / scrollableHeight) * 100 : 0;

            // Update lebar dari progress bar sesuai persentase
            if (scrollIndicatorBar) {
                scrollIndicatorBar.style.width = scrollPercentage + '%';
            }
        }

        // Tambahkan event listener 'scroll' pada window
        window.addEventListener('scroll', updateScrollIndicator);

        // Panggil sekali di awal untuk meng-handle kasus halaman sudah di-scroll saat refresh
        updateScrollIndicator();
    });
</script>
@endpush
