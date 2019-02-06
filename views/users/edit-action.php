<?php  require_once("../../core/includes.php");



if( !empty($_POST)) { // check if form was submitted

    $u = new User;
    $file_upload = $u->edit();

    if( $file_upload['file_upload_error_status'] === 1 ){ // File upload was unsuccessful

        $_SESSION['file_upload_errors'] = $file_upload['errors']; // log file errors

        header("Location: /users/edit-profile.php?edit_profile_error=true"); // flag there was an error
        exit();


    }

    // Add post successful!!
    unset($_SESSION['file_upload_errors']);

    header("Location: /community.php"); //they will have been redirected here
    exit();


}else{

    header("Location: /users/edit-profile.php?edit_profile_error=true");
    exit();

}

exit();
