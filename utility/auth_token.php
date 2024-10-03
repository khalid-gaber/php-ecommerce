<?php
$sql = "SELECT * FROM `tokens` WHERE token='$token'";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $data = $stmt->fetchAll();
    if($data[0]['userID']) {
        $userID = $data[0]['userID'];
    } else {
        header("Location: /error.php?error=you don't have the permission for this process");
    }
    
} catch(PDOException $e) {
    header("Location: /error.php?error=".$e->getMessage());
}
$conn = null;

?>