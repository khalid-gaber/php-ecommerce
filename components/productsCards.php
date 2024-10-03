<?php
//database query string
require($_SERVER['DOCUMENT_ROOT']."/utility/env/DB_CONN_VARIABLES.php");
$servername = servername;
$dbusername = dbusername;
$dbpassword = dbpassword;
$dbname = dbname;

$sql = "SELECT * FROM `products` Orders LIMIT 12";

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
$productsLength = count($products);

?>

<h1 class="text-center py-5"><?= checkLang($lang, 'our products', 'منتجاتنا'); ?></h1>

<div class="d-flex flex-wrap col-gap-3 row-gap-5 justify-content-center justify-content-md-between" >
                
    <?php foreach($products as $product) { ?>
    <div class="card border-0" style="width: 18rem;">
        <a href="/products.php?productID=<?= $product['productID'] ?>" class="card-img-top pb-2 rounded w-100" style="height: 300px;">
            <img  class="h-100 w-100" src="http://<?= $product['productImage'] ?>" class="card-img-top" alt="...">
        </a>
        <div class="card-body p-0 text-center">
            <a href="/products.php?productID=<?= $product['productID'] ?>" onmouseover="this.style.color = '#ffc107';" onmouseleave="this.style.color = 'unset';" class="card-title d-block fs-5 fw-bold text-decoration-none" style="cursor: pointer;">
                <?= $product['productName'] ?>
            </a>
            <a type="button" class="text-decoration-none link-body-emphasis">LE <?= $product['price'] ?></a>
            <div class="dropup-center dropup">
                <button class="btn btn-warning w-100 mt-1" type="button">
                    Add To Card
                </button>
            </div>
        </div>
    </div>
    <?php } ?>
</div>