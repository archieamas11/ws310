<?php

require_once "../../include/initialize.php";
require_once "validations.php";

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

    // case 'add':
    //     add();
    //     break;
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

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }

    $user_id = isset($_GET['user_id']) ? (int) $_GET['user_id'] : 0;
    if ($user_id <= 0) {
        echo "Invalid user ID.";
        return;
    }

    $name = htmlspecialchars(trim($_POST['name']));
    $dob = htmlspecialchars(trim($_POST['dob']));
    $sex = htmlspecialchars(trim($_POST['sex']));
    $status = htmlspecialchars(trim($_POST['status']));
    $birth_place = htmlspecialchars(trim($_POST['birth_place']));
    $nationality = htmlspecialchars(trim($_POST['nationality']));
    $religion = htmlspecialchars(trim($_POST['religion']));
    $tax_number = htmlspecialchars(trim($_POST['tax_number']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $email = htmlspecialchars(trim($_POST['email']));
    $region_code = htmlspecialchars(trim($_POST['region_code']));
    $region_name = htmlspecialchars(trim($_POST['region_name']));
    $province_code = htmlspecialchars(trim($_POST['province_code']));
    $province_name = htmlspecialchars(trim($_POST['province_name']));
    $municipality_code = htmlspecialchars(trim($_POST['municipality_code']));
    $municipality_name = htmlspecialchars(trim($_POST['municipality_name']));
    $barangay_code = htmlspecialchars(trim($_POST['barangay_code']));
    $barangay_name = htmlspecialchars(trim($_POST['barangay_name']));
    $home_address = htmlspecialchars(trim($_POST['home_address']));
    $zipcode = htmlspecialchars(trim($_POST['zipcode']));
    $father_name = htmlspecialchars(trim($_POST['father_name']));
    $mother_name = htmlspecialchars(trim($_POST['mother_name']));

    $sql = "UPDATE tbl_users SET 
            user_full_name = ?, 
            date_of_birth = ?, 
            sex = ?, 
            civil_status = ?, 
            place_of_birth = ?, 
            nationality = ?, 
            religion = ?, 
            tax_identification_number = ?, 
            phone_number = ?, 
            telephone_number = ?, 
            email_address = ?, 
            region_code = ?, 
            region = ?,
            province_code = ?, 
            province = ?,
            municipality_code = ?, 
            municipality = ?,
            barangay_code = ?, 
            barangay = ?,
            home_address = ?, 
            zip_code = ?, 
            fathers_full_name = ?, 
            mothers_full_name = ? 
            WHERE user_id = ?";

    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param(
            'sssssssssssssssssssssssi',
            $name,
            $dob,
            $sex,
            $status,
            $birth_place,
            $nationality,
            $religion,
            $tax_number,
            $phone,
            $telephone,
            $email,
            $region_code,
            $region_name,
            $province_code,
            $province_name,
            $municipality_code,
            $municipality_name,
            $barangay_code,
            $barangay_name,
            $home_address,
            $zipcode,
            $father_name,
            $mother_name,
            $user_id
        );

        if ($stmt->execute()) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $mysqli->error;
    }
}
