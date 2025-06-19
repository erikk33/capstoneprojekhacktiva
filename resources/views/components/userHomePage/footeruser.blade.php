<style>
     /* Footer */
     footer {
            background: var(--dark);
            color: white;
            padding: 3rem 5%;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-col h3 {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .footer-col h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--primary);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: #ccc;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-links a {
            color: white;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            color: var(--secondary);
        }

        .copyright {
            text-align: center;
            margin-top: 3rem;
            padding-top: 1.5rem;
            border-top: 1px solid #444;
            color: #aaa;
            font-size: 0.9rem;
        }
</style>
<footer>
    <div class="footer-grid">
        <div class="footer-col">
            <h3>Minimal</h3>
            <p>Creating simple, functional products designed to enhance your everyday life.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-pinterest"></i></a>
            </div>
        </div>
        <div class="footer-col">
            <h3>Shop</h3>
            <ul class="footer-links">
                <li><a href="#">All Products</a></li>
                <li><a href="#">Featured</a></li>
                <li><a href="#">New Arrivals</a></li>
                <li><a href="#">Sale</a></li>
                <li><a href="#">Collections</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h3>About</h3>
            <ul class="footer-links">
                <li><a href="#">Our Story</a></li>
                <li><a href="#">Design Philosophy</a></li>
                <li><a href="#">Sustainability</a></li>
                <li><a href="#">Press</a></li>
                <li><a href="#">Careers</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h3>Help</h3>
            <ul class="footer-links">
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">FAQs</a></li>
                <li><a href="#">Shipping</a></li>
                <li><a href="#">Returns</a></li>
                <li><a href="#">Privacy Policy</a></li>
            </ul>
        </div>
    </div>
    <div class="copyright">
        &copy; 2023 Minimal. All rights reserved.
    </div>
</footer>