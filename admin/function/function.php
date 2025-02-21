<?php
require_once "../../include/initialize.php";

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
switch ($action) {
    case 'update':
        update();
        break;
}

function update()
{
    global $mysqli;

    // Early return if not a POST request
    if (!isset($_POST['btn-submit'])) {
        return;
    }

    $user_id = $_GET['user_id'] ?? 0;

    // Fetching POST values (ensure form names are accurate)
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

    // Prepare SQL statement with placeholders
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

    $stmt = mysqli_prepare($mysqli, $sql); // Use $mysqli instead of $conn
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssssssssssssssssi', 
            $name, $dob, $sex, $status, $birth_place, $nationality, 
            $tax_number, $phone, $telephone, $email, $region_code, 
            $province_code, $municipality_code, $barangay_code, 
            $home_address, $zipcode, $father_name, $mother_name, $user_id
        );

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // header("location: ../index.php?page=dashboard");
            header("location: ../index.php");
            echo 'sus';

            exit(); // Ensure no further code is executed after the redirect
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($mysqli);
    }
}
