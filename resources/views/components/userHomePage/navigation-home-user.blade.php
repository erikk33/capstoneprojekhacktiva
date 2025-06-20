<nav>
    <div class="logo">
        Erik's E-Commerce
    </div>
    <div class="nav-links">
        <a href="{{ url('/user/home') }}">Home</a>
        <a href="{{ url('/user/shop') }}">Shop</a>
        <a href="{{ url('/user/about') }}">About</a>
        <a href="#">Contact</a>
    </div>
    <div class="nav-actions">
        <a href="{{ route('cart.view') }}" class="cart-icon">
            Cart ({{ count(session('cart', [])) }})
        </a>
        <div class="user-profile">
            <div class="profile-container">
                @auth
                    @php
                        $user = Auth::user();
                        $photoUrl = $user->profile_photo_path
                            ? asset('storage/' . $user->profile_photo_path)
                            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&color=0984e3&background=74b9ff';
                    @endphp
                    <img src="{{ $photoUrl }}" alt="{{ $user->name }}" class="profile-pic">
                @endauth
                <div class="dropdown-content">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-dropdown-btn">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Navigation */
    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem 5%;
        position: fixed;
        width: 100%;
        z-index: 1000;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .logo {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
    }

    .nav-links {
        display: flex;
        gap: 2rem;
    }

    .nav-links a {
        color: var(--dark);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-links a::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary);
        transition: width 0.3s ease;
    }

    .nav-links a:hover::after {
        width: 100%;
    }

    .cart-icon {
        font-size: 1.2rem;
        cursor: pointer;
        color: var(--dark);
        text-decoration: none;
    }

    /* Nav Actions & Profile */
    .nav-actions {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .user-profile {
        position: relative;
        display: inline-block;
        margin-left: 10px;
    }

    .profile-container {
        position: relative;
        display: flex;
        align-items: center;
    }

    .profile-pic {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        cursor: pointer;
        border: 2px solid var(--light);
        transition: all 0.3s ease;
    }

    .profile-pic:hover {
        border-color: var(--primary);
        transform: scale(1.05);
    }

    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        top: 100%;
        background: white;
        min-width: 120px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.1);
        border-radius: 5px;
        z-index: 1001;
        overflow: hidden;
        margin-top: 10px;
    }

    .logout-dropdown-btn {
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        padding: 12px 16px;
        font-size: 1rem;
        color: var(--dark);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .logout-dropdown-btn:hover {
        background: #f5f5f5;
        color: var(--primary);
    }

    /* Responsive Navbar */
    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userProfile = document.querySelector('.user-profile');
        const dropdownContent = document.querySelector('.dropdown-content');
        let hideTimeout;

        userProfile.addEventListener('mouseenter', function() {
            // Tampilkan dropdown saat kursor masuk
            dropdownContent.style.display = 'block';
            // Hapus timeout yang mungkin sedang berjalan
            clearTimeout(hideTimeout);
        });

        userProfile.addEventListener('mouseleave', function() {
            // Set timeout untuk menyembunyikan dropdown setelah 2.5 detik
            hideTimeout = setTimeout(function() {
                dropdownContent.style.display = 'none';
            }, 2500);
        });

        // Tetap tampilkan dropdown jika kursor berada di atasnya
        dropdownContent.addEventListener('mouseenter', function() {
            clearTimeout(hideTimeout);
        });

        // Sembunyikan dropdown saat kursor meninggalkannya
        dropdownContent.addEventListener('mouseleave', function() {
            hideTimeout = setTimeout(function() {
                dropdownContent.style.display = 'none';
            }, 2500);
        });
    });
</script>
