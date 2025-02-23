<?php
    function validateCreateUserParams($name, $email, $location) {
        if(empty($name) || empty($email) || empty($location)) {
            throw new Exception("All fields are required.");
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }
    }
?>