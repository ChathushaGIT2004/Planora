<?php

session_start();
include 'db_connect.php';

// Check if user is logged in and is a vendor
if ($_SESSION['user_role'] !== 'vendor') {
    header('Location: vendor-login.php');
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
$conn->close();

if (!$vendor) {
    echo "<p>No vendor profile found.</p>";
    exit;
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendor Dashboard - <?php echo htmlspecialchars($vendor['vendor_name']); ?></title>
    <link rel="stylesheet" href="color-overrides.css">
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
        .dashboard-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            padding: 1.5rem 2rem;
            min-width: 180px;
            text-align: center;
        }
        .dashboard-card h2 {
            margin: 0.5rem 0 0.2rem 0;
            font-size: 2rem;
            color: #555879;
        }
        .dashboard-card p {
            margin: 0;
            color: #98A1BC;
        }
        .table-section {
            margin-bottom: 2rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 0.8rem 1rem;
            border-bottom: 1px solid #eee;
        }
        th {
            background: #ded3c4;
            color: #555879;
        }
        .calendar-section {
            margin-bottom: 2rem;
        }
        .sales-graph-section {
            background: #fff;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 2rem;
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
            <a href="#" class="active"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
            <a href="packages.php"><i class="fas fa-box"></i> <span>All Packages</span></a>
            <a href="add-package.php"><i class="fas fa-plus-circle"></i> <span>Add Package</span></a>
            <a href="vendor-settings.php"><i class="fas fa-cog"></i> <span>Settings</span></a>
        </nav>
        <form action="logout.php" method="POST" style="width:100%;">
            <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></button>
        </form>
    </div>
    <div class="main-content">
        <h1>Welcome, <?php echo htmlspecialchars($vendor['vendor_name']); ?>!</h1>
        <p>This is your dashboard. Here you can manage your packages, add new ones, update your settings, and more.</p>
        <!-- You can use PHP to include different content here based on navigation -->
    </div>
    <div class="main-content">
    <h1>Welcome, <?php echo htmlspecialchars($vendor['vendor_name']); ?>!</h1>
    <div class="dashboard-cards">
        <div class="dashboard-card">
            <h2 id="total-customers">0</h2>
            <p>Planora Customers</p>
        </div>
        <div class="dashboard-card">
            <h2 id="active-clients">0</h2>
            <p>Active Clients</p>
        </div>
        <div class="dashboard-card">
            <h2 id="total-payments">0</h2>
            <p>Payments Received</p>
        </div>
    </div>

    <div class="table-section">
        <h2>Ongoing Booked Packages</h2>
        <table>
            <thead>
                <tr>
                    <th>Package</th>
                    <th>Client</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fill with PHP rows -->
            </tbody>
        </table>
    </div>

    <div class="table-section">
        <h2>Scheduled Appointments</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Client</th>
                    <th>Package</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fill with PHP rows -->
            </tbody>
        </table>
    </div>

    <div class="calendar-section">
        <h2>Upcoming Appointments Calendar</h2>
        <!-- Placeholder for calendar widget -->
        <div style="height:300px;background:#fff;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#98A1BC;">
            [Calendar will go here]
        </div>
    </div>

    <div class="sales-graph-section">
        <h2>Sales Growth</h2>
        <canvas id="salesChart" width="600" height="250"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Placeholder for sales graph
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Sales',
                data: [0, 0, 0, 0, 0, 0],
                borderColor: '#555879',
                backgroundColor: 'rgba(85,88,121,0.1)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
<?php if (isset($_SESSION['popup_success'])): ?>
<script>
    showPopup("<?= addslashes($_SESSION['popup_success']) ?>", true);
</script>
<?php unset($_SESSION['popup_success']); endif; ?>
</body>
</html>