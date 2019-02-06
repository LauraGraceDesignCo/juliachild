//global variable
var createAccountPasswordsMatch = false;


$(document).ready(function(){


    //Prevent Default Refresh on Post
    $('#search-form').submit(function(event){
        event.preventDefault();

    });




    $('#search-input').keyup(function(){

        var searchData = $('#search-input').val();
        $.post('/posts/search.php', {"search":searchData}, function(data){
            console.log(data);
            $('#search-results').html('');
            var posts = JSON.parse(data);

            var postsHtml = "";

            $.each(posts, function(key, post){



                postsHtml += '<div class="col-md-6 posts-rel smmargin">';

                if( post.user_owns === 'true' ){  //to show edit/delete menu on only user logged in?>
                    postsHtml += '<div class=" nav-item-post ">';
                     postsHtml += ' <a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                        postsHtml += '<i class="menu-post-icon fas fa-ellipsis-h"></i>';
                      postsHtml += '</a>';
                      postsHtml += '<div class="dropdown-menu dm-pos" aria-labelledby="navbarDropdown">';
                        postsHtml += '<a class="dropdown-item drop-item-custom" href="posts/edit-post.php?id='+post.id+'">Edit Post</a>';
                        postsHtml += '<a class="dropdown-item drop-item-custom delete-post-btn" href="/posts/delete.php?id=' +post.id+ '" data-ID="' + post.id + '">Delete Post</a>';
                      postsHtml += '</div>';
                  postsHtml += '</div>';

                }

                postsHtml += '<div class="white-box-shadow">';
                    postsHtml += '<div class="left-post-wrapper post-post" data-projectID="' +post.id+ '">';
                        postsHtml += '<div class="row">';
                                postsHtml += '<div class="col-lg-4">';

                                  var love_class = 'far';
                                   var love_text = 'favourite';

                                  if( post.love_id ){ //they loved it
                                      love_class = 'fas';
                                      love_text = 'favourited';
                                  }

                                postsHtml += '<div class="img-post-wrapper">';
                                    postsHtml += '<img  class="img-post" src="/assets/files/' +post.filename+ '" alt="delicious food image">';
                                postsHtml += '</div>';


                                postsHtml += '<div class="row">';
                                    postsHtml += '<div class="col-6 col-lg-12">';
                                        postsHtml += '<div class="like-icon-wrapper textleft love-btn">';
                                            postsHtml += '<p class="like-number  loves-count">' +post.love_count+ '</p> <i class="' +love_class+ ' red fa-heart love-icon"></i><p class="favourite-recipe p-bold love-btn-text">' +love_text+ '</p>';
                                        postsHtml += '</div>';
                                    postsHtml += '</div>';
                                    postsHtml += '<div class="col-6 col-lg-12">';
                                        postsHtml += '<div class="post-by-wrapper addmg">';
                                            postsHtml += '<p class="p-bold posted-by">posted by: <br>' +post.firstname + ' ' + post.lastname+ '</p>';
                                        postsHtml += '</div>';
                                    postsHtml += '</div>';
                                postsHtml += '</div>';

                                postsHtml += '</div><!--col-md-4-->';

                                postsHtml += '<div class="col-md-12 col-lg-8">';


                                    postsHtml += '<h2 class="post-h2">' +post.title+ '</h2>';
                                    postsHtml += '<hr class="bg-red hr-post">';

                                    postsHtml += '<div class="icons-wrapper-post">';
                                        postsHtml += '<div class="row">';
                                            postsHtml += '<div class="col-lg-12 col-xl-4 add-space">';
                                                postsHtml += '<img class="img-fluid icon-post" src="/assets/images/posts-difficulty-icon.png" alt="difficulty">';
                                                postsHtml += '<p class="p-difficulty">' +post.difficulty +'</p>';
                                            postsHtml += '</div><!--col-lg-4-->';

                                            postsHtml += '<div class="col-lg-12 col-xl-4 add-space">';
                                                postsHtml += '<img class="img-fluid icon-post" src="/assets/images/posts-time-icon.png" alt="time">';
                                                postsHtml += '<p class="p-difficulty">'+post.hours+ 'h ' + post.minutes + 'mins' + '</p>';
                                            postsHtml += '</div><!--col-lg-4-->';

                                            postsHtml += '<div class="col-lg-12 col-xl-4 add-space">';
                                                postsHtml += '<img class="img-fluid icon-post" src="/assets/images/posts-servings-icon.png" alt="servings">';
                                                postsHtml += '<p class="p-difficulty">'+ post.servings + ' serv.' + '</p>';
                                            postsHtml += '</div><!--col-lg-4-->';
                                        postsHtml += '</div><!--row-->';
                                    postsHtml += '</div><!--icons-wrapper-post-->';

                                    postsHtml += '<hr class="bg-red hr-post">';

                                    postsHtml += '<p class="p-post">' +post.description+ '</p>';


                                postsHtml += '</div><!--col-md-8-->';
                            postsHtml += '</div><!--row-->';
                        postsHtml += '</div><!--left-post-wrapper-->';
                    postsHtml += '</div><!--white-box-shadow-->';
                postsHtml += '</div><!--col-md-6-->';


            });

            console.log(postsHtml);

            $('#search-results').html(postsHtml);
        });


    });




    $('#password2').keyup(checkPasswordMatch);


    $('#createAccountForm').submit(function(e){
        if(createAccountPasswordsMatch == false ){
            e.preventDefault();
        }

    });

    $('#form-with-file-upload').submit(function(e){
    if(MaxFileSizeExceeded == true ){
        e.preventDefault();
        $('.img-error').html('your image is too big');
    }


});

// $('#change-password-btn').click(function(){
//     $('#toggle-password').toggle();
//
//
// });

$('#change-password-btn').click(function(){
    $('#toggle-password').toggle();
    $(this).text('Keep Password');

    var display = $('#toggle-password').css('display');

    if( display == 'none'){
        $(this).text('Change Password');
        $('#password1').val('');
    }
});


$('#post-feed').on('click', '.love-btn', function(){

        var $love_btn = $(this);
       var post_id = $love_btn.closest('.post-post').attr('data-projectID');
       var $love_icon = $love_btn.find('.love-icon');
       var $love_btn_text = $love_btn.find('.love-btn-text');
       var $love_btn_count = $love_btn.find('.loves-count');

    //    console.log(post_id);


    $.post('/loves/add.php',{"post_id":post_id}, function(love_data){
         console.log(love_data);
         love_data = JSON.parse(love_data);

         if( love_data.error === false){ //loving worked!
             if(love_data.loved == 'loved'){
                 $love_icon.removeClass('far').addClass('fas');
                 $love_btn_text.text('favourited');
                 $love_btn_count.text(love_data.love_count);

             }else if (love_data.loved == 'unloved') {
                 $love_icon.removeClass('fas').addClass('far');
                 $love_btn_text.text('favourite');
                 $love_btn_count.text(love_data.love_count);
             }

         }


     });

 });


 $('#post-feed').on('click', '.delete-post-btn', function(){

    console.log('delete button clicked');
    var post_id = $(this).attr('data-ID');

    // $(this).closest('.user-comment').remove();
    //closest takes a parameter of an html tag and looks for what tag you put into the function
    //to go down the function is .find()

    $.post('/posts/delete.php', {"post_id": post_id}, function(data){
        console.log(data);

    });
});







}); // END DOCUMENT READY

//checking to see on create an account if passwords match using keyup
function checkPasswordMatch() {
    var password1 = $('#password1').val();
    var password2 = $('#password2').val();

    if( password1 != password2){
        createAccountPasswordsMatch = false;
        $('#passMessage').html("Passwords must match!");

    }else{
        createAccountPasswordsMatch = true;
        $('#passMessage').html("Passwords match!");
    }

}


function previewFile() {

    var preview = document.getElementById('img-preview');
    var file = document.getElementById('file-with-preview').files[0];

    var reader = new FileReader();

    reader.onloadend = function(){
        preview.src = reader.result;
    }

    if(file) {
        reader.readAsDataURL(file);
    }else{
        preview.src = "";
    }

}
