<?php

require('index.php');

// Making function, so if anytime want to see our values on screen.
// We will call this so we can speed up the process. It stands to observe our variables and display our content.

function dd($value) {

    echo "<pre>", print_r($value), "</pre>";
    die();

}

// This function is for displaying all users from our database.

function selectAll($table) {

    global $conn;
    $sql = "SELECT * FROM $table";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

$users = selectAll('users');
dd($users);