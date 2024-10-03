<?php
if($_POST) {
    //database query string
    require($_SERVER['DOCUMENT_ROOT']."/utility/env/DB_CONN_VARIABLES.php");

    $servername = servername;
    $dbusername = dbusername;
    $dbpassword = dbpassword;
    $dbname = dbname;

    $token = $_COOKIE['token'];
    //authenticate the user token and get the $userID
    require($_SERVER['DOCUMENT_ROOT']."/utility/auth_token.php");
    
    require($_SERVER['DOCUMENT_ROOT']."/utility/clean_input.php");
    $productID = clean_input($_POST['productID']);
    
    // make sure that user is authorize for deleting the product by userID
    $sql = "DELETE FROM `products` WHERE `products`.`productID` = '$productID' AND `products`.`userID` = '$userID'";
        
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