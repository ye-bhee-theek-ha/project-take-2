<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "photo_share";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    //checking connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

    // // creating database
    // $create_database = "Create DATABASE DBProject";
    // mysqli_query($conn,$create_database);


    // // users table
    // try {
    //     $users = "CREATE TABLE users
    //     (
    //         name varchar(255) not null,
    //         user_id varchar(255) not null,
    //         phone_num int,
    //         email varchar(255),
    //         password varchar(255) not null,
    //         profile_pic varchar(255), 
    //         credit_card int,
    //         cvv int,
    //         description varchar(255),

    //         Primary key(user_id)
    //     );"; 
    //     mysqli_query($conn,$users);
    // }
    // catch (mysqli_sql_exception $e) { 
    //     print_r($e);
    //     exit; 
    // } 
    
    // // friends table
    // try {
    //     $friends = "CREATE TABLE friends 
    //     (
    //         user_id varchar(255),
    //         friend_id varchar(255) not null,

    //         primary key(user_id)
    //     );";
    //     mysqli_query($conn,$friends);
    // }
    // catch (mysqli_sql_exception $e) { 
    //     print_r($e);
    //     exit; 
    // } 


    // // images table
    // try {
    //     $images = "CREATE TABLE images
    //     (
    //         photo_id int,
    //         user_id varchar(255) not null,
    //         title varchar(255),
    //         description varchar(255),
    //         resolution int,
    //         size int,
    //         price int,
    //         upload_date date not null,
    //         total_likes int not null, 
    //         total_comments int not null,
    //         path varchar(255),

    //         primary key(photo_id)
    //     );";
    //     mysqli_query($conn,$images);
    // }
    // catch (mysqli_sql_exception $e) {
    //     print_r($e);
    //     exit; 
    // }



?>