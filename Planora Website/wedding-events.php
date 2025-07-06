<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Events - Planora</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #555879;
            --secondary-color: #98A1BC;
            --accent-color: #DED3C4;
            --background: #F4EBD3;

            --text-color: #555879;
            --text-light: #98A1BC;
            --text-white: #ffffff;
            --white: #ffffff;
            --gray-light: #F4EBD3;
            --gray-dark: #333333;

            --gradient-1: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            --gradient-2: linear-gradient(135deg, var(--accent-color) 0%, var(--secondary-color) 100%);
            --gradient-dark: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7));
            
            /* Shadows */
            --shadow-soft: 0 4px 15px rgba(85, 88, 121, 0.1);
            --shadow-strong: 0 8px 30px rgba(85, 88, 121, 0.15);
            --shadow-hover: 0 15px 40px rgba(85, 88, 121, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--background);
            color: var(--text-color);
            line-height: 1.6;
        }

        /* Header Styles */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            z-index: 1000;
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        /* Hero Section */
        .event-hero {
            height: 60vh;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                        url('https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--white);
            margin-top: 80px;
        }

        .event-hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .event-hero p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        /* Gallery Section */
        .gallery-section {
            padding: 5rem 5%;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: var(--text-color);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .gallery-item {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-10px);
        }

        .gallery-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .gallery-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            color: var(--white);
        }

        .gallery-caption h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .gallery-caption p {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Event Details Section */
        .event-details {
            padding: 5rem 5%;
            background: var(--white);
        }

        .services-container {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .services-scroll {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            -ms-overflow-style: none;  /* Hide scrollbar for IE and Edge */
            scrollbar-width: none;  /* Hide scrollbar for Firefox */
            padding: 1rem 0;
            gap: 2rem;
        }

        .services-scroll::-webkit-scrollbar {
            display: none;  /* Hide scrollbar for Chrome, Safari and Opera */
        }

        .detail-card {
            flex: 0 0 300px;
            padding: 2rem;
            background: var(--gray-light);
            border-radius: 15px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .detail-card:hover {
            transform: translateY(-5px);
        }

        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background: var(--white);
            border: none;
            border-radius: 50%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .scroll-btn:hover {
            background: var(--primary-color);
            color: var(--white);
        }

        .prev-btn {
            left: 0;
        }

        .next-btn {
            right: 0;
        }

        .detail-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--white);
            font-size: 2rem;
        }

        .detail-card h3 {
            font-size: 1.3rem;
            margin-bottom: 1rem;
            color: var(--text-color);
        }

        .detail-card p {
            color: var(--text-light);
        }

        /* Testimonials Section */
        .testimonials {
            padding: 5rem 5%;
            background: var(--background);
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .testimonial-card {
            background: var(--white);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .testimonial-content {
            margin-bottom: 1.5rem;
        }

        .testimonial-content i {
            color: var(--primary-color);
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .testimonial-author img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .author-info h4 {
            color: var(--text-color);
            font-size: 1.1rem;
            margin-bottom: 0.2rem;
        }

        .author-info p {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* CTA Section */
        .cta-section {
            padding: 5rem 5%;
            text-align: center;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--white);
        }

        .cta-section h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }

        .cta-section p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-button {
            display: inline-block;
            background: var(--white);
            color: var(--primary-color);
            padding: 1rem 2.5rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.3s ease;
        }

        .cta-button:hover {
            transform: translateY(-3px);
        }

        /* Footer */
        .footer {
            background: #1a1a1a;
            color: var(--white);
            padding: 4rem 5% 2rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-section h3 {
            color: var(--white);
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }

        .footer-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            margin-bottom: 1rem;
            display: inline-block;
        }

        .footer-section p {
            color: #999;
            line-height: 1.6;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid #333;
        }

        .copyright {
            color: #999;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .event-hero h1 {
                font-size: 2.5rem;
            }

            .nav-links {
                display: none;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .services-container {
                padding: 0 1rem;
            }

            .detail-card {
                flex: 0 0 250px;
            }

            .scroll-btn {
                width: 35px;
                height: 35px;
            }

            .testimonials-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Import the button styles from index2.html */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 1rem 2.5rem;
            border-radius: var(--radius-lg);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all var(--transition-fast);
            text-decoration: none;
            cursor: pointer;
            border: none;
            position: relative;
            overflow: hidden;
            font-size: 1rem;
            min-width: 200px;
            gap: 0.5rem;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0));
            transform: translateX(-100%);
            transition: transform var(--transition-normal);
        }

        .btn:hover::before {
            transform: translateX(0);
        }

        .btn-primary {
            background: var(--gradient-1);
            color: var(--text-white);
            box-shadow: var(--shadow-soft);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-strong);
        }

        .btn-secondary {
            background: transparent;
            color: var(--text-white);
            border: 2px solid var(--text-white);
            backdrop-filter: blur(5px);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary-color);
            transform: translateY(-3px);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-outline:hover {
            background: var(--primary-color);
            color: var(--text-white);
            transform: translateY(-3px);
        }

        .btn-icon {
            padding: 0.8rem;
            min-width: auto;
            border-radius: var(--radius-full);
        }

        .btn-sm {
            padding: 0.6rem 1.5rem;
            font-size: 0.9rem;
            min-width: 150px;
        }

        .btn-lg {
            padding: 1.2rem 3rem;
            font-size: 1.1rem;
            min-width: 250px;
        }

        /* Update specific button instances in the wedding events page */
        .wedding-header .cta-button {
            display: none; /* Remove old button style */
        }

        .wedding-header .btn-primary {
            margin-left: auto;
        }

        .package-card .btn {
            width: 100%;
            margin-top: 1rem;
        }

        .testimonial-card .btn {
            margin-top: 1rem;
        }

        .contact-form .btn {
            width: 100%;
        }

        @media (max-width: 768px) {
            .btn {
                min-width: 180px;
                padding: 0.8rem 2rem;
            }

            .wedding-header .btn-primary {
                margin: 1rem auto;
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <a href="index2.html" class="logo">Planora</a>
        <nav>
            <ul class="nav-links">
                <li><a href="index2.html">Home</a></li>
                <li><a href="index2.html#about">About</a></li>
                <li><a href="index2.html#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="event-hero">
        <div class="hero-content">
            <h1>Our Wedding Events</h1>
            <p>Discover the magic of our beautifully planned weddings. From intimate ceremonies to grand celebrations, we create unforgettable moments.</p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery-section" id="wedding-gallery">
        <h2 class="section-title">Featured Weddings</h2>
        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Elegant Wedding">
                <div class="gallery-caption">
                    <h3>Elegant Garden Wedding</h3>
                    <p>Sarah & John's romantic celebration</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Modern Wedding">
                <div class="gallery-caption">
                    <h3>Modern City Wedding</h3>
                    <p>Emily & Michael's urban celebration</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1519689680058-324335c77eba?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Beach Wedding">
                <div class="gallery-caption">
                    <h3>Beach Paradise Wedding</h3>
                    <p>Jessica & David's seaside ceremony</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Traditional Wedding">
                <div class="gallery-caption">
                    <h3>Traditional Ceremony</h3>
                    <p>Maria & James's cultural celebration</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Rustic Wedding">
                <div class="gallery-caption">
                    <h3>Rustic Barn Wedding</h3>
                    <p>Sophie & Thomas's countryside celebration</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Luxury Wedding">
                <div class="gallery-caption">
                    <h3>Luxury Ballroom Wedding</h3>
                    <p>Emma & William's grand celebration</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Event Details Section -->
    <section class="event-details">
        <h2 class="section-title">Our Wedding Services</h2>
        <div class="services-container">
            <button class="scroll-btn prev-btn" aria-label="Previous services">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="services-scroll">
                <div class="detail-card">
                    <div class="detail-icon">
                        <i class="fas fa-ring"></i>
                    </div>
                    <h3>Ceremony Planning</h3>
                    <p>From traditional to modern ceremonies, we handle every detail with precision and care.</p>
                </div>
                <div class="detail-card">
                    <div class="detail-icon">
                        <i class="fas fa-glass-cheers"></i>
                    </div>
                    <h3>Reception Planning</h3>
                    <p>Create the perfect celebration with our comprehensive reception planning services.</p>
                </div>
                <div class="detail-card">
                    <div class="detail-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                    <h3>Vendor Coordination</h3>
                    <p>We work with the best vendors to ensure your wedding day is perfect.</p>
                </div>
                <div class="detail-card">
                    <div class="detail-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Custom Themes</h3>
                    <p>Personalize your wedding with unique themes and creative touches.</p>
                </div>
                <div class="detail-card">
                    <div class="detail-icon">
                        <i class="fas fa-music"></i>
                    </div>
                    <h3>Entertainment</h3>
                    <p>Professional DJs, live bands, and entertainment options for your special day.</p>
                </div>
                <div class="detail-card">
                    <div class="detail-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3>Catering Services</h3>
                    <p>Exquisite dining experiences tailored to your preferences and dietary needs.</p>
                </div>
            </div>
            <button class="scroll-btn next-btn" aria-label="Next services">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <h2 class="section-title">Happy Couples</h2>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <i class="fas fa-quote-left"></i>
                    <p>"Planora made our wedding day absolutely perfect. Every detail was handled with care and professionalism."</p>
                </div>
                <div class="testimonial-author">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Sarah & John">
                    <div class="author-info">
                        <h4>Sarah & John</h4>
                        <p>Garden Wedding</p>
                    </div>
                </div>
                <a href="testimonials.html" class="btn btn-outline">
                    <i class="fas fa-star"></i>
                    Read More Reviews
                </a>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <i class="fas fa-quote-left"></i>
                    <p>"The team's attention to detail and creativity made our beach wedding a dream come true."</p>
                </div>
                <div class="testimonial-author">
                    <img src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Jessica & David">
                    <div class="author-info">
                        <h4>Jessica & David</h4>
                        <p>Beach Wedding</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <i class="fas fa-quote-left"></i>
                    <p>"Professional, creative, and so easy to work with. Our luxury wedding was everything we dreamed of."</p>
                </div>
                <div class="testimonial-author">
                    <img src="https://images.unsplash.com/photo-1522673607200-164d1b3ce551?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Emma & William">
                    <div class="author-info">
                        <h4>Emma & William</h4>
                        <p>Luxury Wedding</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <h2>Ready to Plan Your Dream Wedding?</h2>
        <p>Let us help you create the perfect celebration of your love story. Our team of experts is ready to make your wedding day unforgettable.</p>
        <a href="signup.html" class="btn btn-primary btn-sm">
            <i class="fas fa-user-plus"></i>
            Get Started
        </a>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <a href="index2.html" class="footer-logo">Planora</a>
                <p>Making event planning effortless and enjoyable for everyone worldwide.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index2.html">Home</a></li>
                    <li><a href="index2.html#about">About</a></li>
                    <li><a href="index2.html#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>Email: support@planora.com</p>
                <p>Phone: +1 (555) 123-4567</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="copyright">© Planora 2024. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.style.background = 'rgba(255, 255, 255, 0.95)';
                header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.background = 'transparent';
                header.style.boxShadow = 'none';
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const scrollContainer = document.querySelector('.services-scroll');
            const prevBtn = document.querySelector('.prev-btn');
            const nextBtn = document.querySelector('.next-btn');

            // Calculate scroll amount (width of one card + gap)
            const scrollAmount = 320; // 300px card + 20px gap

            prevBtn.addEventListener('click', () => {
                scrollContainer.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            });

            nextBtn.addEventListener('click', () => {
                scrollContainer.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            });

            // Hide/show navigation buttons based on scroll position
            scrollContainer.addEventListener('scroll', () => {
                prevBtn.style.opacity = scrollContainer.scrollLeft > 0 ? '1' : '0.5';
                nextBtn.style.opacity = 
                    scrollContainer.scrollLeft < (scrollContainer.scrollWidth - scrollContainer.clientWidth) 
                    ? '1' : '0.5';
            });
        });
    </script>
</body>
</html> 