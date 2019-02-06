<?php

require_once '../../core/includes.php';
// header('Content-Type: application/json'); //manually put this in the .js file to catch my php errors 
$love_data = array(
    'error' => true
);

if(!empty($_POST['post_id']) ){ // project_id sent

    //add new love to db
    $l = new Love;
    $love_data = $l->add($love_data);

}


echo json_encode($love_data);

die();

// echo 'post ID:' . $_POST['post_id'] . 'was clicked';
//
// die();
