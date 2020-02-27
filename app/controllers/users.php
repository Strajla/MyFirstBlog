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

// Checking if the yser clicked on register button or we check also if they clicked on create admin POST
if(isset($_POST['register-btn']) || isset($_POST['create-admin'])) {
    $errors = validateUser($_POST);
  
    // If number of errors is equal to 0, put data in database
    if (count($errors) === 0) {
     // with this unset function we are removing atributes by passing name of the keys, because we dont have any collumnt in our db with that exact name
    //  We are unseting create-admin input field, bcs we dont have any kind of that, we are passing it to to create function that takes our POST info.
    // And it expext to create collum that dosent't exist in our users table.
        unset($_POST['register-btn'], $_POST['passwordConf'], $_POST['create-admin']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // This is for protecting our data, password encrtyption with this function, who takes 2paramteres
        // One is what user typed in filed, and other one is constant


        // Performing check if the form values that are comming has the value property, if it has admin
        // value we know it is commint from admin section
        if (isset($_POST['admin'])) {
            $_POST['admin'] = 1;
            $user_id = create($table, $_POST);
            $_SESSION['message'] = "Admin user created successfully";
            $_SESSION['type'] = "success";
            header('location: ' . BASE_URL . '/admin/users/indexUsers.php');
            // Everytime we redirect we need to exit the app
            exit();
            // Summary = If our button is clicked our code will run and we will have variable called admin inside our code form values
            // In that case we will set it to one, and create our user inside POST variable
        } else {
            $_POST['admin'] = 0;
            $user_id = create($table, $_POST);
            $user = selectOne($table, ['id'=> $user_id]);
            // Log user in, we will use sessions
            loginUser($user);
            // Here we are using selectOne and login user, bcs when we are creatin admin user, we dont need to login in asap
        }   
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
