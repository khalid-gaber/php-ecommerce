<?php

//database query string
require($_SERVER['DOCUMENT_ROOT']."/utility/env/DB_CONN_VARIABLES.php");
$servername = servername;
$dbusername = dbusername;
$dbpassword = dbpassword;
$dbname = dbname;

$sql = "SELECT users.username, products.productID, products.productName, 
        products.category, products.stock, products.price, products.reviews, 
        products.description, products.productImage
        FROM products
        INNER JOIN users ON products.userID=users.userID
        WHERE products.productID = '$productID'";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $data = $stmt->fetchAll();
} catch(PDOException $e) {
    header("Location: /error.php?error=".$e->getMessage());
}
$conn = null;

$products = $data;

?>

<div class="card my-5" >
    <div class="row g-0">
        <div class="col-md-6">
            <img src="http://<?= $products[0]['productImage']; ?>" class="img-fluid w-100 rounded-start" alt="...">
        </div>
        <div class="col-md-6">
            <div class="card-body">
                <h2 class="text-success text-center">by <?= $products[0]['username']; ?></h2>
                <h2 class="card-title pb-0"><?= $products[0]['productName']; ?></h2>
                <h5 class="text-warning"><?= $products[0]['price']; ?> L.E</h5>
                <hr>
                <h4>Details</h4>
                <p class="card-text"><?= $products[0]['description']; ?></p>
                <form class="row row-gap-2">
                    <div class="col-4">
                        <input type="number" value="1" class="w-100 form-control">
                    </div>
                    <div class="col-8">
                        <button type="button" class="w-100 btn btn-warning">
                            Add To Card
                        </button>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="w-100 btn btn-primary">
                            Buy It Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>