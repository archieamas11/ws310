<?php
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

        function no_white_spaces(array $no_space_fields)
        {
            global $errors; 
            foreach ($no_space_fields as $field => $field_label) {
                if (! empty($_POST[$field]) && preg_match("/\s{2,}/", $_POST[$field])) {
                    $errors[$field] = "$field_label should not contain 2 or more consecutive spaces.";
                }
            }
        }
        
        // Validate required fields
        $required_fields = [
            "contact_number"            => "Phone Number",
            "place_of_birth"            => "Place of Birth",
            "sex"                       => "Gender",
            "civil_status"              => "Civil Status",
            "nationality"               => "Nationality",
            "home_address"              => "Home Address",
            "region_code"               => "Region",
            "province_code"             => "Province",
            "city_code"                 => "City",
            "barangay_code"             => "Barangay",
            "zipcode"                   => "Zip Code",
        ];
        foreach ($required_fields as $field => $label) {
            if (empty(trim($_POST[$field] ?? ''))) {
                $errors[$field] = "Please select your $label.";
            }
        }
?>