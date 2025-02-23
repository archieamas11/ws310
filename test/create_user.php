<?php
include_once "config.php";
include_once "validation.php";

$database = new Database();
$db = $database->getConnection();

$response = ['success' => false, 'message' => ''];

try {
    $name = validateInput($_POST['name'] ?? '');
    $email = validateInput($_POST['email'] ?? '');
    $location = validateInput($_POST['location'] ?? '');


    validateCreateUserParams($name, $email, $location);

    $query = "INSERT INTO test (name, email, location) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$name, $email, $location]);

    $response['success'] = true;
    $response['message'] = "User created successfully.";
} catch(PDOException $e) {
    $response['message'] = $e->getCode() == 23000 ? "Email already exists!" : "Database error.";
} catch(Exception $e) {
    $response['message'] = $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>