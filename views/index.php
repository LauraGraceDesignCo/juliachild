<?php  require_once("../core/includes.php");
    // unique html head vars
    $title = 'Home Page | Julia Child\'s Recipe Share ';
    require_once("../elements/html_head.php");
    require_once("../elements/nav-not-logged-in.php");
    // require_once("../elements/nav.php");
?>



<section id="splash">
    <div id="index-h1-wrapper">
        <div class="splash-text-wrapper textcenter">
            <h1>The Grandmama (or <span class="blue">DADA</span>) <br>of recipe sharing</h1>
            <a class="red-btn btn-splash" href="/create-account.php">join our community</a>
    </div><!--splash-text-wrapper-->
    </div><!--index-h1-wrapper-->
</section><!--splash-->



<section id="what-the-heck-is-this" class="textcenter">
    <div class="container">
        <h2 class="h2-center">What the Heck is This</h2>

        <div class="row">
            <div class="col-md-4 mdmargin">
                <div class="col-wrapper white-box-shadow height-100">
                    <img class="img-fluid add-marg-top" src="/assets/images/index-chickens-whatisthis.png" alt="community">
                    <h3 class="h3">Community</h3>
                    <p class="p-reg p-width">Meet friends, give + get advice</p>
                </div><!--col-wrapper-->
            </div><!--col-sm-4-->

            <div class="col-md-4 mdmargin">
                <div class="col-wrapper white-box-shadow height-100">
                    <img class="img-fluid add-marg-top" src="/assets/images/index-julia-whatisthis.png" alt="julia child's recipes">
                    <h3 class="h3">Julia Child</h3>
                    <p class="p-reg p-width">Get access to Julia's cookbooks. <br>Delicious.</p>
                </div><!--col-wrapper-->
            </div><!--col-sm-4-->

            <div class="col-md-4 mdmargin">
                <div class="col-wrapper white-box-shadow height-100">
                    <img class="img-fluid add-marg-top" src="/assets/images/index-butter-whatisthis.png" alt="Share Recipes">
                    <h3 class="h3">Recipes</h3>
                    <p class="p-reg p-width">Read + Share recipes with the community</p>
                </div><!--col-wrapper-->
            </div><!--col-sm-4-->

        </div><!--row-->

        <div class="row">
                <a class="red-btn mdmargin what-btn" href="/create-account.php">Sign Up Now</a>
        </div><!--row-->

    </div><!--container-->
</section><!--what-the-heck-is-this-->


<section id="about-julia">
    <div class="container mdmargin">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="h2-left black-box-shadow">About Julia Child</h2>
                <p class="white-box-shadow black-box-shadow p-bold about-custom">Popular TV chef and author Julia Child was born in 1912, in Pasadena, California. After attending culinary school in France, she collaborated on the cookbook Mastering the Art of French Cooking, which became a bestseller upon its 1961 publication. Child followed with the launch of The French Chef on the small screen, and she cemented her reputation as an industry icon through additional books and TV appearances, until her death in 2004.</p>

            </div><!--col-sm-6-->

            <div class="col-lg-6">
                <img class="img-fluid about-julia-pic" src="/assets/images/index-about-julia.png" alt="Picture of Julia">

            </div><!--col-sm-6-->
        </div><!--row-->
    </div><!--container-->

</section><!--about julia-->


<section id="are-you-ready">
    <div class="container mdmargin">
        <div class="ready-wrapper">
        <h2 class="h2-center">Are you Ready?</h2>
        <a class="red-btn mdmargin what-btn" href="/create-account.php">Start Sharing Now</a>
        </div>

    </div><!--container-->

</section><!--are-you-ready-->




<?php require_once("../elements/footer.php");
