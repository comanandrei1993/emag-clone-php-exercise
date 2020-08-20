<!-- PHP -->
<?php
include $_SERVER['DOCUMENT_ROOT'].'/web-05/andrei/andrei/emag-new/include.php';
includeFuncFiles(['functions', 'mysql-queries']);
includeClass(['BaseTable', 'Product', 'TempUser', 'User', 'ShopCart', 'CartItem', 'Favorite', 'ProductCategory', 'ProductSubcategory']);

////// make 'user_id'=cookie['value'] //////
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['PHPSESSID'];
}
///////////////////////////////////////////


////// insert tempUser into the tempUsers table //////
if (!is_object(TempUser::findOneBy(['user_id' => $_SESSION['user_id']]))) {
    insertInto('tempUsers', ['user_id' => $_SESSION['user_id']]);
}
///////////////////////////////////////////////////////////////////////////


////// Create shop cart for temporary user //////
if (count(ShopCart::findBy(['user_id' => $_SESSION['user_id']])) == 0) {
    insertInto('shopCarts', ['user_id' => $_SESSION['user_id']]);
}
////////////////////////////////////////////////


/////////////// CLASSES /////////////////////
// User Class
/** @var User $user */

// Product Class
/** @var Product $product */
/** @var Product[] $products */
////////////////////////////////////////////


////// Important Variables //////
$cats = readMySqlTables(['productCategories', 'prodSubCats']);

// user var
if (is_object(User::find($_SESSION['user_id']))) {
    $user = User::find($_SESSION['user_id']);
} else {
    $user = TempUser::findOneBy(['user_id' => $_SESSION['user_id']]);
}
////////////////////////////////

// Page Variables //

/////////////////////////////////////////////////////////////////////////////////////////

//test
//var_dump($user);
//die;
?>

<!-------------------------------->
<!----------- Header ------------->
<!-------------------------------->
<?php include '../components/header.php' ?>

<!---------------------------------->
<!----------- eMag Outlet ---------->
<!---------------------------------->

<div class="container-fluid container-xl pb-2 bg-orange-2">
    <!--  Outlet image  -->
    <div class="row">
        <div class="d-none d-sm-block col-sm-1 col-md-3"></div>

        <div class="col-12 col-sm-10 col-md-6">
            <img class="img-fluid mx-auto"
                 src="http://188.240.210.8/web-05/andrei/andrei/emag-new/assets/images/discount-outlet.png"
                 alt="Outlet Discounts">
        </div>

        <div class="d-none d-sm-block col-sm-1 col-md-3"></div>
    </div>

    <!--  Outlet carousel  -->
    <div class="row">
        <div class="col-12 w-100">
            <div id="outletProducts" class="carousel slide" data-ride="carousel" data-interval="false">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>

                            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>

                            <div class="d-none d-md-block col-md-4 col-lg-3 col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>

                            <div class="d-none d-lg-block col-lg-3 col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>

                            <div class="d-none d-xl-block col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>

                            <div class="d-none d-xl-block col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>

                            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>

                            <div class="d-none d-md-block col-md-4 col-lg-3 col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>

                            <div class="d-none d-lg-block col-lg-3 col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>

                            <div class="d-none d-xl-block col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>

                            <div class="d-none d-xl-block col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>

                            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>

                            <div class="d-none d-md-block col-md-4 col-lg-3 col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>

                            <div class="d-none d-lg-block col-lg-3 col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>

                            <div class="d-none d-xl-block col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>

                            <div class="d-none d-xl-block col-xl-2">
                                <?php include '../components/product-card.php' ?>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#outletProducts" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#outletProducts" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    <!--  Outlet button  -->
    <div class="row mt-3">
        <div class="col-3"></div>

        <div class="col-6">
            <div class="btn btn-light w-100 text-secondary hover-blue">Vezi oferta</div>
        </div>

        <div class="col-3"></div>
    </div>
</div>

<!-------------------------------->
<!----------- Footer ------------->
<!-------------------------------->
<?php include '../components/footer.php' ?>



















