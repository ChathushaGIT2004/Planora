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

// Get package ID
if (!isset($_GET['id'])) {
    echo "No package selected.";
    exit;
}
$package_id = intval($_GET['id']);
// Fetch package details
$stmt = $conn->prepare("SELECT * FROM Service_Package WHERE package_id = ? AND vendor_id = ?");
$stmt->bind_param("ii", $package_id, $vendor['vendor_id']);
$stmt->execute();
$package = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$package) {
    echo "Package not found.";
    exit;
}

// Fetch all images
$stmt = $conn->prepare("SELECT media_url FROM Package_Media WHERE package_id = ?");
$stmt->bind_param("i", $package_id);
$stmt->execute();
$result_img = $stmt->get_result();
$images = [];
while ($row = $result_img->fetch_assoc()) {
    $images[] = $row['media_url'];
}
$stmt->close();

// Handle image delete
if (isset($_POST['delete_image']) && isset($_POST['image_url'])) {
    $img_url = $_POST['image_url'];
    $stmt = $conn->prepare("DELETE FROM Package_Media WHERE package_id = ? AND media_url = ?");
    $stmt->bind_param("is", $package_id, $img_url);
    $stmt->execute();
    $stmt->close();
    if (file_exists($img_url)) unlink($img_url);
    header("Location: package-details.php?id=$package_id");
    exit;
}

// Handle edit
if (isset($_POST['save_edit'])) {
    $new_name = $_POST['package_name'];
    $desc = $_POST['description'];
    $price_min = isset($_POST['price_min']) && $_POST['price_min'] !== '' ? floatval($_POST['price_min']) : null;
    $price_max = isset($_POST['price_max']) && $_POST['price_max'] !== '' ? floatval($_POST['price_max']) : null;

    $stmt = $conn->prepare("UPDATE Service_Package SET package_name=?, description=?, price_min=?, price_max=? WHERE package_id=? AND vendor_id=?");
    $stmt->bind_param("sssiii", $new_name, $desc, $price_min, $price_max, $package_id, $vendor['vendor_id']);
    $stmt->execute();
    $stmt->close();

    // Handle new image uploads
    if (!empty($_FILES['images']['name'][0])) {
        $upload_dir = "uploads/packages/";
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

        $stmt_img = $conn->prepare("INSERT INTO Package_Media (package_id, media_url) VALUES (?, ?)");
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $file_name = basename($_FILES['images']['name'][$key]);
            $target_file = $upload_dir . uniqid() . "_" . $file_name;
            if (move_uploaded_file($tmp_name, $target_file)) {
                $stmt_img->bind_param("is", $package_id, $target_file);
                $stmt_img->execute();
            }
        }
        $stmt_img->close();
    }

    header("Location: package-details.php?id=$package_id");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #181818;
        }
        .container {
            max-width: 1000px;
            margin: 3rem auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 32px rgba(0,0,0,0.10);
            overflow: hidden;
        }
        .carousel-section {
            position: relative;
            width: 100%;
            height: 520px;
            background: #ded3c4;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .carousel-img-wrapper {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0; top: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .carousel-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: #ded3c4;
        }
        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(24,24,24,0.7);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 44px;
            height: 44px;
            font-size: 1.5rem;
            cursor: pointer;
            z-index: 2;
            transition: background 0.2s;
        }
        .carousel-btn.prev { left: 18px; }
        .carousel-btn.next { right: 18px; }
        .carousel-btn:hover { background: #ded3c4; color: #555879; }
        .no-img {
            color: #555879;
            font-size: 1.2rem;
            background: #ded3c4;
            width: 100%;
            height: 100%;
            display: flex; align-items: center; justify-content: center;
        }
        .details-section {
            padding: 2.5rem 2.5rem 2rem 2.5rem;
            background: #fff;
        }
        .package-title {
            margin: 0 0 0.5rem 0;
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: #222;
        }
        .package-price {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #ded3c4;
        }
        .desc-text {
            color: #555879;
            font-size: 1.13rem;
            margin-bottom: 1rem;
            line-height: 1.7;
            white-space: pre-line;
        }
        .back-btn {
            background: #ded3c4;
            color: #555879;
            border: none;
            border-radius: 12px;
            padding: 0.6rem 2.2rem;
            cursor: pointer;
            font-size: 1.08rem;
            font-weight: 500;
            transition: background 0.2s;
            margin-bottom: 1.5rem;
            display: inline-block;
            text-decoration: none;
        }
        .back-btn i { margin-right: 0.5rem; }
        .back-btn:hover { background: #555879; color: #fff; }
        .edit-btn, .save-btn, .cancel-edit-btn {
            background: #555879;
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 0.6rem 2.2rem;
            cursor: pointer;
            font-size: 1.08rem;
            font-weight: 500;
            transition: background 0.2s;
            margin-top: 1rem;
            margin-right: 0.7rem;
            box-shadow: 0 2px 8px rgba(85,88,121,0.07);
        }
        .edit-btn i { margin-right: 0.5rem; }
        .edit-btn:hover, .save-btn:hover { background: #ded3c4; color: #555879; }
        .cancel-edit-btn { background: #aaa; }
        .cancel-edit-btn:hover { background: #ded3c4; color: #555879; }

        .edit-form {
            background: #f8f8f8;
            border-radius: 14px;
            padding: 2rem 1.5rem 1.5rem 1.5rem;
            box-shadow: 0 2px 12px rgba(85,88,121,0.07);
            margin-top: 2rem;
            margin-bottom: 1.5rem;
            max-width: 1000px;
        }

        .edit-form label {
            font-weight: 600;
            margin-bottom: 0.3rem;
            display: block;
            color: #555879;
        }

        .edit-form input[type="text"],
        .edit-form input[type="number"],
        .edit-form textarea {
            width: 850px;
            padding: 0.8rem;
            border-radius: 8px;
            border: 1px solid #ded3c4;
            margin-bottom: 1.1rem;
            font-size: 1.05rem;
            background: #fff;
            color: #222;
            transition: border 0.2s;
        }

        .edit-form input[type="text"]:focus,
        .edit-form input[type="number"]:focus,
        .edit-form textarea:focus {
            border: 1.5px solid #555879;
            outline: none;
        }

        .edit-form input[type="file"] {
            margin-bottom: 1.2rem;
        }

        .edit-actions {
            margin-top: 1.2rem;
            display: flex;
            gap: 1rem;
        }

        .delete-img-btn {
            background: #ff4d4d;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            font-size: 1rem;
            cursor: pointer;
            position: absolute;
            top: 2px;
            right: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .delete-img-btn:hover {
            background: #d32f2f;
        }
        @media (max-width: 900px) {
            .container { max-width: 100vw; border-radius: 0; margin: 0; }
            .carousel-section { height: 260px; }
            .details-section { padding: 1.2rem 1rem 1rem 1rem; }
            .package-title { font-size: 1.2rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="carousel-section">
            <?php foreach ($images as $idx => $img): ?>
                <div class="carousel-img-wrapper" style="<?php echo $idx === 0 ? '' : 'display:none;'; ?>">
                    <img src="<?php echo htmlspecialchars($img); ?>" alt="Package Image" class="carousel-img">
                </div>
            <?php endforeach; ?>
            <?php if (count($images) > 1): ?>
                <button class="carousel-btn prev"><i class="fas fa-chevron-left"></i></button>
                <button class="carousel-btn next"><i class="fas fa-chevron-right"></i></button>
            <?php endif; ?>
            <?php if (empty($images)): ?>
                <div class="no-img">No Image</div>
            <?php endif; ?>
        </div>
        <div class="details-section">
            <div id="view-mode">
                <h1 class="package-title"><?php echo htmlspecialchars($package['package_name'] ?? ''); ?></h1>
                <?php if (!empty($package['price_min']) && !empty($package['price_max']) && $package['price_min'] != $package['price_max']): ?>
                    <div class="package-price">
                        LKR <?php echo number_format($package['price_min'] ?? 0, 2); ?> - <?php echo number_format($package['price_max'] ?? 0, 2); ?>
                    </div>
                <?php else: ?>
                    <div class="package-price">
                        LKR <?php echo number_format($package['price_min'] ?? 0, 2); ?>
                    </div>
                <?php endif; ?>
                <div class="desc-text"><?php echo nl2br(htmlspecialchars($package['description'])); ?></div>
                <button class="edit-btn" id="editBtn"><i class="fas fa-pen"></i> Edit Package</button>
                <a href="packages.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to All Packages</a>
            </div>
            <form id="edit-form" class="edit-form" method="POST" enctype="multipart/form-data" style="display:none; margin-top:2rem;">
                <label>Package Name</label>
                <input type="text" name="package_name" value="<?php echo htmlspecialchars($package['package_name'] ?? ''); ?>" required>
                <label>Price (LKR)</label>
                <div style="display:flex;gap:1rem;">
                    <input type="number" name="price_min" min="0" placeholder="Min" value="<?php echo htmlspecialchars($package['price_min'] ?? ''); ?>">
                    <input type="number" name="price_max" min="0" placeholder="Max" value="<?php echo htmlspecialchars($package['price_max'] ?? ''); ?>">
                </div>
                <small style="color:#888;">Leave Max empty for a single price.</small>
                <label>Description</label>
                <textarea name="description" rows="4" required><?php echo htmlspecialchars($package['description'] ?? ''); ?></textarea>
                <label>Add Images</label>
                <input type="file" name="images[]" multiple accept="image/*">
                <div style="margin:1rem 0;">
                    <strong>Current Images:</strong><br>
                    <div style="display:flex;gap:1rem;flex-wrap:wrap;">
                        <?php foreach ($images as $img): ?>
                            <div style="position:relative;">
                                <img src="<?php echo htmlspecialchars($img); ?>" alt="img" style="width:90px;height:90px;object-fit:cover;border-radius:8px;">
                                <form method="POST" style="position:absolute;top:2px;right:2px;">
                                    <input type="hidden" name="image_url" value="<?php echo htmlspecialchars($img); ?>">
                                    <button type="submit" name="delete_image" class="delete-img-btn" title="Remove Image" style="background:#ff4d4d;color:#fff;border:none;border-radius:50%;width:22px;height:22px;cursor:pointer;">&times;</button>
                                    
                                </form>
                                
                            </div>
                            
                        <?php endforeach; ?>
                    </div>
                    <div class="edit-actions">
                                    <button type="submit" name="save_edit" class="save-btn">Save</button>
                                    <button type="button" class="cancel-edit-btn" id="cancelEditBtn">Cancel</button>
                                </div>
                </div>
                
            </form>
        </div>
    </div>
    <script>
    // Carousel logic
    (function() {
        const carousel = document.querySelector('.carousel-section');
        if (!carousel) return;
        const imgs = carousel.querySelectorAll('.carousel-img-wrapper');
        let idx = 0;
        carousel.querySelectorAll('.carousel-btn').forEach(btn => {
            btn.onclick = function() {
                imgs[idx].style.display = 'none';
                if (btn.classList.contains('prev')) idx = (idx - 1 + imgs.length) % imgs.length;
                else idx = (idx + 1) % imgs.length;
                imgs[idx].style.display = '';
            };
        });
    })();
    document.getElementById('editBtn').onclick = function() {
        document.getElementById('view-mode').style.display = 'none';
        document.getElementById('edit-form').style.display = '';
    };
    document.getElementById('cancelEditBtn').onclick = function() {
        document.getElementById('edit-form').style.display = 'none';
        document.getElementById('view-mode').style.display = '';
    };
    </script>
</body>
</html>