<?php
    $token = $_COOKIE['token'];
    //database query string
    require($_SERVER['DOCUMENT_ROOT']."/utility/env/DB_CONN_VARIABLES.php");
    
    $servername = servername;
    $dbusername = dbusername;
    $dbpassword = dbpassword;
    $dbname = dbname;

    $sql = "DELETE FROM `tokens` WHERE `token` = '$token'";
        
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        //deleting all cookies
        require($_SERVER['DOCUMENT_ROOT']."/utility\deleteAllCookies.php");
        deleteAllCookies();
        header("Location: /login.php");
        exit();        
    } catch(PDOException $e) {
        header("Location: /error.php?error=".$e->getMessage());
    }
    $conn = null;

?>