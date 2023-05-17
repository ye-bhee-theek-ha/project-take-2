<?php
    session_start();

    $current_user = $_SESSION["user_id"];
    $_SESSION["current_page"] = "profile";

    include_once "backend_boilerplate.php";
    include_once "upload.php";
    include "get_images_uploaded.php";
    require_once "scripts/script.php";
    include_once "insert_comments.php"; 
?>

<script>
    
    var upload_box_opened = false;

    function display_upload_form()
    {
        if (upload_box_opened)
        {
            remove_upload_form();
        }
        else
        {
            var form =document.getElementById("upload_form")
            form.style.display = "flex";
            upload_box_opened = true;
        }
    }
    function remove_upload_form()
    {
        var form =document.getElementById("upload_form")
        form.style.display = "none";
        upload_box_opened = false;
    }
</script>

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
                        <button class = "nav_buttons"><a class = "nav_buttons_text" onclick="display_upload_form()"> Upload Image </a></button>
                    </ul>
                </div>
        </div>
    </nav>

    <form class="from_upload" action="" method="post" enctype="multipart/form-data" id= "upload_form" 
    style="display:none;  
    position: absolute;
    top: 11vh;
    left: 57vw;
    flex-direction: column;
    align-items: center;
    padding: 10px;
    background: rgba(250, 235, 215, 0.801);;
    width: 42%;
    margin-inline-start: auto;
    border-radius: 20px;">
        <input class = "nav_buttons2" type="file" name="fileToUpload" id="fileToUpload" style="margin-bottom: 5px" required>
        <input class = "nav_buttons2" type="text" name="title" placeholder="title" style="margin-bottom: 5px" required>
        <input class = "nav_buttons2" type="text" name= "description" placeholder="desription." style="margin-bottom: 5px">
        <input class = "nav_buttons" type="submit" value="Upload Image" name="submit" style="margin-bottom: 5px">
    </form>


    <div class="row user_details_outer_container">
        <div class="d-flex col-12 col-sm-4 justify-content-center" style="position: relative;">
            <img class="profile_pic" src="<?php if (isset($_SESSION["profile_pic"])) {echo $_SESSION["profile_pic"];} ?>" alt="PROFILE PIC">
        </div>
        <div class="col-12 col-sm-8 user_info_container">
            <h2 class="user_info"><?php echo $_SESSION["user_id"]?></h2>
            <h5 class="user_info"><?php echo $_SESSION["name"]?></h3>
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
        <div class="all_images_uplaoded" id = "all_img">

        </div>
    </div>

<script src="scripts/script.js"></script>
</body>
</html>

<?php
        $_SESSION["current_page"] = "";
?>