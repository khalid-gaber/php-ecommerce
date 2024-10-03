<?php
require($_SERVER['DOCUMENT_ROOT']."/utility/clean_input.php");

if(isset($_GET['error'])) {
    $error = clean_input($_GET['error']);
} else {
    $error = '';
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
        <div class="container text-center text-danger pt-5">
            <h1 class="pt-5">Error</h1>
            <h5 class="pt-4"><?= $error ?></h2>

        </div>
    </main>

    <?php require('components/js-scripts.php') ?>
</body>
</html>