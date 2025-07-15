<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Wedding Planner</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="login-form">
            <div class="form-header">
                <h1>Welcome Back!</h1>
                <p>Sign in to continue planning your perfect day</p>
            </div>
            <form id="loginForm">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="remember-forgot">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>
                <button type="submit" class="submit-button">Sign In</button>
                <div class="social-login">
                    <p>Or continue with</p>
                    <div class="social-buttons">
                        <button type="button" class="social-button">
                            <i class="fab fa-google"></i>
                        </button>
                        <button type="button" class="social-button">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <button type="button" class="social-button">
                            <i class="fab fa-apple"></i>
                        </button>
                    </div>
                </div>
                <div class="register-link">
                    Don't have an account? <a href="user-registration.html">Register now</a>
                </div>
            </form>
        </div>
        <div class="welcome-sidebar">
            <h2>Welcome to Wedding Planner</h2>
            <p>Your journey to the perfect wedding starts here. Sign in to access your personalized planning tools and continue creating your dream celebration.</p>
            <div class="features-list">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Track Progress</h3>
                        <p>Access your wedding planning checklist and timeline</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Vendor Messages</h3>
                        <p>View and respond to vendor inquiries</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Event Schedule</h3>
                        <p>Manage your upcoming appointments and meetings</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/common.js"></script>
</body>
</html> 