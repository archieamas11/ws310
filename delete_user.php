<?php
require_once 'config/database.php';

// Handle both GET and POST requests
$user_id = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : null;
}

if ($user_id) {
    // Use prepared statements to prevent SQL injection
    $sql = "DELETE FROM tbl_users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);

    if (mysqli_affected_rows($conn) > 0) {
        header('Location: index.php');
        exit;
    } else {
        http_response_code(404); // Not Found
        echo json_encode(['error' => 'User not found']);
    }
    mysqli_stmt_close($stmt);
} else {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid request']);
}

mysqli_close($conn);