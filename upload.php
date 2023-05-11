<?php
$uploadOk = 1;
$user = $_SESSION["user_id"];


// Check if image file is a actual image or fake image

if(isset($_POST["submit"])) 
{
  if ($_POST["submit"] == "Upload profile")
  {
    $target_dir = "uploads/profile_pics/";
  }
  elseif ($_POST["submit"] == "Upload Image")
  {
    $target_dir = "uploads/";
  }
  else
  {
    die(); 
  }

  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) 
    {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }

  // Check if file already exists
  if (file_exists($target_file) && ($_POST["submit"] == "Upload Image")) 
  {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } 
  else
  {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))  //uploading
    {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

      include "backend_boilerplate.php";  //to updating database
      global $conn;

      if ($_POST["submit"] == "Upload profile")   // checking if profile pic is uploading (target file is the actual path of image stored)
      {
        $sql = "UPDATE users 
        SET 
            profile_pic = '$target_file'
        WHERE 
            user_id = '$user';
        ";
        mysqli_query($conn , $sql);
        $_SESSION["profile_pic"] = $target_file;    // changing the vale in session variable for instant change
      }
      if ($_POST["submit"] == "Upload Image")   // checking if other pic is uploading
      {
        // collecting image details
              //photoid = auto increment
              //userid = user
              $title = $_POST["title"];
              $description = $_POST["description"];

                $image_info = getimagesize($target_file);
                $image_width = $image_info[0];
                $image_height = $image_info[1];
                $resoultion = $image_width . "by" . $image_height;

              $size = $_FILES["fileToUpload"]["size"];
              //date = current
              $total_likes;
              $total_comments;
        
        // adding to database
        $sql = "INSERT INTO `images` (`photo_id`, `user_id`, `title`, `description`, `resolution`, `size`, `total_likes`, `total_comments`, `path`)
                VALUES (NULL, '$user', '$title', '$description', '$resoultion', '$size', '0', '0', '$target_file');";

        mysqli_query($conn , $sql);
      }
    }
    else 
    {
      echo "Sorry, there was an error uploading your file.";
    }
  }

}


