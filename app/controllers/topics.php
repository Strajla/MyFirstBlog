<!-- This file will be responsible for communication with users on app and database -->
<?php

// Here when user submits values frop topics table, we cam grab them and call db methods and insert that topic in table
include (ROOT_PATH . "/app/database/db.php");
include (ROOT_PATH . "/app/helpers/validateTopic.php");


$table = 'topics';

// Bcs we defined our variables here, when user whants to edit we are going to use them bellow
$errors = array();
$id = '';
$name = '';
$description = '';

$topics = selectAll($table);


// Checking if user clicked on button
if (isset($_POST['add-topic'])) {
    $errors = validateTopic($_POST);
    // Inwoking validateTopic function and we will pas al data from the from,and this will validate errors and display them

    if (count($errors) === 0) {
    unset($_POST['add-topic']);
    // Specificing name of the table and past the data, it will makee new topic and return topic ID
    $topic_id = create($table, $_POST);
    $_SESSION['message'] = 'Topic created succesfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/indexTopics.php');

    exit();
    } else {
        $name = $_POST['name'];
        $description = $_POST['description'];
        // Here we will take values that user gave so they can be displayed on the form, giving user chance to modify them 
    }

   
}

// Since it is on URL, it will be GET REQUEST
// We will pick that and we are going to select the record in our topics record, that matches that particular ID

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $topic = selectOne($table, ['id' => $id]);
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
    
    
}


// If there is any sort of variable in GET superglobal, we are going to get that variable
// And we will call delete function on topics table, that we created alerady, and then we will pas the id we want to delete

if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Topic deleted successfully ';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/indexTopics.php');
    exit();
}


// Checking if user clicked on update button, when the button is clicked all values will be sent to this file

if (isset($_POST['update-topic'])) {
    $errors = validateTopic($_POST);

    if (count($errors) === 0) {
    $id = $_POST['id'];
        unset($_POST['update-topic'], $_POST['id']);
        // Unseting the button and the id field
        $topic_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Topic updated successfully ';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/topics/indexTopics.php');
        exit();
    } else {
        $id =  $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
    }
  
}