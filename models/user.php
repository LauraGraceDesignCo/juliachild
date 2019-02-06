<?php
class User extends Db {

    function edit(){

        $id = (int)$_SESSION['user_logged_in'];
        $firstname = trim($this->data['firstname']);
        $lastname = trim($this->data['lastname']);
        $email = trim($this->data['email']);
        $password = password_hash(trim($this->data['password']),PASSWORD_DEFAULT);

        $filename_query = '';

        $file_upload = NULL;
        if( !empty($_FILES['fileToUpload']['name']) ){
            //you have to create a new instance of the util object, then call the function
            $util = new Util;
            $file_upload = $util->file_upload();

            $filename = $file_upload['filename'];
            $filename_query = ", filename='$filename' ";

        }

        //if they put a password in
        if ( !empty( trim($_POST['password'])) ){ //new password entered

            $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', password='$password' $filename_query WHERE id='$id' ";


        }else{//no new password entered

            $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email' $filename_query WHERE id='$id' ";

        }

        $this->execute($sql);

        return $file_upload;


    }



    function login(){
        $_SESSION = array(); //Empty session to start fresh

        //get the users details from the db and store it in a variable
        $email = $this->data['email'];

        $sql = "SELECT * FROM users WHERE email = '$email'";

        $user = $this->select($sql)[0]; //we know we are only going to get one back, so we will put the zero index there.

        //now we have all the credentials for the user

        //check if the password from the form matches the password from db
        if(password_verify($_POST['password'], $user['password']) ){ //this is the function that verifies it against the password hash function.

            $_SESSION['user_logged_in'] = $user['id']; //now the user with that id is logged in

            // //redirect back to marketplace
            header("Location: /community.php");
            die();

        }else{//login attempt failed.
            $_SESSION['login_attempt_msg'] = '<p class="text-danger">* Incorrect Username and/or password</p>';
            $_SESSION['remember_email'] = $_POST['email'];

            //// //redirect to login
          header("Location: /login.php?login_error=unauthorized");
          die();


        }

        }



    function get_by_id($id){
        $id = (int)$id; //the int forces whatever gets put in there to be a number and if not there is an error - it is a type of sql prevention

        $sql = "SELECT * FROM users WHERE id = '$id'";

        // $sql = "SELECT users.*, posts.* FROM users LEFT JOIN posts ON users.id = posts.user_id WHERE users.id = '$id'";

        $user = $this->select($sql)[0]; //because we are only bringing back one id back we put the zero index on it now

	    return $user;
        echo '<pre>' . print_r($user, 1) . '</pre>';
        die();





    }

        //check to see if user already exists
        function exists() {

            $email = $this->data['email'];

            $sql= "SELECT * FROM users WHERE email = '$email'";

            $user = $this->select($sql);

            return $user;

    }


    function add(){
        //data is same as $_POST - see db.php
         //names here are from form "name"
         $firstname = trim($this->data['firstname']);
         $lastname = trim($this->data['lastname']);
         $email = trim($this->data['email']);
         $password = trim(password_hash($_POST['password'], PASSWORD_DEFAULT));

         //names here are COLUMN names from table database on cpanel
         $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";

         $new_user_id = $this->execute_return_id($sql);

         return $new_user_id;

        }


    }





    function get_all(){

        $sql = "SELECT * FROM `users`";

        $users = $this->select($sql);

        return $users;

    }
