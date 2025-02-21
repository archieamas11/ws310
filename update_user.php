<?php
require_once "config/database.php";


if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve all form fields
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $sex = $_POST['sex'];
    $status = $_POST['status'];
    $birth_place = $_POST['birth_place'];
    $nationality = $_POST['nationality'];
    $tax_number = $_POST['tax_number'];
    $phone = $_POST['phone'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $region_code = $_POST['region_code'];
    $province_code = $_POST['province_code'];
    $municipality_code = $_POST['municipality_code'];
    $barangay_code = $_POST['barangay_code'];
    $home_address = $_POST['home_address'];
    $zipcode = $_POST['zipcode'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];

    // Handle 'Others' civil status
    if ($status === 'others' && !empty($_POST['otherStatus'])) {
        $status = $_POST['otherStatus'];
    }

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

        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssssssssssssssssi', 
        $name, $dob, $sex, $status, $birth_place, $nationality, 
        $tax_number, $phone, $telephone, $email, $region_code, 
        $province_code, $municipality_code, $barangay_code, 
        $home_address, $zipcode, $father_name, $mother_name, $user_id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php?update=success");
            exit(); // Ensure no further code is executed after the redirect
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
    } else {
    // If the script is accessed directly, show an error or redirect
    echo "Invalid request method.";
    // Alternatively, redirect to the form page
    // header("Location: index.php");
    // exit();
    }
?>