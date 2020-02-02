<?php 

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateUser.php");

$errors = array();
$username = '';
$email = '';
$password = '';
$passwordConf = '';

if(isset($_POST['register-btn'])) {
    $errors = validateUser($_POST);
  

    // If number of errors is equal to 0, put data in database
    if (count($errors) === 0) {
     // with this unset function we are removing atributes by passing name of the keys, because we dont have any collumnt in our db with that exact name
        unset($_POST['register-btn'], $_POST['passwordConf']);
        $_POST['admin'] = 0;

    // This is for protecting our data, password encrtyption with this function, who takes 2paramteres
    // One is what user typed in filed, and other one is constant
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $user_id = create('users', $_POST);
        $user = selectOne('users', ['id'=> $user_id]);

    dd($user);

    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];
    }
  
  }