<?php
    // getting images for homrscreen
    $all_images = "select * from images ORDER BY total_likes DESC LIMIT 25;";

    //debug_to_console($all_images);

    $data = array();
    if (isset($_POST["search_bar"]))
    {
        // getting searched images
        $searched_text = $_POST["search_bar"];
        $all_images = "select * from images
                        WHERE (title LIKE '%{$searched_text}%'
                        ORDER BY total_likes DESC LIMIT 25;";
                        
    }
    $all_images_result = mysqli_query($conn,$all_images);

    $num = mysqli_num_rows($all_images_result);

    for ($i = 0; $i < $num; $i++)
    {
        $data[] = mysqli_fetch_assoc($all_images_result);
    }


    // getting info on liked images;
    if (isset($_SESSION["user_id"]))
    {
        $liked_images_tmp = array();
        $liked_images = array();

        //getting all liked images of current user then comparing it with displayed images

        $liked_by_user_sql = "select * from likes
                                WHERE (user_id = '{$current_user}')";

        $liked_by_user_sql_result = mysqli_query($conn,$liked_by_user_sql);

        $num_liked = mysqli_num_rows($liked_by_user_sql_result);

        // storing all liked images
        for ($i = 0; $i < $num_liked; $i++)
        {
            $liked_images_tmp[$i] = mysqli_fetch_assoc($liked_by_user_sql_result);
        }

        for ($i = 0; $i < $num_liked; $i++)
        {
            // comparing every liked image by current user with displayed images
            for ($j = 0; $j < $num; $j++)
            {
                // appending if true
                if ($liked_images_tmp[$i]["photo_id"] == $data[$j]["photo_id"])
                {
                    array_push($liked_images, $data[$j]["photo_id"]);
                }
            }
        }
        // debug_to_console("liked_img");
        // debug_to_console($liked_images);
        // debug_to_console("liked_img_end");
    }

    
?>