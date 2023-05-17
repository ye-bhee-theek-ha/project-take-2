<?php
    require "backend_boilerplate.php";

    session_start();
    $current_user  = $_SESSION["user_id"];
    $_SESSION["large_img"] = NULL;
    $_SESSION["total_comments"] = NULL;

    require "scripts/get_liked_info.php"; //also get comment
    require_once "scripts/script.php";
    include_once "insert_comments.php";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>"Snap Society"</title>
</head>

<body onload="display_all_images()">
    <div id = "page1_body">
        <nav class="navbar, navbar-expand-sm, fixed-top">
            <div id = "nav_bar" class = "container-fluid" style="background-color: rgba(67, 59, 56, 1);">
                    <div>
                        <img class = "img-fluid h-100 d-none d-md-flex" id= "logo" src="img_assets/computer-screen.png" alt="logo">
                    </div>
                        <h6 class = "nav_bar_text text-center col-md-2" > <a class = "nav_bar_text" href="#">Snap Society</a> </h6>
                    <div class = "col-md-9 d-flex " style="display: flex">
                        <ul class = "nav_buttons_list_ul">
                            <button class = "nav_buttons"><a class = "nav_buttons_text" href="#page2_body"> Explore </a></button>

                            <!-- do NOT display if user already logged in -->
                            <button class = "nav_buttons
                            <?php 
                            if(isset($_SESSION["user_id"]))
                                echo  " d-none";
                            ?>
                            ">
                            <a class = "nav_buttons_text" href="login.php">
                                Login
                            </a></button>

                            <!--  display pic if user already logged in -->
                            <!-- defaut img -->
                            <a href="profile_page.php">
                                <span style="display: flex; color:antiquewhite; align-items: center; scale: 1.5; margin-inline: 5px;" class="material-symbols-outlined
                                    <?php 
                                    if(isset($_SESSION["user_id"]) && isset($_SESSION["profile_pic"]))
                                        echo  " d-none";
                                    ?>
                                ">
                                    account_circle
                                </span>
                            </a>

                            <!-- user profile pic -->
                            <a href="profile_page.php">
                                <img id= "logo" src="<?php if (isset($_SESSION["profile_pic"])) {echo $_SESSION["profile_pic"];} ?>" alt="logo" style="overflow:hidden; width:34px; height:34px; border-radius: 50%;
                                <?php 
                                if(isset($_SESSION["user_id"]) && !isset($_SESSION["profile_pic"]))
                                    echo  " display: none;";
                                ?>
                                ">
                            </a>
            
                            <div class="nav_more_buttons_dropdown justify-content-end">
                                <button class="nav_buttons_icon">
                                    <i class="material-icons-more" style="display: flex; color:antiquewhite;" > 
                                        <span class="material-symbols-outlined">
                                            keyboard_double_arrow_down
                                        </span>
                                    </i>
                                </button>
                                <div class="nav_dropdown-content">
                                    <button class = "nav_buttons"><a class = "nav_buttons_text" href="login.php"> Signup </a></button>
                                    <button class = "nav_buttons"><a class = "nav_buttons_text" href="gallery.php"> Explore All </a></button>
                                    <button class = "nav_buttons"><a class = "nav_buttons_text" href="profile_page.php"> Profile </a></button>
                                </div>
                            </div>
            
                        </ul>
                    </div>
                    
            </div>
        </nav>
    
        <div class="page1_content">
            <form class="search" action="" method="post">
                <h1 class="above_content">4k wallpapers</h1>
                <p class="above_content_discription">this is a testing website for databse project. this website will allow users to create an account, upoload pictures, view them and much more functionality </p>
                <div class="input_bar">
                    <i class="material-icons" style="display: flex"> search </i>
                    <input class="input" type="text" name="search_bar" placeholder="" autocomplete="off" >
                </div>
                <div class="suggestions">
                    <ul class = "suggestions_list_ul">
                        <p class = "suggestion_text">suggestions : </p>
                        <a class = "suggestion_buttons_text" href="#"> 4k </a>
                        <a class = "suggestion_buttons_text" href="#"> abstract </a>
                        <a class = "suggestion_buttons_text" href="#"> dark </a>
                        <a class = "suggestion_buttons_text" href="#"> nature </a>
                    </ul>
                </div>
            </div>
        </div>    
    </div>
    
    <div id="page2_body">
        <div class="page2_content row">
            <h1 class="page2_heading"> Content </h1>
            

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
                            <button class="nav_buttons_icon dropdown-btn" type = "button">
                                <i class="like_button material-icons-more">
                                    <span class="material-symbols-outlined">
                                        comment
                                    </span>
                                </i>
                                <div class="dropdown-menu">
                                    <input type="text" name="photo_id" value = "" id = "photo_id" style="display:contents">
                                    <input type="text" name="text" placeholder="write your comment here..." id= "input-container">
                                    <input type="submit" value="Upload_comment" name="submit">
                                </div>
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
    </div>
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
    // Get the necessary elements
    const dropdownBtn = document.querySelector('.dropdown-btn');
    const dropdownMenu = document.querySelector('.dropdown-menu');
    const inputContainer = document.getElementById('input-container');
    const inputFields = document.querySelectorAll('.dropdown-menu input');
    
    // Toggle dropdown menu
    dropdownBtn.addEventListener('click', function() 
    {
      dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });
  
    // Handle input selection
    inputFields.forEach(function(input) {
      input.addEventListener('click', function(event) 
      {
        const selectedInput = event.target;
        const clonedInput = selectedInput.cloneNode(true);
        inputContainer.innerHTML = '';
        inputContainer.appendChild(clonedInput);
        dropdownMenu.style.display = 'none'; // Hide the dropdown menu after selection
      });
    });
    </script>
</body>
</html>

