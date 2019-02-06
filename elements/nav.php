<?php
$u = new User;
$user = $u->get_by_id($_SESSION['user_logged_in']);

?>

<section class="mdmargin" id="nav">
            <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand" href="/"><img class="nav-logo" src="/assets/images/butter-logo-white.png" alt="Butter Logo"></a>
          <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse smmargin" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item nav-item-custom active">
                <a class="nav-link" href="/community.php">Community<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item nav-item-custom">
                <a class="nav-link" href="/create-account.php">Julia</a>
              </li>

              <li class="nav-item nav-item-custom dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?=$user['firstname']?>'s Account
                </a>
                <div class="dropdown-menu dm-pos-nav" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item drop-item-custom" href="/users/profile.php">View Profile</a>
                  <a class="dropdown-item drop-item-custom" href="/users/edit-profile.php">Edit Profile</a>
                  <a class="dropdown-item drop-item-custom" href="/users/logout.php">Logout</a>
                  <a class="dropdown-item drop-item-custom">Support</a>
                </div>
              </li>

            </ul>

          </div>
        </nav>
</section><!--nav-->
