<?php
include "backend_boilerplate.php";

session_start();

//make an input named current comments

$user_id = $_SESSION[$user_id];
$photo_id = $_POST[$photo_id];
$comment = $_POST[$comment];
$total_comments = $_POST[$total_comments];



$sql = "INSERT INTO `comments` (`comment_id`, `user_id`, `comment`, `photo_id`, date) VALUES (NULL, '{$user_id}', '{$comment}', '{$photo_id}', NULL);";

mysqli_query($conn, $sql);


$sql_increment_comments = "UPDATE `images` SET `total_comments` = '{$total_comments}'
WHERE `images`.`photo_id` = '{$photo_id}';";

mysqli_query($conn, $sql_increment_comments);


?>