<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Erik's E-Commerce</title>
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
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logout-btn {
            background: var(--dark);
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #1a1a1a;
        }

        /* Shop Header */
        .shop-header {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 0 5%;
        }

        .shop-header-content {
            max-width: 800px;
        }

        .shop-header h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .shop-header p {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }

        /* Shop Controls */
        .shop-controls {
            padding: 2rem 5%;
            background: var(--light);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .controls-left {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .controls-right {
            display: flex;
            gap: 1rem;
        }

        .filter-btn, .sort-select {
            background: white;
            border: 1px solid #ddd;
            padding: 0.6rem 1.2rem;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .filter-btn:hover, .sort-select:hover {
            border-color: var(--primary);
        }

        .sort-select {
            background: white url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%232d3436' viewBox='0 0 16 16'%3E%3Cpath d='M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z'/%3E%3C/svg%3E") no-repeat right 0.75rem center/12px 12px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding-right: 2.5rem;
        }

        .category-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            padding: 0 5% 1.5rem;
            background: var(--light);
            border-bottom: 1px solid #ddd;
        }

        .category-tab {
            padding: 0.6rem 1.2rem;
            background: white;
            border: 1px solid #ddd;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .category-tab.active, .category-tab:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Product Grid */
        .shop-products {
            padding: 3rem 5%;
            background: var(--white);
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .product-card {
            background: white;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .product-img {
            height: 250px;
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

        .btn {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 2px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn:hover {
            background: var(--secondary);
            transform: translateY(-2px);
        }

        .view-btn {
            background: var(--dark);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .view-btn:hover {
            background: #1a1a1a;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
            gap: 0.5rem;
        }

        .page-item {
            display: inline-block;
        }

        .page-link {
            display: block;
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .page-link:hover, .page-link.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Sidebar Filter */
        .shop-container {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 5%;
            gap: 2rem;
        }

        .sidebar {
            width: 250px;
            flex-shrink: 0;
        }

        .filter-section {
            background: white;
            padding: 1.5rem;
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }

        .filter-title {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #eee;
        }

        .filter-options {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .filter-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .price-range {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .price-input {
            flex: 1;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .apply-btn {
            width: 100%;
            margin-top: 1rem;
        }

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
            .shop-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .shop-controls {
                flex-direction: column;
                align-items: flex-start;
            }

            .controls-left, .controls-right {
                width: 100%;
                justify-content: space-between;
            }

            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
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
            .product-grid {
                grid-template-columns: 1fr;
            }

            .product-actions {
                flex-direction: column;
            }

            .btn, .view-btn {
                width: 100%;
                text-align: center;
            }
        }
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

    <!-- Shop Header -->
    <header class="shop-header">
        <div class="shop-header-content">
            <h1>Our Shop</h1>
            <p>Discover our curated collection of high-quality products</p>
            <button class="btn">Shop Now</button>
        </div>
    </header>

    <!-- Shop Controls -->
    <div class="shop-controls">
        <div class="controls-left">
            <button class="filter-btn" id="filterToggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                </svg>
                Filters
            </button>
            <div>
                Showing <strong>{{ $products->firstItem() }}-{{ $products->lastItem() }}</strong> of <strong>{{ $products->total() }}</strong> products
            </div>
        </div>
        <div class="controls-right">
            <div>
                Sort by:
            </div>
            <select class="sort-select" id="sortSelect">
                <option value="Featured" {{ $appliedFilters['sort'] === 'Featured' ? 'selected' : '' }}>Featured</option>
                <option value="Price: Low to High" {{ $appliedFilters['sort'] === 'Price: Low to High' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="Price: High to Low" {{ $appliedFilters['sort'] === 'Price: High to Low' ? 'selected' : '' }}>Price: High to Low</option>
                <option value="Newest Arrivals" {{ $appliedFilters['sort'] === 'Newest Arrivals' ? 'selected' : '' }}>Newest Arrivals</option>
                <option value="Best Selling" {{ $appliedFilters['sort'] === 'Best Selling' ? 'selected' : '' }}>Best Selling</option>
            </select>
        </div>
    </div>

    <!-- Category Tabs -->
    <div class="category-tabs">
        @foreach($categories as $cat)
        <div class="category-tab {{ $appliedFilters['category'] === $cat ? 'active' : '' }}"
             data-category="{{ $cat }}">
            {{ $cat }}
        </div>
        @endforeach
    </div>

    <!-- Shop Content -->
   <!-- Shop Content -->
<div class="shop-container">
    <!-- Sidebar Filters -->
    <aside class="sidebar" id="filterSidebar">
        <form id="filterForm" method="GET" action="{{ route('shop') }}">
            <!-- Kategori -->
            <div class="filter-section">
                <h3 class="filter-title">Categories</h3>
                <div class="filter-options">
                    @foreach($categories as $cat)
                    <label class="filter-option">
                        <input type="checkbox" name="category" value="{{ $cat }}"
                            {{ $appliedFilters['category'] === $cat ? 'checked' : '' }}>
                        {{ $cat }}
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Rentang Harga -->
            <div class="filter-section">
                <h3 class="filter-title">Price Range</h3>
                <div class="price-range">
                    <input type="number" class="price-input" placeholder="Min" name="min_price"
                           value="{{ $appliedFilters['min_price'] }}">
                    <span>-</span>
                    <input type="number" class="price-input" placeholder="Max" name="max_price"
                           value="{{ $appliedFilters['max_price'] }}">
                </div>
                <button type="submit" class="btn apply-btn">Apply</button>
            </div>
        </form>
    </aside>

    <!-- Product Grid -->
    <main class="shop-products">
        <div class="product-grid">
            @foreach($products as $product)
            <div class="product-card">
                <div class="product-img">
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                    @else
                        <img src="https://picsum.photos/600/800?random={{ $product->id }}" alt="{{ $product->name }}">
                    @endif
                </div>
                <div class="product-info">
                    <h3 class="product-title">{{ $product->name }}</h3>
                    <div class="product-price">${{ number_format($product->price, 2) }}</div>
                    <p class="product-desc">{{ \Illuminate\Support\Str::limit($product->description, 100) }}</p>
                    <div class="product-actions">
                        <button class="view-btn" data-product-id="{{ $product->id }}">View Details</button>
                        <form action="{{ route('cart.add') }}" method="POST">
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

        <!-- Pagination -->
        <div class="pagination">
            @if ($products->onFirstPage())
                <div class="page-item disabled">
                    <span class="page-link">Previous</span>
                </div>
            @else
                <div class="page-item">
                    <a href="{{ $products->previousPageUrl() }}" class="page-link">Previous</a>
                </div>
            @endif

            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                @if ($page == $products->currentPage())
                    <div class="page-item active">
                        <span class="page-link">{{ $page }}</span>
                    </div>
                @else
                    <div class="page-item">
                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    </div>
                @endif
            @endforeach

            @if ($products->hasMorePages())
                <div class="page-item">
                    <a href="{{ $products->nextPageUrl() }}" class="page-link">Next</a>
                </div>
            @else
                <div class="page-item disabled">
                    <span class="page-link">Next</span>
                </div>
            @endif
        </div>
    </main>
</div>

    <!-- Footer -->
    <x-footeruser/>

    <!-- View Product Modal -->
    <div class="modal" id="productModal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div class="modal-body">
                <img src="" alt="Product Image" class="modal-img" id="modalProductImage">
                <div class="modal-info">
                    <h3 class="modal-title" id="modalProductTitle"></h3>
                    <div class="modal-price" id="modalProductPrice"></div>
                    <p class="modal-description" id="modalProductDescription"></p>
                    <div class="modal-actions">
                        <button class="btn" id="addToCartModal">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle Filter Sidebar on Mobile
        const filterToggle = document.getElementById('filterToggle');
        const filterSidebar = document.getElementById('filterSidebar');
        const filterForm = document.getElementById('filterForm');
        const sortSelect = document.getElementById('sortSelect');
        const categoryTabs = document.querySelectorAll('.category-tab');

        // Initialize sidebar display for mobile
        if (window.innerWidth < 992) {
            filterSidebar.style.display = 'none';
        }

        filterToggle.addEventListener('click', () => {
            filterSidebar.style.display = filterSidebar.style.display === 'none' ? 'block' : 'none';
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth < 992) {
                filterSidebar.style.display = 'none';
            } else {
                filterSidebar.style.display = 'block';
            }
        });

        // Category Tabs
        categoryTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const category = this.getAttribute('data-category');

                // Update form category
                document.querySelectorAll('input[name="category"]').forEach(input => {
                    input.checked = input.value === category;
                });

                // Submit form
                filterForm.submit();
            });
        });

        // Sort select change
        sortSelect.addEventListener('change', function() {
            // Add sort parameter to form
            const sortInput = document.createElement('input');
            sortInput.type = 'hidden';
            sortInput.name = 'sort';
            sortInput.value = this.value;
            filterForm.appendChild(sortInput);

            // Submit form
            filterForm.submit();
        });

        // View Product Modal
        const modal = document.getElementById('productModal');
        const viewBtns = document.querySelectorAll('.view-btn');
        const closeModal = document.querySelector('.close-modal');
        const modalImg = document.getElementById('modalProductImage');
        const modalTitle = document.getElementById('modalProductTitle');
        const modalPrice = document.getElementById('modalProductPrice');
        const modalDesc = document.getElementById('modalProductDescription');
        const addToCartModal = document.getElementById('addToCartModal');

        // Product data
        const products = @json($products->items());

        viewBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const product = products.find(p => p.id == productId);

                if (product) {
                    modalImg.src = product.image_path
                        ? "{{ asset('storage') }}/" + product.image_path
                        : `https://picsum.photos/600/800?random=${product.id}`;

                    modalTitle.textContent = product.name;
                    modalPrice.textContent = `$${product.price.toFixed(2)}`;
                    modalDesc.textContent = product.description;

                    // Set up add to cart
                    addToCartModal.onclick = function() {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = "{{ route('cart.add') }}";

                        const csrf = document.createElement('input');
                        csrf.type = 'hidden';
                        csrf.name = '_token';
                        csrf.value = "{{ csrf_token() }}";
                        form.appendChild(csrf);

                        const productInput = document.createElement('input');
                        productInput.type = 'hidden';
                        productInput.name = 'product_id';
                        productInput.value = product.id;
                        form.appendChild(productInput);

                        const quantityInput = document.createElement('input');
                        quantityInput.type = 'hidden';
                        quantityInput.name = 'quantity';
                        quantityInput.value = 1;
                        form.appendChild(quantityInput);

                        document.body.appendChild(form);
                        form.submit();
                    };

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

        // Pagination
        const pageLinks = document.querySelectorAll('.page-link');
        pageLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.parentElement.classList.contains('disabled')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>

</html>