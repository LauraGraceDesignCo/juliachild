<?php  require_once("../core/includes.php");
    // unique html head vars
    $title = 'Create Account | Julia Child\'s Recipe Share ';
    require_once("../elements/html_head.php");
    require_once("../elements/nav-not-logged-in.php");
    // require_once("../elements/nav.php");

//checking to see if user is logged in
//     if (!empty($_SESSION)  ){
//
//     if( !empty($_SESSION['user_logged_in']) ){
//         echo '<pre>' . print_r($_SESSION, 1) . '</pre>';
//         die();
//     }
// }
?>




<section id="header-form">

    <div class="container">
        <div class="row">


            <div class="col-md-6 order-md-last smmargin">

                <img class="img-fluid julia-img" src="/assets/images/create-account-Julia-blue.png" alt="Julia Child saying Life itself is the proper binge">

            </div><!--col-md-6-->


            <div class="col-md-6 order-md-first smmargin">

                <h1 class="h1-tsu bg-blue white">Create An Account</h1>
                <?= !empty($_SESSION['create_acc_msg']) ? $_SESSION['create_acc_msg'] : '' ?>


                <form id="createAccountForm" class="white-box-shadow bg-form form-group" action="/users/add.php" method="post">
                    <input class="form-control custom-form-input" type="text" name="firstname" value="<?=!empty($_GET['signup_error']) ? ($_SESSION['remember_firstname']) : "" ?>" placeholder="First Name" required>

                    <input class="form-control custom-form-input" type="text" name="lastname" value="<?=!empty($_GET['signup_error']) ? ($_SESSION['remember_lastname']) : "" ?>" placeholder="Last Name" required>

                    <input class="form-control custom-form-input" type="email" name="email" value="<?=!empty($_GET['signup_error']) ? ($_SESSION['remember_email']) : "" ?>" placeholder="Email Address" required>


                    <input id="password1" class="form-control custom-form-input" type="password" name="password" value="" placeholder="Password" required>

                    <input id="password2" class="form-control custom-form-input" type="password" name="password2" value="" placeholder="Confirm Password" required>
                    <p id="passMessage"></p>

                    <input class="red-btn form-btn-custom" type="submit" value="Submit">

                </form>


                <a class="p-bold plain-text-anchor" href="/login.php">go back to login</a>

            </div><!--col-md-6-->







        </div><!--row-->
    </div><!--container-->
</section><!--header-form-->







<?php require_once("../elements/footer.php");
