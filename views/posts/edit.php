<?php require_once '../../core/includes.php';

$id = (int)$_POST['id'];

if(!empty($_POST) ){
    $p = new Post;
    $file_upload = $p->edit($_POST['id']);


if( $file_upload['file_upload_error_status'] === 1 ){ // File upload was unsuccessful

    $_SESSION['file_upload_errors'] = $file_upload['errors']; // log file errors



    header("Location: /posts/edit-post.php?edit_post_error=true&id=$id"); // flag there was an error
    exit();


}

// Add post successful!!
unset($_SESSION['file_upload_errors']);

header("Location: /community.php"); //they will have been redirected here
exit();


}else{

header("Location: /posts/edit-post.php?edit_post_error=true&id=$id");
exit();

}

exit();
