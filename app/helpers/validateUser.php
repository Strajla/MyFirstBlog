<?php

function validateUser ($user) {

    $errors = array();

        // Wit this variable we will store error messages, if there is any       
        $errors = array();
    
        if (empty($user['username'])) {
            // Here we will add array push function who will add certain value to certain array
            array_push($errors, 'Username is required');
        }
    
        if (empty($user['email'])) {
            array_push($errors, 'Email is required');
        }
        
        if (empty($user['password'])) {  
            array_push($errors, 'Password is required');
        }
    
        if ($user['passwordConf'] !== $user['password']) {
            // We will use equal sign =, if password conf is not equal to password itself, we know passwords do not match
            array_push($errors, 'Passwords do not match');
        }
    
    return $errors;
}