<?php
header('Content-Type: application/json');
include_once "Connection.php";

// Get POST parameters
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
$role = isset($_POST['role']) ? $_POST['role'] : '';

// Validate input
if (empty($user_id) || empty($role)) {
    echo json_encode(["success" => false, "message" => "Missing user_id or role"]);
    exit();
}

// Prepare and execute the SQL update
$sql = "UPDATE users SET role = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $role, $user_id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true, "message" => "User role updated successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "No user found or role already set"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Failed to update role"]);
}

$stmt->close();
$conn->close();
