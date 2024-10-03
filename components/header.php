<?php 
if(isset($_COOKIE['lang']) && $_COOKIE['lang'] === 'ar') {
    $lang = "ar";
  } else {
    $lang = "en";
  }

function is_active($pattern) {
    if(preg_match($pattern, $_SERVER['REQUEST_URI'])){
        return 'active';
    } else {
        return '';
    }
}
//language checker
require($_SERVER['DOCUMENT_ROOT']."/utility/checkLang.php");

?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <div class="navbar-toggler border-0" style="flex: 1">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">

            <div class="offcanvas-header bg-warning">
                    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Backdrop with scrolling</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="navbar-nav align-items-start">
                    <ul class="navbar-nav align-items-start gap-1">
                        <li class="nav-item">
                            <a class="p-1 btn btn-light nav-link <?= is_active('/\/(index.php)?$/');?>" href="/index.php"><?= checkLang($lang, 'home', 'الرئيسيه'); ?></a>
                        </li>
                        <li class="nav-item ">
                            <a class="p-1 btn btn-light nav-link <?= is_active('/\/portfolio.php$/');?>" href="/portfolio.php"><?= checkLang($lang, 'portfolio', 'حسابي'); ?></a>
                        </li>
                        <li class="nav-item ">
                            <a class="p-1 btn btn-light nav-link <?= is_active('/\/products\.php(\/)?/');?>" href="/products.php"><?= checkLang($lang, 'Browse Products', 'تصفح المنتجات'); ?></a>
                        </li>

                        <?php if(isset($_COOKIE['isTrader']) && $_COOKIE['isTrader'] == 1) {?>
                        <li class="nav-item ">
                            <a class="p-1 btn btn-light nav-link <?= is_active('/\/my-products.php$/');?>" href="/my-products.php"><?= checkLang($lang, 'my products', 'اداره منتجاتي'); ?></a>
                        </li>
                        <?php } ?>

                    </ul>
                </div>
            </div>


        </div>

        <div class='logo'>
            <div class="offcanvas">
                <div class="border border-2 rounded-circle px-3 py-3">
                    <i class="fa-solid fa-caret-up fa-2xl border " style="font-size: 3em;"></i>
                </div>
            </div>
            <div class="navbar-toggler d-none d-lg-none d-sm-block">
                <div>TASWAQ</div>
            </div>
        </div>



        <div class="d-flex justify-content-end" style="flex: 1">

            <div class="d-flex">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= checkLang($lang, 'lang', 'اللغه'); ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><button id="en-toggler" class="dropdown-item">english</button></li>
                            <li><button id="ar-toggler" class="dropdown-item">عربي</button></li>
                        </ul>
                    </div>

                    <button id="dark-toggler" style="display: none;" type="button" class="rounded-circle mx-3 btn btn-dark btn-sm" href="">
                        <i class="fa-regular fa-moon" style="padding: 2px"></i>
                    </button>
                    <button id="light-toggler" style="display: none;" type="button" class="rounded-circle mx-3 btn btn-light btn-sm" href="">
                        <i class="fa-regular fa-sun"></i>
                    </button>
                    <a class="py-1 px-2 link-body-emphasis nav-link" href="">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>

                    <?php if(isset($_COOKIE['username'])) {?>
                    <a class="py-1 px-2 link-body-emphasis nav-link" href="/portfolio.php">
                        <div class="px-2 border rounded-circle border-success text-success-emphasis"><?= $_COOKIE['username'][0] ?></div>
                    </a>
                    <a type="button" class="py-1 px-2 btn btn-danger" href="/server/auth/logout.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                    <?php } else { ?>
                    <a class="py-1 px-2 link-body-emphasis nav-link" href="/login.php">
                        <i class="fa-regular fa-user"></i>
                    </a>
                    <?php } ?>

            </div>

        </div>
    </div>
</nav>
