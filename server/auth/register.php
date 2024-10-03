<?php
if($_POST){
    //database query string
    require($_SERVER['DOCUMENT_ROOT']."/utility/env/DB_CONN_VARIABLES.php");
    
    $servername = servername;
    $dbusername = dbusername;
    $dbpassword = dbpassword;
    $dbname = dbname;

    require($_SERVER['DOCUMENT_ROOT']."/utility/clean_input.php");
    $email = clean_input($_POST['email']);
    $inputPassword = clean_input($_POST['password']);
    // hashing password
    $hashedPassword = password_hash($inputPassword, PASSWORD_BCRYPT);
    $username = clean_input($_POST['username']);
    $phone = clean_input($_POST['phone']);
    // $isTrader = clean_input($_POST['isTrader']);
    if(isset($_POST['isTrader']) && clean_input($_POST['isTrader']) === 'on') {
        $isTrader = 1;
    } else {
        $isTrader = 0;
    }

    $sql = "INSERT INTO `users` (`email`, `password`, `username`, `phone`, `isTrader`) VALUES (:email, :password, :username, :phone, :isTrader)";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':isTrader', $isTrader);
        $stmt->execute();
    
        $userID = $conn->lastInsertId();

        if(isset($userID)) {            
            //create token to be stored in DB
            require($_SERVER['DOCUMENT_ROOT']."/utility/createRandomToken.php");
            $token = createRandomToken();

            $stmt = $conn->prepare("INSERT INTO `tokens` (`token`, `userID`) VALUES (:token, :userID)");
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':userID', $userID);          
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
            setcookie(
                "token", $token,
                [
                    "expires" => time() + (86400 * 30),
                    "path" => "/",
                    "httponly" => true,
                    "samesite" => "Strict"
                ]
            );            
            setcookie('username', $username, time() + (86400 * 30), "/");
            setcookie('isAdmin', $isAdmin, time() + (86400 * 30), "/");
            setcookie('isTrader', $isTrader, time() + (86400 * 30), "/");
            header("Location: /portfolio.php");
            exit();
        } else {
            header("Location: /error.php?error=something went wrong");
        }
        exit();
    } catch(PDOException $e) {
        header("Location: /register.php?error=".$e->getMessage());
    }
    $conn = null;
} else {
    header("Location: /login.php");
}
?>