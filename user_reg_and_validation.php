<?php
require_once "backend_boilerplate.php";  //used for connection


if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    print_r($_REQUEST);

    $arr_login = array();
    $arr_register = array();

    // errors
    $login_error = NULL;
    $password_error = NULL;

    $register_error = NULL;
    $agreement_error = NULL;

    $err_userid_txt = NULL;
    $err_aggrement_text = NULL;

    $err_login_txt = NULL;
    $err_password_txt = NULL;


    
    if (isset($_POST['submit_login'])) 
    {
        echo "logging in";
        login();
    }

    if (isset($_POST['submit_register'])) 
    {
        echo "registering data";
        register();
    }

    // once it has been set we reset it to null so it does not submit prematurely
    $_POST['submit_login'] = null;
    $_POST['submit_register'] = null;
}


//functions
function login()
{
    // importing variable to function
    global $arr_login;
    global $conn;  
    global $login_error;
    global $err_login_txt;
    global $password_error;
    global $err_password_txt;

    // getting submitted details in arr_login
    $arr_login = $_POST["login"];

    $user_exists = "SELECT * FROM users WHERE user_id='$arr_login[0]'";
    $user_exists_result = mysqli_query($conn, $user_exists);
    
    // if user does not exist
    if(mysqli_num_rows($user_exists_result) == 0) 
    {  
        $login_error = true;
        $err_login_txt = "having trouble finding you.";
    }
    // if exists
    else
    {
        $correct_pass = "SELECT * FROM users WHERE user_id='$arr_login[0]' AND users.password='$arr_login[1]'";
        $correct_pass_result = mysqli_query($conn, $correct_pass);

        // if password is not correct
        if(mysqli_num_rows($correct_pass_result) == 0)
        {
            $password_error = true;
            $err_password_txt = "wrong password.";
        }
        // if correct
        else
        {
            $_SESSION["user_id"] = $arr_login[0];

            // setting profile pic if any
            $profile_pic_exists = "SELECT * FROM users WHERE user_id='$arr_login[0]'";
            $profile_pic_exists_result = mysqli_query($conn, $user_exists);

            // if user does not exists
            if(mysqli_num_rows($profile_pic_exists_result) == 0)
            {
                $_SESSION["profile_pic"] = NULL;
            }
            // if exists
            else
            {
                $row = mysqli_fetch_assoc($profile_pic_exists_result);
                
                // setting session variables for use in other pages so we do not have to find in database every time.
                $_SESSION["name"] = $row["name"];
                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["phone_num"] = $row["phone_num"];
                $_SESSION["credit_card"] = $row["credit_card"];

                // if profile pic is set
                if (isset($row["profile_pic"]))
                {
                    $_SESSION["profile_pic"] = $row["profile_pic"];
                }
                // if not
                else
                {
                    $_SESSION["profile_pic"] = NULL;
                }
                
                //redirecting to main page
                $url = "http://localhost/project%20take%203/main_page.php";
                redirect($url);
            }

            
        }
    }
}

function register()
{
    // importing variable to function

    global $conn;   
    global $arr_register;
    global $register_error;
    global $err_userid_txt;

    // at start setting all errors to false
    $register_error = false;

    // all details of submitted form in arr_register
    $arr_register = $_POST["register"];

    $user_exists = "SELECT * FROM users WHERE user_id='$arr_register[1]'";  //arr_register[1] = userid
    $user_exists_result = mysqli_query($conn, $user_exists);
    
    // name already exists
    if(mysqli_num_rows($user_exists_result) > 0) 
    {  
        $register_error = true;
        $err_userid_txt = "Sorry... username already taken";
    }
    // new user
    else
    {
        $sql = "INSERT INTO users(name, user_id, phone_num, email, password)
        VALUES ('$arr_register[0]', '$arr_register[1]', '$arr_register[2]', '$arr_register[3]', '$arr_register[4]')";
        mysqli_query($conn , $sql);

        // setting session variables for use in other pages so we do not have to find in database every time.
        $_SESSION["name"] = $arr_register[0];
        $_SESSION["user_id"] = $arr_register[1];
        $_SESSION["email"] = $arr_register[2];
        $_SESSION["phone_num"] = $arr_register[3];

        //redirecting to main page
        $url = "http://localhost/project%20take%203/profile_page.php";
        redirect($url);


    }
}   

?>