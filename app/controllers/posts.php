<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validatePosts.php");

// We are putting it in variable bcs we will use it multiply times in our code
$table = 'posts';


// Quering our topics with selectAll premade function
$topics = selectAll('topics');
$posts = selectAll($table);


$errors = array();
$id  = "";
$title  = "";
$body  =  "";
$topic_id  = "";
$published = "";

// GET help us recive parametars from URL, we are selecting where id is equal to the id, who is sent via URl
if (isset($_GET['id'])) {
    $post = selectOne($table, ['id' => $_GET['id']]);

    // We have fetched all data from the database, and we put it in our variables
    $id = $post['id'];
    $title  = $post['title'];
    $body  =  $post['body'];
    $topic_id  = $post['topic_id'];
    $published = $post['published'];
}


// This if statement here is deleting our post, we are getting the delete and when we delete id,
// We will be calling the delete method, and passing the name of the table, posts table and the id to
if (isset($_GET['delete_id'])) {
    adminOnly();
    $count = delete($table, $_GET['delete_id']);
    $_SESSION['message'] = 'Post deleted successfully';
    $_SESSION['type'] = 'success';
    header("location:" . BASE_URL . "/admin/posts/indexPosts.php");
    exit();
}


// Updating publish field 
if (isset($_GET['published']) && isset($_GET['p_id'])) {
    adminOnly();
    $published = $_GET['published'];
    $p_id = $_GET['p_id'];
    $count = update($table, $p_id, ['published' => $published]);
    $_SESSION['message'] = 'Post published state changed';
    $_SESSION['type'] = 'success';
    header("location:" . BASE_URL . "/admin/posts/indexPosts.php");
    exit();
}


// Checking if user clicked on button
if (isset($_POST['add-post'])) {
    adminOnly();
    // Validating our posts, and passing all post values from our form
    $errors = validatePosts($_POST);

    // Here we are checking if there was no image selected

    if (!empty($_FILES['image']['name'])) {
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
        // Here we are setting the id from sessions bcs, user clicks on create post he is logged in
        $_POST['user_id'] = $_SESSION['id'];
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
        exit();
    } else {
        // We make sure our form stays in place
        $title  = $_POST['title'];
        $body  = $_POST['body'];
        $topic_id  = $_POST['topic_id'];
        $published  = isset($_POST['published']) ? 1 : 0;
    }
}




// Checking if update button is clicked

if (isset($_POST['update-post'])) {
    adminOnly();
    $errors = validatePosts($_POST);

    // Checking if image is sent to the post, and if it is we will sent it, and store it in image variable
    if (!empty($_FILES['image']['name'])) {

        $image_name = time() . '_' . ($_FILES)['image']['name'];
        $destination = ROOT_PATH . "/assets/images/" . $image_name;
        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
            $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Failed to upload image");
        }
    } else {
        array_push($errors, "Post image required");
    }

    // Counting if there is any errors
    if (count($errors) == 0) {
        $id = $_POST['id'];
        // We jsut need id to inform our update function, and we are indetifying it using ID
        unset($_POST['update-post'], $_POST['id']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);

        $post_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Post updated successfully';
        $_SESSION['type'] = 'success';
        header("location:" . BASE_URL . "/admin/posts/indexPosts.php");
    } else {
        $title  = $_POST['title'];
        $body  = $_POST['body'];
        $topic_id  = $_POST['topic_id'];
        $published  = isset($_POST['published']) ? 1 : 0;
    }
}
