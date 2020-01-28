<?php

require('index.php');

// Making function, so if anytime want to see our values on screen.
// We will call this so we can speed up the process. It stands to observe our variables and display our content.

function dd($value) {

    // I added true value here, bcs i want to remove that 1, below that last brace

    echo "<pre>", print_r($value, true), "</pre>";
    die();

}

// This function is for displaying all users from our database.

function selectAll($table, $conditions =[]) {

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
                $sql = $sql . " WHERE $key=$value";
            } else {
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
        dd($sql);
    } 
}

$conditions = [
    'admin' => 1,
    'username' => 'Joe'
];

$users = selectAll('users', $conditions);
dd($users);