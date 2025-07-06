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
body {
    font-family: 'Poppins', sans-serif;
    line-height: 1.6;
    color: var(--text-color);
    background-color: var(--background);
    overflow-x: hidden;
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
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    background: transparent;
    padding: 20px 40px;
    z-index: 999;
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
    padding: 1rem 5%;   
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
    background-color:var(--primary-color);
    width: 200px;
    text-align: center;
    color: white;
    padding: 10px 18px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.login-button:hover {
    background-color:var(--secondary-color);
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
    background: var(--gradient-1);
    border-radius: 4px;
}
.section-subtitle {
    text-align: center;
    font-size: 1.2rem;
    color: var(--text-light);
    max-width: 700px;
    margin: 0 auto 2rem;
}

/* Buttons */
.btn, .cta-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 1rem 2.5rem;
    border-radius: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s;
    text-decoration: none;
    cursor: pointer;
    border: none;
    position: relative;
    overflow: hidden;
    font-size: 1rem;
    min-width: 200px;
    gap: 0.5rem;
}
.btn::before, .cta-button::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0));
    transform: translateX(-100%);
    transition: transform 0.3s;
}
.btn:hover::before, .cta-button:hover::before { transform: translateX(0); }
.btn-primary, .cta-button:not(.secondary) {
    background: var(--gradient-1);
    color: var(--text-white);
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
.btn-primary:hover, .cta-button:not(.secondary):hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}
.btn-secondary, .cta-button.secondary {
    background: transparent;
    color: var(--text-white);
    border: 2px solid var(--text-white);
    backdrop-filter: blur(5px);
}
.btn-secondary:hover, .cta-button.secondary:hover {
    background: rgba(255,255,255,0.1);
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
.btn-sm { padding: 0.6rem 1.5rem; font-size: 0.9rem; min-width: 150px; }
.btn-lg { padding: 1.2rem 3rem; font-size: 1.1rem; min-width: 250px; }

/* Hero Slider */
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
    background: rgba(85, 88, 121, 0.7);
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

/* Planora Section Styles */
.what-is-planora {
    background: linear-gradient(135deg, #fff5f5 0%, #f4ebd3 100%);
    padding: 5rem 0 4rem 0;
    position: center;
    overflow: hidden;
}

.planora-intro {
    text-align: center;
    margin-bottom: 2.5rem;
}

.planora-content {
    display: flex;
    flex-wrap: wrap;
    gap: 3rem;
    justify-content: space-between;
    align-items: flex-start;
}

.planora-text {
    flex: 2;
    min-width: 320px;
}

.planora-description p {
    font-size: 1.15rem;
    color: var(--text-color);
    margin-bottom: 2rem;
    line-height: 1.7;
}

.planora-tabs {
  display: flex;
  justify-content: center;
  gap: 2rem;
  margin-bottom: 2.5rem;
}
.planora-tab {
  background: var(--white);
  border: 2px solid var(--primary-color);
  color: var(--primary-color);
  padding: 0.8rem 2.5rem;
  border-radius: 30px;
  font-weight: 600;
  font-size: 1.1rem;
  cursor: pointer;
  transition: background 0.2s, color 0.2s;
}
.planora-tab.active {
  background: var(--primary-color);
  color: #fff;
}
.planora-panel { display: none; }
.planora-panel.active { display: block; animation: fadeIn 0.5s; }

/* Planora Features */
.services-overview h3 {
    font-size: 1.3rem;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
}

.services-container {
    width: 100%;
    overflow-x: auto;
    padding-bottom: 1rem;
}
.services-container::-webkit-scrollbar {
    display: block; 
}
.services-grid {
    display: flex-start;
    gap: 2rem;  
    padding: 0 1rem;
}
.service-item {
    min-width: 220px;
    max-width: 260px;
    flex: 0 0 240px;
    height: 260px;  
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 2px 12px rgba(85, 88, 121, 0.08);
    padding: 2rem 1.5rem;
    text-align: center;
    transition: transform 0.25s, box-shadow 0.25s;
}

.service-item:hover {
    transform: translateY(-8px) scale(1.03);
    box-shadow: 0 8px 32px rgba(85, 88, 121, 0.13);
}

.service-item i {
    font-size: 2.2rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.service-item h4 {
    font-size: 1.15rem;
    color: var(--primary-color);
    margin-bottom: 0.7rem;
    font-weight: 600;
}

.service-item p {
    color: var(--text-light);
    font-size: 1rem;
    line-height: 1.5;
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

.scroll-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    background: rgba(85, 88, 121, 0.8);
    border: none;
    color: #fff;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 8px rgba(85, 88, 121, 0.18);
    opacity: 0.85;
}
.scroll-arrow:hover {
    background: var(--primary-color);
    opacity: 1;
}
.left-arrow {
    left: 0.5rem;
}
.right-arrow {
    right: 0.5rem;
}
.scroll-arrows-bottom {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    margin-top: 1.5rem;
}
.scroll-arrows-bottom .scroll-arrow {
    position: static;
    transform: none;
    margin: 0;
    box-shadow: 0 2px 8px rgba(85, 88, 121, 0.18);
    background: rgba(85, 88, 121, 0.8);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-size: 1.5rem;
    color: #fff;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    opacity: 0.85;
    transition: background 0.2s, box-shadow 0.2s;
}
.scroll-arrows-bottom .scroll-arrow:hover {
    background: var(--primary-color);
    opacity: 1;
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

.tracker-section {
    background: linear-gradient(135deg, #fff5f5 0%, #f4ebd3 100%);
    padding: 5rem 0 4rem 0;
    position: relative;
    overflow: hidden;
}

.budget-tracker-header {
    text-align: center;
    margin-bottom: 2.5rem;
}
.budget-tracker-header .section-title {
    font-size: 2.2rem;
    color: var(--primary-color);
    margin-bottom: 0.7rem;
}
.budget-tracker-header .section-subtitle {
    color: var(--text-light);
    font-size: 1.15rem;
    max-width: 700px;
    margin: 0 auto;
}

.tracker-features {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    justify-content: center;
    margin-bottom: 2.5rem;
}
.feature-card {
    background: #fff;
    border-radius: 1.5rem;
    box-shadow: 0 2px 8px rgba(85,88,121,0.08);
    padding: 2rem 1.5rem;
    text-align: center;
    width: 260px;
    min-height: 260px;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: transform 0.3s, box-shadow 0.3s;
    border: 1px solid rgba(85,88,121,0.08);
}
.feature-card:hover {
    transform: translateY(-8px) scale(1.03);
    box-shadow: 0 8px 24px rgba(85,88,121,0.13);
    border-color: var(--secondary-color);
}
.feature-icon {
    width: 64px;
    height: 64px;
    background: var(--secondary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.2rem;
    box-shadow: 0 2px 8px rgba(85,88,121,0.10);
}
.feature-icon i {
    font-size: 2rem;
    color: var(--primary-color);
}
.feature-content h3 {
    font-size: 1.15rem;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
    font-weight: 700;
}
.feature-content p {
    color: var(--text-light);
    font-size: 1rem;
    line-height: 1.5;
}

/* Stats Cards */
.tracker-stats {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    justify-content: center;
    margin: 2.5rem 0 2rem 0;
}
.stats-card {
    background: #fff;
    border-radius: 1.2rem;
    box-shadow: 0 2px 8px rgba(85,88,121,0.08);
    padding: 2rem 1.5rem;
    text-align: center;
    min-width: 200px;
    width: 220px;
    border-top: 4px solid var(--primary-color);
    display: flex;
    flex-direction: column;
    align-items: center;
}
.stats-card .stat-number {
    font-size: 2.2rem;
    color: var(--primary-color);
    font-weight: 700;
    margin-bottom: 0.5rem;
}
.stats-card .stat-label {
    font-size: 1.1rem;
    color: var(--secondary-color);
    margin-bottom: 0.3rem;
    font-weight: 600;
}
.stats-card .stat-desc {
    color: var(--text-light);
    font-size: 0.98rem;
}

/* CTA */
.tracker-cta {
    text-align: center;
    margin-top: 2.5rem;
}
.tracker-cta .cta-button {
    background: var(--primary-color);
    color: #fff;
    font-size: 1.1rem;
    padding: 1rem 2.5rem;
    border-radius: 30px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s, transform 0.2s;
    margin-bottom: 1rem;
}
.tracker-cta .cta-button:hover {
    background: var(--secondary-color);
    transform: translateY(-2px);
}
.tracker-cta .cta-note {
    color: var(--text-light);
    font-size: 1rem;
    margin-top: 0.5rem;
}
/* How It Works Section */
.how-it-works {
    padding: 6rem 5%;
    background: var(--white);
    position: relative;
    overflow: hidden;
}
.timeline-container {
    max-width: 1200px;
    margin: 4rem auto 0;
    padding: 0 1rem;
    position: relative;
}
.timeline-container::before {
    content: '';
    position: absolute;
    top: 0; left: 50%;
    transform: translateX(-50%);
    width: 4px; height: 100%;
    background: var(--gradient-1);
    border-radius: 999px;
    box-shadow: 0 0 15px rgba(255,182,193,0.3);
}
.timeline {
    position: relative;
    padding: 2rem 0;
}
.timeline-item {
    display: flex;
    justify-content: center;
    padding: 2rem 0;
    position: relative;
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.6s ease forwards;
}
.timeline-item:nth-child(odd) { animation-delay: 0.2s;}
.timeline-item:nth-child(even) { animation-delay: 0.4s;}
.timeline-dot {
    width: 60px; height: 60px;
    background: var(--gradient-1);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: var(--white); font-size: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    position: relative; z-index: 2;
    transition: all 0.3s;
    border: 3px solid var(--white);
}
.timeline-item:hover .timeline-dot {
    transform: scale(1.1);
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
}
.timeline-content {
    width: 45%;
    background: var(--background);
    padding: 2rem;
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s;
    position: relative;
    border: 1px solid rgba(255,182,193,0.1);
}
.timeline-content::before {
    content: '';
    position: absolute; top: 50%;
    width: 20px; height: 20px;
    background: var(--background);
    transform: rotate(45deg) translateY(-50%);
}
.timeline-item:nth-child(odd) .timeline-content {
    margin-right: 2rem;
    text-align: left;
}
.timeline-item:nth-child(odd) .timeline-content::before {
    right: -10px;
    border-right: 1px solid rgba(255,182,193,0.1);
    border-top: 1px solid rgba(255,182,193,0.1);
}
.timeline-item:nth-child(even) .timeline-content {
    margin-left: 2rem;
    text-align: right;
    order: -1;
}
.timeline-item:nth-child(even) .timeline-content::before {
    left: -10px;
    border-left: 1px solid rgba(255,182,193,0.1);
    border-bottom: 1px solid rgba(255,182,193,0.1);
}
.timeline-item:hover .timeline-content {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    border-color: var(--primary-color);
}
.timeline-content h3 {
    color: var(--primary-color);
    font-size: 1.5rem;
    margin-bottom: 1rem;
    font-family: 'Playfair Display', serif;
}
.timeline-content p {
    color: var(--text-light);
    font-size: 1rem;
    line-height: 1.6;
}


/* About Section */
.about {
    padding: 5rem 5%;
    background: var(--white);
}
.about-content {
    display: flex;
    gap: 4rem;
    align-items: center;
    margin-top: 3rem;
}
.about-text { flex: 1; }
.story-intro {
    font-size: 1.4rem;
    color: var(--text-color);
    margin-bottom: 2rem;
    line-height: 1.8;
    font-weight: 500;
}
.story-points {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}
.story-point {
    display: flex;
    gap: 1.5rem;
    align-items: flex-start;
}
.story-point i {
    font-size: 1.5rem;
    color: var(--primary-color);
    margin-top: 0.5rem;
}
.story-point h3 {
    font-size: 1.3rem;
    margin-bottom: 0.5rem;
    color: var(--text-color);
}
.story-point p {
    color: #666;
    line-height: 1.6;
}
.about-image {
    flex: 1;
    max-width: 400px;
}
.about-image img {
    width: 100%;
    height: auto;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s;
}
.about-image img:hover { transform: scale(1.02); }

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

/* Testimonials Section */
.testimonials {
    padding: 5rem 5%;
    background: var(--white);
}
.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 3rem;
}
.testimonial-card {
    background: var(--gray-light);
    border-radius: 15px;
    padding: 2rem;
    transition: transform 0.3s;
}
.testimonial-card:hover { transform: translateY(-10px);}
.testimonial-content { margin-bottom: 1.5rem;}
.testimonial-content i {
    color: var(--primary-color);
    font-size: 1.5rem;
    margin-bottom: 1rem;
}
.testimonial-content p {
    color: #666;
    line-height: 1.6;
    font-style: italic;
}
.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
}
.testimonial-author img {
    width: 60px; height: 60px;
    border-radius: 50%;
    object-fit: cover;
}
.author-info h4 {
    color: var(--text-color);
    font-size: 1.1rem;
    margin-bottom: 0.2rem;
}
.author-info p {
    color: #666;
    font-size: 0.9rem;
}

/* FAQ Section */
.faq {
    padding: 5rem 5%;
    background: linear-gradient(135deg, #fff5f5 0%, #fff 100%);
}
.faq-container {
    max-width: 800px;
    margin: 3rem auto 0;
}
.faq-item {
    background: var(--white);
    border-radius: 10px;
    margin-bottom: 1rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    overflow: hidden;
    transition: box-shadow 0.3s, transform 0.3s;
}
.faq-item:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}
.faq-question {
    padding: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: background 0.3s;
}
.faq-question:hover { background-color: var(--gray-light);}
.faq-question h3 {
    font-size: 1.2rem;
    color: var(--text-color);
    margin: 0;
    transition: color 0.3s;
}
.faq-question:hover h3 { color: var(--primary-color);}
.faq-question i {
    color: var(--primary-color);
    transition: transform 0.3s;
    font-size: 1.1rem;
}
.faq-answer {
    padding: 0 1.5rem;
    max-height: 0;
    overflow: hidden;
    transition: all 0.3s;
    opacity: 0;
}
.faq-item:hover .faq-answer {
    padding: 0 1.5rem 1.5rem;
    max-height: 500px;
    opacity: 1;
}
.faq-answer p {
    color: #666;
    line-height: 1.6;
    margin: 0;
}

/* Contact Section */
.contact {
    padding: 5rem 5%;
    background: var(--white);
}
.contact-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    margin-top: 3rem;
}
.contact-info {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}
.info-item {
    display: flex;
    gap: 1.5rem;
    align-items: flex-start;
}
.info-item i {
    font-size: 1.5rem;
    color: var(--primary-color);
    margin-top: 0.5rem;
}
.info-item h3 {
    font-size: 1.2rem;
    color: var(--text-color);
    margin-bottom: 0.5rem;
}
.info-item p {
    color: #666;
    line-height: 1.6;
}
.social-links {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}
.social-link {
    width: 40px; height: 40px;
    background: var(--gray-light);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: var(--text-color);
    text-decoration: none;
    transition: background 0.3s, color 0.3s, transform 0.3s;
}
.social-link:hover {
    background: var(--primary-color);
    color: var(--white);
    transform: translateY(-3px);
}
.contact-form {
    background: var(--gray-light);
    padding: 2rem;
    border-radius: 15px;
}
.form-group { margin-bottom: 1.5rem;}
.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--text-color);
    font-weight: 500;
}
.form-group input, .form-group textarea {
    width: 100%;
    padding: 0.8rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-family: inherit;
    font-size: 1rem;
    transition: border-color 0.3s;
}
.form-group input:focus, .form-group textarea:focus {
    outline: none;
    border-color: var(--primary-color);
}
.submit-button {
    background: linear-gradient(45deg, var(--primary-color), #FFA500);
    color: var(--white);
    padding: 1rem 2rem;
    border: none;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.3s;
    width: 100%;
}
.submit-button:hover { transform: translateY(-2px); }

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
    margin-bottom: 1rem;
}
.footer-section ul {
    list-style: none;
    padding: 0;
}
.footer-section ul li { margin-bottom: 0.8rem;}
.footer-section ul li a {
    color: #999;
    text-decoration: none;
    transition: color 0.3s;
}
.footer-section ul li a:hover { color: var(--primary-color);}
.newsletter-form {
    display: flex;
    gap: 0.5rem;
}
.newsletter-form input {
    flex: 1;
    padding: 0.8rem;
    border: 1px solid #333;
    border-radius: 25px;
    background: #333;
    color: var(--white);
    font-family: inherit;
}
.newsletter-form input:focus {
    outline: none;
    border-color: var(--primary-color);
}
.newsletter-form button {
    padding: 0.8rem 1.5rem;
    background: var(--primary-color);
    color: var(--white);
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: transform 0.3s;
}
.newsletter-form button:hover { transform: translateY(-2px);}
.footer-bottom {
    border-top: 1px solid #333;
    padding-top: 2rem;
    text-align: center;
}
.footer-bottom .social-links {
    justify-content: center;
    margin-bottom: 1rem;
}
.footer-bottom .social-link {
    background: #333;
    color: var(--white);
}
.footer-bottom .social-link:hover { background: var(--primary-color);}
.copyright {
    color: #999;
    font-size: 0.9rem;
}

/* Loader */
.loader-container {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(255,255,255,0.9);
    z-index: 9999;
    display: flex; align-items: center; justify-content: center;
}
.loader {
    border: 4px solid var(--primary-color);
    border-top: 4px solid transparent;
    border-radius: 50%;
    width: 50px; height: 50px;
    animation: spin 1s linear infinite;
}

/* Scroll to Top Button */
.scroll-to-top {
    position: fixed;
    bottom: 2rem; right: 2rem;
    background: var(--primary-color);
    color: var(--white);
    width: 50px; height: 50px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem;
    cursor: pointer;
    opacity: 0; visibility: hidden;
    transition: opacity 0.3s, visibility 0.3s, background 0.3s;
}
.scroll-to-top:hover { background: var(--secondary-color);}
.scroll-to-top.show { opacity: 1; visibility: visible; }

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
    <link rel="stylesheet" href="color-overrides.css">
    
    <header class="header animate fade-in">
    <a href="index2.php" class="logo">
        <img src="images/Logo_without_bg.png" alt="Planora Logo">
    </a>
    <div class="header-right">
        <nav>
            <ul class="nav-links">
                <li><a href="#home" >Home</a></li>
                <li><a href="#promo">About</a></li>
                <li><a href="#services">Services <i class="fas fa-chevron-down"></i></a>
                    <ol>
                        <li><a href="vendor.php">Vendor Services</a></li>
                        <li><a href="#budget">Budget Tracker</a></li>
                        <li><a href="#timeline">Timeline Tracker</a></li>
                    </ol>
                </li>
                <li><a href="#testimonials">Stories</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="blog.php" target="_blank">Blog</a></li>
            </ul>
        </nav>
        <a href="vendor-registration.php" class="login-button">
            VENDOR SIGN UP
        </a>
        <a href="vendor-login.php" class="login-button">
            VENDOR LOGIN
        </a>
    </div>
</header>
  
   <section class="hero-slider" id="home">
    <div class="slides-container">
        <div class="slide active" style="background-image: url('https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');">
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
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');">
            <div class="slide-content">
                <h1>Your Wedding, Your Way—Anywhere</h1>
                <p>Download the Planora app to plan, organize, and celebrate from any device.</p>
                <div class="hero-buttons">
                    <a href="user-registration.php" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i>
                        Download Planora Wedding Planning App
                    </a>
                </div>
            </div>
        </div>
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');">
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
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');">
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
    </div>
    <div class="slider-controls">
        <button class="prev-slide"><i class="fas fa-chevron-left"></i></button>
        <div class="slider-dots"></div>
        <button class="next-slide"><i class="fas fa-chevron-right"></i></button>
    </div>
    
</section>


<!-- Planora For Everyone Section -->
<section class="what-is-planora" id="promo">
  <div class="section-container">
    <div class="planora-intro">
      <h2 class="section-title">About Planora</h2>
      <p class="section-subtitle">Bringing couples and wedding pros together</p>
      <p class="section-subtitle">Planora makes dream weddings easy to create and simple to manage, with powerful tools for couples and a thriving marketplace for vendors.</p>
    </div>

    <!-- Tab Switcher -->
    <div class="planora-tabs">
      <button class="planora-tab active" data-tab="couple">For Couples</button>
      <button class="planora-tab" data-tab="vendor">For Vendors</button>
    </div>

    <!-- Couples Content -->
    <div class="planora-panel planora-panel-couple active">
      <div class="planora-description">
        <p>Planora empowers couples to plan their dream wedding with ease. Discover top vendors, manage your budget, track your timeline, and organize every detail—all in one place.</p>
      </div>
      <div class="services-overview">
        <h3>Plan Your Perfect Day—Here’s What You Get</h3>
        <div class="services-grid">
          <div class="service-item">
            <i class="fas fa-calendar-check"></i>
            <h4>Smart Planning Tools</h4>
            <p>Budget tracking, timeline management, guest list organization, and more.</p>
          </div>
          <div class="service-item">
            <i class="fas fa-users"></i>
            <h4>Vendor Marketplace</h4>
            <p>Access verified vendors for venues, catering, photography, and all wedding needs.</p>
          </div>
          <div class="service-item">
            <i class="fas fa-comments"></i>
            <h4>Expert Support</h4>
            <p>24/7 access to professional wedding planners.</p>
          </div>
          <div class="service-item">
            <i class="fas fa-mobile-alt"></i>
            <h4>Mobile App</h4>
            <p>Plan on-the-go with our user-friendly mobile application.</p>
          </div>
        </div>
      </div>
      <div class="planora-how-it-works">
        <h3>How It Works</h3>
        <div class="how-it-works-steps">
          <div class="step">
            <div class="step-icon"><i class="fas fa-user-plus"></i></div>
            <div class="step-title">Sign Up</div>
            <div class="step-desc">Create your free account as a couple.</div>
          </div>
          <div class="step">
            <div class="step-icon"><i class="fas fa-search"></i></div>
            <div class="step-title">Discover</div>
            <div class="step-desc">Browse vendors, tools, and inspiration for your big day.</div>
          </div>
          <div class="step">
            <div class="step-icon"><i class="fas fa-calendar-check"></i></div>
            <div class="step-title">Plan & Track</div>
            <div class="step-desc">Use our tools to manage your budget, timeline, and more.</div>
          </div>
          <div class="step">
            <div class="step-icon"><i class="fas fa-heart"></i></div>
            <div class="step-title">Celebrate</div>
            <div class="step-desc">Enjoy a stress-free, perfectly planned wedding!</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Vendors Content -->
    <div class="planora-panel planora-panel-vendor">
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
      </div>
      <div class="planora-how-it-works">
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
      </div>
    </div>
  </div>
</section>

       <!-- Vendor Services Section -->
 <!-- Vendor Services Section -->
<section class="vendor-services" id="vendorservice">
  <div class="section-container">
    <h2 class="section-title">All Your Wedding Needs, All in One Place</h2>
    <p class="section-subtitle">
      Explore a world of trusted wedding services—find everything you need or showcase your expertise, all on Planora.
    </p>
    <div class="services-container" id="servicesScroller">
        <div class="services-grid">
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-hotel"></i></div>
            <h3>Venues</h3>
            <p>Hotels, banquet halls, outdoor venues</p>
          </div>
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-camera"></i></div>
            <h3>Photography</h3>
            <p>Photographers, videographers, drones</p>
          </div>
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-utensils"></i></div>
            <h3>Catering</h3>
            <p>Food, desserts, bar services</p>
          </div>
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-music"></i></div>
            <h3>Entertainment</h3>
            <p>DJs, live bands, performers</p>
          </div>
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-paint-brush"></i></div>
            <h3>Decor</h3>
            <p>Floral, lighting, themes</p>
          </div>
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-spa"></i></div>
            <h3>Beauty</h3>
            <p>Makeup, hair, spa</p>
          </div>
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-tshirt"></i></div>
            <h3>Attire</h3>
            <p>Bridal, groom, accessories</p>
          </div>
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-car"></i></div>
            <h3>Transport</h3>
            <p>Luxury cars, shuttles</p>
          </div>
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-envelope-open-text"></i></div>
            <h3>Invitations</h3>
            <p>Cards, digital invites</p>
          </div>
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-birthday-cake"></i></div>
            <h3>Cakes</h3>
            <p>Wedding cakes, desserts</p>
          </div>
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-gem"></i></div>
            <h3>Jewelry</h3>
            <p>Bridal jewelry sets</p>
          </div>
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-gifts"></i></div>
            <h3>Favors</h3>
            <p>Guest gifts, packaging</p>
          </div>
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-heart"></i></div>
            <h3>Honeymoon</h3>
            <p>Travel packages, planning</p>
          </div>
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-ring"></i></div>
            <h3>Rings</h3>
            <p>Engagement & wedding rings</p>
          </div>
          <div class="service-card">
            <div class="service-icon"><i class="fas fa-calendar-check"></i></div>
            <h3>Planning</h3>
            <p>Full-service coordination</p>
          </div>
        </div>
    </div>
    <div class="scroll-arrows-bottom">
            <button class="scroll-arrow left-arrow" aria-label="Scroll left">
            <i class="fas fa-chevron-left"></i>
            </button>
            <button class="scroll-arrow right-arrow" aria-label="Scroll right">
            <i class="fas fa-chevron-right"></i>
            </button>
        </div>
  </div>
</section>

<section class="tracker-section">
    <div class="budget-tracker-header">
        <h2 class="section-title">Planora Budget Tracker</h2>
        <p class="section-subtitle">
            Take control of your wedding spending—track every expense, get smart alerts, and stay on budget with ease.
        </p>
    </div>
        <div class="tracker-features">
            <div class="feature-card">
                <div class="feature-icon" style="background-color: var(--secondary-color);">
                    <i class="fas fa-chart-pie" style="color: var(--primary-color);"></i>
                </div>
                <div class="feature-content">
                    <h3>Visual Budget Breakdown</h3>
                    <p>See exactly where every dollar goes with our colorful pie charts and spending categories</p>
                </div>
            </div>

            <div class="feature-card">
                <div class="feature-icon" style="background-color: var(--secondary-color);">
                    <i class="fas fa-bell" style="color: var(--primary-color);"></i>
                </div>
                <div class="feature-content">
                    <h3>Smart Spending Alerts</h3>
                    <p>Get notifications when you're approaching budget limits in any category</p>
                </div>
            </div>

            <div class="feature-card">
                <div class="feature-icon" style="
                style="color: var(--primary-color);"></i>
                </div>
                <div class="feature-content">
                    <h3>Vendor Payment Tracker</h3>
                    <p>Manage deposits, balances, and payment due dates for all your vendors</p>
                </div>
            </div>

            <div class="feature-card">
                <div class="feature-icon" style="background-color: var(--secondary-color);">
                    <i class="fas fa-lightbulb" style="color: var(--primary-color);"></i>
                </div>
                <div class="feature-content">
                    <h3>Savings Recommendations</h3>
                    <p>Personalized tips to help you save based on your spending patterns</p>
                </div>
            </div>
        </div>
        <!-- Right Column - Stats -->
            <div class="tracker-stats">
                <div class="stats-card" style="border-top: 4px solid var(--primary-color);">
                    <div class="stat-number">95%</div>
                    <div class="stat-label">Couples stay within budget</div>
                    <div class="stat-desc">When using our tracking tools</div>
                </div>

                <div class="stats-card" style="border-top: 4px solid var(--secondary-color);">
                    <div class="stat-number">$5,200</div>
                    <div class="stat-label">Average savings</div>
                    <div class="stat-desc">Through smart recommendations</div>
                </div>

                <div class="stats-card" style="border-top: 4px var(--secondary-color);">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Access anywhere</div>
                    <div class="stat-desc">Mobile-friendly tracking</div>
                </div>

                <div class="stats-card" style="border-top: 4px var(--secondary-color);">
                    <div class="stat-number">10,000+</div>
                    <div class="stat-label">Happy couples</div>
                    <div class="stat-desc">Who planned stress-free</div>
                </div>
            </div>
        </div>
    </div>
</section>


 <!-- Timeline Importance Section -->
<section class="timeline-importance" id="timeline">
    <div class="section-container">
        <div class="header-wrapper">
            <h2 class="section-title">Why Your Wedding Timeline Matters</h2>
            <p class="section-subtitle">The secret weapon for a stress-free, perfectly orchestrated wedding day</p>
        </div>

        <div class="importance-grid">
            <!-- Stat Card 1 -->
            <div class="stat-card" style="background-color: #FFF0F5;">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">87%</div>
                    <div class="stat-description">of couples report reduced stress when using a detailed timeline</div>
                </div>
            </div>

            <!-- Stat Card 2 -->
            <div class="stat-card" style="background-color: #FFF9FB;">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">3.5x</div>
                    <div class="stat-description">more likely to stay on budget with proper scheduling</div>
                </div>
            </div>

            <!-- Visual Timeline -->
            <div class="timeline-visual">
                <div class="timeline-bar">
                    <div class="timeline-marker"></div>
                    <div class="timeline-marker"></div>
                    <div class="timeline-marker"></div>
                </div>
                <div class="timeline-labels">
                    <div class="timeline-label" style="left: 20%;">
                        <div class="label-dot"></div>
                        <div class="label-text">Preparation</div>
                    </div>
                    <div class="timeline-label" style="left: 50%;">
                        <div class="label-dot"></div>
                        <div class="label-text">Ceremony</div>
                    </div>
                    <div class="timeline-label" style="left: 80%;">
                        <div class="label-dot"></div>
                        <div class="label-text">Reception</div>
                    </div>
                </div>
            </div>

            <!-- Stat Card 3 -->
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">92%</div>
                    <div class="stat-description">of vendors require a timeline for proper coordination</div>
                </div>
            </div>

            <!-- Stat Card 4 -->
            <div class="stat-card" style="background-color: #FFF9FB;">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">4.8/5</div>
                    <div class="stat-description">average satisfaction when using timeline tools</div>
                </div>
            </div>
        </div>

        <!-- Features List -->
        <div class="features-container">
            <h3 class="features-title">How Our Timeline Tracker Helps You</h3>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h4>Automated Alerts</h4>
                    <p>Get reminders for important deadlines and payments</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Vendor Sync</h4>
                    <p>All your vendors automatically receive timeline updates</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h4>Mobile Access</h4>
                    <p>Manage your timeline anywhere with our easy-to-use app</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-magic"></i>
                    </div>
                    <h4>Smart Suggestions</h4>
                    <p>AI-powered recommendations for optimal scheduling</p>
                </div>
            </div>
        </div>
    </div>
</section>
           
    <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <div class="section-container">
            <h2 class="section-title">What Our Users Say</h2>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left"></i>
                        <p>This app made planning our wedding so much easier! The budget tracker and vendor communication features saved us countless hours.</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Sarah & John">
                        <div class="author-info">
                            <h4>Sarah & John</h4>
                            <p>Newlyweds</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left"></i>
                        <p>As a wedding planner, this platform has revolutionized how I manage my clients. The organization tools are incredible!</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Emily Parker">
                        <div class="author-info">
                            <h4>Emily Parker</h4>
                            <p>Wedding Planner</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left"></i>
                        <p>Our venue has seen a 40% increase in bookings since joining the platform. The quality of leads is outstanding!</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Michael Chen">
                        <div class="author-info">
                            <h4>Michael Chen</h4>
                            <p>Venue Manager</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq" id="faq">
        <div class="section-container">
            <h2 class="section-title">Have Questions? We've Got Answers</h2>
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Is the app free to use?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes! Our basic features are completely free to use. We offer premium features for couples who want additional tools and support.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Can I plan more than one event?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Absolutely! Our platform supports multiple event planning, whether it's a wedding, birthday, or corporate event.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>How do I contact a wedding planner?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>You can browse our network of professional wedding planners and contact them directly through our in-app messaging system.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Is my personal data and budget private?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, we take privacy seriously. Your personal information and budget details are encrypted and only shared with vendors you choose to connect with.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>How can vendors join the platform?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Vendors can register through our website or app. We verify all vendors to ensure quality service for our users.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
 </div>
 <div class="vendor">
     


 
</section>

<!-- Vendor Categories Section -->
<section class="vendor-categories">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Vendor Categories We Support</h2>
      <p class="section-subtitle">Join our diverse community of wedding professionals</p>
    </div>

    <div class="categories-grid">
      <!-- Category 1 -->
      <div class="category-card">
        <div class="category-icon">
          <i class="fas fa-camera"></i>
        </div>
        <h3>Photographers & Videographers</h3>
        <p>Capture precious moments with your creative expertise</p>
        <a href="#" class="category-link">Join Now <i class="fas fa-arrow-right"></i></a>
      </div>

      <!-- Category 2 -->
      <div class="category-card">
        <div class="category-icon">
          <i class="fas fa-clipboard-list"></i>
        </div>
        <h3>Wedding Planners</h3>
        <p>Bring wedding visions to life with your organizational magic</p>
        <a href="#" class="category-link">Join Now <i class="fas fa-arrow-right"></i></a>
      </div>

      <!-- Category 3 -->
      <div class="category-card">
        <div class="category-icon">
          <i class="fas fa-hotel"></i>
        </div>
        <h3>Hotel & Venue Providers</h3>
        <p>Showcase your beautiful spaces for unforgettable celebrations</p>
        <a href="#" class="category-link">Join Now <i class="fas fa-arrow-right"></i></a>
      </div>

      <!-- Category 4 -->
      <div class="category-card">
        <div class="category-icon">
          <i class="fas fa-spa"></i>
        </div>
        <h3>Florists & Designers</h3>
        <p>Transform venues with your floral artistry and decor</p>
        <a href="#" class="category-link">Join Now <i class="fas fa-arrow-right"></i></a>
      </div>

      <!-- Category 5 -->
      <div class="category-card">
        <div class="category-icon">
          <i class="fas fa-magic"></i>
        </div>
        <h3>Makeup Artists</h3>
        <p>Help bridal parties look and feel their absolute best</p>
        <a href="#" class="category-link">Join Now <i class="fas fa-arrow-right"></i></a>
      </div>

      <!-- Category 6 -->
      <div class="category-card">
        <div class="category-icon">
          <i class="fas fa-utensils"></i>
        </div>
        <h3>Caterers</h3>
        <p>Delight guests with your culinary creations</p>
        <a href="#" class="category-link">Join Now <i class="fas fa-arrow-right"></i></a>
      </div>

      <!-- Category 7 -->
      <div class="category-card">
        <div class="category-icon" ;">
          <i class="fas fa-music"></i>
        </div>
        <h3>Entertainment Providers</h3>
        <p>Set the perfect mood with music and performances</p>
        <a href="#" class="category-link">Join Now <i class="fas fa-arrow-right"></i></a>
      </div>
    </div>

    <div class="cta-container">
      <p class="cta-text">Don't see your category? We're always expanding our network!</p>
      <a href="#" class="cta-button">Become a vendor</a>
    </div>
  </div>
</section>

<!-- Pricing Transparency Section - Minimalist Redesign -->
<section class="pricing-section">
  <div class="container">
    <div class="pricing-header">
      <h2 class="section-title">Simple, Fair Pricing</h2>
      <p class="section-subtitle">No subscriptions. No hidden fees. Just 5% when you book.</p>
    </div>

    <div class="pricing-content">
      <div class="pricing-percentage">
        <span class="percentage">5%</span>
        <span class="per-booking">per booking</span>
      </div>

      <div class="pricing-details">
        <h3>Everything included at no cost:</h3>
        <div class="benefits-grid">
          <div class="benefit-item">
            <i class="fas fa-check"></i>
            <span>Professional portfolio</span>
          </div>
          <div class="benefit-item">
            <i class="fas fa-check"></i>
            <span>Booking dashboard</span>
          </div>
          <div class="benefit-item">
            <i class="fas fa-check"></i>
            <span>Unlimited inquiries</span>
          </div>
          <div class="benefit-item">
            <i class="fas fa-check"></i>
            <span>Verified leads</span>
          </div>
          <div class="benefit-item">
            <i class="fas fa-check"></i>
            <span>Marketing exposure</span>
          </div>
          <div class="benefit-item">
            <i class="fas fa-check"></i>
            <span>Secure payments</span>
          </div>
        </div>
      </div>

      <div class="cta-wrapper">
        <a href="#" class="cta-button">Get Started - Free Forever</a>
        <p class="disclaimer">*5% fee only applies to successfully booked events</p>
      </div>
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
    </footer>

    <script>
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
        document.querySelector('.planora-panel-' + tab.dataset.tab).classList.add('active');
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
