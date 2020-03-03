<?php

function validateTopic($topic) {

// This function takes topic that user is abaout to create, initializing error arraz
// And checks atributes of topic and gives error if there is any

    $errors = array();
    
        if (empty($topic['name'])) {
            array_push($errors, 'Name is required');
        }


// Name is unique in topics and table and we will select one record where name is equal to name the user provided
        $existingTopic = selectOne('topics', ['name' => $post['name']]);
        if ($existingTopic) {
            // Checking is user updating post or adding the new one, and we are checking if the post that defined in db is not the post that they are trying to update
            if (isset($post['update-topic']) && $existingTopic['id'] != $post['id']) {
                array_push($errors, 'Name alerady exists');
            }
            
            // Checking if the add post key exist in our POST VARIABLE and if it exist, and the exisitng post is set 
            if (isset($post['add-topic'])) {
                array_push($errors, 'Post with that title alerady exists');
            }
        }

    return $errors;
}
