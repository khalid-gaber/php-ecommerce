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
    
    //clean inputs
    require($_SERVER['DOCUMENT_ROOT']."/utility/clean_input.php");
    
    if(isset($_FILES["productImage"]) && $_FILES["productImage"]['size']) {
        //upload the new image then get the new product path as $uploadedFileURL
        $target_dir = "/public/uploads/img/products/";
        $file_name = basename($_FILES["productImage"]["name"]);
        require($ROOT_PATH."/utility/upload_image.php");
        $productImage = $uploadedFileURL;
    } else {
        $productImage = clean_input($_POST['currentProductImage']);
    }
    
    $productID = clean_input($_POST['productID']);
    $productName = clean_input($_POST['productName']);
    $category = clean_input($_POST['category']);
    $price = clean_input($_POST['price']);
    $stock = clean_input($_POST['stock']);
    $description = clean_input($_POST['description']);

    // make sure that user is authorize for deleting the product by userID
    $sql = "UPDATE `products` SET `productName` = '$productName', `category` = '$category', `stock` = '$stock', `price` = '$price', `description` = '$description', `productImage` = '$productImage' WHERE `products`.`productID` = '$productID' AND `products`.`userID` = '$userID'";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            header("Location: /my-products.php");
        } else {
            header("Location: /error.php?error=non authorized");
        }
        exit();        
    } catch(PDOException $e) {
        header("Location: /error.php?error=".$e->getMessage());
    }
    $conn = null;
}

?>