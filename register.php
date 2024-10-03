<?php
if(isset($_COOKIE['token'])) {
    header("Location: /index.php");
    exit();
}

if(isset($_GET['error'])) {
    $error = $_GET['error'];
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
    <header>
    <?php include('components/header.php') ?>
    </header>
    <main>
        <div class="container d-flex">
            <form class="row g-3 mx-auto pt-5" action="server/auth/register.php" method="POST">
                <h1 class="text-center pb-5">Register</h1>
                <div class="col-md-6">
                    <label for="inputtext" class="form-label">username</label>
                    <input type="text" class="form-control" id="inputtext" name="username">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" name="email">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" name="password">
                </div>
                <div class="col-md-4">
                    <label for="inputCity" class="form-label">Country</label>
                    <input type="text" class="form-control" id="inputCity" name="country">
                </div>

                <div class="col-md-8">
                    <label for="inputZip" class="form-label">phone</label>
                    <input type="phone" class="form-control" id="inputZip" name="phone">
                </div>
                <div class="col-12">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" name="isTrader">
                    <label class="form-check-label" for="gridCheck">
                        register as a trader
                    </label>
                </div>
                <p class="text-success" style="font-size: .8em;">
                    if you want to view products for buying it, register as trader
                </p> 
                </div>
                <p class="text-danger"><?= $error ?></p>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Sign up</button>
                </div>
                <a href="/login.php">have an account? login</a>
            </form>



        </div>
    </main>
    <?php require('components/js-scripts.php') ?>
</body>
</html>