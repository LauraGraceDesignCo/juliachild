<?php require_once '../../core/includes.php';

if ( !empty($_POST['email']) && !empty($_POST['password']) ){

    $u = new User;
    $u->login();

}

// //redirect back to homepage
header("Location: /login.php");
