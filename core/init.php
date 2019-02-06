<?php
// For functionality like checking if a user is an admin before page is loaded


if (empty($_SESSION['user_logged_in']) ){ // user not logged in

    //redirect people if they aren't logged in

    //allowed logged out functionality
    $allowed_urls = array(
        '/',
        '/create-account.php?signup_error=email-exists',
        '/login.php?login_error=unauthorized',
        '/create-account.php',
        '/login.php',
        '/users/login.php',
        '/users/add.php',
        '/login.php?restricted_area=not-logged-in',
        '/users/login-user.php',


    );

    $allowed = false;

    foreach($allowed_urls as $allowed_url){
        if( $_SERVER['REQUEST_URI'] == $allowed_url){
            $allowed = true;
            break;
        }
    }

    if($allowed === false){
        header('Location: /login.php?restricted_area=not-logged-in'); //if logged out we are going to redirect them to homepage
        $_SESSION['restricted_area_msg'] = '<p class="must-log-in">* you must be logged in to perfom that function</p>';
    }



}else{ // user logged in

    // restrict access to pages like login when the ARE logged in

    // blacklisted logged in pages
    $blacklist_urls = array(
        '/',
        '/create-account.php?signup_error=email-exists',
        '/create-account.php',
        '/login.php',
        '/login.php?restricted_area=not-logged-in',
        '/users/login.php',
        '/users/add.php',
    );

    $allowed = true;

    foreach($blacklist_urls as $blacklist_url){
        if( $_SERVER['REQUEST_URI'] == $blacklist_url){
            $allowed = false;
            break;
        }
    }

    if($allowed === false){
        header('Location: /community.php'); // if logged in we are going to redirect them to marketplace
    }



}
