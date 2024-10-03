<?php
//database query string
require($_SERVER['DOCUMENT_ROOT']."/utility/env/DB_CONN_VARIABLES.php");

$sql = "SELECT * FROM `products` Orders LIMIT 12";

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
} catch(PDOException $e) {
    header("Location: /error.php?error=".$e->getMessage());
}
$conn = null;

$products = $data;
$productTurn = 0;
$productsLength = count($products);

function checkProductTurn(&$prodTurn, $prodLength) {
    if($prodTurn >= $prodLength) {
        $prodTurn = 0;
    }
}

?>

<?php  ?>
<!-- --------------for xl(>1200px)--------------- -->
<div id="tas-carousel-xl-4" class="carousel slide tas-4" data-bs-ride="carousel">
    <div class="carousel-inner">

        <?php for ($x = 0; $x < 3; $x++) { ?>
        <div class="carousel-item <?php if($x===0){echo 'active';} ?>">

            <?php for ($y = 0; $y < 4; $y++) {
                checkProductTurn($productTurn, $productsLength);
            ?>
            <div class="card border-0" style="width: 18rem;">
                <a href="/products.php?productID=<?= $products[$productTurn]['productID'] ?>" class="card-img-top pb-2 rounded w-100" style="height: 300px;">
                    <img class="h-100 w-100" src="http://<?= $products[$productTurn]['productImage'] ?>" alt="...">
                </a>
                <div class="card-body p-0 text-center">
                    <a href="/products.php?productID=<?= $products[$productTurn]['productID'] ?>" class="card-title d-block fs-5 fw-bold text-decoration-none" href="">
                        <?= $products[$productTurn]['productName'] ?>
                    </a>
                    <a type="button" class="text-decoration-none link-body-emphasis">LE <?= $products[$productTurn]['price'] ?></a>
                    <div class="dropup-center dropup">
                        <button class="btn btn-warning w-100 mt-3" type="button">
                            Add To Card
                        </button>
                    </div>
                </div>
            </div>
            <?php 
                $productTurn++;
                } 
            ?>

        </div>
        <?php } ?>

    </div>

    <div class="carousel-control-left" type="button" data-bs-target="#tas-carousel-xl-4" data-bs-slide="prev">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>
    </div>
    <div class="carousel-control-right" type="button" data-bs-target="#tas-carousel-xl-4" data-bs-slide="next">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
        </svg>
    </div>
</div>
<!-- ----------\\\\for xl(>1200px)////----------- -->


<!-- --------------for lg(992px-1200px)--------------- -->
<div id="tas-carousel-lg-3" class="carousel slide tas-3" data-bs-ride="carousel">
    <div class="carousel-inner">

        <?php for ($x = 0; $x < 4; $x++) { ?>
        <div class="carousel-item <?php if($x===0){echo 'active';} ?>">

            <?php for ($y = 0; $y < 3; $y++) {
                checkProductTurn($productTurn, $productsLength);
            ?>
            <div class="card border-0" style="width: 18rem;">
                <a href="/products.php?productID=<?= $products[$productTurn]['productID'] ?>" class="card-img-top pb-2 rounded w-100" style="height: 300px;">
                    <img class="h-100 w-100" src="http://<?= $products[$productTurn]['productImage'] ?>" alt="...">
                </a>
                <div class="card-body p-0 text-center">
                    <a href="/products.php?productID=<?= $products[$productTurn]['productID'] ?>" class="card-title d-block fs-5 fw-bold text-decoration-none" href="">
                        <?= $products[$productTurn]['productName'] ?>
                    </a>
                    <a type="button" class="text-decoration-none link-body-emphasis">LE <?= $products[$productTurn]['price'] ?></a>
                    <div class="dropup-center dropup">
                        <button class="btn btn-warning w-100 mt-3" type="button">
                            Add To Card
                        </button>
                    </div>
                </div>
            </div>
            <?php 
                $productTurn++;
                } 
            ?>

        </div>
        <?php } ?>

    </div>

    <div class="carousel-control-left" type="button" data-bs-target="#tas-carousel-lg-3" data-bs-slide="prev">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>
    </div>
    <div class="carousel-control-right" type="button" data-bs-target="#tas-carousel-lg-3" data-bs-slide="next">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
        </svg>
    </div>
</div>
<!-- ----------\\\\for lg(992px-1200px)////----------- -->


<!-- --------------for md(768px-992px)--------------- -->
<div id="tas-carousel-md-2" class="carousel slide tas-2" data-bs-ride="carousel">
    <div class="carousel-inner">

        <?php for ($x = 0; $x < 6; $x++) { ?>
        <div class="carousel-item <?php if($x===0){echo 'active';} ?>">

            <?php for ($y = 0; $y < 2; $y++) {
                checkProductTurn($productTurn, $productsLength);
            ?>
            <div class="card border-0" style="width: 18rem;">
                <a href="/products.php?productID=<?= $products[$productTurn]['productID'] ?>" class="card-img-top pb-2 rounded w-100" style="height: 300px;">
                    <img class="h-100 w-100" src="http://<?= $products[$productTurn]['productImage'] ?>" alt="...">
                </a>
                <div class="card-body p-0 text-center">
                    <a href="/products.php?productID=<?= $products[$productTurn]['productID'] ?>" class="card-title d-block fs-5 fw-bold text-decoration-none" href="">
                        <?= $products[$productTurn]['productName'] ?>
                    </a>
                    <a type="button" class="text-decoration-none link-body-emphasis">LE <?= $products[$productTurn]['price'] ?></a>
                    <div class="dropup-center dropup">
                        <button class="btn btn-warning w-100 mt-3" type="button">
                            Add To Card
                        </button>
                    </div>
                </div>
            </div>
            <?php 
                $productTurn++;
                } 
            ?>

        </div>
        <?php } ?>

    </div>

    <div class="carousel-control-left" type="button" data-bs-target="#tas-carousel-md-2" data-bs-slide="prev">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>
    </div>
    <div class="carousel-control-right" type="button" data-bs-target="#tas-carousel-md-2" data-bs-slide="next">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
        </svg>
    </div>
</div>
<!-- ----------\\\\for md(768px-992px)////----------- -->


<!-- --------------for sm(<768px)--------------- -->
<div id="tas-carousel-sm-1" class="carousel slide tas-1" data-bs-ride="carousel">
    <div class="carousel-inner">

        <?php for ($y = 0; $y < 12; $y++) {
            checkProductTurn($productTurn, $productsLength);
        ?>
        <div class="carousel-item <?php if($y===0){echo 'active';} ?>">

            <div class="card border-0" style="width: 18rem;">
                <a href="/products.php?productID=<?= $products[$productTurn]['productID'] ?>" class="card-img-top pb-2 rounded w-100" style="height: 300px;">
                    <img class="h-100 w-100" src="http://<?= $products[$productTurn]['productImage'] ?>" alt="...">
                </a>
                <div class="card-body p-0 text-center">
                    <a href="/products.php?productID=<?= $products[$productTurn]['productID'] ?>" class="card-title d-block fs-5 fw-bold text-decoration-none" href="">
                        <?= $products[$productTurn]['productName'] ?>
                    </a>
                    <a type="button" class="text-decoration-none link-body-emphasis">LE <?= $products[$productTurn]['price'] ?></a>
                    <div class="dropup-center dropup">
                        <button class="btn btn-warning w-100 mt-3" type="button">
                            Add To Card
                        </button>
                    </div>
                </div>
            </div>

        </div>
        <?php 
            $productTurn++;
            } 
        ?>

    </div>

    <div class="carousel-control-left" type="button" data-bs-target="#tas-carousel-sm-1" data-bs-slide="prev">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>
    </div>
    <div class="carousel-control-right" type="button" data-bs-target="#tas-carousel-sm-1" data-bs-slide="next">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
        </svg>
    </div>
</div>
<!-- ----------\\\\for sm(<768px)////----------- -->

