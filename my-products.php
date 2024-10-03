<?php
///////////////////to be edites to more secure///////////
if(isset($_COOKIE['token']) && $_COOKIE['isTrader'] == 1) {
    $token = $_COOKIE['token'];
}
//database query string
require($_SERVER['DOCUMENT_ROOT']."/utility/env/DB_CONN_VARIABLES.php");

$servername = servername;
$dbusername = dbusername;
$dbpassword = dbpassword;
$dbname = dbname;

//authenticate the user token and get the $userID
require($_SERVER['DOCUMENT_ROOT']."/utility/auth_token.php");

$sql = "SELECT * FROM `products` WHERE userID='$userID'";

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
        <div class="container py-5">
            <?php if(count($data) > 0) { ?>
            <table id="products" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">img</th>
                        <th scope="col">name</th>
                        <th scope="col">cat</th>
                        <th scope="col">stock</th>
                        <th scope="col">price</th>
                        <!-- <th scope="col"></th> -->
                    </tr>
                </thead>
                <tbody>

                <?php foreach($data as $product){ ?>
                    <tr class="">
                        <td style="vertical-align: middle;">
                            <div class="" style="height: 50px;">
                                <img src="http://<?= $product['productImage'] ?>" class="productImage h-100 img-fluid rounded-start" alt="...">
                            </div>
                        </td>
                        <td class="productName" style="vertical-align: middle;">
                            <?= $product['productName'] ?>
                        </td>
                        <td class="category" style="vertical-align: middle;">
                            <?= $product['category'] ?>
                        </td>
                        <td class="stock" style="vertical-align: middle;">
                            <?= $product['stock'] ?>
                        </td>
                        <td class="price" style="vertical-align: middle;">
                            <?= $product['price'] ?>
                        </td>
                        <td class="productID" style="display: none;">
                            <?= $product['productID'] ?>
                        </td>
                        <td class="description" style="display: none;">
                            <?= $product['description'] ?>
                        </td>

                        <td class="float-td align-items-center h-100" style="<?= checkLang($lang, 'right', 'left'); ?>: 0;">
                            <div class="d-flex gap-1">
                                <i type="button" class="fa-solid fa-pen btn btn-secondary btn-sm d-flex align-items-center p-1" data-bs-toggle="modal" data-bs-target="#editProduct"></i>
                                <i type="button" class="fa-solid fa-trash btn btn-danger btn-sm d-flex align-items-center p-1" data-bs-toggle="modal" data-bs-target="#deleteProduct"></i>
                            </div>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
                    
            <?php } else { ?>
            <div class="list-group">
                <div class="list-group-item list-group-item-action" style="cursor: default;">
                    <div class="d-flex justify-content-between">
                        there is no products to show
                    </div>
                </div>
            </div>
            <?php } ?>

            <button type="button" class="mt-5 btn btn-secondary btn-lg w-100" data-bs-toggle="modal" data-bs-target="#addProduct">
                Add New Product
            </button>

            
            <!--add product Modal -->
            <div class="modal fade" id="addProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 p-0" id="addProductLabel">new product</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="server/my-product/create.php" method="POST" class="row g-3" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">product image</label>
                                    <input class="form-control" type="file" id="formFile" name="productImage">
                                </div>

                                <div class="col-md-12">
                                    <label for="inputEmail4" class="form-label">product name</label>
                                    <input type="text" class="form-control" id="inputEmail4" name="productName" required>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">category</label>
                                    <select id="inputState" class="form-select" name="category" required>
                                        <option value="t-shirts">t-shirts</option>
                                        <option value="jackets">jackets</option>
                                        <option value="suits">suits</option>
                                        <option value="shoes">shoes</option>
                                        <option value="pants">pants</option>
                                        <option value="Accessories">Accessories</option>
                                    </select>
                                    
                                </div>
                                <div class="col-md-4">
                                    <label for="inputCity" class="form-label">price</label>
                                    <input type="number" class="form-control" id="inputCity" name="price" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label">stock</label>
                                    <input type="number" class="form-control" id="inputZip" name="stock" required>
                                </div>
                                
                                <div class="col-12">
                                    <label for="inputDesc" class="form-label">description</label>
                                    <textarea class="form-control" id="inputDesc" name="description" required></textarea>
                                </div>
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100">add new product</button>
                                </div>
                            </form>
                        </div>
                    </div>        
                </div>
            </div> 
            <!--///////////add product Modal////////////// -->


            
            <!--edit product Modal -->
            <div class="modal fade" id="editProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 p-0" id="editProductLabel">Edit product</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div  class="modal-body">
                            <form action="server/my-product/update.php" method="POST" class="row g-3" enctype="multipart/form-data">
                                <div>
                                    <img class="w-100" src="" alt="product image">
                                    <input class="w-100" type="hidden" name="currentProductImage" value="test">
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="file" name="productImage">
                                    <label class="form-label">change the current image if you want</label>
                                </div>

                                <div class="col-md-12">
                                    <label for="inputEmail4" class="form-label">product name</label>
                                    <input type="text" class="form-control" id="inputEmail4" name="productName">
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">category</label>
                                    <select id="inputState" class="form-select" name="category">
                                        <option selected>Choose...</option>
                                        <option value="t-shirts">t-shirts</option>
                                        <option value="jackets">jackets</option>
                                        <option value="suits">suits</option>
                                        <option value="shoes">shoes</option>
                                        <option value="pants">pants</option>
                                        <option value="Accessories">Accessories</option>
                                    </select>
                                    
                                </div>
                                <div class="col-md-4">
                                    <label for="inputCity" class="form-label">price</label>
                                    <input type="number" class="form-control" id="inputCity" name="price">
                                </div>
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label">stock</label>
                                    <input type="number" class="form-control" id="inputZip" name="stock">
                                </div>
                                
                                <div class="col-12">
                                    <label for="inputDesc" class="form-label">description</label>
                                    <textarea class="form-control" id="inputDesc" name="description"></textarea>
                                </div>

                                <input type="hidden" name="productID">
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100">save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>        
                </div>
            </div> 
            <!--///////////edit product Modal////////////// -->



            <!--delete product Modal -->
            <div class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="deleteProductLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteProductLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="server/my-product/delete.php" method="POST">
                                <div class="pb-5">you're about deleting this product</div>

                                <input type="hidden" name="productID">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-danger w-100">Delete</button>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
            <!--///////////delete product Modal////////////// -->





        </div>
    </main>
    <footer>
    <?php include('components/footer.php') ?>
    </footer>

    <?php require('components/js-scripts.php') ?>
</body>
</html>