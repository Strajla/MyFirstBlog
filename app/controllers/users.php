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


        // Log user in, we will use sessions
        $_SESSION['id'] = $user['id'];
        // Here we are pulling username into session, bcs we want it to be displayed in navbar righ corner
        $_SESSION['username'] = $user['username'];
        $_SESSION['admin'] = $user['admin'];
        // Here we need to pull admin, bcs we want to know is user is admin or no, so we can display dashboard or leave it blank
        $_SESSION['message'] = 'You are now logged in';
        $_SESSION['type'] = 'success';
        // By giving it value of string named 'succes' we will be displaying green message, bcs we identify it as class in our css
       
        // If our user is admin, redirect him to dashboard, if he is regular user,redirect him to home page
        if ($_SESSION['admin']) {
            header('location: ' . BASE_URL . '/admin/dashboard.php');
        }   else {
            header('location: ' . BASE_URL . '/index.php');
        }

        exit();

        // There is no point of executing the code that comes after

    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];
    }
  
  }