<?php  require_once("../core/includes.php");
    // unique html head vars
    $title = 'The Community | Julia Child\'s Recipe Share ';
    require_once("../elements/html_head.php");
    require_once("../elements/nav.php");

    $u = new User;
    $user = $u->get_by_id($_SESSION['user_logged_in']);



?>


    <div class="container">
        <div class="row">


            <div class="col-md-6">
                <h1 class="h1-tsu bg-white black">The Community</h1>
            </div><!--col-md-6-->

            <div class="col-md-6">
                <a class="red-btn alignright btn-add-marg" href="/create-post.php">Post Recipe</a>
            </div><!--col-md-6-->

                </div><!--row-->



            <div class="row smmargin">
                <div class="col-sm-12">
                    <div class="filter-search-wrapper bg-black">


                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <form id="search-form" class="form-group" method="get">
                                    <input id="search-input" class="form-control custom-form-input search-input" type="search" name="search" value="" placeholder="search">
                                    <input class="blue-btn search-btn" type="submit" value="Submit">
                                </form>
                            </div><!--col-md-6-->
                        </div><!--row-->

                    </div><!--filter-search-wrapper-->
                </div><!--col-xs-12-->
            </div><!--row-->
    </div><!--container-->

<section id="community-posts">

<div class="container">

<div id="post-feed">
    <div class="row " id="search-results">




        <?php
        $p = new Post;
        $posts = $p->get_all();



        foreach ($posts as $post) {



         ?>








        <div class="col-md-6 posts-rel smmargin">

    <?php if( $post['user_id'] == $_SESSION['user_logged_in'] ){  //to show edit/delete menu on only user logged in?>
            <div class=" nav-item-post ">
              <a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="menu-post-icon fas fa-ellipsis-h"></i>
              </a>
              <div class="dropdown-menu dm-pos" aria-labelledby="navbarDropdown">
                <a class="dropdown-item drop-item-custom" href="posts/edit-post.php?id=<?=$post['id']?>">Edit Post</a>
                <a class="dropdown-item drop-item-custom delete-post-btn" href="/posts/delete.php?id=<?=$post['id']?>" data-ID="<?=$post['id']?>">Delete Post</a>
              </div>
          </div>

      <?php } ?>









            <div class="white-box-shadow">
                <div class="left-post-wrapper post-post" data-projectID="<?=$post['id']?>">
                    <div class="row">
                            <div class="col-lg-4">

                                        <?php
                                          $love_class = 'far';
                                          $love_text = 'favourite';

                                          if( !empty($post['love_id']) ){ //they loved it
                                              $love_class = 'fas';
                                              $love_text = 'favourited';
                                          }



                                         ?>



                                        <div class="img-post-wrapper">
                                            <img  class="img-post" src="/assets/files/<?=$post['filename'] ?>" alt="delicious food image">
                                        </div>


                                        <div class="row">
                                            <div class="col-6 col-lg-12">
                                                <div class="like-icon-wrapper textleft love-btn">
                                                    <p class="like-number  loves-count"><?=$post['love_count']?></p> <i class="<?=$love_class?> red fa-heart love-icon"></i><p class="favourite-recipe p-bold love-btn-text"><?=$love_text?></p>
                                                </div>
                                            </div>
                                            <div class="col-6 col-lg-12">
                                                <div class="post-by-wrapper addmg">
                                                    <p class="p-bold posted-by">posted by: <br><?=$post['firstname']. ' ' .$post['lastname']?></p>
                                                </div>
                                            </div>
                                        </div>





                            </div><!--col-md-4-->

                            <div class="col-md-12 col-lg-8">


                                <h2 class="post-h2"><?=$post['title']?></h2>
                                <hr class="bg-red hr-post">

                                <div class="icons-wrapper-post">
                                    <div class="row">
                                        <div class="col-lg-12 col-xl-4 add-space">
                                            <img class="img-fluid icon-post" src="/assets/images/posts-difficulty-icon.png" alt="difficulty">
                                            <p class="p-difficulty"><?=$post['difficulty']?></p>
                                        </div><!--col-lg-4-->

                                        <div class="col-lg-12 col-xl-4 add-space">
                                            <img class="img-fluid icon-post" src="/assets/images/posts-time-icon.png" alt="time">
                                            <p class="p-difficulty"><?=$post['hours'] . 'h ' . $post['minutes'] . 'mins'?></p>
                                        </div><!--col-lg-4-->

                                        <div class="col-lg-12 col-xl-4 add-space">
                                            <img class="img-fluid icon-post" src="/assets/images/posts-servings-icon.png" alt="servings">
                                            <p class="p-difficulty"><?=$post['servings'] . ' serv.'?></p>
                                        </div><!--col-lg-4-->
                                    </div><!--row-->
                                </div><!--icons-wrapper-post-->

                                <hr class="bg-red hr-post">

                                <p class="p-post"><?=$post['description']?></p>


                            </div><!--col-md-8-->
                    </div><!--row-->
                </div><!--left-post-wrapper-->
            </div><!--white-box-shadow-->
        </div><!--col-md-6-->


        <?php  } ?>



        </div><!--row-->
    </div><!--posts-feed-->
</div><!--container-->




</section><!--community-posts-->







<?php require_once("../elements/footer.php");
