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

// Fetch all packages for this vendor
$stmt = $conn->prepare("SELECT * FROM Service_Package WHERE vendor_id = ? ORDER BY package_id DESC");
$stmt->bind_param("i", $vendor['vendor_id']);
$stmt->execute();
$packages = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendor Packages</title>
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
            max-width: 1200px;
        }
        .packages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }
        .package-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(85,88,121,0.07);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.2s;
            position: relative;
        }
        .package-card:hover {
            box-shadow: 0 4px 24px rgba(85,88,121,0.13);
            transform: translateY(-2px) scale(1.01);
        }
        .package-img {
            width: 100%;
            height: 600px;
            background: #ded3c4;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .package-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.2s;
        }
        .no-img {
            color: #555879;
            font-size: 1.1rem;
        }
        .package-info {
            padding: 1.2rem 1.5rem 1.5rem 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .package-info h3 {
            margin: 0 0 0.5rem 0;
            color: #555879;
            font-size: 1.18rem;
            font-weight: 700;
        }
        .package-info .price {
            color: #555879;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 1.2rem;
        }
        .card-actions {
            margin-top: auto;
            width: 100%;
            display: flex;
            gap: 0.7rem;
        }
        .read-more-btn, .edit-btn {
            background: #555879;
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 0.5rem 1.4rem;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: background 0.2s;
        }
        .read-more-btn:hover, .edit-btn:hover {
            background: #ded3c4;
            color: #555879;
        }
        @media (max-width: 900px) {
            .sidebar { width: 70px; }
            .sidebar .vendor-name, .sidebar nav a span { display: none; }
            .main-content { margin-left: 70px; }
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
            <a href="packages.php" class="active"><i class="fas fa-box"></i> <span>All Packages</span></a>
            <a href="add-package.php"><i class="fas fa-plus-circle"></i> <span>Add Package</span></a>
            <a href="vendor-settings.php"><i class="fas fa-cog"></i> <span>Settings</span></a>
        </nav>
        <form action="logout.php" method="POST" style="width:100%;">
            <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></button>
        </form>
    </div>
    <div class="main-content">
        <h2 style="margin-top:2.5rem;">All Your Packages</h2>
        <div class="packages-grid">
        <?php while ($package = $packages->fetch_assoc()):
            // Fetch the first image for this package
            $stmt_img = $conn->prepare("SELECT media_url FROM Package_Media WHERE package_id = ? LIMIT 1");
            $stmt_img->bind_param("i", $package['package_id']);
            $stmt_img->execute();
            $stmt_img->bind_result($media_url);
            $stmt_img->fetch();
            $stmt_img->close();
        ?>
            <div class="package-card">
                <div class="package-img">
                    <?php if (!empty($media_url)): ?>
                        <img src="<?php echo htmlspecialchars($media_url); ?>" alt="Package Image">
                    <?php else: ?>
                        <div class="no-img">No Image</div>
                    <?php endif; ?>
                </div>
                <div class="package-info">
                    <h3><?php echo htmlspecialchars($package['package_name']); ?></h3>
                    <?php if (!empty($package['price_min']) && !empty($package['price_max']) && $package['price_min'] != $package['price_max']): ?>
                        <div class="package-price">
                            LKR <?php echo number_format($package['price_min'] ?? 0, 2); ?> - <?php echo number_format($package['price_max'] ?? 0, 2); ?>
                        </div>
                    <?php else: ?>
                        <div class="package-price">
                            LKR <?php echo number_format($package['price_min'] ?? 0, 2); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card-actions">
                        <a href="package-details.php?id=<?php echo $package['package_id']; ?>" class="read-more-btn">Read More</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
