<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planora - For Vendors</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #043823;   
            --secondary-color: #FDFBED; 
            --accent-color: #F8DCDA;  
            --background: #f1f7f5ff;      
            --transparent: rgba(255, 255, 255, 0);        

            --text-color: #043823;      
            --text-light: #FDFBED;    
            --text-white: #ffffff;      
            --white: #ffffff;           
            --gray-light: #F4EFFA;      
            --gray-dark: #333333;

            --gradient-1: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            --gradient-2: linear-gradient(135deg, var(--accent-color) 0%, var(--secondary-color) 100%);
            --gradient-dark: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7));
            
            /* Shadows */
            --shadow-soft: 0 4px 15px rgba(85, 88, 121, 0.1);
            --shadow-strong: 0 8px 30px rgba(85, 88, 121, 0.15);
            --shadow-hover: 0 15px 40px rgba(85, 88, 121, 0.2);
            
            /* Spacing */
            --spacing-xs: 0.5rem;
            --spacing-sm: 1rem;
            --spacing-md: 2rem;
            --spacing-lg: 3rem;
            --spacing-xl: 4rem;
            
            /* Border Radius */
            --radius-sm: 8px;
            --radius-md: 15px;
            --radius-lg: 25px;
            --radius-full: 50%;
            
            /* Transitions */
            --transition-fast: 0.3s ease;
            --transition-normal: 0.5s ease;
            --transition-slow: 0.8s ease;
            
            /* Container Widths */
            --container-sm: 640px;
            --container-md: 768px;
            --container-lg: 1024px;
            --container-xl: 1200px;
        }

        /* Reset & Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            font-size: 16px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--background);
            overflow-x: hidden;
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            line-height: 1.3;
            margin-bottom: var(--spacing-sm);
        }

        p {
            margin-bottom: var(--spacing-sm);
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: var(--transition-fast);
        }

        .main-header {
            text-align: center;
            background: var(--background);
        }

        .logo-container img {
            width: 150px;
            height: auto;
        }

        .nav-container {
            margin-bottom: 5px;
        }

        .nav-links {
            list-style: none;
            display: inline-flex;
            gap: 25px;
            padding: 0;
        }

        .nav-links li a {
            text-decoration: none;
            color: var(--primary-color);
            font-weight: 600;
        }

        .gradient-strip {
            background: linear-gradient(hsla(144, 56%, 2%, 0.70), rgba(177, 184, 181, 0.5)), 
                        url('images/slide10.jpg') no-repeat center center/cover;
            height: 400px;
            position: relative;
        }

        .white-hero {
            background: var(--background);
            padding: 60px 20px 40px 20px;
            text-align: center;
            position: relative;
        }

        .hero-images-row {
            display: flex;
            justify-content: center;
            gap: 20px;
            position: absolute;
            top: -150px; 
            left: 50%;
            transform: translateX(-50%);
        }

        .hero-images-row img {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            object-fit: cover;
        }

        .small-img {
            width: 250px;
            height: 270px;
        }

        .large-img {
            width: 290px;
            height: 310px;
        }

        .hero-text-content {
            margin-top: 100px; 
        }

        .hero-text-content h1 {
            color: var(--primary-color);
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .hero-text-content p {
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .btn-primary {
            background: var(--primary-color);
            color: var(--secondary-color);
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 50px;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            color: var(--primary-color);
        }

        .features {
            background: url('images/WebPlanora.png') no-repeat center center/cover;;
            padding: 60px 20px;
            text-align: center;
        }

        .features .section-title {
            color: var(--primary-color);
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .features .section-subtitle {
            color: var(--gray-dark);
            font-size: 1.1rem;
            margin-bottom: 40px;
        }

        .features-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
        }

        .feature-card {
            background: url('images/cards.png') no-repeat center/cover;
            padding: 30px 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(4,56,35,0.08);
            width: 300px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(4,56,35,0.15);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .feature-card h3 {
            color: var(--primary-color);
            font-size: 1.4rem;
            margin-bottom: 10px;
        }

        .feature-card p {
            color: var(--gray-dark);
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .features-grid {
                flex-direction: column;
                align-items: center;
            }
        }

        .planora-description p {
            max-width: 800px;
            margin: 0 auto 40px;
            font-size: 1.2rem;
            color: var(--primary-color);
            line-height: 1.8;
        }

        /* Services Overview */
        .services-overview h3 {
            color: var(--primary-color);
            font-size: 2rem;
            margin-bottom: 30px;
        }

        .services-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .service-item {
            background: var(--background);
            border-radius: 15px;
            padding: 25px 20px;
            width: 250px;
            box-shadow: 0 4px 12px rgba(4, 56, 35, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .service-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(4, 56, 35, 0.15);
        }

        .service-item i {
            font-size: 2rem;
            color: var(--accent-color);
            margin-bottom: 15px;
        }

        .service-item h4 {
            color: var(--primary-color);
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .service-item p {
            color: var(--gray-dark);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .services-grid {
                flex-direction: column;
                align-items: center;
            }
        }

        .benefits {
            background: var(--background);
            padding: 60px 20px;
            text-align: center;
        }

        .benefits .section-title {
            color: var(--primary-color);
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .benefits .section-subtitle {
            color: var(--gray-dark);
            font-size: 1.1rem;
            margin-bottom: 40px;
        }

        .benefits-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .benefit-card {
            background: var(--secondary-color);
            padding: 30px 20px;
            border-radius: 15px;
            width: 250px;
            box-shadow: 0 4px 12px rgba(4,56,35,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .benefit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(4,56,35,0.15);
        }

        .benefit-card h3 {
            color: var(--primary-color);
            font-size: 1.3rem;
            margin-bottom: 10px;
        }

        .benefit-card p {
            color: var(--gray-dark);
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .benefits-grid {
                flex-direction: column;
                align-items: center;
            }
        }


        .planora-how-it-works {
            margin-top: 2.5rem;
            text-align: center;
        }
        .how-it-works-steps {
            display: flex;
            justify-content: center;
            gap: 2.5rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }
        .step {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(85,88,121,0.08);
            padding: 1.5rem 1.2rem;
            width: 180px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .step-icon {
            background: var(--gradient-1);
            color: #fff;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 0.7rem;
        }
        .step-title {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.3rem;
        }
        .step-desc {
            color: var(--text-light);
            font-size: 0.98rem;
        }

        .vendor-services {
            background: linear-gradient(135deg, #fff5f5 0%, #f4ebd3 100%);
            padding: 5rem 0 4rem 0;
            position: relative;
            overflow: hidden;
        }
        .vendor-services .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
            font-family: 'Playfair Display', serif;
        }
        .vendor-services .section-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: var(--text-light);
            max-width: 700px;
            margin: 0 auto 3rem;
        }
        .services-container {
            width: 100%;
            overflow-x: auto;
            padding-bottom: 1rem;
            display: flex;
            flex-direction: column;
            scroll-behavior: smooth;
        }
        .services-grid {
            display: flex;
            gap: 2rem;
            padding: 0 1rem;
            justify-content: center;
        }
        .service-card {
            min-width: 240px;
            max-width: 280px;
            flex: 0 0 260px;
            height: 260px;
            justify-content: flex-start;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 2px 16px rgba(85, 88, 121, 0.10);
            padding: 2.5rem 1.5rem 2rem 1.5rem;
            text-align: center;
            transition: transform 0.25s cubic-bezier(.4,2,.6,1), box-shadow 0.25s, border 0.25s;
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            border: none;
            position: relative;
            overflow: hidden;
        }
        .service-card::before {
            content: '';
            display: block;
            position: absolute;
            top: 0; left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 5px;
            border-radius: 0 0 8px 8px;
            background: var(--gradient-1, linear-gradient(135deg, #555879 0%, #98A1BC 100%));
            opacity: 0.7;
        }
        .service-card:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 8px 32px rgba(85, 88, 121, 0.18);
        }

       

        /* Vendors Section */
        .vendors {
            padding: 5rem 5%;
            background: linear-gradient(135deg, #fff5f5 0%, #fff 100%);
        }
        .vendors-content {
            display: flex;
            gap: 4rem;
            align-items: center;
            margin-top: 3rem;
        }
        .vendors-text { flex: 1; }
        .vendors-intro {
            font-size: 1.4rem;
            color: var(--text-color);
            margin-bottom: 2rem;
            line-height: 1.8;
            font-weight: 500;
        }
        .vendor-benefits {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            margin-bottom: 2rem;
        }
        .benefit {
            display: flex;
            gap: 1.5rem;
            align-items: flex-start;
        }
        .benefit-icon {
            width: 60px; height: 60px;
            background: linear-gradient(45deg, var(--primary-color), #FFA500);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .benefit-icon i {
            font-size: 1.5rem;
            color: var(--white);
        }
        .benefit-content h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }
        .benefit-content p {
            color: #666;
            line-height: 1.6;
        }
        .vendor-cta { margin-top: 2rem; }
        .vendors-image {
            flex: 1;
            max-width: 400px;
        }
        .vendors-image img {
            width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .vendors-image img:hover { transform: scale(1.02); }
.testimonials {
    background: var(--secondary-color);
    padding: 60px 20px;
    text-align: center;
}

.testimonials .section-title {
    color: var(--primary-color);
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.testimonials .section-subtitle {
    color: var(--gray-dark);
    font-size: 1.1rem;
    margin-bottom: 40px;
}

/* Testimonials Grid */
.testimonials-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
}

/* Testimonial Card */
.testimonial-card {
    background: var(--white);
    border-radius: 15px;
    padding: 30px 25px;
    width: 300px;
    box-shadow: 0 4px 12px rgba(4, 56, 35, 0.08);
    transition: transform 0.3s, box-shadow 0.3s;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(4, 56, 35, 0.15);
}

/* Quote Icon */
.testimonial-content i {
    font-size: 2rem;
    color: var(--accent-color);
    margin-bottom: 15px;
}

.testimonial-content p {
    color: var(--gray-dark);
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 20px;
}

/* Author Info */
.testimonial-author {
    display: flex;
    align-items: center;
    gap: 15px;
}

.testimonial-author img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--accent-color);
}

.author-info h4 {
    color: var(--primary-color);
    font-size: 1rem;
    margin: 0;
}

.author-info p {
    color: var(--gray-dark);
    font-size: 0.9rem;
    margin: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .testimonials-grid {
        flex-direction: column;
        align-items: center;
    }
}
.faq {
    background: var(--secondary-color);
    padding: 60px 20px;
}

.faq .section-title {
    color: var(--primary-color);
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.faq .section-subtitle {
    color: var(--gray-dark);
    text-align: center;
    margin-bottom: 40px;
    font-size: 1.1rem;
}

/* FAQ Grid */
.faq-grid {
    max-width: 800px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* FAQ Item */
.faq-item {
    background: var(--white);
    border-radius: 12px;
    padding: 20px 25px;
    box-shadow: 0 4px 10px rgba(4, 56, 35, 0.08);
    cursor: pointer;
    transition: background 0.3s, box-shadow 0.3s;
}

.faq-item:hover {
    background: #fdfbedcc;
    box-shadow: 0 6px 18px rgba(4, 56, 35, 0.12);
}

/* Question */
.faq-question {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: var(--primary-color);
    font-size: 1.2rem;
    font-weight: 600;
}

.faq-question i {
    transition: transform 0.3s ease;
}

/* Answer */
.faq-answer {
    margin-top: 15px;
    color: var(--gray-dark);
    font-size: 1rem;
    line-height: 1.6;
    display: none;
}

/* Active State */
.faq-item.active .faq-answer {
    display: block;
}

.faq-item.active .faq-question i {
    transform: rotate(180deg);
}

/* Responsive */
@media (max-width: 768px) {
    .faq-grid {
        padding: 0 10px;
    }
}


        .benefits-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: center;
        }

        .benefit-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        color: var(--text-color);
        }

        .benefit-item i {
        color: var(--primary-color);
        }

        .cta-wrapper {
        margin-top: 2rem;
        }

        .cta-button {
        background: var(--primary-color);
        color: #fff;
        padding: 1rem 2rem;
        border-radius: 30px;
        text-decoration: none;
        font-weight: bold;
        transition: background 0.3s;
        }

        .cta-button:hover {
        background: var(--secondary-color);
        }

        .disclaimer {
        font-size: 0.9rem;
        color: var(--text-light);
        margin-top: 0.5rem;
        }


        /* CTA Section */
        .cta-section {
            padding: var(--spacing-xl) 0;
            background: var(--gradient-1);
            color: var(--text-white);
            text-align: center;
        }

        .cta-content {
            max-width: 600px;
            margin: 0 auto;
        }

        /* Footer */
        .footer {
            background: var(--gray-dark);
            color: var(--text-white);
            padding: var(--spacing-xl) 0;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--spacing-lg);
        }

        .footer-section h3 {
            margin-bottom: var(--spacing-md);
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: var(--spacing-xs);
        }

        .footer-section a:hover {
            color: var(--primary-color);
        }

        .social-links {
            display: flex;
            gap: var(--spacing-sm);
            margin-top: var(--spacing-sm);
        }

        .social-links a {
            color: var(--text-white);
            font-size: 1.5rem;
        }

        .social-links a:hover {
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <header class="main-header">
    <div class="logo-container">
        <img src="images/planora.png" alt="Planora Logo">
    </div>
    <nav class="nav-container">
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#promo">About</a></li>
            <li><a href="vendor.php">Vendors</a></li>
            <li><a href="client.php">Clients</a></li>
            <li><a href="blog.php">Blog</a></li>
        </ul>
    </nav>
</header>

<section class="gradient-strip">
    
</section>

<section class="hero white-hero">
    <div class="hero-images-row">
        <img src="images/slide12.jpg" alt="Wedding Setup" class="small-img">
        <img src="images/rustic.jpg" alt="Wedding Couple" class="large-img">
        <img src="images/hero9.jpg" alt="Ceremony Moment" class="small-img">
    </div>

    <div class="hero-text-content">
        <h1>Grow Your Business with Planora</h1>
        <p>Connect with couples & vendors in one seamless platform.</p>
        <a href="vendor-registration.php" class="btn-primary">Become a Vendor</a>
    </div>
</section>

    <section id="features" class="features">
        <div class="section-container">
            <h2 class="section-title">Why Choose Planora?</h2>
            <p class="section-subtitle">Discover how our platform can help you expand your business and reach more clients</p>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-users feature-icon"></i>
                    <h3>Wide Customer Base</h3>
                    <p>Connect with thousands of event planners actively seeking vendors like you.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-calendar-check feature-icon"></i>
                    <h3>Easy Booking Management</h3>
                    <p>Streamline your booking process with our intuitive calendar and scheduling system.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-star feature-icon"></i>
                    <h3>Build Your Reputation</h3>
                    <p>Collect reviews and ratings to showcase your quality service to potential clients.</p>
                </div>
            </div>
        </div>
    
      <div class="planora-description">
        <p>Vendors can showcase their services, build a professional portfolio, and connect directly with couples looking for trusted partners for their big day.</p>
      </div>
      <div class="services-overview">
        <h3>Grow Your Business—Here’s What You Get</h3>
        <div class="services-grid">
          <div class="service-item">
            <i class="fas fa-briefcase"></i>
            <h4>Professional Portfolio</h4>
            <p>Showcase your best work and attract more clients with a stunning profile.</p>
          </div>
          <div class="service-item">
            <i class="fas fa-bolt"></i>
            <h4>Direct Leads</h4>
            <p>Get direct bookings and appointments from couples—no middlemen, no hidden fees.</p>
          </div>
          <div class="service-item">
            <i class="fas fa-comments"></i>
            <h4>Get Verified Leads</h4>
            <p>We connect you with real users actively looking for services in your area.</p>
          </div>
          <div class="service-item">
            <i class="fas fa-magic"></i>
            <h4>No Middlemen, Full Control</h4>
            <p>Manage your own packages, pricing, and availability without any interference.</p>
          </div>
          <div class="service-item">
            <i class="fas fa-star"></i>
            <h4>Grow Your Brand</h4>
            <p>Build trust with ratings, reviews, and a professional presence.</p>
          </div>
        </div>
    </section>

    <section id="benefits" class="benefits">
        <div class="section-container">
            <h2 class="section-title">Benefits for Vendors</h2>
            <p class="section-subtitle">See how Planora can transform your business</p>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <h3>Increased Visibility</h3>
                    <p>Get discovered by event planners actively searching for your services.</p>
                </div>
                <div class="benefit-card">
                    <h3>Business Growth</h3>
                    <p>Expand your client base and increase your revenue with our platform.</p>
                </div>
                <div class="benefit-card">
                    <h3>Time Management</h3>
                    <p>Save time with automated booking and communication tools.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Vendors Content -->
    
      <section class="planora-how-it-works">
        <h3>How It Works</h3>
        <div class="how-it-works-steps">
          <div class="step">
            <div class="step-icon"><i class="fas fa-user-plus"></i></div>
            <div class="step-title">Sign Up</div>
            <div class="step-desc">Register as a vendor for free.</div>
          </div>
          <div class="step">
            <div class="step-icon"><i class="fas fa-briefcase"></i></div>
            <div class="step-title">Create Portfolio</div>
            <div class="step-desc">Showcase your services and past work.</div>
          </div>
          <div class="step">
            <div class="step-icon"><i class="fas fa-comments"></i></div>
            <div class="step-title">Connect</div>
            <div class="step-desc">Chat with couples and manage bookings.</div>
          </div>
          <div class="step">
            <div class="step-icon"><i class="fas fa-chart-line"></i></div>
            <div class="step-title">Grow</div>
            <div class="step-desc">Get more leads and grow your business.</div>
          </div>
        </div>
    </section>
      
  


<section id="testimonials" class="testimonials">
        <div class="section-container">
            <h2 class="section-title">Vendor Success Stories</h2>
            <p class="section-subtitle">Hear from our successful vendors about their experience with Planora</p>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left"></i>
                        <p>"Since joining Planora, I've gotten more exposure and bookings than ever before! The platform is incredibly user-friendly."</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e" alt="Sarah Johnson">
                        <div class="author-info">
                            <h4>Sarah Johnson</h4>
                            <p>Wedding Photographer</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left"></i>
                        <p>"The direct communication with couples has streamlined my booking process. I love how easy it is to manage my schedule."</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a" alt="Michael Chen">
                        <div class="author-info">
                            <h4>Michael Chen</h4>
                            <p>Catering Services</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left"></i>
                        <p>"Being featured on Planora has significantly increased my visibility and helped me build a strong reputation in the industry."</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956" alt="Emma Rodriguez">
                        <div class="author-info">
                            <h4>Emma Rodriguez</h4>
                            <p>Event Decorator</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>  



    <!-- FAQ Section -->
    <section class="faq" id="faq">
        <div class="section-container">
            <h2 class="section-title">Frequently Asked Questions</h2>
            <p class="section-subtitle">Find answers to common questions about our vendor services</p>
            <div class="faq-grid">
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>How do I get started as a vendor?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Getting started is easy! Simply create an account, complete your profile, and list your services. Our team will review your application and help you get set up.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>What types of vendors can join?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>We welcome all wedding and event vendors, including photographers, caterers, venues, decorators, musicians, and more. If you provide services for events, you're welcome to join!</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>How does the payment system work?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>We offer secure payment processing through our platform. Clients can book and pay directly through Planora, and you'll receive payments according to your preferred schedule.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Can I customize my vendor profile?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes! You can customize your profile with photos, service descriptions, pricing, and more. Premium members get additional customization options.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="cta-section">
        <div class="section-container">
            <div class="cta-content">
                <h2>Ready to Grow Your Business?</h2>
                <p>Join Planora today and start connecting with event planners in your area.</p>
                <a href="vendor-registration.php" class="cta-button secondary">Get Started Now</a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="section-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <p>Email: vendors@planora.com</p>
                    <p>Phone: (555) 123-4567</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            item.addEventListener('click', () => {
                item.classList.toggle('active');
            });
    });
    </script>
</body>
</html> 