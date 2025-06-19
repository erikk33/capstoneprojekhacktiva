<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erik's E-Commerce</title>
    <style>
        :root {
            --primary: #0984e3;
            --secondary: #74b9ff;
            --dark: #2d3436;
            --light: #dfe6e9;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Helvetica Neue', Arial, sans-serif;
        }

        body {
            background-color: var(--white);
            color: var(--dark);
            overflow-x: hidden;
        }

        /* Navigation */


        /* Hero Section */
        .hero {
            height: 100vh;
            display: flex;
            align-items: center;
            padding: 0 5%;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            width: 50%;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            color: var(--dark);
        }

        .hero p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            color: #666;
            max-width: 80%;
        }

        .btn {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 2px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: var(--secondary);
            transform: translateY(-2px);
        }

        .hero-image {
            position: absolute;
            right: 5%;
            top: 50%;
            transform: translateY(-50%);
            width: 40%;
            height: 70%;
            background: url('https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80') no-repeat center center/cover;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        /* Featured Products */
        .featured {
            padding: 5rem 5%;
            background: var(--light);
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 2rem;
            color: var(--dark);
        }

        .product-slider {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            overflow: hidden;
        }

        .slider-container {
            display: flex;
            transition: transform 0.5s ease;
        }

        .product-slide {
            min-width: 100%;
            padding: 0 1rem;
        }

        .product-card {
            background: white;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .product-img {
            height: 300px;
            overflow: hidden;
            position: relative;
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-img img {
            transform: scale(1.05);
        }

        .product-tag {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: var(--primary);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 3px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .product-desc {
            color: #666;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
        }

        .view-btn {
            background: var(--dark);
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .view-btn:hover {
            background: #1a1a1a;
        }

        .slider-nav {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            gap: 1rem;
        }

        .slider-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #ccc;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slider-dot.active {
            background: var(--primary);
        }

        /* Parallax Section */
        .parallax {
            height: 500px;
            background: url('https://images.unsplash.com/photo-1492707892479-7bc8d5a4ee93?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80') no-repeat center center/cover;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
        }

        .parallax::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .parallax-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            padding: 0 2rem;
        }

        .parallax h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }

        /* Categories */
        .categories {
            padding: 5rem 5%;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .category-card {
            height: 300px;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .category-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .category-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 1.5rem;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            color: white;
        }

        .category-title {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }

        /* Newsletter */
        .newsletter {
            padding: 5rem 5%;
            background: var(--primary);
            color: white;
            text-align: center;
        }

        .newsletter h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }

        .newsletter p {
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        .newsletter-form {
            display: flex;
            max-width: 500px;
            margin: 0 auto;
        }

        .newsletter-input {
            flex: 1;
            padding: 0.8rem 1rem;
            border: none;
            font-size: 1rem;
        }

        .newsletter-btn {
            padding: 0 1.5rem;
            background: var(--dark);
            color: white;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .newsletter-btn:hover {
            background: #1a1a1a;
        }

        /* Footer */


        /* View Product Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            width: 80%;
            max-width: 800px;
            border-radius: 10px;
            overflow: hidden;
            animation: modalFadeIn 0.3s ease;
            position: relative;
        }

        .close-modal {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.5rem;
            color: white;
            cursor: pointer;
            background: rgba(0, 0, 0, 0.5);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }

        .modal-body {
            display: flex;
        }

        .modal-img {
            width: 50%;
            height: 400px;
            object-fit: cover;
        }

        .modal-info {
            width: 50%;
            padding: 2rem;
        }

        .modal-title {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .modal-price {
            font-size: 1.5rem;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .modal-description {
            color: #666;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
        }

        /* Animations */
        @keyframes float {
            0% {
                transform: translateY(-50%) translateX(0);
            }

            50% {
                transform: translateY(-50%) translateX(-10px);
            }

            100% {
                transform: translateY(-50%) translateX(0);
            }
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero-content {
                width: 60%;
            }

            .hero-image {
                width: 50%;
            }
        }

        @media (max-width: 768px) {
            .hero {
                height: auto;
                padding: 8rem 5% 5rem;
                flex-direction: column;
            }

            .hero-content {
                width: 100%;
                margin-bottom: 3rem;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero-image {
                position: relative;
                right: auto;
                top: auto;
                transform: none;
                width: 100%;
                height: 300px;
                order: 2;
            }


            .modal-body {
                flex-direction: column;
            }

            .modal-img {
                width: 100%;
                height: 300px;
            }

            .modal-info {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .newsletter-form {
                flex-direction: column;
            }

            .newsletter-input {
                margin-bottom: 1rem;
            }

            .newsletter-btn {
                padding: 0.8rem;
            }

            .product-actions {
                flex-direction: column;
            }
        }
        /* rekomendasi produk */

        /* Di dalam tag style */
.recommended {
    padding: 5rem 5%;
    background: var(--light);
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}
     /* END OFF rekomendasi produk  */
        /*Logout*/
          /* Tambahkan style untuk nav-actions dan logout */


    </style>
</head>

<body>
    <x-scroll-indicator/>
    <x-navigation-home-user />

    @if(session('success'))
    <div style="position: fixed; top: 80px; right: 20px; background: #27ae60; color: white; padding: 10px 20px; border-radius: 4px; z-index: 10000;">
        {{ session('success') }}
    </div>
@endif
    <x-userHomePage.heroComponent />

    <section class="featured">
        <h2 class="section-title">Featured Products</h2>
        <div class="product-slider">
            <div class="slider-container">
                @foreach ($featuredProducts as $product)
                <div class="product-slide">
                    <div class="product-card">
                        <div class="product-img">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/800" alt="Placeholder">
                            @endif

                            @if($loop->first)
                                <span class="product-tag">New</span>
                            @endif
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <div class="product-price">${{ number_format($product->price, 0) }}</div>
                            <p class="product-desc">{{ Str::limit($product->description, 100) }}</p>
                            <div class="product-actions">
                                <button class="view-btn" data-product-id="{{ $product->id }}">View Product</button>
                                <form action="{{ route('cart.add') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="slider-nav">
                @for ($i = 0; $i < count($featuredProducts); $i++)
                    <div class="slider-dot {{ $i === 0 ? 'active' : '' }}" data-slide="{{ $i }}"></div>
                @endfor
            </div>
        </div>
    </section>

<!--Rekomendasi produk-->

<!-- Setelah section featured -->
@if($recommendedProducts->isNotEmpty())
<section class="recommended">
    <h2 class="section-title">Recommended For You</h2>
    <div class="product-grid">
        @foreach ($recommendedProducts as $product)
        <div class="product-card">
            <div class="product-img">
                @if($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/800" alt="Placeholder">
                @endif
            </div>
            <div class="product-info">
                <h3 class="product-title">{{ $product->name }}</h3>
                <div class="product-price">${{ number_format($product->price, 0) }}</div>
                <p class="product-desc">{{ Str::limit($product->description, 100) }}</p>
                <div class="product-actions">
                    <button class="view-btn" data-product-id="{{ $product->id }}">View Product</button>
                    <form action="{{ route('cart.add') }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

    <section class="parallax">
        <div class="parallax-content">
            <h2>Less is More</h2>
            <p>Our philosophy is simple: create products with purpose, designed to last.</p>
            <button class="btn">Our Story</button>
        </div>
    </section>

    <section class="categories">
        <h2 class="section-title">Shop by Category</h2>
        <div class="category-grid">
            <div class="category-card">
                <img src="https://images.unsplash.com/photo-1490114538077-0a7f8cb49891?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                    alt="Furniture" class="category-img">
                <div class="category-overlay">
                    <h3 class="category-title">Furniture</h3>
                    <p>25 items</p>
                </div>
            </div>
            <div class="category-card">
                <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                    alt="Electronics" class="category-img">
                <div class="category-overlay">
                    <h3 class="category-title">Electronics</h3>
                    <p>42 items</p>
                </div>
            </div>
            <div class="category-card">
                <img src="https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                    alt="Accessories" class="category-img">
                <div class="category-overlay">
                    <h3 class="category-title">Accessories</h3>
                    <p>36 items</p>
                </div>
            </div>
            <div class="category-card">
                <img src="https://images.unsplash.com/photo-1551232864-3f0890e580d9?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                    alt="Lighting" class="category-img">
                <div class="category-overlay">
                    <h3 class="category-title">Lighting</h3>
                    <p>18 items</p>
                </div>
            </div>
        </div>
    </section>

    <section class="newsletter">
        <h2>Join Our Newsletter</h2>
        <p>Subscribe to receive updates, access to exclusive deals, and more.</p>
        <form class="newsletter-form">
            <input type="email" placeholder="Your email address" class="newsletter-input" required>
            <button type="submit" class="newsletter-btn">Subscribe</button>
        </form>
    </section>

   <x-footeruser/>
    <!-- View Product Modal -->
    <div class="modal" id="productModal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div class="modal-body">
                <img src="" alt="Product Image" class="modal-img">
                <div class="modal-info">
                    <h3 class="modal-title">Product Title</h3>
                    <div class="modal-price">$0.00</div>
                    <p class="modal-description">Product description goes here...</p>
                    <div class="modal-actions">
                        <button class="btn">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Product Slider
    const sliderContainer = document.querySelector('.slider-container');
    const slides = document.querySelectorAll('.product-slide');
    const dots = document.querySelectorAll('.slider-dot');

    // Periksa apakah ada produk sebelum menginisialisasi slider
    let currentIndex = 0;
    let slideWidth = 0;

    if (slides.length > 0) {
        slideWidth = slides[0].clientWidth;

        function goToSlide(index) {
            sliderContainer.style.transform = `translateX(-${index * slideWidth}px)`;
            dots.forEach(dot => dot.classList.remove('active'));
            if (dots.length > index) {
                dots[index].classList.add('active');
            }
            currentIndex = index;
        }

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => goToSlide(index));
        });

        // Auto slide hanya jika ada produk
        setInterval(() => {
            if (slides.length > 0) {
                currentIndex = (currentIndex + 1) % slides.length;
                goToSlide(currentIndex);
            }
        }, 5000);
    }

    // Parallax effect
    window.addEventListener('scroll', function() {
        const parallax = document.querySelector('.parallax');
        if (parallax) {
            const scrollPosition = window.pageYOffset;
            parallax.style.backgroundPositionY = scrollPosition * 0.5 + 'px';
        }
    });

    // View Product Modal
    const modal = document.getElementById('productModal');
    const viewBtns = document.querySelectorAll('.view-btn');
    const closeModal = document.querySelector('.close-modal');
    const modalImg = document.querySelector('.modal-img');
    const modalTitle = document.querySelector('.modal-title');
    const modalPrice = document.querySelector('.modal-price');
    const modalDesc = document.querySelector('.modal-description');

    // Product data from server (dikirim dari controller)
    const products = @json($productsForJs);

    viewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const product = products[productId];

            if (product) {
                modalImg.src = product.image;
                modalTitle.textContent = product.title;
                modalPrice.textContent = product.price;
                modalDesc.textContent = product.description;

                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
        });
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });

    // Font Awesome fallback
    if (!document.querySelector('.fa')) {
        const style = document.createElement('style');
        style.innerHTML = `
            .fa { font-family: 'Arial'; font-weight: bold; }
            .fa-facebook::before { content: 'f'; }
            .fa-twitter::before { content: 't'; }
            .fa-instagram::before { content: 'ig'; }
            .fa-pinterest::before { content: 'p'; }
        `;
        document.head.appendChild(style);
    }
    </script>
</body>

</html>