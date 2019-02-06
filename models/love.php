<?php

class Love extends Db{

    function add($love_data){

        $post_id = $this->data['post_id'];
        $user_id = (int)$_SESSION['user_logged_in'];

        //Check if already loved
        $sql = "SELECT * FROM loves WHERE post_id = '$post_id' AND user_id='$user_id'";
        $love = $this->select($sql)[0];

        if( !empty($love['id']) ){//already loved, delete the love
            $sql = "DELETE FROM loves WHERE post_id ='$post_id' AND user_id = '$user_id ' ";
            $this->execute($sql);
            $love_data['loved'] = 'unloved';
            $love_data['error'] = false;
        }else{
            $sql= "INSERT INTO loves (post_id, user_id) VALUES ('$post_id', '$user_id')";

            $love_id = (int)$this->execute_return_id($sql);
            if( !empty($love_id) ){
                if($love_id != 0 && is_numeric($love_id) ){
                    $love_data['loved'] = 'loved';
                    $love_data['error'] = false;
                }
            }
        }

        $sql = "SELECT COUNT(id) AS love_count FROM loves WHERE post_id = '$post_id'";
        $love_count = $this->select($sql)[0];
        $love_data['love_count'] = $love_count['love_count'];

	    return $love_data;

    }


}










    // function add($love_data){
    //     $post_id = $this->data['post_id'];
    //     $user_id = (int)$_SESSION['user_logged_in'];
    //
    //
    //     //Check if already loved
    //     $sql = "SELECT * FROM loves WHERE post_id = '$post_id' AND user_id='$user_id'";
    //     $love = $this->select($sql)[0];
    //
    //     if( !empty($love['id']) ){//already loved, delete the love
    //         $sql = "DELETE FROM loves WHERE post_id ='$post_id' AND user_id = '$user_id ' ";
    //         $this->execute($sql);
    //         $love_data['loved'] = 'unloved';
    //         $love_data['error'] = false;
    //
    //     }else{
    //
    //         $sql= "INSERT INTO loves (post_id, user_id) VALUES ('$post_id', '$user_id')";
    //
    //         $this->execute($sql);
    //     }
    //
    // }



// }
