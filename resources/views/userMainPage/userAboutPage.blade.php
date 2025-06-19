<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Erik's E-Commerce</title>
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
            height: 60vh;
            display: flex;
            align-items: center;
            padding: 0 5%;
            position: relative;
            overflow: hidden;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                        url('https://images.unsplash.com/photo-1497215842964-222b430dc094?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80') no-repeat center center/cover;
            color: white;
            text-align: center;
        }

        .hero-content {
            width: 100%;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            color: white;
        }

        .hero p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            color: #eee;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
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

        /* About Content */
        .about {
            padding: 5rem 5%;
            background: var(--white);
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 2rem;
            color: var(--dark);
        }

        .section-subtitle {
            text-align: center;
            margin-bottom: 3rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            color: #666;
            line-height: 1.7;
        }

        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .about-card {
            background: white;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .about-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .about-img {
            height: 250px;
            overflow: hidden;
        }

        .about-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .about-card:hover .about-img img {
            transform: scale(1.05);
        }

        .about-info {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .about-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .about-desc {
            color: #666;
            margin-bottom: 1.5rem;
            flex: 1;
        }

        /* Team Section */
        .team {
            padding: 5rem 5%;
            background: var(--light);
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .team-member {
            background: white;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            text-align: center;
        }

        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .member-img {
            height: 300px;
            overflow: hidden;
        }

        .member-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .team-member:hover .member-img img {
            transform: scale(1.05);
        }

        .member-info {
            padding: 1.5rem;
        }

        .member-name {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }

        .member-role {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .social-links a {
            color: var(--dark);
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            color: var(--primary);
        }

        /* Values Section */
        .values {
            padding: 5rem 5%;
            background: var(--white);
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .value-card {
            background: white;
            border-radius: 5px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            text-align: center;
        }

        .value-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .value-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .value-title {
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }

        .value-desc {
            color: #666;
            line-height: 1.7;
        }

        /* Stats Section */
        .stats {
            padding: 5rem 5%;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            text-align: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .stat-item {
            padding: 1.5rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1rem;
            font-weight: 500;
        }

        /* Footer */

        /* Responsive */
        @media (max-width: 992px) {
            .hero h1 {
                font-size: 2.8rem;
            }
        }

        @media (max-width: 768px) {
            .hero {
                height: auto;
                padding: 8rem 5% 5rem;
            }

            .hero h1 {
                font-size: 2.3rem;
            }


        }

        @media (max-width: 576px) {
            .hero h1 {
                font-size: 2rem;
            }

            .section-title {
                font-size: 1.8rem;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Navigation -->
  <x-navigation-home-user/>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Our Story</h1>
            <p>Discover the journey of Minimal, our values, and the passionate team behind our products.</p>
            <button class="btn">Explore Our Products</button>
        </div>
    </section>

    <!-- About Section -->
    <section class="about">
        <h2 class="section-title">Who We Are</h2>
        <p class="section-subtitle">Minimal was founded in 2018 with a simple mission: to create products that blend functionality with minimalist design. We believe that less is more, and that well-crafted essentials can transform everyday experiences.</p>

        <div class="about-grid">
            <div class="about-card">
                <div class="about-img">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Our Beginning">
                </div>
                <div class="about-info">
                    <h3 class="about-title">Our Beginning</h3>
                    <p class="about-desc">Founded in a small workshop, Minimal started with just three people passionate about design. Our first product was a simple wooden chair that combined Scandinavian design with sustainable materials.</p>
                    <button class="btn">Read More</button>
                </div>
            </div>

            <div class="about-card">
                <div class="about-img">
                    <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Design Philosophy">
                </div>
                <div class="about-info">
                    <h3 class="about-title">Design Philosophy</h3>
                    <p class="about-desc">We believe in the power of simplicity. Every product we create undergoes rigorous design refinement to remove the unnecessary while preserving functionality and aesthetic appeal.</p>
                    <button class="btn">Our Process</button>
                </div>
            </div>

            <div class="about-card">
                <div class="about-img">
                    <img src="https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Sustainability">
                </div>
                <div class="about-info">
                    <h3 class="about-title">Sustainability</h3>
                    <p class="about-desc">We're committed to ethical manufacturing and sustainable practices. From sourcing materials to packaging, we prioritize the planet in every decision we make.</p>
                    <button class="btn">Our Commitment</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team">
        <h2 class="section-title">Meet Our Team</h2>
        <p class="section-subtitle">Behind every great product is a passionate team of designers, engineers, and creatives.</p>

        <div class="team-grid">
            <div class="team-member">
                <div class="member-img">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Alex Morgan">
                </div>
                <div class="member-info">
                    <h3 class="member-name">Alex Morgan</h3>
                    <div class="member-role">Founder & CEO</div>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>

            <div class="team-member">
                <div class="member-img">
                    <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Sarah Johnson">
                </div>
                <div class="member-info">
                    <h3 class="member-name">Sarah Johnson</h3>
                    <div class="member-role">Lead Designer</div>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-dribbble"></i></a>
                    </div>
                </div>
            </div>

            <div class="team-member">
                <div class="member-img">
                    <img src="https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Michael Chen">
                </div>
                <div class="member-info">
                    <h3 class="member-name">Michael Chen</h3>
                    <div class="member-role">Product Engineer</div>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>

            <div class="team-member">
                <div class="member-img">
                    <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Jessica Williams">
                </div>
                <div class="member-info">
                    <h3 class="member-name">Jessica Williams</h3>
                    <div class="member-role">Marketing Director</div>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values">
        <h2 class="section-title">Our Core Values</h2>
        <p class="section-subtitle">These principles guide everything we do at Minimal</p>

        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3 class="value-title">Sustainability</h3>
                <p class="value-desc">We prioritize eco-friendly materials and ethical manufacturing processes to minimize our environmental impact.</p>
            </div>

            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-pencil-ruler"></i>
                </div>
                <h3 class="value-title">Design Excellence</h3>
                <p class="value-desc">Every product undergoes rigorous design refinement to achieve the perfect balance of form and function.</p>
            </div>

            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3 class="value-title">Customer Focus</h3>
                <p class="value-desc">We listen to our customers and create products that enhance their daily lives with thoughtful design.</p>
            </div>

            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h3 class="value-title">Innovation</h3>
                <p class="value-desc">We constantly explore new materials and techniques to improve our products and processes.</p>
            </div>

            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <h3 class="value-title">Community</h3>
                <p class="value-desc">We support local artisans and collaborate with global partners who share our values.</p>
            </div>

            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-award"></i>
                </div>
                <h3 class="value-title">Quality</h3>
                <p class="value-desc">Every product is crafted to last, using premium materials and meticulous attention to detail.</p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">2018</div>
                <div class="stat-label">Founded</div>
            </div>

            <div class="stat-item">
                <div class="stat-number">150+</div>
                <div class="stat-label">Products</div>
            </div>

            <div class="stat-item">
                <div class="stat-number">50K+</div>
                <div class="stat-label">Customers</div>
            </div>

            <div class="stat-item">
                <div class="stat-number">12</div>
                <div class="stat-label">Team Members</div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <x-footeruser/>

    <script>
        // Navigation active state
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.pathname.split('/').pop();
            const navLinks = document.querySelectorAll('.nav-links a');

            navLinks.forEach(link => {
                if (link.getAttribute('href') === '#' && currentPage.includes('about')) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        });

        // Parallax effect for hero
        window.addEventListener('scroll', function() {
            const hero = document.querySelector('.hero');
            const scrollPosition = window.pageYOffset;
            hero.style.backgroundPositionY = scrollPosition * 0.5 + 'px';
        });

        // Team member hover effect
        const teamMembers = document.querySelectorAll('.team-member');
        teamMembers.forEach(member => {
            member.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });

            member.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
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
                .fa-linkedin::before { content: 'in'; }
                .fa-dribbble::before { content: 'd'; }
                .fa-github::before { content: 'gh'; }
                .fa-leaf::before { content: 'Eco'; }
                .fa-pencil-ruler::before { content: 'D'; }
                .fa-heart::before { content: '♥'; }
                .fa-lightbulb::before { content: 'I'; }
                .fa-hands-helping::before { content: 'C'; }
                .fa-award::before { content: 'Q'; }
            `;
            document.head.appendChild(style);
        }
    </script>
</body>

</html>