<?php

function validatePosts($post)
{

    $errors = array();

    // Wit this variable we will store error messages, if there is any       
    $errors = array();

    if (empty($post['title'])) {
        array_push($errors, 'Title is required');
    }

    if (empty($post['body'])) {
        array_push($errors, 'Body is required');
    }

    if (empty($post['topic_id'])) {
        array_push($errors, 'Please select a topic');
    }

    // This ensure that no 2 posts in our db has the same title

    // We are selecting posts table from our db, where the title is the same that user is providing
    $existingPost = selectOne('posts', ['title' => $post['title']]);
    if ($existingPost) {
        // Checking is user updating post or adding the new one, and we are checking if the post that defined in db is not the post that they are trying to update
        if (isset($post['update-post']) && $existingPost['id'] != $post['id']) {
            array_push($errors, 'Post with that title alerady exists');
        }

        // Checking if the add post key exist in our POST VARIABLE and if it exist, and the exisitng post is set 
        if (isset($post['add-post'])) {
            array_push($errors, 'Post with that title alerady exists');
        }
    }

    return $errors;
}
