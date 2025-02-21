<?php
// Sample PHP code to return user data
require_once "../../include/initialize.php";
require_once "../../include/config.php";

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $user_id = intval($_POST['user_id']); // Sanitize input

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM tbl_users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Return JSON data
    header('Content-Type: application/json');
    echo json_encode($user);
}
?>
