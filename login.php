<?php
    session_start();
    $_SESSION["name"] = NULL;
    $_SESSION["user_id"] = NULL;
    $_SESSION["email"] = NULL;
    $_SESSION["phone_num"] = NULL;
    $_SESSION["password"] = NULL;
    $_SESSION["profile_pic"] = NULL;
    $_SESSION["credit_card"] = NULL;
    
    include_once "user_reg_and_validation.php";
?>

<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="style_home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


    <title>"Login/Register | Snap Society"</title>
</head>

<!-- overflow: hidden; -->
<body style="width: 100vw;" 
<?php if (isset($register_error)): ?> onload="register()" <? elseif ($login_error): ?> onload="login()" <?php endif ?>
>
    <div id = "nav_bar" style="background-color: rgba(67, 59, 56, 1);">
                <div >
                    <img class = "logo" id= "logo" src="img_assets/computer-screen.png" alt="logo" style="height: 100%;">
                </div>
                    <h6 class = "nav_bar_text" style="width: 20%;"> <a class = "nav_bar_text" href="#">Snap Society</a> </h6>
                <div style="display: flex; width: inherit; justify-content: flex-end;">
                    <ul class = "nav_buttons_list_ul" style="margin-inline-end: 1%;">
                        <button class = "nav_buttons"><a class = "nav_buttons_text" href="main_page.php"> home </a></button>
                    </ul>
                </div>
                
            </div>

    <div class = "main" style="height: 90vh;">
        <div class = "form-box">
                <div class = "button-box">
                    <div id="btn"></div>
                    <button type="button" class = "toggle-btn form_text " onclick="login()">Log in</button>
                    <button type="button" class = "toggle-btn form_text" onclick="register()">Register</button>
                </div>
                <form id = "login" class="input-group" method="POST" 
                action = "<?php 
                            //if (($login_error == NULL) && ($password_error == NULL))
                               // echo "http://localhost/project%20take%203/main_page.php";
                            //else
                                //echo "";
                           ?>">

                    <input type="text" class="input-field" placeholder="User ID" name="login[]"
                    value="<?php 
                        global $arr_login;
                        echo $arr_login[0] ?? "";
                    ?>" required>

                    <!-- css required / db err handeling -->
                    <span style="display:contents">
                        <?php 
                        global $login_error;
                        global $err_login_txt;

                        if(isset($login_error))
                        {
                            echo $err_login_txt; 
                        } 
                        ?>
                    </span>

                    <div class="password" style="cursor: default;">

                        <input type="password" class = "input-field password" id="pass1" placeholder="Password" name="login[]"
                        value="<?php 
                        global $arr_login;
                        echo $arr_login[1] ?? "";
                        ?>" required>

                         <!-- css required / db err handeling -->
                        <span style="display:contents">
                            <?php 
                            global $password_error;
                            global $err_password_txt;

                            if(isset($password_error))
                            {
                                echo $err_password_txt; 
                            } 
                            ?>
                        </span>

                        <span class="material-symbols-outlined" onclick="show_pass1()" id = "pass_icon1" style="color: antiquewhite; display: contents;">
                            visibility_off
                        </span>                   
                    </div>                    
                    <input type="checkbox" class="check-box"> <span class="form_text">Remember Password</span>
                    <button type="submit" class = "submit-btn form_text" name="submit_login">Log In</button>
                </form>
                <form id="register" class="input-group" method="POST"
                      action = "<?php 
                            //if (($register_error == NULL) && ($agreement_error == NULL))
                                //echo "http://localhost/project%20take%203/main_page.php";
                            //else
                                //echo "";
                           ?>"
                >

                    <input type="text" class="input-field" name="register[]" placeholder="Name"
                    value="<?php 
                    global $arr_register;
                    echo $arr_register[0] ?? "";
                    ?>" required>
                    
                    <!-- save previously input data and fill it again -->
                    <input type="text" class="input-field" placeholder="User ID" name="register[]"
                    value="<?php 
                    global $arr_register;
                    echo $arr_register[1] ?? "";
                    ?>" required> 

                    <!-- css required / db err handeling -->
                    <span style="display:contents">
                        <?php 
                        global $register_error;
                        global $err_userid_txt;
                        if(isset($register_error))
                        {
                            echo $err_userid_txt; 
                        } 
                        ?>
                    </span>

                    <!-- change back to email -->
                    <input type="text" class="input-field" placeholder="Email ID" name="register[]" 
                    value="<?php 
                    global $arr_register;
                    echo $arr_register[2] ?? "";
                    ?>">
                    
                    <!-- save previously input data and fill it again -->                    
                    <input type="phone_num" class="input-field" placeholder="Phone Number" name="register[]" #value="<?php 
                    global $arr_register;
                    echo $arr_register[3] ?? "";
                    ?>">

                    <div class="password" style="cursor: default;">

                        <!-- save previously input data and fill it again -->
                        <input type="password" class = "input-field password" id = "pass2" placeholder="Password" name="register[]" 
                        value="<?php 
                        global $arr_register;
                        echo $arr_register[4] ?? "";
                        ?>" required>

                        <span class="material-symbols-outlined" id = "pass_icon2" onclick="show_pass2()" style="color: antiquewhite; display: contents;">
                            visibility_off
                        </span>                   
                    </div>

                    <input type="checkbox" class="check-box" required> <span class="form_text">I agree to the terms and conditions</span>
                    <!-- css required / db err handeling -->
                    <button type="submit" class = "submit-btn form_text" name="submit_register">Register</button>
                </form>
        </div> 
    </div>

    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var k = document.getElementById("phone_num")
        var z = document.getElementById("btn");

        function register()
        {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }
        function login()
        {
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0px";
        }

        function show_pass1()
        {
            var i = document.getElementById("pass1");
            var j = document.getElementById("pass_icon1");
            if (i.type === "password") 
            {
                i.type = "text";
                j.innerHTML ="visibility";
            }
            else
            {
                i.type = "password";
                j.innerHTML = "visibility_off";
            }
        }

        
        function show_pass2()
        {
            var i = document.getElementById("pass2");
            var j = document.getElementById("pass_icon2");
            if (i.type === "password") 
            {
                i.type = "text";
                j.innerHTML ="visibility";
            }
            else
            {
                i.type = "password";
                j.innerHTML = "visibility_off";
            }
        }

    </script>
</body>
</html>