<?php
if($_POST){

    require($_SERVER['DOCUMENT_ROOT']."/utility/env/DB_CONN_VARIABLES.php");
    
    require($_SERVER['DOCUMENT_ROOT']."/utility/clean_input.php");
    $email = clean_input($_POST['email']);
    $inputPassword = clean_input($_POST['password']);

    $sql = "SELECT userID, username, isAdmin, isTrader, password FROM users WHERE email='$email'";

    $servername = servername;
    $dbusername = dbusername;
    $dbpassword = dbpassword;
    $dbname = dbname;
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $data = $stmt->fetchAll();
        if(count($data) === 1 && password_verify($inputPassword, $data[0]['password'])) {
            $username = $data[0]['username'];
            $isAdmin = $data[0]['isAdmin'];
            $isTrader = $data[0]['isTrader'];
            
            //create token to be stored in DB
            require($_SERVER['DOCUMENT_ROOT']."/utility/createRandomToken.php");
            $token = createRandomToken();

            $userID = $data[0]['userID'];
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
            header("Location: /index.php");
            exit();
        } else {
            header("Location: /login.php?error=invalid email or password");
        }
        
    } catch(PDOException $e) {
        header("Location: /error.php?error=".$e->getMessage());
    }
    $conn = null;
} else {
    header("Location: /login.php");
}
?>