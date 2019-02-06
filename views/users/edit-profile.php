<?php  require_once("../../core/includes.php");

$u = new User;

$user = $u->get_by_id($_SESSION['user_logged_in']);


    // unique html head vars
    $title = 'Edit Account | Julia Child\'s Recipe Share ';
    require_once("../../elements/html_head.php");
    // require_once("../../elements/nav-not-logged-in.php");
    require_once("../../elements/nav.php");

?>




<section id="header-form">

    <div class="container">
        <div class="row">


            <div class="col-md-6 order-md-last smmargin">

                <img class="img-fluid julia-img" src="/assets/images/edit-profile-julia2.png" alt="Julia Child saying Life itself is the proper binge">

            </div><!--col-md-6-->


            <div class="col-md-6 order-md-first smmargin">

                <h1 class="h1-tsu bg-blue white">Edit Account</h1>
                <?= !empty($_SESSION['create_acc_msg']) ? $_SESSION['create_acc_msg'] : '' ?>


                <form id="form-with-file-upload" action="/users/edit.php" class="white-box-shadow bg-form-long form-group" method="post" enctype="multipart/form-data">

                    <div class="file-upload-wrapper">
                        <div class="img-size-wrapper">
                            <?php
                                if( !empty($user['filename'])){
                                    echo '<img id="img-preview" class="img-fluid custom-preview-file" src="/assets/files/' . $user['filename']. ' ">';

                                }else {
                                    echo '<img id="img-preview" class="img-fluid custom-preview-file" src="/assets/images/edit-profile-template-pic.png">';
                                }

                             ?>


                        </div><!--image-size-wrapper-->

                        <input id="file-with-preview" onchange="previewFile()" type="file" name="fileToUpload" class="inputfile">
                        <label for="file-with-preview"><i class="fas fa-upload upload-icon"></i> Choose an image</label>
                        <p class="img-error">

                            <?php

                            if( !empty($_GET['edit_profile_error']) ){


                                if( isset($_SESSION['file_upload_errors']) ){
                                    foreach($_SESSION['file_upload_errors'] as $file_upload_error){
                                        echo $file_upload_error;
                                        echo '<br>';
                                    }
                                }

                            }

                            ?>
                        </p>
                    </div><!--file-upload-wrapper-->

                    <input class="form-control custom-form-input" type="text" name="firstname" value="<?=$user['firstname']?>" placeholder="First Name">

                    <input class="form-control custom-form-input" type="text" name="lastname" value="<?=$user['lastname']?>" placeholder="Last Name">

                    <input class="form-control custom-form-input" type="email" name="email" value="<?=$user['email']?>" placeholder="Email Address">

                    <button type="button" id="change-password-btn" class="blue-btn form-btn-custom">Change Password</button>

                    <div id="toggle-password">

                    <input id="password1" class="form-control custom-form-input" type="password" name="password" value="" placeholder="Password">

                    <input id="password2" class="form-control custom-form-input" type="password" name="password2" value="" placeholder="Confirm Password">
                    <p id="passMessage"></p>

                    </div><!--toggle-password-->



                    <input class="red-btn form-btn-custom" type="submit" value="Submit">

                </form>


                <a class="p-bold plain-text-anchor" href="/community.php">just kidding! go back to my profile</a>


            </div><!--col-md-6-->







        </div><!--row-->
    </div><!--container-->
</section><!--header-form-->







<?php require_once("../../elements/footer.php");
