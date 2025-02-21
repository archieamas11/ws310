<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../include/initialize.php";
require_once "../include/config.php";
require_once "tabs/edit_modal.php";

// Session/Auth check
// if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false || $_SESSION["user_type"] === "user") {
//     header("location: ../../login/index.php");
//     exit;
// }

// if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admin") {
$content = 'dashboard.php';

$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';

switch ($view) {
    case 'dashboard':
        $title     = "Dashboard";
        $content   = 'dashboard.php';
        $dashboard = 'active';
        break;

    case 'insert':
        $title   = "New Record";
        $content = 'tabs/insert_record.php';
        $record  = 'active';
        break;

    case 'logout':
        $title    = "Logout";
        $content  = 'logout.php';
        $activity = 'active';
        break;

    case 'edit_record':
        $title = "Update Record";
        $content = 'tabs/edit_record.php';
        $record = 'active';
        break;

    default:
        $title     = "Dashboard";
        $content   = 'dashboard.php';
        $dashboard = 'active';
}

// }
require_once "template/admin_template.php";