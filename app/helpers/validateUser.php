<?php

function validateUser($user) {

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

        // Here we will be checking if email alerady exists, by using selectOne function
        // It takes two arguments, users table and condiition. Where email column is equal to email user provided in our contact form.
        // If existing user existing, we will push error message

        $existingUser = selectOne('users', ['email' => $user['email']]);
            if ($existingUser) {
                if(isset($user['update-user']) && $existingUser['id'] != $user['id']) {
                    array_push($errors, 'User with that email alerady exists');
                }

                if (isset($user['create-admin'])) {
                    array_push($errors, 'Email alerady exists');
                }
            }
        return $errors;
}

function validateLogin($user) {

    $errors = array();

        $errors = array();
    
        if (empty($user['username'])) {
            array_push($errors, 'Username is required');
        }

        if (empty($user['password'])) {  
            array_push($errors, 'Password is required');
        }

    return $errors;
}