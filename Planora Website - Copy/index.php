<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planora - Event Planning Made Easy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="assets/css/slider.css">
    
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
        --gradient-dark: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5));
    }

/* Reset & Base */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
html {
    scroll-behavior: smooth;
    font-size: 16px;
}

h1, h2, h3, h4, h5, h6 {
    font-family: 'Playfair Display', serif;
    line-height: 1.3;
    margin-bottom: 1rem;
}
p {
    margin-bottom: 1rem;
}
a {
    text-decoration: none;
    color: inherit;
    transition: color 0.3s;
}

/* Utility Classes */
.hidden { display: none; }
.animate { opacity: 0; }
.animate.fade-in { animation: fadeIn 0.6s ease-out forwards; }
.animate.fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
.animate.slide-in-left { animation: slideInLeft 0.6s ease-out forwards; }
.animate.slide-in-right { animation: slideInRight 0.6s ease-out forwards; }
.animate.scale-in { animation: scaleIn 0.6s ease-out forwards; }

/* Keyframes */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px);}
    to { opacity: 1; transform: translateY(0);}
}
@keyframes fadeIn {
    from { opacity: 0;}
    to { opacity: 1;}
}
@keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-50px);}
    to { opacity: 1; transform: translateX(0);}
}
@keyframes slideInRight {
    from { opacity: 0; transform: translateX(50px);}
    to { opacity: 1; transform: translateX(0);}
}
@keyframes scaleIn {
    from { opacity: 0; transform: scale(0.9);}
    to { opacity: 1; transform: scale(1);}
}
@keyframes spin {
    100% { transform: rotate(360deg);}
}

/* Header & Navigation */
.header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: transparent;
    padding: 20px 40px;
    z-index: 999;
}

.header .logo {
    max-width: 250px;
    margin-bottom: 20px;
}

.header nav {
    margin-top: 10px;
}

.nav-links a {
    color: var(--secondary-color);
}

.nav-links a:hover {
    opacity: 0.7;
}

.header-right {
  margin-left: auto;
  display: flex;
  align-items: center;
  gap: 20px;
  z-index: 2;
}

.header.scrolled {
    background: var(--primary-color);
    backdrop-filter: blur(10px);
    box-shadow: 0 2px 20px rgba(0,0,0,0.1);
    padding: 10px 40px;;   
}

.logo {
  position: absolute;
  top: 0;
  left: 40px;
  width: 400px;
  height: 400px;
  z-index: 1;
  margin-left: 10px;
  pointer-events: none;
}


.logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
}

.nav-links {
    list-style: none;
    display: flex;
    align-items: center;
    gap: 25px;
    margin: 0;
    padding: 0;
}

.header .logo img {
    transition: all 0.3s ease;
}

.header.scrolled .logo img {
    transform: scale(0.8); 
}

.nav-links li {
    position: relative;
}

.nav-links a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    padding: 8px 12px;
    transition: color 0.3s ease;
}

.nav-links a.active {
    color: var(--primary-color);
    background: rgba(255,255,255,0.2);
}
.nav-links a::after {
    content: '';
    position: absolute;
    bottom: -5px; left: 0;
    width: 0; height: 2px;
    background: var(--primary-color);
    transition: width 0.3s;
}
.nav-links a:hover::after { width: 100%; }
.nav-links ol {
    position: absolute;
    top: 100%; left: 0;
    background: rgba(255,255,255,0.98);
    backdrop-filter: blur(10px);
    min-width: 200px;
    border-radius: 15px;
    padding: 0.5rem;
    margin-top: 0.5rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    opacity: 0; visibility: hidden;
    transform: translateY(10px);
    transition: all 0.3s;
    list-style: none;
    pointer-events: none;
}

.nav-links li:hover ol {
    opacity: 1; visibility: visible;
    transform: translateY(0);
    pointer-events: auto;
}

.nav-links ol li { width: 100%; }
.nav-links ol a {
    color: var(--text-color);
    padding: 0.8rem 1rem;
    display: block;
    border-radius: 10px;
    font-size: 1rem;
    transition: background 0.3s, color 0.3s, transform 0.3s;
}

.nav-links ol a:hover {
    background: rgba(255,105,180,0.1);
    color: var(--primary-color);
    transform: translateX(5px);
}

.login-button {
    background-color: var(--secondary-color);
    width: 200px;
    text-align: center;
    color: var(--text-color);
    padding: 10px 18px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.login-button:hover {
    background-color:var(--primary-color);
    color: var(--secondary-color);
}

.mobile-menu-btn {
    display: none;
    background: none;
    border: none;
    color: var(--text-white);
    font-size: 1.5rem;
    cursor: pointer;
    padding: 0.5rem;
    transition: color 0.3s;
    z-index: 1001;
}
.mobile-menu-btn:focus {
    outline: none;
    box-shadow: 0 0 0 2px var(--primary-color);
}
.mobile-menu-btn:hover { color: var(--primary-color); }

/* Social Links */
.social-link {
    transition: transform 0.3s, background-color 0.3s;
}
.social-link:hover {
    transform: translateY(-3px) rotate(360deg);
}

/* Section Container */
.section-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    background: var(--secondary-color);
}
.section-title {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 2rem;
    position: relative;
    display: block;
}
.section-title::after {
    content: '';
    position: absolute;
    bottom: -15px; left: 50%;
    transform: translateX(-50%);
    width: 80px; height: 4px;
    background: var(--primary-color);
    border-radius: 4px;
}
.section-subtitle {
    text-align: center;
    font-size: 1.2rem;
    color: var(--text-color);
    max-width: 700px;
    margin: 0 auto 2rem;
}

.btn-primary, .btn-secondary {
    background: var(--primary-color);
    color: var(--text-light);
    padding: 1rem 2.5rem;
    border-radius: 50px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: none;
    transition: all 0.3s ease;
    font-size: 1rem;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.btn-primary:hover, .btn-secondary:hover {
    background: var(--accent-color);
    color: var(--primary-color);
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.2);
}

.hero-slider {
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}
.slides-container {
    width: 100%; height: 100%; position: relative;
}
.slide {
    position: absolute; top: 0; left: 0;
    width: 100%; height: 100%;
    opacity: 0; visibility: hidden;
    transition: opacity 1s, visibility 1s;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}
.slide:nth-child(1) { background-image: url('https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80'); }
.slide:nth-child(2) { background-image: url('https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80'); }
.slide:nth-child(3) { background-image: url('https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80'); }
.slide:nth-child(4) { background-image: url('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80'); }
.slide::before {
    content: '';
    position: absolute; top: 0; left: 0;
    width: 100%; height: 100%;
    background: var(--gradient-dark);
}
.slide.active { opacity: 1; visibility: visible; }
.slide-content {
    position: relative; z-index: 2;
    max-width: 800px; margin: 0 auto; padding: 0 5%;
    height: 100%; display: flex; flex-direction: column; justify-content: center;
    color: var(--white); text-align: center;
}
.slide-content h1 {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}
.slide-content p {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}
.slide-content .hero-buttons {
    display: flex; gap: 1rem; justify-content: center;
}

.slider-controls {
    position: absolute;
    left: 50%;
    bottom: 60px;
    transform: translateX(-50%);
    display: flex;
    align-items: center;
    gap: 1.5rem;
    z-index: 20;
    pointer-events: none;
}

.slider-controls > * {
    pointer-events: auto;
}

.slide-navigation {
    margin-top: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}

.prev-slide, .next-slide {
    background: var(--primary-color);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    color: #fff;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
    box-shadow: 0 2px 8px rgba(0,0,0,0.12);
}
.prev-slide:hover, .next-slide:hover {
    background: var(--primary-color);
    transform: scale(1.08);
}

.slider-dots {
    display: flex;
    gap: 0.8rem;
    align-items: center;
}
.dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255,255,255,0.5);
    cursor: pointer;
    transition: background 0.3s, transform 0.3s;
    border: none;
    outline: none;
}
.dot.active {
    background: var(--primary-color);
    transform: scale(1.2);
}


.what-is-planora {
    background-color: var(--secondary-color);
    padding: 80px 20px;
}

.section-container {
    max-width: 1200px;
    margin: 0 auto;
}

.planora-intro {
    text-align: center;
    margin-bottom: 50px;
}

.planora-intro .section-title {
    font-size: 2.8rem;
    color: var(--primary-color);
    font-family: 'Playfair Display', serif;
    position: relative;
}

.planora-intro .section-title::after {
    content: '';
    display: block;
    width: 80px;
    height: 4px;
    background: var(--accent-color);
    margin: 10px auto 0;
    border-radius: 2px;
}

.planora-intro .section-subtitle {
    font-size: 1.2rem;
    color: var(--gray-dark);
    margin-top: 15px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}


.planora-features {
    text-align: center;
}

.features-title {
    font-size: 2rem;
    margin-bottom: 40px;
    color: var(--primary-color);
    font-family: 'Playfair Display', serif;
}

/* Grid Layout */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

/* Individual Feature Item */
.feature-item {
    background: var(--white);
    border-radius: 15px;
    padding: 30px 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

.feature-item i {
    font-size: 2.5rem;
    color: var(--accent-color);
    margin-bottom: 15px;
}

.feature-item h4 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: var(--primary-color);
}

.feature-item p {
    font-size: 1rem;
    color: var(--gray-dark);
    line-height: 1.6;
}

.service-icon {
    width: 64px;
    height: 64px;
    background: var(--gradient-1, linear-gradient(135deg, #555879 0%, #98A1BC 100%));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.2rem;
    box-shadow: 0 2px 8px rgba(85, 88, 121, 0.12);
    transition: transform 0.3s, box-shadow 0.3s;
}
.service-card:hover .service-icon {
    transform: scale(1.15) rotate(-8deg);
    box-shadow: 0 6px 18px rgba(85, 88, 121, 0.18);
}
.service-icon i {
    font-size: 2rem;
    color: #fff;
    transition: color 0.3s;
}
.service-card h3 {
    font-size: 1.18rem;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
    font-weight: 700;
    letter-spacing: 0.5px;
}
.service-card p {
    color: var(--text-light);
    font-size: 1rem;
    line-height: 1.5;
    margin-bottom: 0;
}
.footer {
    background: var(--primary-color);
    color: var(--secondary-color);
    padding: 50px 20px;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 40px;
}

.footer-section {
    flex: 1 1 300px;
}

.footer-section h3 {
    font-size: 1.8rem;
    margin-bottom: 20px;
    color: var(--secondary-color);
    font-family: 'Playfair Display', serif;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 12px;
}

.footer-section ul li a {
    color: var(--secondary-color);
    text-decoration: none;
    transition: opacity 0.3s ease;
}

.footer-section ul li a:hover {
    opacity: 0.7;
}

.footer-section p {
    font-size: 1rem;
    margin-bottom: 10px;
}

/* Social Links */
.social-links {
    margin-top: 15px;
}

.social-links a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: var(--secondary-color);
    color: var(--primary-color);
    border-radius: 50%;
    margin-right: 10px;
    font-size: 1.2rem;
    transition: transform 0.3s, opacity 0.3s;
}

.social-links a:hover {
    transform: translateY(-3px);
    opacity: 0.8;
}




/* Responsive Styles */
@media (max-width: 1024px) {
    .nav-links { gap: 1rem;}
    .nav-links a { font-size: 1rem; padding: 0.5rem 0.8rem;}
    .section-container { padding: 0 1rem;}
    html { font-size: 15px;}
}
@media (max-width: 768px) {
    html { font-size: 14px;}
    .header { padding: 1rem; background: rgba(255,255,255,0.95); }
    .header .logo { color: var(--primary-color);}
    .header .nav-links a { color: var(--text-color);}
    .mobile-menu-btn { display: block;}
    .nav-links {
        position: fixed; top: 0; right: -100%;
        width: 80%; max-width: 300px; height: 100vh;
        background: rgba(255,255,255,0.98);
        backdrop-filter: blur(10px);
        flex-direction: column; align-items: flex-start; justify-content: flex-start;
        gap: 0; transition: all 0.4s;
        box-shadow: -5px 0 15px rgba(0,0,0,0.1);
        padding: 5rem 1rem 2rem;
        overflow-y: auto; display: none;
    }
    .nav-links.active { right: 0; display: flex;}
    .nav-links li { width: 100%;}
    .nav-links a {
        color: var(--text-color);
        font-size: 1.1rem;
        width: 100%;
        padding: 1rem;
        border-radius: 10px;
    }
    .nav-links ol {
        position: static; background: transparent; box-shadow: none;
        padding: 0; margin: 0; opacity: 1; visibility: visible; transform: none;
        display: none; pointer-events: auto;
    }
    .nav-links li:hover ol { display: block;}
    .nav-links ol a { padding: 0.8rem 1rem 0.8rem 2rem; font-size: 1rem;}
    .slide-content h1, .slide-content h2 { font-size: 2.5rem;}
    .slide-content p { font-size: 1.2rem;}
    .slide-content .hero-buttons { flex-direction: column; align-items: center; gap: 1rem;}
    .slide-content .hero-buttons .btn, .cta-button { width: 100%; max-width: 300px; text-align: center; margin: 0.5rem 0;}
    .prev-slide, .next-slide { width: 40px; height: 40px;}
    .hero { flex-direction: column; text-align: center; padding-top: 6rem;}
    .hero h1 { font-size: 2.5rem;}
    .hero-buttons { flex-direction: column; align-items: center;}
    .promo-section { padding: 4rem 1rem;}
    .promo-title { font-size: 2.2rem;}
    .promo-subtitle { font-size: 1.1rem; margin-bottom: 3rem;}
    .promo-feature { padding: 1.5rem;}
    .feature-icon { width: 60px; height: 60px;}
    .feature-icon i { font-size: 1.5rem;}
    .promo-feature h3 { font-size: 1.3rem;}
    .benefits-grid { grid-template-columns: 1fr;}
    .event-types-grid { grid-template-columns: 1fr;}
    .event-card { height: auto;}
    .timeline-container::before { left: 30px;}
    .timeline-item { justify-content: flex-start; padding-left: 60px;}
    .timeline-item:nth-child(odd) .timeline-content,
    .timeline-item:nth-child(even) .timeline-content {
        width: calc(100% - 90px); margin: 0; text-align: left; order: 1;
    }
    .timeline-item:nth-child(odd) .timeline-content::before,
    .timeline-item:nth-child(even) .timeline-content::before {
        left: -10px; right: auto;
        border-left: 1px solid rgba(255,182,193,0.1);
        border-bottom: 1px solid rgba(255,182,193,0.1);
        border-right: none; border-top: none;
    }
    .timeline-dot { position: absolute; left: 0; width: 50px; height: 50px; font-size: 1.2rem;}
    .features-grid { grid-template-columns: 1fr; gap: 1.5rem;}
    .about-content, .vendors-content, .planora-content { flex-direction: column;}
    .about-image, .vendors-image { order: -1; margin-bottom: 2rem;}
    .story-point, .benefit { flex-direction: column; text-align: center;}
    .story-point i, .benefit-icon { margin: 0 auto 1rem;}
    .testimonials-grid { grid-template-columns: 1fr;}
    .faq-question h3 { font-size: 1.1rem;}
    .contact-content { grid-template-columns: 1fr;}
    .contact-info { order: 2;}
    .contact-form { order: 1;}
    .footer-content { grid-template-columns: 1fr; text-align: center;}
    .newsletter-form { flex-direction: column;}
    .newsletter-form button { width: 100%;}
    .footer-links { flex-direction: column, gap: 1rem;}
}
@media (max-width: 576px) {
    .service-card { flex: 0 0 calc(100% - 0.5rem); padding: 1.5rem;}
    .services-navigation { margin-top: 1rem;}
    .services-grid, .small-services-grid, .vendor-categories .categories-grid, .benefits-grid { grid-template-columns: 1fr;}
    .vendor-categories .category-card { padding: 1.5rem;}
    .vendor-categories .category-icon { width: 60px; height: 60px;}
    .features-grid { grid-template-columns: 1fr;}
    .timeline-label { transform: translateX(-50%) scale(0.9);}
    .pricing-section { padding: 3rem 0;}
    .section-title { font-size: 1.8rem;}
    .percentage { font-size: 3.5rem;}
    .benefits-grid { gap: 1rem;}
}
@media (max-width: 480px) {
    html { font-size: 13px;}
    .section-title { font-size: 1.8rem;}
    .section-subtitle { font-size: 1rem;}
    .timeline-content { padding: 1.5rem;}
    .timeline-content h3 { font-size: 1.3rem;}
    .timeline-dot { width: 50px; height: 50px; font-size: 1.2rem;}
}

@media (max-width: 900px) {
    .services-grid {grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));gap: 1.2rem;}
    .service-card { padding: 1.2rem 0.8rem;}
}
@media (max-width: 600px) {
    .scroll-arrow {width: 32px; height: 32px; font-size: 1.1rem;}
}
    </style>
    
</head>
<body>
     
    
    <header class="header animate fade-in">
    <a href="index.php" class="logo">
        <img src="images/planora.png" alt="Planora Logo">
    </a>
    <div class="header-right">
        <nav>
            <ul class="nav-links">
                <li><a href="#home" >Home</a></li>
                <li><a href="#promo">About</a></li>
                <li><a href="vendor.php">Vendors</a></li>
                <li><a href="client.php">Clients</a></li>
                <li><a href="blog.php" target="_blank">Blog</a></li>
            </ul>
        </nav>

        <a href="vendor-login.php" class="login-button">
            VENDOR LOGIN
        </a>
    </div>
</header>
  
   <section class="hero-slider" id="home">
    <div class="slides-container">

        <div class="slide active" style="background-image: url('images/slide7.jpg');">
            <div class="slide-content">
                <h1>Showcase Your Talent. Grow Your Brand.</h1>
                <p>Vendors: Create a stunning portfolio and connect with thousands of couples.</p>
                <div class="hero-buttons">
                    <a href="auth/signup.php" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i>
                        Sign Up Now
                    </a>
                    <a href="auth/login.php" class="btn btn-secondary">
                        <i class="fas fa-map-marker-alt"></i>
                       Login Now
                    </a>
                </div>
            </div>
        </div>
        <div class="slide" style="background-image: url('images/slide6.jpg');">
            <div class="slide-content">
                <h1>Plan Your Dream Wedding, Effortlessly</h1>
                <p>All-in-one tools and expert support to make your special day unforgettable.</p>
                <div class="hero-buttons">
                    <a href="user-registration.php" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i>
                        Download Planora Wedding Planning App
                    </a>
                </div>
            </div>
        </div>
        <div class="slide" style="background-image: url('images/slide3.jpg');">
            <div class="slide-content">
                <h1>Your Wedding, Your Way-Anywhere</h1>
                <p>Download the Planora app to plan, organize, and celebrate from any device.</p>
                <div class="hero-buttons">
                    <a href="user-registration.php" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i>
                        Download Planora Wedding Planning App
                    </a>
                </div>
            </div>
        </div>
        <div class="slide" style="background-image: url('images/slide1.jpg');">
            <div class="slide-content">
                <h1>Connect with Top Vendors</h1>
                <p>Browse verified professionals and book every wedding service in one place.</p>
                <div class="hero-buttons">
                    <a href="user-registration.php" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i>
                        Download Planora Wedding Planning App
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="slider-controls">
        <button class="prev-slide"><i class="fas fa-chevron-left"></i></button>
        <div class="slider-dots"></div>
        <button class="next-slide"><i class="fas fa-chevron-right"></i></button>
    </div>
    
</section>



<section class="what-is-planora" id="promo">
  <div class="section-container">
    <div class="planora-intro">
      <h2 class="section-title">About Planora</h2>
      <p class="section-subtitle">Bringing couples and wedding pros together</p>
      <p class="section-subtitle">Planora makes dream weddings easy to create and simple to manage, with powerful tools for couples and a thriving marketplace for vendors.</p>
    </div>

    <div class="planora-features">
      <h3 class="features-title">Why Choose Planora?</h3>
      <div class="features-grid">
        <div class="feature-item" style="background-image: url('images/cards.png');">
          <i class="fas fa-calendar-alt"></i>
          <h4>All-in-One Planning</h4>
          <p>From budgeting to vendor management, Planora simplifies every step of your wedding planning journey.</p>
        </div>
        <div class="feature-item" style="background-image: url('images/cards.png');">
          <i class="fas fa-users"></i>
          <h4>Verified Vendors</h4>
          <p>Access a curated list of trusted vendors for venues, catering, photography, and more.</p>
        </div>
        <div class="feature-item" style="background-image: url('images/cards.png');">
          <i class="fas fa-heart"></i>
          <h4>Personalized Experience</h4>
          <p>Tailored tools and recommendations to match your unique wedding vision.</p>
        </div>
        <div class="feature-item" style="background-image: url('images/cards.png');">
          <i class="fas fa-mobile-alt"></i>
          <h4>Mobile-Friendly</h4>
          <p>Plan your wedding anytime, anywhere with our user-friendly mobile app.</p>
        </div>
      </div>
    </div>
</section>


    <footer class="footer">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="vendor.php">Vendor Services</a></li>
                        <li><a href="client.php">Client Services</a></li>
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
        </footer>

    <script>
        window.addEventListener('scroll', function() {
        const header = document.querySelector('.header');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
      /* FAQ Hover Functionality */
            document.addEventListener('DOMContentLoaded', function() {
                const faqItems = document.querySelectorAll('.faq-item');
                
                // For mobile devices, we'll keep the click functionality
                if (window.innerWidth <= 768) {
                    faqItems.forEach(item => {
                        const question = item.querySelector('.faq-question');
                        const answer = item.querySelector('.faq-answer');
                        
                        question.addEventListener('click', () => {
                            const isActive = item.classList.contains('active');
                            
                            // Close all FAQ items
                            faqItems.forEach(faqItem => {
                                faqItem.classList.remove('active');
                                const faqAnswer = faqItem.querySelector('.faq-answer');
                                faqAnswer.style.maxHeight = '0';
                                faqAnswer.style.opacity = '0';
                            });
                            
                            // Open clicked item if it wasn't active
                            if (!isActive) {
                                item.classList.add('active');
                                answer.style.maxHeight = answer.scrollHeight + 'px';
                                answer.style.opacity = '1';
                            }
                        });
                    });
                }
            });
             
        const promoData = [
            {
                type: 'main',
                image: 'https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80',
                title: 'Your All-in-One Event Planning App',
                description: 'Plan any event with ease using our powerful app. From weddings to corporate events, we make planning stress-free and enjoyable.',
                primaryButton: 'Download Now',
                secondaryButton: 'See Features'
            },
            {
                type: 'features',
                image: 'https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80',
                title: 'Smart Planning Tools at Your Fingertips',
                description: 'Budget tracking, vendor management, guest lists, and more - all in one beautiful app. Start planning smarter today!',
                primaryButton: 'Try Free',
                secondaryButton: 'View Demo'
            },
            {
                type: 'benefits',
                image: 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80',
                title: 'Join 10,000+ Happy Planners',
                description: 'Experience why thousands of event planners and couples trust our app for their special occasions. Your perfect event starts here.',
                primaryButton: 'Get Started',
                secondaryButton: 'Read Reviews'
            },
            {
                type: 'premium',
                image: 'https://images.unsplash.com/photo-1519689680058-324335c77eba?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80',
                title: 'Premium Features for Perfect Events',
                description: 'Access advanced tools, AI-powered recommendations, and priority support. Make your event planning journey extraordinary.',
                primaryButton: 'Upgrade Now',
                secondaryButton: 'Compare Plans'
            },
            {
                type: 'community',
                image: 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80',
                title: 'Connect with Top Event Vendors',
                description: 'Access our network of verified vendors, read reviews, and book services directly through the app. Your perfect vendor match awaits!',
                primaryButton: 'Find Vendors',
                secondaryButton: 'Join as Vendor'
            },
            {
                type: 'mobile',
                image: 'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80',
                title: 'Plan Anywhere, Anytime',
                description: 'Available on iOS and Android. Sync across all your devices and collaborate with your team in real-time. Your event planning companion.',
                primaryButton: 'App Store',
                secondaryButton: 'Play Store'
            }
        ];

        document.addEventListener('DOMContentLoaded', function () {
            const slides = document.querySelectorAll('.slide');
            const prevButton = document.querySelector('.prev-slide');
            const nextButton = document.querySelector('.next-slide');
            const dotsContainer = document.querySelector('.slider-dots');
            let currentSlide = 0;

    
    slides.forEach((_, index) => {
        const dot = document.createElement('div');
        dot.classList.add('dot');
        if (index === 0) dot.classList.add('active');
        dot.addEventListener('click', () => showSlide(index));
        dotsContainer.appendChild(dot);
    });

    const dots = dotsContainer.querySelectorAll('.dot');

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
            dots[i].classList.toggle('active', i === index);
        });
        currentSlide = index;
    }

    function nextSlide() {
        showSlide((currentSlide + 1) % slides.length);
    }

    function prevSlide() {
        showSlide((currentSlide - 1 + slides.length) % slides.length);
    }

    nextButton.addEventListener('click', nextSlide);
    prevButton.addEventListener('click', prevSlide);

    // Auto slide every 8 seconds
    setInterval(nextSlide, 8000);

    // Show initial
    showSlide(currentSlide);
});

    document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.planora-tab');
    const panels = document.querySelectorAll('.planora-panel');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(t => t.classList.remove('active'));
            panels.forEach(p => p.classList.remove('active'));
            tab.classList.add('active');
            const panel = document.querySelector('.planora-panel-' + tab.dataset.tab);
            panel.classList.add('active');
            console.log(panel); // Debug the active panel
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const scroller = document.getElementById('servicesScroller');
    const section = scroller.closest('.section-container');
    const leftArrow = section.querySelector('.left-arrow');
    const rightArrow = section.querySelector('.right-arrow');
    const scrollAmount = 300; // px per click

    leftArrow.addEventListener('click', function(e) {
        e.preventDefault();
        scroller.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });
    rightArrow.addEventListener('click', function(e) {
        e.preventDefault();
        scroller.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });
});
</script>

    

   
</body>
</html>
