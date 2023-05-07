<?php
    session_start();
    include_once "upload.php";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_home.css">
    <link rel="stylesheet" href="style_profile_page.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>"Snap Society"</title>
</head>

<body onload="display_all_images()">

    <nav class="navbar, navbar-expand-sm, fixed-top">
        <div id = "nav_bar" class = "container-fluid" style="background-color: rgba(67, 59, 56, 1);">
                <div >
                    <img class = "img-fluid h-100 d-none d-md-flex" id= "logo" src="img_assets/computer-screen.png" alt="logo">
                </div>
                    <h6 class = "nav_bar_text text-center col-md-2" > <a class = "nav_bar_text" href="#">Snap Society</a> </h6>
                <div class = "col-md-9 d-flex" style="display: flex">
                    <ul class = "nav_buttons_list_ul">
                        <!-- image upload -->
                        <button class = "nav_buttons"><a class = "nav_buttons_text" href="main_page.php"> Home </a></button>
                        <button class = "nav_buttons"><a class = "nav_buttons_text" href="upload.php"> Upload Image </a></button>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <input type="text" name="title" placeholder="title">
                            <input type="text" name= "description" placeholder="desc.">
                            <input type="submit" value="Upload Image" name="submit">
                        </form>
                    </ul>
                </div>
        </div>
    </nav>


    <div class="row user_details_outer_container">
        <div class="d-flex col-12 col-sm-4 justify-content-center" style="position: relative;">
            <img class="profile_pic" src="<?php if (isset($_SESSION["profile_pic"])) {echo $_SESSION["profile_pic"];} ?>" alt="PROFILE PIC">
        </div>
        <div class="col-12 col-sm-8 user_info_container">
            <h2 class="user_info"><?php echo $_SESSION["user_id"]?></h2>
            <h5 class="user_info"><?php echo $_SESSION["name"]?></h3>
            <p class="user_info">some very long quote or some description some very long quote or some description</p>
            <!-- profile upload -->
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload profile" name="submit">
            </form>
        </div>
    </div>

    <div class="img_data_container" style="width: 100%;">
        <div class="image_button">

        </div>
        <div class="all_images_uplaoded">
            <img class="image_uplaoded" src="images/Wallpaper - 1.jpg" alt="">
            <img class="image_uplaoded" src="images/Wallpaper - 2.jpg" alt="">
            <img class="image_uplaoded" src="images/Wallpaper - 3.jpg" alt="">
            <img class="image_uplaoded" src="images/Wallpaper - 4.jpg" alt="">
            <img class="image_uplaoded" src="images/Wallpaper - 5.jpg" alt="">
            <img class="image_uplaoded" src="images/Wallpaper - 6.jpg" alt="">
            <img class="image_uplaoded" src="images/Wallpaper - 7.jpg" alt="">
            <img class="image_uplaoded" src="images/Wallpaper - 8.jpg" alt="">
            <img class="image_uplaoded" src="images/Wallpaper - 9.jpg" alt="">
            <img class="image_uplaoded" src="images/Wallpaper - 10.jpg" alt="">
            <img class="image_uplaoded" src="images/Wallpaper - 15.jpg" alt="">
            <img class="image_uplaoded" src="images/Wallpaper - 16.jpg" alt="">
            <img class="image_uplaoded" src="images/Wallpaper - 19.jpg" alt="">
            <img class="image_uplaoded" src="images/Wallpaper - 22.jpg" alt="">
        </div>
    </div>

    <?php
    print_r($_SESSION);
    ?>    
<script src="scripts/script.js"></script>
</body>
</html>