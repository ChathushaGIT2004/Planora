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
            --accent-color: ;    
            --background: #e9f5f1ff;     
            --transparent: rgba(255, 255, 255, 0);         

            --text-color: #043823;     
            --text-light: #AF99FF;     
            --text-white: #ffffff;      
            --gray-light: ;    
            --gray-dark: #333333;      

            --gradient-1: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            --gradient-2: linear-gradient(135deg, var(--accent-color) 0%, var(--secondary-color) 100%);
            --gradient-dark: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7));


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

        /* Common Components */
        .section-container {
            max-width: var(--container-xl);
            margin: 0 auto;
            padding: 0 var(--spacing-md);
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: var(--spacing-md);
            position: relative;
            display: inline-block;
            left: 50%;
            transform: translateX(-50%);
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--gradient-1);
            border-radius: var(--radius-sm);
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: var(--text-light);
            max-width: 700px;
            margin: 0 auto var(--spacing-lg);
        }

        /* Buttons */
         

        

        /* Header Styles */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: transparent;
            z-index: 1000;
            padding: var(--spacing-md) 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition-fast);
        }

        .header.scrolled {
            padding: var(--spacing-sm) 5%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-soft);
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-white);
            font-family: 'Playfair Display', serif;
            transition: var(--transition-fast);
        }

        .header.scrolled .logo {
            color: var(--primary-color);
        }

        .nav-links {
            display: flex;
            gap: var(--spacing-md);
            list-style: none;
        }

        .nav-links a {
            color: var(--text-white);
            font-weight: 500;
            position: relative;
        }

        .header.scrolled .nav-links a {
            color: var(--text-color);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-1);
            transition: var(--transition-fast);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: var(--gradient-dark), url('https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--text-white);
            padding: 0 var(--spacing-md);
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: var(--spacing-md);
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: var(--spacing-lg);
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

        .budget-tracker-header {
            text-align: center;
            margin-bottom: 3rem;
            margin-top: 2.5rem;
            padding: 0 2rem;
            position: relative;
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

         
        /* How It Works Section */
        .how-it-works {
            padding: 6rem 5%;
            background: var(--white);
            position: relative;
            overflow: hidden;
        }


        .timeline-importance .header-wrapper {
            text-align: center;
            margin-bottom: 3rem;
        }

        .timeline-importance .section-title {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-family: 'Playfair Display', serif;
        }

        .timeline-importance .section-subtitle {
            font-size: 1.2rem;
            color: var(--text-light);
            max-width: 700px;
            margin: 0 auto;
        }

        .importance-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            align-items: center;
        }

        .stat-card {
            width: 260px;
            height: 300px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 2px 12px rgba(85, 88, 121, 0.08);
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(85, 88, 121, 0.15);
        }

        .stat-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 2rem;
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-description {
            font-size: 1rem;
            color: var(--text-light);
            line-height: 1.5;
        }

        .timeline-visual {
            position: relative;
            margin: 2rem 0;
        }

        .timeline-bar {
            position: relative;
            height: 4px;
            background: var(--primary-color);
            border-radius: 2px;
            margin: 0 auto;
            width: 80%;
        }

        .timeline-marker {
            position: absolute;
            top: -6px;
            width: 16px;
            height: 16px;
            background: var(--primary-color);
            border-radius: 50%;
        }

        .timeline-labels {
            position: relative;
            margin-top: 1rem;
        }

        .timeline-label {
            position: absolute;
            text-align: center;
            transform: translateX(-50%);
        }

        .label-dot {
            width: 12px;
            height: 12px;
            background: var(--primary-color);
            border-radius: 50%;
            margin: 0 auto;
        }

        .label-text {
            font-size: 1rem;
            color: var(--text-color);
            margin-top: 0.5rem;
        }

        .features-container {
            margin-top: 3rem;
        }

        .features-title {
            text-align: center;
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 2rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .feature-item {
            text-align: center;
            padding: 2rem;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 2px 12px rgba(85, 88, 121, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(85, 88, 121, 0.15);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .feature-item h4 {
            font-size: 1.2rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .feature-item p {
            font-size: 1rem;
            color: var(--text-light);
            line-height: 1.5;
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
                

                .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
            margin-bottom: 3rem;
        }
        .testimonials .section-title {
            font-size: 2rem;
            color: var(--text-color);
            margin-bottom: 2rem;
            margin-top: 2rem;
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

        

        .disclaimer {
            f.cta-wrapper {
        margin-top: 2rem;
        }

         .cta-wrapper {
        margin-top: 2rem;
        }

        

        .disclaimer {
        font-size: 0.9rem;
        color: var(--text-light);
        margin-top: 0.5rem;
        }


         

        


    </style>
</head>
<body>
    <header class="header">
        <a href="index.html" class="logo">Planora</a>
        <nav>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Plan Your Dream Wedding with Planora</h1>
            <p>Join our platform to plan your dream wedding with ease. Connect with top vendors, manage your budget, track your timeline, and organize every detail—all in one place.</p>
            <a href="#" class="cta-button">Download Planora Wedding Planning Mobile Application</a>
        </div>
    </section>

    <!-- Couples Content -->
    <section id="features" class="features">
        <div class="section-container">
            <h2 class="section-title">Why Choose Planora?</h2>
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
    </section>
      <section class="planora-how-it-works">
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
    </section>


      <!-- Budget Tracker Section -->
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
              <p>See exactly where every dollar goes with our colorful pie charts and spending categories.</p>
            </div>
          </div>
          <div class="feature-card">
            <div class="feature-icon" style="background-color: var(--secondary-color);">
              <i class="fas fa-bell" style="color: var(--primary-color);"></i>
            </div>
            <div class="feature-content">
              <h3>Smart Spending Alerts</h3>
              <p>Get notifications when you're approaching budget limits in any category.</p>
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
              <p>Personalized tips to help you save based on your spending patterns.</p>
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
    </section>
      <!-- Timeline Importance Section -->
      <section class="timeline-importance" id="timeline">
        <div class="section-container">
          <div class="header-wrapper">
            <h2 class="section-title">Why Your Wedding Timeline Matters</h2>
            <p class="section-subtitle">The secret weapon for a stress-free, perfectly orchestrated wedding day.</p>
          </div>
          <div class="importance-grid">
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-clock"></i>
              </div>
              <div class="stat-content">
                <div class="stat-number">87%</div>
                <div class="stat-description">of couples report reduced stress when using a detailed timeline.</div>
              </div>
            </div>
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
              </div>
              <div class="stat-content">
                <div class="stat-number">3.5x</div>
                <div class="stat-description">more likely to stay on budget with proper scheduling.</div>
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
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">4.8/5</div>
                    <div class="stat-description">average satisfaction when using timeline tools</div>
                </div>
            </div>
          </div> 
        </div>
    </section>
      <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <div class="section-container">
            <h2 class="section-title">What Our Clients Say</h2>
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
            </div>
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <i class="fas fa-quote-left"></i>
                    <p>The timeline tracker and budget tools were lifesavers during our wedding planning. Highly recommend Planora!</p>
                </div>
                <div class="testimonial-author">
                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Sophia & Liam">
                    <div class="author-info">
                        <h4>Sophia & Liam</h4>
                        <p>Newlyweds</p>
                    </div>
                </div>
            </div>
        <div class="testimonial-card">
  <div class="testimonial-content">
    <i class="fas fa-quote-left"></i>
    <p>"Planora made our wedding planning stress-free and enjoyable. The budget tracker was a lifesaver, and the vendor marketplace helped us find the perfect team for our big day."</p>
  </div>
  <div class="testimonial-author">
    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Emily & James">
    <div class="author-info">
      <h4>Emily & James</h4>
      <p>Newlyweds</p>
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

    <style>
        .cta-section {
    justify-items: center; 
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-content: center;
    align-items: center; 
            padding: 4rem 0;
            padding: auto;
            background-color: var(--primary-color);
            text-align: center;
             padding: var(--spacing-xl) 0;
             color: var(--text-white);
                    text-align: center;
             height: 400px;       
        }
         
        .cta-section h2 {
            font-size: 2.5rem;
            color: var(--text-while);
            margin-bottom: 1rem;
        }
        .cta-section p {
            color: var(--gray-light);
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }
        .cta-button {
            margin-top: 20px;
            background:var(--secondary-color);
            color: var(--primary-color);
            padding :16px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s, transform 0.3s;
        }
        .cta-button:hover {

            border:2px solid var(--secondary-color);
            color: var(--text-white);
            background: var(--transperent);
            transform: translateY(-2px);
        }
        </style>

    <section class="cta-section">
        <div class="section-container">
            <div class="cta-content">
                <h2>Ready to Plan Your Dream Wedding?</h2>
                <p>Join Planora today and start planning your perfect day.</p>
                <a href="#download" class="cta-button">Get Started Now</a>
            </div>
        </div>
    </section>

    <style>
        * Footer */
        .footer {
            background: var(--background);
            color: var(--text-while);
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
            color:#451000;
            margin-bottom: var(--spacing-xs);
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
    </script>
</body>
</html> 