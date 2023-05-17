<?php
    session_start();

    require "backend_boilerplate.php";

    // getting all images
    $data = array();


    $all_images = "select * from images ORDER BY total_likes DESC LIMIT 20;";
    $all_images_result = mysqli_query($conn,$all_images);

    $num = mysqli_num_rows($all_images_result);
    for ($i = 0; $i < $num; $i++)
    {
        $data[] = mysqli_fetch_assoc($all_images_result);
    }
    
    

    require "scripts/get_liked_info.php"; //also get comment
    require_once "scripts/script.php";
    include_once "insert_comments.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_gallery.css">
    <link rel="stylesheet" href="style_home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Gallery</title>
</head>

<body onload="display_all_images()">

    <nav class="navbar, navbar-expand-sm, fixed-top">
        <div id = "nav_bar" class = "container-fluid" style="background-color: rgba(67, 59, 56, 1);">
                <div >
                    <img class = "img-fluid h-100 d-none d-md-flex" id= "logo" src="img_assets/computer-screen.png" alt="logo">
                </div>
                    <h6 class = "nav_bar_text text-center col-md-2" > <a class = "nav_bar_text" href="#">Snap Society</a> </h6>
                <div class = "col-md-9 d-flex " style="display: flex">
                    <ul class = "nav_buttons_list_ul" style="width: 210px;">
                        <button class = "nav_buttons"><a class = "nav_buttons_text" href="main_page.php"> home </a></button>
                        <button class = "nav_buttons"><a class = "nav_buttons_text" href="login.php"> Login </a></button>
        
                        <div class="nav_more_buttons_dropdown justify-content-end">
                            <button class="nav_buttons_icon">
                                <i class="material-icons-more" style="display: flex; color:antiquewhite;" > 
                                    <span class="material-symbols-outlined">
                                        keyboard_double_arrow_down
                                    </span>
                                </i>
                            </button>
                            <div class="nav_dropdown-content">
                                <button class = "nav_buttons"><a class = "nav_buttons_text" href="login.php"> signup </a></button>
                                <button class = "nav_buttons"><a class = "nav_buttons_text" href="#"> edit profile </a></button>
                            </div>
                        </div>
        
                    </ul>
                </div>
                
        </div> 
    </nav> 
    <div class="row navbar2" style="margin-top: 10vh; padding-inline: 1% ; background-color:rgba(255, 255, 255, 0.2);">
        <div class="col-md-6 d-sm-none d-md-flex">
           <div class="suggestions w-100">
                <ul class = "suggestions_list_ul m-0" style="justify-content: flex-start;">
                    <button class="nav_buttons m-1"><a class = "nav_buttons_text" href="#"> 4k </a></button>
                    <button class="nav_buttons m-1"><a class = "nav_buttons_text" href="#"> abstract </a></button>
                    <button class="nav_buttons m-1"><a class = "nav_buttons_text" href="#"> dark </a></button>
                    <button class="nav_buttons m-1"><a class = "nav_buttons_text" href="#"> nature </a></button>
                    <button class="nav_buttons m-1"><a class = "nav_buttons_text" href="#"> portrait </a></button>
                    <button class="nav_buttons m-1 d-none d-lg-inline"><a class = "nav_buttons_text" href="#"> vector </a></button>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <nav class="navbar">
                <div class="input_bar w-100">
                    <i class="material-icons" style="display: flex"> search </i>
                    <input class="input" type="text" name="q" placeholder="" autocomplete="off" >
                    <button class="nav_buttons m-0"><a class = "nav_buttons_text" href="#"> search </a></button>
                </div>
            </nav>
        </div>
    </div> 


    <div id="page2_body">

    <div class="page2_content row">          

        <div class="view_img position-sticky col-6" id="view_img" style="">
            <div class="image_container_view" style="height: auto;">
                <div class="close_btn_div" style="margin-inline-start: auto;" >
                    <button class="nav_buttons_icon" onclick="set_view_image_false()">
                    <i class="like_button material-icons-more">
                        <span class="material-symbols-outlined">
                            close
                        </span>
                    </i>
                    </button>
                </div>
                <img class = "image_view img-fluid" id = "image_view" src="uploads/ok/t0apabs39vj91.jpg" alt="pic1">
                <div class="image_options2">
                    <div class="info">
                        <div class="title" id= "title">

                        </div>
                        <div class="description" id = "description">

                        </div>

                    </div>
                    <div class="image_button_container">
                        <button class="nav_buttons_icon dropdown-btn" type = "button" onclick="show()">
                            <i class="like_button material-icons-more">
                                <span class="material-symbols-outlined">
                                    comment
                                </span>
                            </i>
                            <form id="show" class="dropdown-menu" method="post">
                                <input type="text" name="photo_id" value = "" id = "photo_id" style="display:contents">
                                <input type="text" name="text" placeholder="write your comment here..." id= "input-container">
                                <input type="submit" value="Upload_comment" name="submit">
                            </form>
                        </button>
                        <div>
                            <p class="total_comments" id="total_comments_view">
                                <!-- filled in script -->
                            </p>
                        </div>
                    </div>
                    

                    <br>
                    <div class="comments" id="comments">
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 all_images " id="all_img" >
        </div>

    </div>

    <?php
        
    ?>  

</body>
</html>

<!-- <div class="col-lg-3 col-md-6 align-self-center">
    <div class="image_container">
        <img class = "image img-fluid" src="2.jpg" alt="pic1">
        <div class="image_options">
            <button class="nav_buttons_icon">
                <i class="material-icons-more" style="display: flex; color:antiquewhite; margin-top: 5px;" > 
                    <span class="material-symbols-outlined">
                        favorite
                    </span>
                </i>
            </button>
        </div>
    </div>
</div> -->

<script>
    var sb = false;
    function show()
    {
        if (sb)
        {
            colses();
        }
        else
        {
            var s =document.getElementById("show");
            s.style.display = "block";
        }
    }

    function closes()
    {
        var s =document.getElementById("show");
        s.style.display = "none";
    }
</script>