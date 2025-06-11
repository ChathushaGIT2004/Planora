<?php
header('Content-Type: application/json');
include "Connection.php";

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$conn) {
    echo json_encode(["status" => "error", "message" => "DB connection failed"]);
    exit();
}

$stmt = $conn->prepare("SELECT id, Password FROM users WHERE Email = ?");
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "Prepare failed: " . $conn->error]);
    exit();
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($password === $row['Password']) { // or use password_verify if hashed
        echo json_encode([
            "status" => "success",
            "user_id" => $row['id']
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid credentials"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid credentials"
    ]);
}

$stmt->close();
$conn->close();
exit();
?>
