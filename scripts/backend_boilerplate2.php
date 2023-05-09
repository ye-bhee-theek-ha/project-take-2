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

    function debug_to_console2($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
?>