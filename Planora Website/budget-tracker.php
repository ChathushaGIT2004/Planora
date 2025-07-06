<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Tracker - Planora</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
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
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--background);
        }

        .budget-tracker-section {
            padding: 6rem 5%;
            background: linear-gradient(135deg, #fff 0%, #FFF5F7 100%);
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .budget-tracker-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23FF69B4' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.5;
        }

        .budget-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .budget-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .budget-header h2 {
            font-size: 2.8rem;
            color: var(--text-color);
            margin-bottom: 1rem;
            font-family: 'Playfair Display', serif;
        }

        .budget-header p {
            font-size: 1.1rem;
            color: var(--text-light);
            max-width: 600px;
            margin: 0 auto;
        }

        .budget-features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .budget-feature-card {
            background: white;
            padding: 2.5rem 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(255, 105, 180, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .budget-feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--gradient-1);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .budget-feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(255, 105, 180, 0.15);
        }

        .budget-feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-1);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .feature-icon i {
            font-size: 1.8rem;
            color: white;
        }

        .feature-content h3 {
            font-size: 1.4rem;
            color: var(--text-color);
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .feature-content p {
            color: var(--text-light);
            line-height: 1.6;
            font-size: 1rem;
        }

        .budget-cta {
            text-align: center;
            margin-top: 3rem;
        }

        .budget-cta .cta-button {
            padding: 1.2rem 2.5rem;
            font-size: 1.1rem;
            background: var(--gradient-1);
            color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(255, 105, 180, 0.2);
        }

        .budget-cta .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(255, 105, 180, 0.3);
        }

        @media (max-width: 1024px) {
            .budget-features {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .budget-features {
                grid-template-columns: 1fr;
            }
            
            .budget-header h2 {
                font-size: 2.2rem;
            }
            
            .budget-feature-card {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <section class="budget-tracker-section">
        <div class="budget-container">
            <div class="budget-header">
                <h2>Smart Budget Tracking</h2>
                <p>Stay on top of your event expenses with our intuitive budget management tools</p>
            </div>
            <div class="budget-features">
                <div class="budget-feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Real-time Tracking</h3>
                        <p>Monitor your expenses in real-time with interactive charts and analytics</p>
                    </div>
                </div>
                <div class="budget-feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Smart Alerts</h3>
                        <p>Get notified when you're approaching budget limits or when expenses need attention</p>
                    </div>
                </div>
                <div class="budget-feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Expense Reports</h3>
                        <p>Generate detailed reports and export them in multiple formats</p>
                    </div>
                </div>
            </div>
            <div class="budget-cta">
                <button class="cta-button">Start Tracking Now</button>
            </div>
        </div>
    </section>
</body>
</html> 