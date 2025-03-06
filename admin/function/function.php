<?php
require_once "validations.php";
require_once "CRUD.php";
require_once "user-data.php";


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
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        return;
    }

    $user_id = $_POST['user_id'] ?? 0;

    if ($user_id <= 0) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid user ID']);
        return;
    }

    // Use getData function for fetching user details
    $user = getData($mysqli, 'tbl_users', ['user_id' => $user_id]);

    if (!empty($user)) {
        echo json_encode($user[0]); // Return first matching user
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'User not found']);
    }
}

/**
 * Delete data from any table
 */
function delete()
{
    global $mysqli;

    $user_id = $_GET['user_id'] ?? 0;

    if (deleteData($mysqli, "tbl_users", ['user_id' => $user_id])) {
        header("location: ../index.php?page=dashboard");
        exit;
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Failed to delete user']);
    }
}

function update()
{
    global $mysqli;

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }

    $user_id = $_GET['user_id'] ?? 0;
    if ($user_id > 0) {
        $data = getUserData();
        if (!empty($data) && updateData($mysqli, 'tbl_users', $data, ['user_id' => $user_id])) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Failed to update user.";
        }
    } else {
        echo "Invalid user ID.";
    }
}

function add()
{
    global $mysqli;

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }

    $_POST['full_name']         = trim($_POST['first_name'] . ' ' . $_POST['middle_name'] . ' ' . $_POST['last_name']);
    $_POST['fathers_full_name'] = trim($_POST['father_first_name'] . ' ' . $_POST['father_middle_name'] . ' ' . $_POST['father_last_name']);
    $_POST['mothers_full_name'] = trim($_POST['mother_first_name'] . ' ' . $_POST['mother_middle_name'] . ' ' . $_POST['mother_last_name']);

    // Get formatted user data fomr user-data.php
    $data = getUserData();
    $data["date_created"] = date('Y-m-d H:i:s');
    if (!empty($data) && insertData($mysqli, 'tbl_users', $data)) {
        echo "<script>window.location.href = '../admin/index.php?page=dashboard';</script>";
        exit;
    } else {
        echo "Failed to add user.";
    }
}

