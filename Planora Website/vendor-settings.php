<?php

session_start();
include 'db_connect.php';

// Check if user is logged in and is a vendor
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'vendor') {
    header('Location: vendor-registration.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch vendor details
$stmt = $conn->prepare("SELECT * FROM Vendor WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$vendor = $result->fetch_assoc();
$stmt->close();

$success = $error = "";

// Handle profile update
if (isset($_POST['update_profile'])) {
    $vendor_name = $_POST['vendor_name'];
    $description = $_POST['description'];
    $contact_name = $_POST['contact_name'];
    $contact_number = $_POST['contact_number'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $type = $_POST['type'];

    // Handle logo upload if provided
    $logo_url = $vendor['logo_url'];
    if (isset($_FILES['logo_img']) && $_FILES['logo_img']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = "uploads/vendor_logos/";
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
        $ext = pathinfo($_FILES['logo_img']['name'], PATHINFO_EXTENSION);
        $filename = "vendor_" . $vendor['vendor_id'] . "_" . time() . "." . $ext;
        $target_file = $upload_dir . $filename;
        if (move_uploaded_file($_FILES['logo_img']['tmp_name'], $target_file)) {
            $logo_url = $target_file;
        } else {
            $error = "Failed to upload logo.";
        }
    }

    // Update vendor info
    $stmt = $conn->prepare("UPDATE Vendor SET vendor_name=?, description=?, contact_name=?, contact_number=?, city=?, district=?, type=?, logo_url=? WHERE vendor_id=?");
    $stmt->bind_param("ssssssssi", $vendor_name, $description, $contact_name, $contact_number, $city, $district, $type, $logo_url, $vendor['vendor_id']);
    if ($stmt->execute()) {
        $success = "Profile updated successfully!";
        // Refresh vendor data
        $vendor = array_merge($vendor, [
            'vendor_name' => $vendor_name,
            'description' => $description,
            'contact_name' => $contact_name,
            'contact_number' => $contact_number,
            'city' => $city,
            'district' => $district,
            'type' => $type,
            'logo_url' => $logo_url
        ]);
    } else {
        $error = "Failed to update profile.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendor Settings</title>
    <link rel="stylesheet" href="color-overrides.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .sidebar {
            position: fixed;
            left: 0; top: 0; bottom: 0;
            width: 250px;
            background: #555879;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 2rem;
            min-height: 100vh;
        }
        .sidebar .logo-img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: contain;
            background: #fff;
            margin-bottom: 1rem;
            border: 3px solid #ded3c4;
        }
        .sidebar .vendor-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 2rem;
            text-align: center;
        }
        .sidebar nav {
            width: 100%;
        }
        .sidebar nav a {
            display: flex;
            align-items: center;
            padding: 1rem 2rem;
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
            transition: background 0.2s;
        }
        .sidebar nav a i {
            margin-right: 1rem;
        }
        .sidebar nav a.active,
        .sidebar nav a:hover {
            background: #ded3c4;
            color: #555879;
        }
        .sidebar .logout-btn {
            margin-top: 2rem;
            margin-bottom: 2rem;
            padding: 0.7rem 2rem;
            background: #ff4d4d;
            color: #fff;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .sidebar .logout-btn:hover {
            background: #d32f2f;
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }
        @media (max-width: 900px) {
            .sidebar { width: 70px; }
            .sidebar .vendor-name, .sidebar nav a span { display: none; }
            .main-content { margin-left: 70px; }
        }
        body { background: #f4f4f4; font-family: 'Poppins', sans-serif; margin: 0; }
        .settings-container {
            max-width: 600px;
            margin: 3rem auto;
            background: #fff;
            padding: 2rem 2.5rem;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(85,88,121,0.07);
        }
        h2 { text-align: center; color: #555879; margin-bottom: 1.5rem; }
        .form-group { margin-bottom: 1.2rem; }
        label { font-weight: 600; }
        input[type="text"], input[type="number"], textarea, select {
            width: 100%; padding: 0.7rem; border-radius: 8px; border: 1px solid #ded3c4; margin-top: 0.3rem;
        }
        .logo-preview {
            display: block; margin: 0 auto 1rem auto; width: 100px; height: 100px; object-fit: contain; border-radius: 50%; border: 3px solid #ded3c4; background: #fff;
        }
        .submit-btn {
            background: #555879; color: #fff; padding: 0.8rem 2.5rem; border: none; border-radius: 25px;
            font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: background 0.2s;
            display: block; margin: 1.5rem auto 0 auto;
        }
        .submit-btn:hover { background: #ded3c4; color: #555879; }
        .msg-success { color: #2e7d32; text-align: center; margin-bottom: 1rem; }
        .msg-error { color: #d32f2f; text-align: center; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="sidebar">
        <?php if ($vendor['logo_url']): ?>
            <img src="<?php echo htmlspecialchars($vendor['logo_url']); ?>" alt="Logo" class="logo-img">
        <?php else: ?>
            <div class="logo-img" style="display:flex;align-items:center;justify-content:center;background:#eee;color:#555879;">No Logo</div>
        <?php endif; ?>
        <div class="vendor-name"><?php echo htmlspecialchars($vendor['vendor_name']); ?></div>
        <div class="vendor-type" style="font-size:1rem;font-weight:400;margin-bottom:1.5rem;text-align:center;color:#ded3c4;">
            <?php echo htmlspecialchars($vendor['type']); ?>
        </div>
        <nav>
            <a href="vendor-portfolio.php" ><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
            <a href="packages.php"><i class="fas fa-box"></i> <span>All Packages</span></a>
            <a href="add-package.php"><i class="fas fa-plus-circle"></i> <span>Add Package</span></a>
            <a href="vendor-settings.php" class="active"><i class="fas fa-cog"></i> <span>Settings</span></a>
        </nav>
        <form action="logout.php" method="POST" style="width:100%;">
            <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></button>
        </form>
    </div>
    <div class="settings-container">
        <h2>Vendor Profile Settings</h2>
        <?php if ($success): ?><div class="msg-success"><?php echo $success; ?></div><?php endif; ?>
        <?php if ($error): ?><div class="msg-error"><?php echo $error; ?></div><?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group" style="text-align:center;">
                <?php if ($vendor['logo_url']): ?>
                    <img src="<?php echo htmlspecialchars($vendor['logo_url']); ?>" alt="Logo" class="logo-preview">
                <?php else: ?>
                    <div class="logo-preview" style="display:flex;align-items:center;justify-content:center;color:#ded3c4;">No Logo</div>
                <?php endif; ?>
                <input type="file" name="logo_img" accept="image/*" style="margin-top:0.5rem;">
            </div>
            <div class="form-group">
                <label for="vendor_name">Business Name</label>
                <input type="text" id="vendor_name" name="vendor_name" value="<?php echo htmlspecialchars($vendor['vendor_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="type">Business Type</label>
                <input type="text" id="type" name="type" value="<?php echo htmlspecialchars($vendor['type']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3" required><?php echo htmlspecialchars($vendor['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="contact_name">Contact Name</label>
                <input type="text" id="contact_name" name="contact_name" value="<?php echo htmlspecialchars($vendor['contact_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="text" id="contact_number" name="contact_number" value="<?php echo htmlspecialchars($vendor['contact_number']); ?>" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($vendor['city']); ?>" required>
            </div>
            <div class="form-group">
                <label for="district">District</label>
                <input type="text" id="district" name="district" value="<?php echo htmlspecialchars($vendor['district']); ?>" required>
            </div>
            <button type="submit" name="update_profile" class="submit-btn">Update Profile</button>
        </form>
        
    </div>
</body>
</html>