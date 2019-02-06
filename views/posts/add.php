<?php require_once '../../core/includes.php';

// Remember what user typed functionality
$_SESSION['remember_title'] = $_POST['title'];
$_SESSION['remember_description'] = $_POST['description'];
$_SESSION['remember_servings'] = $_POST['servings'];
$_SESSION['remember_hours'] = $_POST['hours'];
$_SESSION['remember_minutes'] = $_POST['minutes'];
$_SESSION['remember_difficulty'] = $_POST['difficulty'];
$_SESSION['remember_course'] = $_POST['course'];
$_SESSION['remember_method'] = $_POST['method'];


if( !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['servings']) && !empty($_POST['hours']) && !empty($_POST['minutes']) && !empty($_POST['difficulty']) && !empty($_POST['course']) && !empty($_POST['method']) ){ // All post fields filled


    // Add new post to db
    $p = new Post;
    $file_upload = $p->add();

    if( $file_upload['file_upload_error_status'] === 1 ){ // File upload was unsuccessful

        $_SESSION['file_upload_errors'] = $file_upload['errors']; // log file errors

        header("Location: /create-post.php?create_post_error=true"); // flag there was an error
        exit();
    }

    // Add post successful!!
    unset($_SESSION['remember_title']);
    unset($_SESSION['remember_description']);
    unset($_SESSION['remember_servings']);
    unset($_SESSION['remember_hours']);
    unset($_SESSION['remember_minutes']);
    unset($_SESSION['remember_difficulty']);
    unset($_SESSION['remember_course']);
    unset($_SESSION['remember_method']);
    unset($_SESSION['file_upload_errors']);

    header("Location: /community.php"); //they will have been redirected here
    exit();

}else{



    header("Location: /create-post.php?create_post_error=true"); // flag there was an error
    exit();

}

exit();
