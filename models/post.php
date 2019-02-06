<?php

class Post extends Db {

    function delete(){

        $current_user_id = (int)$_SESSION['user_logged_in'];
        $id = (int)$_GET['id'];
        $this->check_ownership($id);

        // Delete the old project image file
        $project_image = trim($this->get_by_id($id)['filename']);
            if( !empty($project_image) ){
                if( file_exists(APP_ROOT.'/views/assets/files/'.$project_image )){
                    unlink( APP_ROOT.'/views/assets/files/'.$project_image );
                }
            }

        $sql = "DELETE FROM posts WHERE id='$id' AND user_id='$current_user_id'";
        $this->execute($sql);

    }




    function check_ownership($id){

    $id = (int)$id;

    $sql = "SELECT * FROM posts WHERE id = '$id'";

    $post = $this->select($sql)[0];


    if( $post['user_id'] == $_SESSION['user_logged_in'] ){
        return true;
    }else{
        header("Location: /community.php");
        exit();
    }



}


    function edit($id){

        $post_id = $this->data['id'];
        $id = (int)$_SESSION['user_logged_in']; // user id
        $this->check_ownership($post_id); // make sure user owns post thats being editted



        $title = $this->data['title'];
        $description = $this->data['description'];
        $servings = $this->data['servings'];
        $hours = $this->data['hours'];
        $minutes = $this->data['minutes'];
        $difficulty = $this->data['difficulty'];
        $course = $this->data['course'];
        $method = $this->data['method'];

        $filename_query = '';

        $file_upload = NULL;
        if( !empty($_FILES['fileToUpload']['name']) ){
            //you have to create a new instance of the util object, then call the function
            $util = new Util;
            $file_upload = $util->file_upload();

            $filename = $file_upload['filename'];
            $filename_query = ", filename='$filename' ";

        }


            $sql = "UPDATE posts SET title='$title', description='$description', servings='$servings', hours='$hours', minutes='$minutes', difficulty='$difficulty', course='$course', method='$method'  $filename_query WHERE id='$post_id' AND user_id='$id' ";


        $this->execute($sql);

        return $file_upload;




    }






    function get_by_id($id){
        $user_id = (int)$_SESSION['user_logged_in'];

        $sql = "SELECT * FROM posts WHERE user_id = '$user_id' ";

        $posts = $this->select($sql);

        return $posts;


    }

    function get_by_post_id($id) {
        $id = (int)$id; //the int forces whatever gets put in there to be a number and if not there is an error - it is a type of sql prevention

        $sql = "SELECT * FROM posts WHERE id = '$id'";

        $post = $this->select($sql)[0]; //because we are only bringing back one id back we put the zero index on it now instead of later when you are calling them. since you only cal one user in this function.

        return $post;

        // echo '<pre>' . print_r($post, 1) . '</pre>';
        // die();





    }


    function get_all(){

        $user_id = $_SESSION['user_logged_in'];


        if( !empty($_POST['search']) ){

            $search = $this->data['search'];

            $sql = "SELECT posts.*, users.firstname, users.lastname, loves.id AS love_id,
            (SELECT COUNT(loves.id) FROM loves WHERE loves.post_id = posts.id) AS love_count,
            IF(posts.user_id = '$user_id', 'true', 'false') AS user_owns
            FROM posts
            LEFT JOIN users
            ON posts.user_id = users.id
            LEFT JOIN loves
            ON posts.id = loves.post_id
            AND loves.user_id = '$user_id'
            WHERE posts.title
            LIKE '%$search%'
            ORDER BY posted_time DESC";


        }else{//They're not searching


            $sql = "SELECT posts.*, users.firstname, users.lastname, loves.id AS love_id,
            (SELECT COUNT(loves.id) FROM loves WHERE loves.post_id = posts.id) AS love_count,
            IF(posts.user_id = '$user_id', 'true', 'false') AS user_owns
            FROM posts
            LEFT JOIN users
            ON posts.user_id = users.id
            LEFT JOIN loves
            ON posts.id = loves.post_id
            AND loves.user_id = '$user_id'
            ORDER BY posted_time DESC";
        }



       $posts = $this->select($sql);

       return $posts;

    }




    function add(){
        //collect all user input
        $title = $this->data['title'];
        $description = $this->data['description'];
        $servings = $this->data['servings'];
        $hours = $this->data['hours'];
        $minutes = $this->data['minutes'];
        $difficulty = $this->data['difficulty'];
        $course = $this->data['course'];
        $method = $this->data['method'];
        $user_id = (int)$_SESSION['user_logged_in']; //we can just get the user id from the session because we have already recorded it from when they logged in
        //(int) will ensure that anything in there will be numbers. if there happens to be other characters, it'll remove them (its a lazy sql prevention)


        //you have to create a new instance of the util object, then call the function
        $util = new Util;
        $file_upload = $util->file_upload();
        $filename = $file_upload['filename'];


        //this just spits out the current time
        $current_time = time();

        //names here are COLUMN names from table database on cpanel
        if( $file_upload['file_upload_error_status'] === 0 ){ // File upload was successful
            $sql = "INSERT INTO posts (title, description, servings, hours, minutes, difficulty, course, method, filename, user_id, posted_time) VALUES ('$title', '$description', '$servings', '$hours', '$minutes', '$difficulty', '$course', '$method', '$filename', '$user_id', '$current_time')";

            $this->execute($sql); //execute sends it to database
        }

        return $file_upload;



    }





















}
