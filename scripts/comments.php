<?php
    include "backend_boilerplate2.php";

    $photo_id = json_decode(file_get_contents("php://input"), true);

    debug_to_console("$photo_id");


    $sql = "SELECT * FROM `comments` where photo_id = '{$photo_id}'";
    $sql_result = mysqli_query($conn, $sql);

    $total_comments = mysqli_num_rows($sql_result);

    $_SESSION["total_comments"] = $total_comments;

    $array = array();

    for ($i = 0; $i < $total_comments; $i++)
    {
        array_push($array[$i], (mysqli_fetch_assoc($sql_result)));
    }

?>