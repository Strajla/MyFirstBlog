<?php

require('index.php');

// Making function, so if anytime want to see our values on screen.
// We will call this so we can speed up the process. It stands to observe our variables and display our content.

function dd($value) {

    // I added true value here, bcs i want to remove that 1, below that last brace

    echo "<pre>", print_r($value, true), "</pre>";
    die();

}

function executeQuery($sql, $data) {
// because we will interacting with database here we will use global keyword
// to make sure our conected object is avilable in this function as well.
  
    global $conn;
    $stmt =   $conn->prepare($sql); 
    // we are preparing query
    $values = array_values($data); 
    // we get the values that we are passing to query
    $types = str_repeat('s', count($values));
    // we get types from values
    //  SPLAT operator or better known as (...), will provide list of values 
    $stmt->bind_param($types, ...$values);
    // we bind our paramter here
    // inserting values with bind paramter, it takes 2 arguments. Data and string, represeting the types
    // that are contained in that data
    $stmt->execute();
    return $stmt;
}

// This function is for displaying all users from our database.
function selectAll($table, $conditions =[] ) {

    global $conn;
    $sql = "SELECT * FROM $table";

    if (empty($conditions)) {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    } else {
        // Return record that match conditions ...
        // $sql = "SELECT * FROM $table WHERE username='Joe' AND admin=1";

        $i = 0;
        foreach ($conditions as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=?";
            } else {
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }

        $stmt = executeQuery($sql, $conditions);
        // and then execute it
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    } 
    // SelectAll function will return array of arrays
}

//Because we are selecting one record, are required and not longer optional
// Since the conditions are required we no longer need if statement, bcs we are sure they will not be empyty 

function selectOne($table, $conditions) {

    global $conn;
    $sql = "SELECT * FROM $table";

        // Return record that match conditions ...
        // $sql = "SELECT * FROM $table WHERE username='Joe' AND admin=1";

        $i = 0;
        foreach ($conditions as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=?";
            } else {
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }

        // We are adding LIMIT function here bcs we dont want our query to gou trough whole db.
        // We just want it to stop when we find what are we look for.

        $sql = $sql . " LIMIT 1";
        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_assoc();
        return $records;

}

// SelectOne function will return only one array

$conditions = [
    'admin' => 0,
    'username' => 'Joe'
];

// If we pass 1 in admin section, we will have 0 displays on our screen. Bcs
// we dont have any user in our database that has admin status

$users = selectOne('users', $conditions);
dd($users);