<?php
    $errors    = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        function validate_name_fields(array $fields)
        {
            global $errors;
            foreach ($fields as $field => $field_name) {
                $value          = trim($_POST[$field] ?? '');
                $is_middle_name = in_array($field, ['middle_name', 'mother_middle_name', 'father_middle_name', 'father_first_name', 'father_last_name', 'mother_first_name', 'mother_last_name']);
                if (empty($value)) {
                    if (! $is_middle_name) {
                        $errors[$field] = "Please enter your $field_name.";
                    }
                } elseif (! preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ' -]+$/", $value)) {
                    $errors[$field] = "$field_name can only contain letters and spaces.";
                } elseif (! $is_middle_name && (strlen($value) < 2 || strlen($value) > 50)) {
                    $errors[$field] = "$field_name must be between 2 and 50 characters.";
                }
            }
        }

        // Validate multiple name fields at once
        validate_name_fields([
            "last_name"           => "last name",
            "first_name"          => "first name",
            "middle_name"         => "middle name", 
            "father_last_name"    => "father's last name",
            "father_first_name"   => "father's first name",
            "father_middle_name"  => "father's middle name",
            "mother_last_name"    => "mother's last name",
            "mother_first_name"   => "mother's first name",
            "mother_middle_name"  => "mother's middle name",
        ]);

        function no_white_spaces(array $no_space_fields)
        {
            global $errors; 
            foreach ($no_space_fields as $field => $field_label) {
                if (! empty($_POST[$field]) && preg_match("/\s{2,}/", $_POST[$field])) {
                    $errors[$field] = "$field_label should not contain 2 or more consecutive spaces.";
                }
            }
        }

        // Call the function with field names as keys and labels as values
        no_white_spaces([
            "last_name"                 => "Last Name",
            "first_name"                => "First Name",
            "middle_name"               => "Middle Name",
            "father_last_name"          => "Father's Last Name",
            "father_first_name"         => "Father's First Name",
            "father_middle_name"        => "Father's Middle Name",
            "mother_last_name"          => "Mother's Last Name",
            "mother_first_name"         => "Mother's First Name",
            "mother_middle_name"        => "Mother's Middle Name",
            "otherStatus"               => "Civil Status",
            "place_of_birth"            => "Place of Birth",
            "nationality"               => "Nationality",
            "home_address"              => "Home Address",
            "email_address"             => "Email Address",
        ]);

        // Validate required fields
        $required_fields = [
            "contact_number"    => "Phone Number",
            "place_of_birth"    => "Place of Birth",
            "sex"               => "Gender",
            "civil_status"      => "Civil Status",
            "nationality"       => "Nationality",
            "home_address"      => "Home Address",
            "region_code"       => "Region",
            "province_code"     => "Province",
            "city_code"         => "City",
            "barangay_code"     => "Barangay",
            "zipcode"           => "Zip Code",
        ];

        foreach ($required_fields as $field => $label) {
            if (empty(trim($_POST[$field] ?? ''))) {
                $errors[$field] = "Please enter/select your $label.";
            }
        }

        validateDob($_POST['dob'], 'dob', "You must be at least 18 years old.");
        validateEmail($_POST['email_address'], 'email_address', "Please enter a valid email address.");
        validateNationality($_POST['nationality'], 'nationality', "Nationality must not contain numbers.");
        validateReligion($_POST['religion'], 'religion', "Religion must not contain numbers.");
        validateTIN($_POST['tin'], 'tin', "TIN must be 9-12 digits only.");
        validatePhoneNumber($_POST['contact_number'], 'contact_number', "Phone number must be a valid PH number (09XXXXXXXXX).");
        validateTelephone($_POST['telephone_number'], 'telephone_number', "Telephone number must be a valid PH landline.");
        validateZipCode($_POST['zipcode'], 'zipcode', "Zip Code must be exactly 4 digits.");


        // If no errors, store data in database
        if (empty($errors)) {
            // Set parameters and execute
            $full_name                 = $_POST['first_name'] . ' ' . $_POST['middle_name'] . ' ' . $_POST['last_name'];
            $date_of_birth             = $_POST['dob'];
            $sex                       = $_POST['sex'];
            $civil_status              = $_POST['civil_status'];
            $tax_identification_number = $_POST['tin'];
            $nationality               = $_POST['nationality'];
            $religion                  = $_POST['religion'];
            $place_of_birth            = $_POST['place_of_birth'];
            $phone_number              = $_POST['contact_number'];
            $email_address             = $_POST['email_address'];
            $telephone_number          = $_POST['telephone_number'];
            $region                    = $_POST['region_name'];
            $region_code               = $_POST['region_code'];
            $province                  = $_POST['province_name'];
            $province_code             = $_POST['province_code'];
            $municipality              = $_POST['city_name'];
            $municipality_code         = $_POST['city_code'];
            $barangay                  = $_POST['barangay_name'];
            $barangay_code             = $_POST['barangay_code'];
            $complete_address          = $_POST['home_address'];
            $zip_code                  = $_POST['zipcode'];
            $fathers_full_name         = $_POST['father_first_name'] . ' ' . $_POST['father_middle_name'] . ' ' . $_POST['father_last_name'];
            $mothers_full_name         = $_POST['mother_first_name'] . ' ' . $_POST['mother_middle_name'] . ' ' . $_POST['mother_last_name'];

            // Prepare and bind
            $sql = "INSERT INTO tbl_users (user_full_name, date_of_birth, sex, civil_status, tax_identification_number, nationality, religion, place_of_birth, phone_number, email_address, telephone_number, region, region_code, province, province_code, municipality, municipality_code, barangay, barangay_code, home_address, zip_code, fathers_full_name, mothers_full_name, date_created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $mysqli->prepare($sql);
            if($stmt){
                $stmt->bind_param("sssssssssssssssssssssss", 
                $full_name, 
                $date_of_birth, 
                $sex, 
                $civil_status, 
                $tax_identification_number, 
                $nationality, 
                $religion, 
                $place_of_birth, 
                $phone_number, 
                $email_address, 
                $telephone_number, 
                $region, 
                $region_code, 
                $province, 
                $province_code, 
                $municipality, 
                $municipality_code, 
                $barangay, 
                $barangay_code, 
                $complete_address, 
                $zip_code, 
                $fathers_full_name, 
                $mothers_full_name);
              
                if ($stmt->execute()) {
                    echo "";
                } else {
                    echo "Error updating record: " . $mysqli->error;
                }
            $stmt->close();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - FORM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" crossorigin href="<?php echo web_root; ?>assets/compiled/css/app.css">
    <link rel="stylesheet" crossorigin href="<?php echo web_root; ?>assets/compiled/css/app-dark.css">
    <link rel="stylesheet" crossorigin href="<?php echo web_root; ?>assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="<?php echo web_root; ?>assets/extensions/simple-datatables/style.css">

    <link rel="stylesheet" crossorigin href="<?php echo web_root; ?>assets/compiled/css/table-datatable.css">
</head>

<body>
    <!-- <script src="assets/static/js/initTheme.js"></script> -->
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="<?php echo web_root; ?>admin/index.php">
                                <span class="logo-name">WS310</span>
                            </a>
                        </div>
                        <!-- <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                        opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark"
                                    style="cursor: pointer">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                                preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div> -->
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                            <!-- For Admin Dashboard sidebars -->
                            <li class="sidebar-item <?php echo $dashboard; ?>"><a class="sidebar-link" href="<?php echo web_root; ?>admin/index.php"><i class="bi bi-grid-fill"></i><span>Dashboard</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <?php include($content); ?>
        </div>
    </div>
    <script src="<?php echo web_root; ?>assets/static/js/components/dark.js"></script>
    <script src="<?php echo web_root; ?>assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo web_root; ?>assets/compiled/js/app.js"></script>
    <script src="<?php echo web_root; ?>assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="<?php echo web_root; ?>assets/static/js/pages/simple-datatables.js"></script>
    <script src="<?php echo web_root; ?>assets/js/edit-regions.js"></script>
    <script src="<?php echo web_root; ?>assets/js/regions.js"></script>
    <script src="<?php echo web_root; ?>assets/js/modal.js"></script>
    <script src="<?php echo web_root; ?>assets/js/fill.js"></script>
    <script>if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href)}</script>