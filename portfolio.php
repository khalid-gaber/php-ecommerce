<?php 
if(isset($_COOKIE['token'])) {
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

    $sql = "SELECT * FROM `users` WHERE userID='$userID'";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
        $data = $stmt->fetchAll();
        $user = $data[0]; 
    } catch(PDOException $e) {
        header("Location: /error.php?error=".$e->getMessage());
    }
    $conn = null;
    
} else {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include('components/head.php') ?>
<?php 
     ?>
</head>
<body>
    <div class="content-container">
        <header>
        <?php include('components/header.php') ?>
        </header>
        <main>
            <div class="container d-flex">
                <form class="row g-3 mx-auto pt-5" action="server/auth/register.php" method="POST">
                    <div class="text-center pb-5">
                        <h1><?= $user['username']; ?></h1>
                        <span class="text-success"><?php if($user['isTrader']) {echo "TRADER";} ?></span>
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control-plaintext border px-2" id="inputEmail4" name="email" readonly value="<?= $user['email'] ?>">
                    </div>
                    <div class="col-md-12">
                        <label for="inputZip" class="form-label">phone</label>
                        <input type="phone" class="form-control-plaintext border px-2" id="inputZip" name="phone" readonly value="<?= $user['phone'] ?>">
                    </div>
                </form>
            </div>
        </main>
    </div>

    <?php require('components/js-scripts.php') ?>
</body>
</html>