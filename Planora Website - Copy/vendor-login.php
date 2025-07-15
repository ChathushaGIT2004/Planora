<?php
// filepath: c:\wamp64\www\Planora Website\vendor-login.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
    $login_email = $_POST['email'];
    $login_password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, password, user_role, status FROM User WHERE email = ?");
    $stmt->bind_param("s", $login_email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $db_password, $user_role, $status);
        $stmt->fetch();

        if (password_verify($login_password, $db_password)) {
            if ($user_role === 'vendor') {
                // Set session variables
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_role'] = $user_role; // Set user role to 'vendor'
                $_SESSION['email'] = $login_email;

                // Redirect to vendor portfolio
                $_SESSION['popup_success'] = 'Login successful!';
                header('Location: vendor-portfolio.php');
                exit;
            } else {
                $error = "Invalid user role.";
            }
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with that email.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Registration - Wedding Planner</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/vendor-services.css">
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
                }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            line-height: 1.6;
            color: var(--text-color);
            background: var(--gray-light);
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                        url('https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            color: var(--white);
            padding: 6rem 2rem;
            text-align: center;
            margin-bottom: 3rem;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .form-container {
            background: var(--white);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .header::after {
            content: '';
            display: block;
            width: 100px;
            height: 3px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            margin: 1rem auto;
        }

        .header h1 {
            color: var(--text-color);
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .header p {
            color: #666;
            font-size: 1.1rem;
        }

        .site-footer {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--text-color);
            padding: 2rem 0 1rem 0;
            margin-top: 3rem;
            font-size: 1rem;
        }

        .footer-container {
            max-width: 1200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.2rem;
        }
        
        .footer-copy {
            font-size: 0.95rem;
            opacity: 0.8;
            margin-top: 0.5rem;
        }

        .login-form {
            background: rgba(255, 255, 255, 0.95);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: var(--shadow-soft);
            backdrop-filter: blur(10px);
            transform: translateY(0);
            transition: transform 0.3s ease;
        }

        .login-form:hover {
            transform: translateY(-5px);
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-header h1 {
            color: var(--text-color);
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

       .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .remember-me input[type="checkbox"] {
            width: auto;
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .submit-button {
            padding: 0.7rem 2.5rem;
            border: none;
            border-radius: 25px;
            background: var(--primary-color);
            color: var(--white);
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: var(--shadow-soft);
            cursor: pointer;
            opacity: 0.85;
            margin-bottom: 1.5rem;
            transition:
                background 0.2s,
                color 0.2s,
                opacity 0.2s,
                box-shadow 0.2s;
        }

        .cancel-button {
            padding: 0.7rem 2.5rem;
            border: none;
            border-radius: 25px;
            background: var(--white);
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: var(--shadow-soft);
            cursor: pointer;
            opacity: 0.85;
            margin-bottom: 1.5rem;
            transition:
                background 0.2s,
                color 0.2s,
                opacity 0.2s,
                box-shadow 0.2s;
        }

        /* Popup Message */
        #popupMessage {
            display: none;
            position: fixed;
            top: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: #555879;
            color: #fff;
            padding: 1rem 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(85, 88, 121, 0.13);
            z-index: 9999;
            font-size: 1.1rem;
            min-width: 220px;
            text-align: center;
        }

        .login-message {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            text-align: center;
            font-weight: 600;
        }

        .vendor-form {
            display: grid;
            gap: 1rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 5px;
        }

        .form-group {
            margin-bottom: 2px;
        }

        .form-group label {
            display: block;
            margin-bottom: 20px;
            color: var(--text-color);
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 20px;
        }

        .form-group select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
        }

        

    </style>
</head>
<body>

    <div class="hero-section">
        <div class="hero-content">
            <h1>Experience the Magic of Weddings</h1>
            <p>Connect with couples planning their special day and grow your business</p>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            <a href="index.php" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Back to Home
            </a>

            <div class="form-header">
                <h1>Welcome Back!</h1>
            </div>

            <?php if (isset($error)): ?>
                <div style="color:red"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="vendor-login.php">
                <div class="form-group">
                    <label for="loginEmail">Email Address</label>
                    <input type="email" id="loginEmail" name="email" required>
                </div>
                <div class="form-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" id="loginPassword" name="password" required>
                </div>
                <div class="remember-forgot">
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>
                <button type="submit" class="submit-button">Sign In</button>
                <div class="register-link">
                    Don't have an account? <a href="vendor-registration.php">Register now</a>
                </div>
            </form>
        </div>
    </div>
    <footer class="site-footer">
            <div class="footer-container">
                <div class="footer-copy">
                    &copy; 2025 Planora. All rights reserved.
                </div>
            </div>
        </footer>
</body>
</html>