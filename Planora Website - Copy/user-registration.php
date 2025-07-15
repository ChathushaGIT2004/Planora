<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Wedding Planner</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/registration.css">
</head>
<body>
    <div class="container">
        <div class="registration-form">
            <div class="form-header">
                <h1>Create Account</h1>
                <p>Join us to start planning your perfect wedding</p>
            </div>
            <form id="registrationForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                </div>
                <button type="submit" class="submit-button">Create Account</button>
                <div class="login-link">
                    Already have an account? <a href="login.html">Sign in</a>
                </div>
            </form>
        </div>
        <div class="benefits-sidebar">
            <h2>Why Join Wedding Planner?</h2>
            <p>Create your account today and unlock a world of wedding planning possibilities.</p>
            <div class="benefits-list">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="benefit-content">
                        <h3>Personalized Timeline</h3>
                        <p>Get a customized planning timeline based on your wedding date</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="benefit-content">
                        <h3>Vendor Network</h3>
                        <p>Connect with trusted wedding vendors in your area</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="benefit-content">
                        <h3>Task Management</h3>
                        <p>Keep track of all your wedding planning tasks in one place</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/common.js"></script>
</body>
</html> 