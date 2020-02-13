<?php

include (ROOT_PATH . "/app/database/db.php");
include (ROOT_PATH . "/app/helpers/validatePosts.php");

// We are putting it in variable bcs we will use it multiply times in our code
$table = 'posts';


// Quering our topics with selectAll premade function
$topics = selectAll('topics');
$posts = selectAll($table);


$errors = array();
$title  = "";
$body  =  "";
$topic_id  = ""; 
$published = "";

// Checking if user clicked on button
if (isset($_POST['add-post'])) {
    // Validating our posts, and passing all post values from our form
        $errors = validatePosts($_POST);

    // Here we are checking if there was no image selected

    if(!empty($_FILES['image']['name'])) {
        // If there is image in array, we need image name, image destination that is directory where we want to store that image
        // This is not just directory it is full path to the final file that we want of the end of the upload
        // Adding time, bcs we want every image to be unique, it returns string of number
        $image_name = time() . '_' . ($_FILES)['image']['name'];
        $destination = ROOT_PATH . "/assets/images/" . $image_name;

        // This function takes the temporary file and key to acces that temporary file. We are moving file from temporary location
        // to our destination 
        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);


        if ($result) {
            $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Failed to upload image");
        }
        
    } else {
        array_push($errors, "Post image required");
    }

    // validatePosts returns array of errors, we make sure that errors array dosent have any errors in it
    if (count($errors) == 0) {
        unset($_POST['add-post']);
        $_POST['user_id'] = 1;
        // This is just shorcut of ilsef statement if users selected the published filed, it will be set to 1 TRUE,
        //  otherwise it will be 0 FALSE
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        // Using htmlentities function to remove our html tags in DB, and sets them in new certain format, meaning
        // we are preventing cross site scripting also known as XSS
        $_POST['body'] = htmlentities($_POST['body']);


        $post_id = create($table, $_POST);
        $_SESSION['message'] = 'Post created successfully';
        $_SESSION['type'] = 'success';
        header("location:" . BASE_URL . "/admin/posts/indexPosts.php");
    } else {
        // We make sure our form stays in place
        $title  = $_POST['title'];
        $body  = $_POST['body'];
        $topic_id  = $_POST['topic_id'];
        $published  = isset($_POST['published']) ? 1 : 0;
    } 
}