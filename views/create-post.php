<?php  require_once("../core/includes.php");
    // unique html head vars
    $title = 'Create Post | Julia Child\'s Recipe Share ';
    require_once("../elements/html_head.php");
    // require_once("../elements/nav-not-logged-in.php");
    require_once("../elements/nav.php");



?>




<section id="header-form">

    <div class="container">
        <div class="row">


            <div class="col-lg-6 order-lg-last smmargin">

                <img class="img-fluid julia-img" src="/assets/images/create-post-Julia.png" alt="Julia Child saying Share the knowledge dear! Do it while cookin' steak!">

            </div><!--col-md-6-->


            <div class="col-lg-6 order-lg-first smmargin">

                <h1 class="h1-tsu bg-blue white">Post a Recipe</h1>


                <form id="form-with-file-upload" class="white-box-shadow bg-form-long form-group" action="/posts/add.php" method="post" enctype="multipart/form-data">

                    <div class="file-upload-wrapper">
                        <div class="img-size-wrapper">
                            <img id="img-preview" class="img-fluid custom-preview-file" src="/assets/images/create-post-template-pic.png">
                        </div><!--image-size-wrapper-->

                        <input id="file-with-preview" onchange="previewFile()" type="file" name="fileToUpload" class="inputfile" required>
                        <label for="file-with-preview"><i class="fas fa-upload upload-icon"></i> Choose an image</label>
                        <p class="img-error">

                            <?php

                            if( !empty($_GET['create_post_error']) ){


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

                    <input class="form-control custom-form-input" type="text" name="title" value="<?=!empty($_GET['create_post_error']) ? ($_SESSION['remember_title']) : "" ?>" placeholder="Recipe Title" required>

                    <textarea class="form-control custom-form-input custom-form-text-area" id="exampleFormControlTextarea1" rows="3" placeholder="Short Description (Max 100 char.)" name="description" required><?=!empty($_GET['create_post_error']) ? ($_SESSION['remember_description']) : "" ?></textarea>

                    <input class="form-control custom-form-input " type="number" name="servings" value="<?=!empty($_GET['create_post_error']) ? ($_SESSION['remember_servings']) : "" ?>" placeholder="# of Servings" required>

                    <div class="row time-wrapper-form">
                        <div class="col-6 spacing-fix-time">
                          <label class="label-time">Prep + Time Total:</label>
                        </div>
                      <div class="col-3 spacing-fix-time">
                        <input type="number" class="form-control custom-time-input" name="hours" placeholder="Hours" value="<?=!empty($_GET['create_post_error']) ? ($_SESSION['remember_hours']) : "" ?>" required>
                      </div>
                      <div class="col-3 spacing-fix-time">
                        <input type="number" class="form-control custom-time-input" name="minutes" placeholder="Minutes" value="<?=!empty($_GET['create_post_error']) ? ($_SESSION['remember_minutes']) : "" ?>" required>
                      </div>
                    </div>

                    <!-- <select class="form-control custom-form-input difficulty-select" name="difficulty">
                      <option selected disabled>Difficulty</option>
                      <option>Easy</option>
                      <option>Moderate</option>
                      <option>Hard</option>
                    </select> -->

                    <select class="form-control custom-form-input difficulty-select" name="difficulty" required>
                    <?php

                    $difficultyOptions = array(
                         'Difficulty',
                          'Easy',
                          'Moderate',
                          'Hard'

                      );

                    $selected = '';
                    $disabled = '';
                    $value = 'value = ""'; //this is for making the field required

                    $x = 0;

                    foreach ( $difficultyOptions as $difficultyOption ){

                        if( !empty($_GET['create_post_error']) ){
                            if ( $_SESSION['remember_difficulty'] == $difficultyOption ){
                                $selected = 'selected';
                            }else{
                                $selected = '';
                            }
                        }else{
                            if( $x === 0 ){ //selects very first entry ie: Difficulty if error flag is not set in url
                                $selected = 'selected';
                            }else{
                                $selected = '';
                            }
                        }



                          if( $x === 0 ){
                              $disabled = 'disabled';
                              $value = 'value = ""';
                          }else{
                              $disabled = '';
                              $value = 'value = "' . $difficultyOption . '"';
                          }

                          echo '<option ' .$selected. ' '.$disabled. ' ' .$value. '>' . $difficultyOption . '</option>';
                          $x++;
                      }

                     ?>
                     </select>



                    <!-- <select class="form-control custom-form-input difficulty-select" name="course">
                      <option selected disabled>Course</option>
                      <option>Breakfast</option>
                      <option>Lunch</option>
                      <option>Dinner</option>
                    </select> -->

                    <select class="form-control custom-form-input difficulty-select" name="course" required>
                        <?php

                        $courseOptions = array(
                             'Course',
                              'Breakfast',
                              'Lunch',
                              'Dinner'

                          );

                        $selected = '';
                        $disabled = '';
                        $value = 'value = ""'; //this is for making the field required

                        $x = 0;

                        foreach ( $courseOptions as $courseOption ){

                            if( !empty($_GET['create_post_error']) ){
                                if ( $_SESSION['remember_course'] == $courseOption ){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                            }else{
                                if( $x === 0 ){ //selects very first entry ie: Difficulty if error flag is not set in url
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                            }



                              if( $x === 0 ){
                                  $disabled = 'disabled';
                                  $value = 'value = ""';

                              }else{
                                  $disabled = '';
                                  $value = 'value = "' . $courseOption . '"';
                              }

                              echo '<option ' .$selected. ' ' .$disabled. ' ' .$value . '>' . $courseOption . '</option>';
                              $x++;
                          }

                         ?>
                    </select>

                    <textarea class="form-control custom-form-input custom-form-text-area" id="exampleFormControlTextarea1" rows="5" placeholder="Method" name="method" required><?=!empty($_GET['create_post_error']) ? ($_SESSION['remember_method']) : "" ?></textarea>


                    <input class="red-btn form-btn-custom" type="submit" value="Post">

                </form>


                <a class="p-bold plain-text-anchor" href="/community.php">just kidding! go back to the community</a>

            </div><!--col-md-6-->







        </div><!--row-->
    </div><!--container-->
</section><!--header-form-->







<?php require_once("../elements/footer.php");
