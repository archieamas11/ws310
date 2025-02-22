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

    case 'add':
        add();
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

function add() {
    global $mysqli;
    
    if (!isset($_POST['btn-submit'])) {
        return;
    }

    $errors = array();
    $data = array();

    $required_fields = array('first_name', 'last_name', 'dob', 'sex', 'civil_status', 'region_code', 'province_code', 'municipality_code', 'barangay_code', 'home_address', 'zip_code', 'father_name', 'mother_name');

    // Personal Data Validation
    $data['first_name'] = trim($_POST['first_name'] ?? '');
    if (empty($data['first_name'])) {
        $errors['first_name'] = "First name is required";
    }

    $data['middle_name'] = trim($_POST['middle_name'] ?? '');
    $data['last_name'] = trim($_POST['last_name'] ?? '');
    if (empty($data['last_name'])) {
        $errors['last_name'] = "Last name is required";
    }

    $data['dob'] = trim($_POST['dob'] ?? '');
    if (empty($data['dob'])) {
        $errors['dob'] = "Date of birth is required";
    }

    $data['sex'] = trim($_POST['sex'] ?? '');
    if (empty($data['sex'])) {
        $errors['sex'] = "Sex is required";
    }

    $data['civil_status'] = trim($_POST['civil_status'] ?? '');
    if (empty($data['civil_status'])) {
        $errors['civil_status'] = "Civil status is required";
    }

    $data['tin'] = trim($_POST['tin'] ?? '');
    $data['nationality'] = trim($_POST['nationality'] ?? '');
    if (empty($data['nationality'])) {
        $errors['nationality'] = "Nationality is required";
    }

    $data['religion'] = trim($_POST['religion'] ?? '');
    $data['place_of_birth'] = trim($_POST['place_of_birth'] ?? '');

    // Address Validation
    $data['region_code'] = trim($_POST['region_code'] ?? '');
    if (empty($data['region_code'])) {
        $errors['region_code'] = "Region is required";
    }

    $data['province_code'] = trim($_POST['province_code'] ?? '');
    if (empty($data['province_code'])) {
        $errors['province_code'] = "Province is required";
    }

    $data['city_code'] = trim($_POST['city_code'] ?? '');
    if (empty($data['city_code'])) {
        $errors['city_code'] = "City is required";
    }

    $data['barangay_code'] = trim($_POST['barangay_code'] ?? '');
    if (empty($data['barangay_code'])) {
        $errors['barangay_code'] = "Barangay is required";
    }

    $data['zipcode'] = trim($_POST['zipcode'] ?? '');
    if (empty($data['zipcode'])) {
        $errors['zipcode'] = "Zipcode is required";
    } elseif (!preg_match('/^\d{4}$/', $data['zipcode'])) {
        $errors['zipcode'] = "Zipcode must be exactly 4 digits";
    }

    $data['home_address'] = trim($_POST['home_address'] ?? '');
    if (empty($data['home_address'])) {
        $errors['home_address'] = "Home address is required";
    }

    // Contact Information Validation
    $data['email_address'] = trim($_POST['email_address'] ?? '');
    if (!empty($data['email_address']) && !filter_var($data['email_address'], FILTER_VALIDATE_EMAIL)) {
        $errors['email_address'] = "Invalid email format";
    }

    $data['contact_number'] = trim($_POST['contact_number'] ?? '');
    if (empty($data['contact_number'])) {
        $errors['contact_number'] = "Contact number is required";
    } elseif (!preg_match('/^09\d{9}$/', $data['contact_number'])) {
        $errors['contact_number'] = "Contact number must start with '09' and be 11 digits long";
    }

    $data['telephone_number'] = trim($_POST['telephone_number'] ?? '');

    // Parents Information
    $data['father_first_name'] = trim($_POST['father_first_name'] ?? '');
    $data['father_middle_name'] = trim($_POST['father_middle_name'] ?? '');
    $data['father_last_name'] = trim($_POST['father_last_name'] ?? '');
    $data['mother_first_name'] = trim($_POST['mother_first_name'] ?? '');
    $data['mother_middle_name'] = trim($_POST['mother_middle_name'] ?? '');
    $data['mother_last_name'] = trim($_POST['mother_last_name'] ?? '');

    if (!empty($errors)) {
        // Store errors in session
        $_SESSION['form_errors'] = $errors;
        $_SESSION['form_data'] = $data;
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // If no errors, proceed with database insertion
    $sql = "INSERT INTO tbl_users (
        user_full_name, date_of_birth, sex, civil_status,
        tax_identification_number, nationality, religion, place_of_birth, region, region_code, province, province_code, municipality, municipality_code,
        barangay, barangay_code, zip_code, home_address, email_address, phone_number,
        telephone_number, fathers_full_name, mothers_full_name, date_created
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $mysqli->prepare($sql);
    
    // Combine names
    $full_name = trim($data['first_name'] . ' ' . $data['middle_name'] . ' ' . $data['last_name']);
    $fathers_full_name = trim($data['father_first_name'] . ' ' . $data['father_middle_name'] . ' ' . $data['father_last_name']);
    $mothers_full_name = trim($data['mother_first_name'] . ' ' . $data['mother_middle_name'] . ' ' . $data['mother_last_name']);

    $stmt->bind_param(
        'sssssssssssssssssss',
        $full_name,
        $data['dob'],
        $data['sex'],
        $data['civil_status'],
        $data['tin'],
        $data['nationality'],
        $data['religion'],
        $data['place_of_birth'],
        $data['region_name'],
        $data['region_code'],
        $data['province_name'],
        $data['province_code'],
        $data['city_name'],
        $data['city_code'],
        $data['barangay_name'],
        $data['barangay_code'],
        $data['zipcode'],
        $data['home_address'],
        $data['email_address'],
        $data['contact_number'],
        $data['telephone_number'],
        $fathers_full_name,
        $mothers_full_name
    );

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Record added successfully!";
        unset($_SESSION['form_data']);
    } else {
        $_SESSION['form_errors']['db_error'] = "Error adding record: " . $mysqli->error;
        $_SESSION['form_data'] = $data;
    }

    $stmt->close();
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
