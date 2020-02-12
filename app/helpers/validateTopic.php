<?php

function validateTopic($topic) {

// This function takes topic that user is abaout to create, initializing error arraz
// And checks atributes of topic and gives error if there is any

    $errors = array();
    
        if (empty($topic['name'])) {
            array_push($errors, 'Name is required');
        }


// Name is unique in topics and table and we will select one record where name is equal to name the user provided
        $existingTopic = selectOne('topics', ['name' => $topic['name']]);
        if ($existingTopic) {
            array_push($errors, 'Name alerady exists');
        }

    return $errors;
}
