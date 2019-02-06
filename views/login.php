<?php  require_once("../core/includes.php");
    // unique html head vars
    $title = 'Login | Julia Child\'s Recipe Share ';
    require_once("../elements/html_head.php");
    require_once("../elements/nav-not-logged-in.php");
    // require_once("../elements/nav.php");
?>




<section id="header-form">

    <div class="container">
        <div class="row">


            <div class="col-md-6">

                <img class="img-fluid julia-img smmargin" src="/assets/images/sign-in-Julia.png" alt="Julia Child saying don't be afraid to really smack the chicken!">

            </div><!--col-md-6-->


            <div class="col-md-6 ">

                <div class="top-wrapper smmargin">

                    <h1 class="h1-tsu bg-black white">Sign In</h1>
                    <?=!empty($_SESSION['restricted_area_msg']) ? ($_SESSION['restricted_area_msg']) : "" ?>
                    <?=!empty($_SESSION['login_attempt_msg']) ? ($_SESSION['login_attempt_msg']) : "" ?>

                    <form class="white-box-shadow bg-form form-group" action="/users/login-user.php" method="post">

                        <input class="form-control custom-form-input" type="email" name="email" value="<?=!empty($_SESSION['remember_email']) ? ($_SESSION['remember_email']) : "" ?>" placeholder="Email Address" required>

                        <input class="form-control custom-form-input" type="password" name="password" value="" placeholder="Password" required>


                        <input class="red-btn form-btn-custom" type="submit" value="Submit">

                    </form>


                    <a class="p-bold plain-text-anchor" href="/create-account.php">I don't have an account! I need one.</a>


                </div><!--top-wrapper-->



                <p class="p-bold">Thank you. <br> With your help, we can keep Julia's spunky spirit alive.<br> <span class="red">Cook. Share. Live Julia.</span></p>
                <img class="img-fluid smmargin" src="/assets/images/signin-from-butter-logo.png" alt="thank you from butter">

            </div><!--col-md-6-->



        </div><!--row-->
    </div><!--container-->
</section><!--header-form-->







<?php require_once("../elements/footer.php");
