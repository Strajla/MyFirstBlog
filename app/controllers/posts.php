<?php

include (ROOT_PATH . "/app/database/db.php");
include (ROOT_PATH . "/app/helpers/validatePosts.php");

// We are putting it in variable bcs we will use it multiply times in our code
$table = 'posts';


// Quering our topics with selectAll premade function
$topics = selectAll('topics');
$posts = selectAll($table);


$errors = array();

// Checking if user clicked on button
if (isset($_POST['add-post'])) {
    unset($_POST['add-post'], $_POST['topic_id']);
    $_POST['user_id'] = 1;
    $_POST['published'] = 1;



    $post_id = create($table, $_POST);
    header("location:" . BASE_URL . "/admin/posts/indexPosts.php");
}