<?php
    $errors = [];

    function validateEmail($email, $fieldName, $errorMessage) {
        global $errors;
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
            $errors[$fieldName] = $errorMessage;
        }
    }

    function validateReligion($religion, $fieldName, $errorMessage) {
        global $errors;
        if (!empty($religion) && preg_match("/\d/", $religion)) {
            $errors[$fieldName] = $errorMessage;
        }
    }

    function validateNationality($nationality, $fieldName, $errorMessage) {
        global $errors;
        if (!empty($nationality) && preg_match("/\d/", $nationality)) {
            $errors[$fieldName] = $errorMessage;
        }
    }

    function validateTIN($tin, $fieldName, $errorMessage) {
        global $errors;
        if (! empty($tin) && ! preg_match("/^\d{9,12}$/", $tin)) {
            $errors[$fieldName] = $errorMessage;
        }
    }

    function validatePhoneNumber($contact_number, $fieldName, $errorMessage) {
        global $errors;
        if (! empty($contact_number) && ! preg_match("/^09[0-9]{9}$/", $contact_number)) {
            $errors[$fieldName] = $errorMessage;
        } else if (empty($contact_number)) {
            $errors[$fieldName] = "Please enter your Phone Number.";
        }
    }

    function validateTelephone($telephone_number, $fieldName, $errorMessage) {
        global $errors;
        if (!empty($telephone_number) && !preg_match("/^(\+?\d{1,4}[\s-]?)?(\(?\d{1,4}\)?[\s-]?)?\d{3,4}[\s-]?\d{3,4}$/", $telephone_number)) {
            $errors[$fieldName] = $errorMessage;
        }
    }

    function validateZipCode($zipcode, $fieldName, $errorMessage) {
        global $errors;
        if (! empty($zipcode) && ! preg_match("/^\d{4}$/", $zipcode)) {
            $errors[$fieldName] = $errorMessage;
        }
    }
    
    function validateDob($dob, $fieldName, $errorMessage) {
        global $errors;
        if (empty($dob)) {
            $errors[$fieldName] = "Please enter your Date of Birth.";
        } else {
            $dob   = DateTime::createFromFormat('Y-m-d', $dob);
            $today = new DateTime();
            $age   = $today->diff($dob)->y;
            if ($age < 18) {
                $errors[$fieldName] = $errorMessage;
            }
        }
    }
?>