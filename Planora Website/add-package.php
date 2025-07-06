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

if (!$vendor) {
    echo "<p>No vendor profile found.</p>";
    exit;
}

// Handle Add Package form submission
if (isset($_POST['add_package'])) {
    $package_name = $_POST['package_name'];
    $description = $_POST['description'];
    $package_price = isset($_POST['package_price']) && $_POST['package_price'] !== '' ? floatval($_POST['package_price']) : null;
    $vendor_id = $vendor['vendor_id'];

    // Insert into Service_Package
    $stmt = $conn->prepare("INSERT INTO Service_Package (package_name, description, package_price, vendor_id, status) VALUES (?, ?, ?, ?, 'active')");
    $stmt->bind_param("ssdi", $package_name, $description, $package_price, $vendor_id);
    $stmt->execute();
    $package_id = $stmt->insert_id;
    $stmt->close();

    // Handle image uploads
    if (!empty($_FILES['images']['name'][0])) {
        $upload_dir = "uploads/packages/";
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

        // Prepare the statement ONCE before the loop
        $stmt = $conn->prepare("INSERT INTO Package_Media (package_id, media_url) VALUES (?, ?)");

        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $file_name = basename($_FILES['images']['name'][$key]);
            $target_file = $upload_dir . uniqid() . "_" . $file_name;
            if (move_uploaded_file($tmp_name, $target_file)) {
                // Save image path to Package_Media
                $stmt->bind_param("is", $package_id, $target_file);
                $stmt->execute();
            }
        }
        $stmt->close(); // Close after the loop
    }
    echo "<script>alert('Package added successfully!');window.location='add-package.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Package - <?php echo htmlspecialchars($vendor['vendor_name']); ?></title>
    <link rel="stylesheet" href="color-overrides.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f4f4f4;
        }
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
        .dashboard-cards {
    display: flex;
    gap: 2rem;
    margin-bottom: 2rem;
}
        .main-content {
            max-width: 600px;
            margin: 3rem auto;
            background: #fff;
            padding: 2rem 2.5rem;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(85,88,121,0.07);
        }
        h2 {
            text-align: center;
            color: #555879;
            margin-bottom: 1.5rem;
        }
        .form-input:focus {
            outline: 2px solid #555879;
            border-color: #555879;
        }
        .submit-btn {
            background: #555879;
            color: #fff;
            padding: 0.8rem 2.5rem;
            border: none;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .submit-btn:hover {
            background: #ded3c4;
            color: #555879;
        }
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
            <a href="vendor-portfolio.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
            <a href="packages.php"><i class="fas fa-box"></i> <span>All Packages</span></a>
            <a href="add-package.php" class="active"><i class="fas fa-plus-circle"></i> <span>Add Package</span></a>
            <a href="vendor-settings.php"><i class="fas fa-cog"></i> <span>Settings</span></a>
        </nav>
        <form action="logout.php" method="POST" style="width:100%;">
            <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></button>
        </form>
    </div>
    <div class="main-content">
        <h2>Add New Package</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div style="margin-bottom:1.2rem;">
                <label for="package_name" style="font-weight:600;">Package Name</label>
                <input type="text" id="package_name" name="package_name" class="form-input" required style="width:100%;padding:0.7rem;border-radius:8px;border:1px solid #ded3c4;margin-top:0.3rem;">
            </div>
            <div style="margin-bottom:1.2rem;">
                <label for="description" style="font-weight:600;">Description</label>
                <textarea id="description" name="description" class="form-input" rows="3" required style="width:100%;padding:0.7rem;border-radius:8px;border:1px solid #ded3c4;margin-top:0.3rem;"></textarea>
            </div>
            <div style="margin-bottom:1.2rem;">
                <label for="package_price" style="font-weight:600;">Minimum Price (LKR)</label>
                <input type="number" id="package_price" name="package_price" class="form-input" min="0" placeholder="Enter the minimum price" style="width:100%;padding:0.7rem;border-radius:8px;border:1px solid #ded3c4;margin-top:0.3rem;">
            </div>
            <div style="margin-bottom:1.2rem;">
                <label for="images" style="font-weight:600;">Package Images</label>
                <input type="file" id="images" name="images[]" class="form-input" multiple accept="image/*" style="width:100%;margin-top:0.3rem;">
                <small style="color:#98A1BC;">You can upload multiple images (jpg, png, gif).</small>
            </div>
            <div style="text-align:center;">
                <button type="submit" name="add_package" class="submit-btn">Add Package</button>
            </div>
        </form>
        
    </div>
</body>
</html>