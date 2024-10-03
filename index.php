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

            <section id="tas-home-section-1">
                <h1 class="text-center py-5">TASWAQ's Recommendation</h1>

                <?php include('components/carousal.php') ?>
                
                <div class="text-center py-5">
                    <a href="/products.php" type="button" class="btn btn-light py-2">View More Products</a>
                </div>
            </section>

            <section id="tas-home-section-2">
                <h1 class="text-center">TASWAQ's Collections</h1>
                <p class="text-center pb-3">Discover Our Product Line</p>

                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 g-4">
                    <div class="col">
                        <a type="button" class="card h-100 px-5 pt-5 text-decoration-none">
                            <img src="/public/img/t-shirt.png" class="card-img-top" alt="t-shirt">
                            <div class="card-body  text-center">
                                <h5 class="card-title">t-shirts</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a type="button" class="card h-100 px-5 pt-5 text-decoration-none">
                            <img src="/public/img/jacket.png" class="card-img-top" style="padding: 15px" alt="jacket">
                            <div class="card-body text-center">
                                <h5 class="card-title">jackets</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a type="button" class="card h-100 px-5 pt-5 text-decoration-none">
                            <img src="/public/img/suit.png" class="card-img-top" alt="suit">
                            <div class="card-body text-center">
                                <h5 class="card-title">suits</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a type="button" class="card h-100 px-5 pt-5 text-decoration-none">
                            <img src="/public/img/shoes.png" class="card-img-top" alt="shoes">
                            <div class="card-body text-center">
                                <h5 class="card-title">shoes</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a type="button" class="card h-100 px-5 pt-5 text-decoration-none">
                            <img src="/public/img/pants.png" class="card-img-top" alt="pants">
                            <div class="card-body text-center">
                                <h5 class="card-title">pants</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a type="button" class="card h-100 px-5 pt-5 text-decoration-none">
                            <img src="/public/img/watch.png" class="card-img-top" alt="watch">
                            <div class="card-body text-center">
                                <h5 class="card-title">Accessories</h5>
                            </div>
                        </a>
                    </div>

                </div>

            </section>

        </div>
    </main>
    <footer>
    <?php include('components/footer.php') ?>
    </footer>


    <?php require('components/js-scripts.php') ?>
</body>
</html>