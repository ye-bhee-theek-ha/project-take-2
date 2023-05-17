<?php

if ($num != 0)
{
    //make an input named current comments
    if (isset($_POST["submit"]) && $_POST["text"] != "")
    {
        $user_id = $_SESSION["user_id"];
        $photo_id = $_POST["photo_id"];
        $comment = $_POST["text"];

        $sql_tmp = "select * from comments where comment = '{$comment}' and photo_id = '{$photo_id}';";

        if (!(mysqli_num_rows(mysqli_query($conn, $sql_tmp)) > 0))
        {
            $sql = "INSERT INTO `comments` (`comment_id`, `user_id`, `comment`, `photo_id`) VALUES (NULL, '{$user_id}', '{$comment}', '{$photo_id}');";

            mysqli_query($conn, $sql);
    
            $_POST["text"] = NULL;
            
            $sql_get_increment_comments = "select * from images WHERE `images`.`photo_id` = '{$photo_id}';";
            $tmp__comments = mysqli_fetch_assoc(mysqli_query($conn, $sql_get_increment_comments));
            $tmp_no_comments = $tmp__comments["total_comments"];
            $tmp_no_comments++;
              
    
            $sql_increment_comments = "UPDATE `images` SET `total_comments` = '{$tmp_no_comments}'
                                        WHERE `images`.`photo_id` = '{$photo_id}';";
    
            mysqli_query($conn, $sql_increment_comments);
        }
    }  
}


?>