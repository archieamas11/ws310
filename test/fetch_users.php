<?php
include_once "config.php";

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM test";
$stmt = $db->prepare($query);
$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($users);
?>