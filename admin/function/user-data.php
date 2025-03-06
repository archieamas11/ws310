<?php
function getUserData()
{
    // Mapping form input names to database column names
    $fields_map = [
        'full_name'         => 'user_full_name',
        'name'              => 'user_full_name', 
        'dob'               => 'date_of_birth',
        'date_of_birth'     => 'date_of_birth', 
        'sex'               => 'sex',
        'civil_status'      => 'civil_status',
        'tin'               => 'tax_identification_number',
        'tax_number'        => 'tax_identification_number', 
        'nationality'       => 'nationality',
        'religion'          => 'religion',
        'place_of_birth'    => 'place_of_birth',
        'birth_place'       => 'place_of_birth', 
        'contact_number'    => 'phone_number',
        'phone'             => 'phone_number',  
        'email_address'     => 'email_address',
        'telephone_number'  => 'telephone_number',
        'telephone'         => 'telephone_number',  
        'region_name'       => 'region',
        'region_code'       => 'region_code',
        'province_name'     => 'province',
        'province_code'     => 'province_code',
        'city_name'         => 'municipality',
        'municipality_name' => 'municipality',  
        'city_code'         => 'municipality_code',
        'municipality_code' => 'municipality_code',  
        'barangay_name'     => 'barangay',
        'barangay_code'     => 'barangay_code',
        'home_address'      => 'home_address',
        'zipcode'           => 'zip_code',
        'fathers_full_name' => 'fathers_full_name',
        'father_name'       => 'fathers_full_name', 
        'mothers_full_name' => 'mothers_full_name',
        'mother_name'       => 'mothers_full_name'  
    ];

    $data = [];

    // Loop through possible form inputs and assign to the database column
    foreach ($fields_map as $form_key => $db_column) {
        if (isset($_POST[$form_key]) && !isset($data[$db_column])) {
            $data[$db_column] = htmlspecialchars(trim($_POST[$form_key]));
        }
    }

    return $data;
}
?>