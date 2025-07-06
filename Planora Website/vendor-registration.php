<?php
session_start();
include 'db_connect.php';

// Handle Login
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

        // Try hashed password first
        if (password_verify($login_password, $db_password) || $login_password === $db_password) {
            if ($user_role === 'vendor') {
                // On successful login
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

// Handle Registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vendorEmail'], $_POST['vendorPassword'])) {
    // 1. Collect user info
    $email = $_POST['vendorEmail'];
    $password = password_hash($_POST['vendorPassword'], PASSWORD_DEFAULT); // <-- hashed and secure
    $user_role = 'vendor';
    $status = 'active';
    $app_feedback = null;

    // 2. Collect vendor info
    $vendor_name = $_POST['businessName'];
    $description = $_POST['description'];
    $type = $_POST['vendorType'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $contact_name = $_POST['contactName'];
    $contact_number = $_POST['phone'];
    $logo_url = ''; // Handle logo upload if needed

    // 3. Store password as plain text (remove hashing)
    // $password = password_hash($password, PASSWORD_DEFAULT); // <-- REMOVE this line

    // 4. Insert into User table
    // Get the next user_id
    $result = $conn->query("SELECT MAX(user_id) AS max_id FROM User");
    $row = $result->fetch_assoc();
    $new_user_id = $row['max_id'] + 1;

    $stmtUser = $conn->prepare("INSERT INTO User (user_id, email, password, user_role, status, app_feedback) VALUES (?, ?, ?, ?, ?, ?)");
    $stmtUser->bind_param("isssss", $new_user_id, $email, $password, $user_role, $status, $app_feedback);

    if ($stmtUser->execute()) {
        $user_id = $stmtUser->insert_id;

        // 5. Insert into Vendor table
        $stmtVendor = $conn->prepare("INSERT INTO Vendor (vendor_name, description, type, city, district, contact_name, contact_number, logo_url, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmtVendor->bind_param("ssssssssi", $vendor_name, $description, $type, $city, $district, $contact_name, $contact_number, $logo_url, $user_id);

        if ($stmtVendor->execute()) {
            $success = true;
        } else {
            $error = "Vendor Error: " . $stmtVendor->error;
        }
        $stmtVendor->close();
    } else {
        $error = "User Error: " . $stmtUser->error;
    }
    $stmtUser->close();
    
    if (isset($success) && $success) {
        // Auto-login after registration
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_role'] = $user_role;
        $_SESSION['email'] = $email;
        header("Location: vendor-registration.php");
        exit;
    }
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

        .benefits-section {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 4rem 2rem;
            margin-top: 3rem;
            position: relative;
            overflow: hidden;
        }

        .benefits-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80') center/cover;
            opacity: 0.05;
            z-index: 0;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2.5rem;
            margin-top: 3rem;
            position: relative;
            z-index: 1;
        }

        .benefit-item {
            text-align: center;
            padding: 2.5rem;
            background: var(--white);
            border-radius: 20px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .benefit-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .benefit-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .benefit-item:hover::before {
            transform: scaleX(1);
        }

        .benefit-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: rotate(-10deg);
            transition: transform 0.4s ease;
        }

        .benefit-item:hover .benefit-icon {
            transform: rotate(0deg);
        }

        .benefit-icon i {
            font-size: 2.5rem;
            color: var(--white);
        }

        .benefit-content h3 {
            font-size: 1.4rem;
            color: var(--text-color);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .benefit-content h3::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.4s ease;
        }

        .benefit-item:hover .benefit-content h3::after {
            width: 80px;
        }

        .benefit-content p {
            color: #666;
            font-size: 1rem;
            line-height: 1.6;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 4rem;
            padding-top: 3rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        .stat-item {
            text-align: center;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(45deg, var(--primary-color),var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-color);
            font-size: 1.1rem;
            font-weight: 500;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
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

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
        }

        .submit-section {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1rem;
        }

        .cancel-button {
            padding: 0.8rem 1.5rem;
            border: 1px solid #ddd;
            border-radius: 25px;
            background: var(--white);
            color: var(--text-color);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cancel-button:hover {
            background: #f5f5f5;
        }

        .submit-button {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: var(--white);
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .submit-button:hover {
            transform: translateY(-2px);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-color);
            text-decoration: none;
            margin-bottom: 1rem;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: var(--primary-color);
        }

        .required-field::after {
            content: " *";
            color: #ff4444;
        }

        .success-message {
            display: none;
            text-align: center;
            padding: 2rem;
            background: var(--white);
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .success-message.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 1024px) {
            .benefits-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .benefits-grid {
                grid-template-columns: 1fr;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }
        }

        .form-section {
            background: var(--white);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.3rem;
            color: var(--text-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-color);
        }

        .logo-upload {
            text-align: center;
            padding: 2rem;
            border: 2px dashed #ddd;
            border-radius: 10px;
            margin-bottom: 2rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logo-upload:hover {
            border-color: var(--primary-color);
            background: rgba(255, 215, 0, 0.05);
        }

        .logo-upload i {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 1rem;
        }

        .logo-upload p {
            color: #666;
            margin-bottom: 0.5rem;
        }

        .logo-upload .file-types {
            font-size: 0.8rem;
            color: #999;
        }

        .logo-preview {
            width: 150px;
            height: 150px;
            margin: 0 auto;
            border-radius: 10px;
            overflow: hidden;
            display: none;
        }

        .logo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-section:last-child {
            margin-bottom: 0;
        }

        /* New Promotional Content Styles */
        .promo-section {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            padding: 3rem 2rem;
            margin: 3rem 0;
            border-radius: 15px;
            color: var(--white);
        }

        .promo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .promo-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease;
        }

        .promo-card:hover {
            transform: translateY(-5px);
        }

        .promo-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .promo-card p {
            margin-bottom: 1.5rem;
        }

        .promo-price {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .promo-features {
            list-style: none;
            margin-bottom: 1.5rem;
        }

        .promo-features li {
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .promo-features li i {
            margin-right: 0.5rem;
            color: var(--primary-color);
        }

        .payment-section {
            background: var(--white);
            padding: 2rem;
            border-radius: 15px;
            margin-top: 2rem;
        }

        .payment-methods {
            display: flex;
            gap: 1rem;
            margin: 1rem 0;
        }

        .payment-method {
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-method:hover {
            border-color: var(--primary-color);
        }

        .payment-method.selected {
            border-color: var(--primary-color);
            background: var(--gray-light);
        }

        .secure-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #28a745;
            margin-top: 1rem;
        }

        .secure-badge i {
            font-size: 1.2rem;
        }

        /* Footer Styles */
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

        .toggle-buttons {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Toggle Button Style */
        .toggle-btn {
            padding: 0.7rem 2.5rem;
            border: none;
            border-radius: 25px;
            background: rgba(255,255,255,0.95);
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: var(--shadow-soft);
            cursor: pointer;
            opacity: 0.85;
            transition: 
                background 0.2s,
                color 0.2s,
                opacity 0.2s,
                box-shadow 0.2s;
        }

        .toggle-btn.active,
        .toggle-btn:hover {
            background: var(--primary-color);
            color: #fff;
            opacity: 1;
            box-shadow: var(--shadow-strong);
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

    </style>
</head>
<body>
    <div class="hero-section">
        <div class="hero-content">
            <h1>Join Our Network of Wedding Vendors</h1>
            <p>Connect with couples planning their special day and grow your business</p>
        </div>
    </div>

    <div class="container">
        <div class="form-container">
            <a href="index2.php" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Back to Home
            </a>

            <div class="toggle-buttons">
                <button type="button" id="showLogin" class="toggle-btn active">Login</button>
                <button type="button" id="showRegister" class="toggle-btn">Register</button>
            </div>

            <div class="success-message" id="successMessage">
                <i class="fas fa-check-circle" style="font-size: 3rem; color: #4CAF50; margin-bottom: 1rem;"></i>
                <h2>Registration Submitted!</h2>
                <p>Thank you for your registration. We will review your application and get back to you soon.</p>
            </div>

            
            <?php if (isset($success) && $success): ?>
    <div class="alert alert-success" id="vendorSuccessAlert">Vendor registered successfully!</div>
<?php elseif (isset($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

            <!-- Toggle Buttons -->


<!-- Login Form (shown by default) -->
<div id="loginForm" class="toggle-form" style="display:block;">
    <form method="POST">
        <div class="form-header">
            <h1>Welcome Back!</h1>
        </div>
        <div class="form-group">
            <label for="vendorEmail">Email Address</label>
            <input type="email" id="vendorEmail" name="email" required>
        </div>
        <div class="form-group">
            <label for="vendorPassword">Password</label>
            <input type="password" id="vendorPassword" name="password" required>
        </div>
        <div class="remember-forgot">
            <label class="remember-me">
                <input type="checkbox" name="remember">
                Remember me
            </label>
            <a href="#" class="forgot-password">Forgot Password?</a>
        </div>
        <button type="submit" class="submit-button">Sign In</button>
        <div class="register-link">
            Don't have an account? <a href="#" id="goToRegister">Register now</a>
        </div>
    </form>
</div>

<!-- Registration Form (hidden by default) -->
<div id="registerForm" class="toggle-form" style="display:none;">
    <form class="vendor-form" id="vendorForm" method="POST" enctype="multipart/form-data">
                <div class="header">
                <h1>Register as a Vendor</h1>
                <p>Join our network of trusted wedding vendors and grow your business</p>
            </div>
                <div class="form-section">
                    <h2 class="section-title">Business Information</h2>
                    
                    <div class="logo-upload" id="logoUpload">
                        <div class="logo-preview" id="logoPreview">
                            <img src="" alt="Business Logo Preview">
                        </div>
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Upload your business logo</p>
                        <p class="file-types">PNG, JPG, or SVG (Max 2MB)</p>
                        <input type="file" id="logoInput" accept="image/*" style="display: none;">
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="businessName" class="required-field">Business Name</label>
                            <input type="text" id="businessName" name="businessName" required>
                        </div>
                        <div class="form-group">
                            <label for="vendorType" class="required-field">Vendor Type</label>
                            <select id="vendorType" name="vendorType" required>
                                <option value="">Select Vendor Type</option>
                                <option value="venue">Venue</option>
                                <option value="catering">Catering</option>
                                <option value="photography">Photography</option>
                                <option value="florist">Florist</option>
                                <option value="music">Music & Entertainment</option>
                                <option value="attire">Wedding Attire</option>
                                <option value="beauty">Beauty & Makeup</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Business Details Section -->
                <div class="form-section">
                    <h2 class="section-title">Business Details</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="district" class="required-field">Business District</label>
                            <select id="district" name="district" required>
                                <option value="">Select District</option>
                                <option value="Ampara">Ampara</option>
                                <option value="Anuradhapura">Anuradhapura</option>
                                <option value="Badulla">Badulla</option>
                                <option value="Batticaloa">Batticaloa</option>
                                <option value="Colombo">Colombo</option>
                                <option value="Galle">Galle</option>
                                <option value="Gampaha">Gampaha</option>
                                <option value="Hambantota">Hambantota</option>
                                <option value="Jaffna">Jaffna</option>
                                <option value="Kalutara">Kalutara</option>
                                <option value="Kandy">Kandy</option>
                                <option value="Kegalle">Kegalle</option>
                                <option value="Kilinochchi">Kilinochchi</option>
                                <option value="Kurunegala">Kurunegala</option>
                                <option value="Mannar">Mannar</option>
                                <option value="Matale">Matale</option>
                                <option value="Matara">Matara</option>
                                <option value="Monaragala">Monaragala</option>
                                <option value="Mullaitivu">Mullaitivu</option>
                                <option value="Nuwara Eliya">Nuwara Eliya</option>
                                <option value="Polonnaruwa">Polonnaruwa</option>
                                <option value="Puttalam">Puttalam</option>
                                <option value="Ratnapura">Ratnapura</option>
                                <option value="Trincomalee">Trincomalee</option>
                                <option value="Vavuniya">Vavuniya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city" class="required-field">Business City</label>
                            <select id="city" name="city" required>
                                <option value="">Select City</option>
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <label for="description" class="required-field">Business Description</label>
                            <textarea id="description" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="experience" class="required-field">Years of Experience</label>
                            <input type="number" id="experience" name="experience" min="0" required>
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="form-section">
                    <h2 class="section-title">Contact Information</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="contactName" class="required-field">Contact Person</label>
                            <input type="text" id="contactName" name="contactName" required>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="required-field">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="required-field">Email Address</label>
                            <input type="vendorEmail" id="vendorEmail" name="vendorEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="vendorPassword" class="required-field">Password</label>
                            <input type="password" id="vendorPassword" name="vendorPassword" required>
                        </div>
                        
                    </div>
                </div>

                


                <!-- Terms and Submit Section -->
                <div class="form-section">
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms" class="required-field">I agree to the Terms and Conditions</label>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button type="button" class="cancel-button" onclick="window.location.href='index2.html'">Cancel</button>
                        <button type="submit" class="submit-button">Submit Registration</button>
                    </div>
                </div>
            </form>
</div>

        </div>

         <div class="benefits-section">
            <div class="header">
                <h1>Why Choose Planora?</h1>
                <p>Join the most trusted wedding vendor network and transform your business</p>
            </div>

            <div class="benefits-grid">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="benefit-content">
                        <h3>Premium Client Network</h3>
                        <p>Connect with high-value clients actively planning their dream weddings. Our platform attracts couples who value quality and are ready to invest in their special day.</p>
                    </div>
                </div>

                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="benefit-content">
                        <h3>Business Growth</h3>
                        <p>Experience up to 3x growth in bookings with our advanced matching algorithm and targeted marketing tools. Track your success with detailed analytics and insights.</p>
                    </div>
                </div>

                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="benefit-content">
                        <h3>Enhanced Visibility</h3>
                        <p>Stand out with a premium profile, showcase your portfolio, and collect verified reviews. Get featured in our curated vendor listings and special promotions.</p>
                    </div>
                </div>

                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="benefit-content">
                        <h3>Smart Management</h3>
                        <p>Streamline your business with our all-in-one platform. Manage bookings, payments, and client communications effortlessly with our intuitive tools.</p>
                    </div>
                </div>

                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="benefit-content">
                        <h3>Marketing Power</h3>
                        <p>Access powerful marketing tools including social media integration, email campaigns, and targeted promotions. Reach your ideal clients with precision.</p>
                    </div>
                </div>

                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="benefit-content">
                        <h3>Vendor Network</h3>
                        <p>Join an exclusive community of top-tier vendors. Create valuable partnerships, collaborate on events, and expand your business network.</p>
                    </div>
                </div>
            </div>

            <div class="stats-container">
                <div class="stat-item">
                    <div class="stat-number">15K+</div>
                    <div class="stat-label">Active Couples</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">8K+</div>
                    <div class="stat-label">Premium Vendors</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">99%</div>
                    <div class="stat-label">Success Rate</div>
                </div>
            </div>
        </div>

       

        <div class="payment-section">
            <h2>Secure Payment Options</h2>
            <p>Choose your preferred payment method</p>
            <div class="payment-methods">
                <div class="payment-method">
                    <i class="fab fa-cc-visa fa-2x"></i>
                    <span>Visa</span>
                </div>
                <div class="payment-method">
                    <i class="fab fa-cc-mastercard fa-2x"></i>
                    <span>Mastercard</span>
                </div>
                <div class="payment-method">
                    <i class="fab fa-cc-paypal fa-2x"></i>
                    <span>PayPal</span>
                </div>
            </div>
            <div class="secure-badge">
                <i class="fas fa-lock"></i>
                <span>Secure Payment Processing</span>
            </div>
        </div>

        <footer class="site-footer">
            <div class="footer-container">
                <div class="footer-copy">
                    &copy; 2025 Planora. All rights reserved.
                </div>
            </div>
        </footer>

        
    <script>
        // Form validation
        const form = document.getElementById('vendorForm');
        const inputs = form.querySelectorAll('input, select, textarea');

        inputs.forEach(input => {
            input.addEventListener('invalid', function(e) {
                e.preventDefault();
                this.classList.add('invalid');
            });

            input.addEventListener('input', function() {
                if (this.classList.contains('invalid')) {
                    this.classList.remove('invalid');
                }
            });
        });

        // Logo Upload Preview
        const logoUpload = document.getElementById('logoUpload');
        const logoInput = document.getElementById('logoInput');
        const logoPreview = document.getElementById('logoPreview');
        const logoPreviewImg = logoPreview.querySelector('img');

        logoUpload.addEventListener('click', () => {
            logoInput.click();
        });

        logoInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) { // 2MB limit
                    alert('File size should not exceed 2MB');
                    return;
                }

                const reader = new FileReader();
                reader.onload = (e) => {
                    logoPreviewImg.src = e.target.result;
                    logoPreview.style.display = 'block';
                    logoUpload.querySelector('i').style.display = 'none';
                    logoUpload.querySelector('p').style.display = 'none';
                    logoUpload.querySelector('.file-types').style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });

        // Drag and drop functionality
        logoUpload.addEventListener('dragover', (e) => {
            e.preventDefault();
            logoUpload.style.borderColor = '#FFD700';
        });

        logoUpload.addEventListener('dragleave', () => {
            logoUpload.style.borderColor = '#ddd';
        });

        logoUpload.addEventListener('drop', (e) => {
            e.preventDefault();
            logoUpload.style.borderColor = '#ddd';
            
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                logoInput.files = e.dataTransfer.files;
                const event = new Event('change');
                logoInput.dispatchEvent(event);
            }
        });

        // Payment method selection
        document.querySelectorAll('.payment-method').forEach(method => {
            method.addEventListener('click', function() {
                document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        // Package selection
        document.querySelectorAll('.promo-card .btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const packageName = this.closest('.promo-card').querySelector('h3').textContent;
                alert(`You selected the ${packageName}. You will be redirected to the payment page.`);
            });
        });

const districtCities = {
    "Ampara": ["Ampara", "Kalmunai", "Dehiattakandiya", "Sammanthurai", "Addalaichenai", "Akkaraipattu"],
    "Anuradhapura": ["Anuradhapura", "Medawachchiya", "Tambuttegama", "Kahatagasdigiliya", "Galnewa", "Kebithigollewa"],
    "Badulla": ["Badulla", "Bandarawela", "Haputale", "Welimada", "Passara", "Hali-Ela"],
    "Batticaloa": ["Batticaloa", "Kattankudy", "Eravur", "Valaichenai", "Chenkalady", "Oddamavadi"],
    "Colombo": ["Colombo", "Dehiwala", "Moratuwa", "Mount Lavinia", "Homagama", "Kottawa", "Nugegoda", "Kolonnawa"],
    "Galle": ["Galle", "Ambalangoda", "Hikkaduwa", "Elpitiya", "Baddegama", "Karapitiya"],
    "Gampaha": ["Negombo", "Gampaha", "Ja-Ela", "Wattala", "Ragama", "Minuwangoda", "Kiribathgoda", "Divulapitiya"],
    "Hambantota": ["Hambantota", "Tangalle", "Tissamaharama", "Ambalantota", "Beliatta", "Weeraketiya"],
    "Jaffna": ["Jaffna", "Chavakachcheri", "Point Pedro", "Nallur", "Kilinochchi", "Kankesanthurai", "Tellippalai"],
    "Kalutara": ["Kalutara", "Panadura", "Horana", "Bandaragama", "Matugama", "Beruwala", "Wadduwa"],
    "Kandy": ["Kandy", "Peradeniya", "Katugastota", "Gampola", "Wattegama", "Pilimathalawa", "Digana", "Akurana"],
    "Kegalle": ["Kegalle", "Mawanella", "Warakapola", "Rambukkana", "Dehiowita", "Yatiyantota"],
    "Kilinochchi": ["Kilinochchi", "Pallai", "Iyakachchi", "Paranthan", "Uruthirapuram"],
    "Kurunegala": ["Kurunegala", "Kuliyapitiya", "Polgahawela", "Wariyapola", "Narammala", "Galgamuwa", "Nikaweratiya"],
    "Mannar": ["Mannar", "Madhu", "Murunkan", "Thalaimannar", "Pesalai"],
    "Matale": ["Matale", "Dambulla", "Galewela", "Ukuwela", "Naula", "Rattota"],
    "Matara": ["Matara", "Weligama", "Dikwella", "Akuressa", "Kamburupitiya", "Hakmana"],
    "Monaragala": ["Monaragala", "Bibile", "Wellawaya", "Siyambalanduwa", "Madulla", "Medagama"],
    "Mullaitivu": ["Mullaitivu", "Puthukkudiyiruppu", "Oddusuddan", "Thunukkai", "Mankulam"],
    "Nuwara Eliya": ["Nuwara Eliya", "Hatton", "Talawakele", "Ragala", "Lindula", "Nanu Oya"],
    "Polonnaruwa": ["Polonnaruwa", "Kaduruwela", "Hingurakgoda", "Medirigiriya", "Dimbulagala", "Manampitiya"],
    "Puttalam": ["Puttalam", "Chilaw", "Wennappuwa", "Nattandiya", "Anamaduwa", "Mundel", "Dankotuwa"],
    "Ratnapura": ["Ratnapura", "Embilipitiya", "Balangoda", "Kuruwita", "Pelmadulla", "Eheliyagoda"],
    "Trincomalee": ["Trincomalee", "Kantale", "Muttur", "Kinniya", "China Bay", "Nilaveli"],
    "Vavuniya": ["Vavuniya", "Omanthai", "Cheddikulam", "Nedunkeni", "Settikulam"]
};

document.getElementById('district').addEventListener('change', function() {
    const citySelect = document.getElementById('city');
    const cities = districtCities[this.value] || [];
    citySelect.innerHTML = '<option value="">Select City</option>';
    cities.forEach(city => {
        const option = document.createElement('option');
        option.value = city;
        option.textContent = city;
        citySelect.appendChild(option);
    });
});

// Clear logo preview if registration was successful
window.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('vendorSuccessAlert')) {
        // Hide logo preview and reset image
        logoPreviewImg.src = "";
        logoPreview.style.display = "none";
        // Show upload icon and text again
        logoUpload.querySelector('i').style.display = '';
        logoUpload.querySelector('p').style.display = '';
        logoUpload.querySelector('.file-types').style.display = '';
        // Also clear the file input
        logoInput.value = "";
    }
});

// Toggle between registration and login forms
document.getElementById('showLogin').onclick = function() {
    document.getElementById('loginForm').style.display = 'block';
    document.getElementById('registerForm').style.display = 'none';
    this.classList.add('active');
    document.getElementById('showRegister').classList.remove('active');
};
document.getElementById('showRegister').onclick = function() {
    document.getElementById('loginForm').style.display = 'none';
    document.getElementById('registerForm').style.display = 'block';
    this.classList.add('active');
    document.getElementById('showLogin').classList.remove('active');
};
// Also allow "Register now" link to toggle
document.getElementById('goToRegister').onclick = function(e) {
    e.preventDefault();
    document.getElementById('showRegister').click();
};

function showPopup(msg, isSuccess = false) {
    const popup = document.getElementById('popupMessage');
    popup.textContent = msg;
    popup.style.background = isSuccess ? '#4CAF50' : '#d32f2f';
    popup.style.display = 'block';
    setTimeout(() => { popup.style.display = 'none'; }, 3000);
}

// Show PHP messages as popup
<?php if (isset($success) && $success): ?>
    showPopup('Registration successful! Redirecting...', true);
<?php elseif (isset($error)): ?>
    showPopup("<?= addslashes($error) ?>");
<?php endif; ?>

// For login success, you can redirect after showing the popup if needed
    </script>

  



</body>
</html>