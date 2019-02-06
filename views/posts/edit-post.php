<?php  require_once("../../core/includes.php");

$u = new User;
$user = $u->get_by_id($_SESSION['user_logged_in']);


if(!empty($_GET)){
$p = new Post;
$post = $p->get_by_post_id($_GET['id']);

}else{
    header('Location: /community.php');
}
// echo '<pre>' . print_r($post, 1) . '</pre>';
// die();



    // unique html head vars
    $title = 'Edit Post | Julia Child\'s Recipe Share ';
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

                <h1 class="h1-tsu bg-blue white">Edit Recipe</h1>


                <form id="form-with-file-upload" action="/posts/edit.php" class="white-box-shadow bg-form-long form-group" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$post['id'] ?>">

                    <div class="file-upload-wrapper">
                        <div class="img-size-wrapper">
                            <?php
                                if( !empty($post['filename'])){
                                    echo '<img id="img-preview" class="img-fluid custom-preview-file" src="/assets/files/' . $post['filename']. ' ">';

                                }else {
                                    echo '<img id="img-preview" class="img-fluid custom-preview-file" src="/assets/images/create-post-template-pic.png">';
                                }

                             ?>


                        </div><!--image-size-wrapper-->

                        <input id="file-with-preview" onchange="previewFile()" type="file" name="fileToUpload" class="inputfile">
                        <label for="file-with-preview"><i class="fas fa-upload upload-icon"></i> Choose an image</label>
                        <p class="img-error">

                            <?php

                            if( !empty($_GET['edit_post_error']) ){


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

                    <input class="form-control custom-form-input" type="text" name="title" value="<?=$post['title']?>" placeholder="Recipe Title" required>

                    <textarea class="form-control custom-form-input custom-form-text-area" id="exampleFormControlTextarea1" rows="3" placeholder="Short Description (Max 100 char.)" name="description" required><?=$post['description']?></textarea>

                    <input class="form-control custom-form-input " type="number" name="servings" value="<?=$post['servings']?>" placeholder="# of Servings" required>

                    <div class="row time-wrapper-form">
                        <div class="col-6 spacing-fix-time">
                          <label class="label-time">Prep + Time Total:</label>
                        </div>
                      <div class="col-3 spacing-fix-time">
                        <input type="number" class="form-control custom-time-input" name="hours" placeholder="Hours" value="<?=$post['hours']?>" required>
                      </div>
                      <div class="col-3 spacing-fix-time">
                        <input type="number" class="form-control custom-time-input" name="minutes" placeholder="Minutes" value="<?=$post['minutes']?>" required>
                      </div>
                    </div>

                    <select class="form-control custom-form-input difficulty-select" name="difficulty" value="<?=$post['difficulty']?>" required>
                      <option disabled>Difficulty</option>
                      <option>Easy</option>
                      <option>Moderate</option>
                      <option>Hard</option>
                    </select>


                    <select class="form-control custom-form-input difficulty-select" name="course" value="<?=$post['course']?>" required >
                      <option disabled>Course</option>
                      <option>Breakfast</option>
                      <option>Lunch</option>
                      <option>Dinner</option>
                    </select>



                    <textarea class="form-control custom-form-input custom-form-text-area" id="exampleFormControlTextarea1" rows="5" placeholder="Method" name="method" required><?=$post['method'] ?></textarea>


                    <input class="red-btn form-btn-custom" type="submit" value="Save Changes">



                </form>


                <a class="p-bold plain-text-anchor" href="/community.php">just kidding! go back to the community</a>


            </div><!--col-md-6-->







        </div><!--row-->
    </div><!--container-->
</section><!--header-form-->







<?php require_once("../../elements/footer.php");
