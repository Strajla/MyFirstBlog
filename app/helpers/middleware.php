<?php

// Here we will define our middleware functions



// 1. First function is usersOnly, when we execute before certain functionlaity it will strict that functionality only for locked in users
// 2. Second function is adminOnly, if we want to restrict some part of the code only for admin users, we can execute this function right before that functionality
// 3. Third function is for guestsOnly, this function is used to restrict pages like register and login page from users that are locked in, because if we are locked in
// there is no need to have login or register section


// Redirect just specify the path, were user should be taken to, in case any of this checks fail



function usersOnly($redirect = '/index.php')
{
    // In this function we are checking if user is locked in, that means if they dont have the value of the session such is ID
    // we will redirect them to homepage

    if (empty($_SESSION['id'])) {
        $_SESSION['message'] = 'You need to login first';
        $_SESSION['type'] = 'error';
        header('location ' . BASE_URL . $redirect);
        exit(0);
    }
}



function adminOnly($redirect = '/index.php')
{
    // Here we are checking if they are not admin user, but before that we will check if they are not locked in

    if (empty($_SESSION['id']) ||  empty($_SESSION['admin'])) {
        $_SESSION['message'] = 'You are not authorized';
        $_SESSION['type'] = 'error';
        header('location ' . BASE_URL . $redirect);
        exit(0);
    }
}



function guestsOnly($redirect = '/index.php')
{
    // Checking if the users are locked in

    if (isset($_SESSION['id'])) {
        header('location ' . BASE_URL . $redirect);
        exit(0);
    }
}
