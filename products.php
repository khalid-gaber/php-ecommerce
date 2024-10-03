<?php
require('utility/clean_input.php');
if(isset($_GET['productID'])) {
    $productID = clean_input($_GET['productID']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<?php include('components/head.php') ?>
</head>
<body>
    <header class="position-sticky top-0 start-0 z-1">
    <?php include('components/header.php') ?>
    </header>
    <main>
        <div class="container">


            <?php if(isset($productID)) {
                include('components/productItem.php');
            } else {
                include('components/productsCards.php');
            } ?>

        </div>
    </main>
    <footer>
    <?php include('components/footer.php') ?>
    </footer>

    <?php require('components/js-scripts.php') ?>
</body>
</html>