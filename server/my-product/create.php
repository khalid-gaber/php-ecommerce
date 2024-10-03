<?php
if($_POST) {
    $ROOT_PATH = $_SERVER['DOCUMENT_ROOT'];

    //database query string
    require($ROOT_PATH."/utility/env/DB_CONN_VARIABLES.php");

    $servername = servername;
    $dbusername = dbusername;
    $dbpassword = dbpassword;
    $dbname = dbname;

    $token = $_COOKIE['token'];
    //authenticate the user token and get the $userID
    require($ROOT_PATH."/utility/auth_token.php");
    
    //upload iamge and get the image path as $uploadedFileURL
    $target_dir = "/public/uploads/img/products/";
    $file_name = basename($_FILES["productImage"]["name"]);
    require("$ROOT_PATH/utility/upload_image.php");
    $productImage = $uploadedFileURL;

    require($_SERVER['DOCUMENT_ROOT']."/utility/clean_input.php");
    $productName = clean_input($_POST['productName']);
    $category = clean_input($_POST['category']);
    $price = clean_input($_POST['price']);
    $stock = clean_input($_POST['stock']);
    $description = clean_input($_POST['description']);

    $sql = "INSERT INTO products (productName, category, stock, price, description, userID, productImage) VALUES (:productName, :category, :stock, :price, :description, :userID, :productImage)";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':productName', $productName);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':productImage', $productImage);

        $stmt->execute();
    
        header("Location: /my-products.php");
        exit();        
    } catch(PDOException $e) {
        header("Location: /error.php?error=".$e->getMessage());
    }
    $conn = null;
}

?>