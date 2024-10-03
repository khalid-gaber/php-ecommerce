<?php

$ROOT_PATH = $_SERVER['DOCUMENT_ROOT'];

$newFileName = time()."-".$file_name;
$destPath = $ROOT_PATH.$target_dir.$newFileName;
$uploadOk = 1;
$imageFileExtention = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["productImage"]["tmp_name"]);
if($check === false) {
    header("Location: /error.php?error=File is not an image.");
    exit();
}
    
// Check file size
if ($_FILES["productImage"]["size"] > 500000) {
    header("Location: /error.php?error=Sorry, your file is too large.");
    exit();
}

// Allow certain file formats
if($imageFileExtention != "jpg" && $imageFileExtention != "png" && $imageFileExtention != "jpeg"
&& $imageFileExtention != "gif" && $imageFileExtention != "jfif") {
    header("Location: /error.php?error=Sorry, only JPG, JPEG, jfif, PNG & GIF files are allowed.");
    exit();
}

// Check if $uploadOk is set to 0 by an error
if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $destPath)) {
    $uploadedFileURL = $_SERVER['SERVER_NAME'].$target_dir.$newFileName;
} else {
    header("Location: /error.php?error=Sorry, there was an error uploading your file.");
    exit();
}

?>