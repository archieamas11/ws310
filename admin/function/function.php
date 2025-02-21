<?php

require_once "../../include/initialize.php";

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
    case 'get':
        get();
        break;

    case 'update':
        update();
        break;

    case 'delete':
        delete();
        break;
}

function get()
{
    global $mysqli;

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405); // Method Not Allowed
        echo json_encode(['error' => 'Method not allowed']);
        return;
    }

    $user_id = $_POST['user_id'] ?? 0;

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM tbl_users WHERE user_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        http_response_code(404); // Not Found
        echo json_encode(['error' => 'User not found']);
    }

    $stmt->close();
}

function delete()
{
    global $mysqli;

    $user_id = $_GET['user_id'] ?? 0;

    $sql = "DELETE FROM tbl_users WHERE user_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->close();

    header("location: ../index.php");
    exit;
}

function update()
{
    global $mysqli;

    if (!isset($_POST['btn-submit'])) {
        return;
    }

    $user_id = $_GET['user_id'] ?? 0;

    $name = trim($_POST['name']);
    $dob = trim($_POST['dob']);
    $sex = trim($_POST['sex']);
    $status = trim($_POST['status']);
    $birth_place = trim($_POST['birth_place']);
    $nationality = trim($_POST['nationality']);
    $tax_number = trim($_POST['tax_number']);
    $phone = trim($_POST['phone']);
    $telephone = trim($_POST['telephone']);
    $email = trim($_POST['email']);
    $region_code = trim($_POST['region_code']);
    $province_code = trim($_POST['province_code']);
    $municipality_code = trim($_POST['municipality_code']);
    $barangay_code = trim($_POST['barangay_code']);
    $home_address = trim($_POST['home_address']);
    $zipcode = trim($_POST['zipcode']);
    $father_name = trim($_POST['father_name']);
    $mother_name = trim($_POST['mother_name']);

    $sql = "UPDATE tbl_users SET 
            user_full_name = ?, 
            date_of_birth = ?, 
            sex = ?, 
            civil_status = ?, 
            place_of_birth = ?, 
            nationality = ?, 
            tax_identification_number = ?, 
            phone_number = ?, 
            telephone_number = ?, 
            email_address = ?, 
            region_code = ?, 
            province_code = ?, 
            municipality_code = ?, 
            barangay_code = ?, 
            home_address = ?, 
            zip_code = ?, 
            fathers_full_name = ?, 
            mothers_full_name = ?
            WHERE user_id = ?";

    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ssssssssssssssssssi', 
            $name, $dob, $sex, $status, $birth_place, $nationality, 
            $tax_number, $phone, $telephone, $email, $region_code, 
            $province_code, $municipality_code, $barangay_code, 
            $home_address, $zipcode, $father_name, $mother_name, $user_id
        );

        if ($stmt->execute()) {
            header("location: ../index.php");
            exit();
        } else {
            echo "Error updating record: " . $mysqli->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $mysqli->error;
    }
}
