<?php 

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateUser.php");

$errors = array();
$username = '';
$email = '';
$password = '';
$passwordConf = '';
$table = 'users';

function loginUser($user) {
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
}

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

        $user_id = create($table, $_POST);
        $user = selectOne($table, ['id'=> $user_id]);
        // Log user in, we will use sessions
        loginUser($user);
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];
    }
  
  }

if (isset($_POST['login-btn'])) {
    // If there is any errors, they will be stored in errors aray
    $errors = validateLogin($_POST);

    if (count($errors) === 0) {
        // If there is no errors, find user in database with premade function
        // Defined in users table, and conditions should be equal to user submited on the form
        $user = selectOne($table, ['username' => $_POST['username']]);


        // PHP provides method verify password, it takes the string, and the second paramter is encrtypted version of password if they match
        // Function will return true
        if ($user && password_verify($_POST['password'], $user['password'])) {
            loginUser($user);
        }   else {
            array_push($errors, 'Wrong credentials');
        }
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    
}
