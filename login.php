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

            <form class="row g-3 mx-auto pt-5" action="server/auth/login.php" method="POST">
                <h1 class="text-center pb-5">sign in</h1>
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="inputEmail4" required>
                </div>
                <div class="col-12">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword4" required>
                </div>
                <p class="text-danger"><?= $error ?></p>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
                <a href="/register.php">don't have an account? register</a>
            </form>
        </div>
    </main>

    <?php require('components/js-scripts.php') ?>
</body>
</html>