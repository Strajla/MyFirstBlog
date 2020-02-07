<!-- This file will be responsible for communication with users on app and database -->
<?php

// Here when user submits values frop topics table, we cam grab them and call db methods and insert that topic in table
include (ROOT_PATH . "/app/database/db.php");

$table = 'topics';

// Bcs we defined our variables here, when user whants to edit we are going to use them bellow
$id = '';
$name = '';
$description = '';

$topics = selectAll($table);


// Checking if user clicked on button
if (isset($_POST['add-topic'])) {
    unset($_POST['add-topic']);
    // Specificing name of the talbe and past the data, it will makee new topic and return topic ID
    $topic_id = create($table, $_POST);
    $_SESSION['message'] = 'Topic created succesfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/indexTopics.php');
    exit();
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

// Checking if user clicked on update button, when the button is clicked all values will be sent to this file

if (isset($_POST['update-topic'])) {
    $id = $_POST['id'];
    unset($_POST['update-topic'], $_POST['id']);
    // Unseting the button and the id field
    $topic_id = update($table, $id, $_POST);
    $_SESSION['message'] = 'Topic updated successfully ';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/topics/indexTopics.php');
    exit();
}