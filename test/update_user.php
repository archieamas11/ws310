<?php
include_once "config.php";
include_once "validation.php";


$database = new Database();
$db = $database->getConnection();

$response = ['success' => false, 'message' => ''];

try {
    $id = $_POST['userId'] ?? 0;
    $name = validateInput($_POST['name'] ?? '');
    $email = validateInput($_POST['email'] ?? '');
    $location = validateInput($_POST['location'] ?? '');

    validateCreateUserParams($name, $email, $location);

    $query = "UPDATE users SET name=?, email=?, location=? WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->execute([$name, $email, $location, $id]);

    $response['success'] = true;
    $response['message'] = "User updated successfully.";
} catch(PDOException $e) {
    // ... same error handling ...
}

echo json_encode($response);
?>