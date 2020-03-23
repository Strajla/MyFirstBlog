<?php

session_start();
require('connect.php');

// Making function, so if anytime want to see our values on screen.
// We will call this so we can speed up the process. It stands to observe our variables and display our content.

function dd($value)
{

    // I added true value here, bcs i want to remove that 1, below that last brace

    echo "<pre>", print_r($value, true), "</pre>";
    die();
}

function executeQuery($sql, $data)
{
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
function selectAll($table, $conditions = [])
{

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

function selectOne($table, $conditions)
{

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

    // SelectOne function will return only one array        

}

function create($table, $data)
{

    global $conn;
    $sql = "INSERT INTO $table SET ";

    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }


    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $id;
}

function update($table, $id, $data)
{

    global $conn;
    $sql = "UPDATE $table SET ";

    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }

    $sql = $sql . " WHERE id=?";
    $data['id'] = $id;
    $stmt = executeQuery($sql, $data);
    return $stmt->affected_rows;
}


function delete($table, $id)
{

    global $conn;
    $sql = "DELETE FROM $table WHERE id=?";

    $stmt = executeQuery($sql, ['id' => $id]);
    // We are putting id here under quotation, bcs our ExecuteQuery function only accepts
    // assoc arrays

    return $stmt->affected_rows;
}



// If we pass 1 in admin section, we will have 0 displays on our screen. Bcs
// we dont have any user in our database that has admin status


// Making another function se we can fetch name of the user from who created the post


function getPostsByTopicId($topic_id)
{
    global $conn;
    // Our method will select username and all atributes from the post and the users table under condition and where the articile is published and topic id is id id
    // of the topic user clicked on
    $sql = "SELECT p.*, u.username FROM posts as p JOIN users AS u ON p.user_id=u.id WHERE p.published=? AND topic_id=?";

    $stmt = executeQuery($sql, ['published' => 1, 'topic_id' => $topic_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getPublishedPosts()
{
    // since we are using db, we need to include db connection
    global $conn;
    // selecting all collums from posts table, and also we are selecting username colluum in user table,we are putting
    // this together only in condtion where
    // and we are performing  in cases where user id in post table is equal to the user id in users table
    $sql = "SELECT p.*, u.username FROM posts as p JOIN users AS u ON p.user_id=u.id WHERE p.published=?";
    $stmt = executeQuery($sql, ['published' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}



// This $value is the word that user putted in search field
function searchPosts($term)
{

    $match = '%' . $term . '%';
    global $conn;
    $sql = "SELECT
                p.*, u.username
                FROM posts AS p
                JOIN users AS u
                ON p.user_id=u.id
                WHERE p.published=?
                AND p.title LIKE ? OR p.body LIKE ?";
    // We are selecting from the users and posts table and joining, and making sure that we are seleciting
    // posts that are published, and we are making sure that title has certain string that looks like search term
    $stmt = executeQuery($sql, ['published' => 1, 'title' => $match, 'body' => $match]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}
