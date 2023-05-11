<?php
    session_start();
    include_once "backend_boilerplate2.php";

    $user_id = $_SESSION["user_id"];

    $data = json_decode(file_get_contents("php://input"), true);

    $sql_get_total_likes_and_comments = "SELECT total_likes, total_comments FROM `images` WHERE photo_id = '{$data[0]}'";
    $sql_get_total_likes_and_comments_result = mysqli_query($conn, $sql_get_total_likes_and_comments);

    $num = mysqli_num_rows($sql_get_total_likes_and_comments_result);

    if ($num > 1)
    {
        debug_to_console2("sever error (2 images with same id)");
        die();
    }

    $data_2 = mysqli_fetch_assoc($sql_get_total_likes_and_comments_result);
    
    $total_likes = $data2["total_likes"];

    if (isset($_SESSION["user_id"]))
    {
        if ($data[1] == true)   //liking
        {
            $sql_like = "INSERT INTO `likes` (`photo_id`, `user_id`)
                         VALUES ('{$data[0]}', '{$user_id}');";

            mysqli_query($conn, $sql_like);
            
            $sql_increment_liked = "UPDATE `images` SET `total_likes` = '{$data[2]}'
            WHERE `images`.`photo_id` = '{$data[0]}';";

            mysqli_query($conn, $sql_increment_liked);
        }
        else                    //inliking
        {
            $sql_unlike = "DELETE FROM `likes` 
                           WHERE  user_id = '{$user_id}' AND photo_id = '{$data[0]}'";

            mysqli_query($conn, $sql_unlike);

            $sql_increment_liked = "UPDATE `images` SET `total_likes` = '{$data[2]}'
                                    WHERE `images`.`photo_id` = '{$data[0]}';";

            mysqli_query($conn, $sql_increment_liked);
        }
    }
?>