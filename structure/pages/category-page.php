<!-- PHP -->
<?php
include $_SERVER['DOCUMENT_ROOT'].'/web-05/andrei/andrei/emag-new/include.php';
includeFuncFiles(['functions', 'mysql-queries']);
includeClass(['BaseTable', 'Product', 'ProductBrand', 'TempUser', 'User', 'ShopCart', 'CartItem', 'Review', 'Favorite', 'ProductCategory', 'ProductSubcategory']);

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

// Favorite Class
/** @var Favorite $favorite */
/** @var Favorite[] $favorites */

// Category Class
/** @var ProductCategory $prodCategory */
/** @var ProductCategory[] $prodCategories */

// Subcategory Class
/** @var ProductSubcategory $subcategory */
/** @var ProductSubcategory[] $subcategories */
////////////////////////////////////////////


////// Important Variables //////

// user var
if (is_object(User::find($_SESSION['user_id']))) {
    $user = User::find($_SESSION['user_id']);
} else {
    $user = TempUser::findOneBy(['user_id' => $_SESSION['user_id']]);
}
////////////////////////////////


// Page Variables //
$subcategory = ProductSubcategory::findOneBy(['subcatName' => $_GET['subcategory']]);
$products = $subcategory->getProducts();
$favorites = $user->getFavorites();
/////////////////////////////////////////////////////////////////////////////////////////

//test

//die;
?>

<!-------------------------------->
<!----------- Header ------------->
<!-------------------------------->
<?php include '../components/header.php' ?>

<!-------------------------------->
<!-------------------------------->
<!-------------------------------->


<!-------------------------------------------->
<!----------- Category Page Comp ------------->
<!-------------------------------------------->
<div class="container-fluid container-xl">
    <div class="row">
        <!-------------------------------------->
        <!----------- Side filters ------------->
        <!-------------------------------------->

        <?php include $_SERVER['DOCUMENT_ROOT'].'/web-05/andrei/andrei/emag-new/structure/components/myFiltersCard.php'; ?>


        <!------------------------------------------------------------->
        <!------------------------------------------------------------->
        <!------------------------------------------------------------->

        <!------------------------------------------------------------->
        <!----------- Filter for Small Screens & Order By ------------->
        <!-------------------------- Products ------------------------->
        <!------------------------------------------------------------->

        <!------------------------------------------------------------->
        <!----------- Filter for Small Screens & Order By ------------->
        <!------------------------------------------------------------->
        <div class="col-12 col-md-9 pt-3 bg-white">
            <div class="row">
                <h4><?php echo ProductSubcategory::findOneBy(['subcatName' => $_GET['subcategory']])->subcatName ?>
                    <span class="myFont-size-16 font-weight-thin">
                        <?php echo count($products) ?>
                        de produse
                    </span>
                </h4>
            </div>

            <div class="row myFilter">
                <div class="col-5 d-md-none">
                    <a id="prodFilters" class="btn btn-outline-secondary grey-text w-100 myHover-white">
                        <span class="font-weight-bold">Filtreaza</span>
                        <span class="font-size-12 d-block">Aplica Filtre</span>
                    </a>
                </div>

                <div class="col-5 d-md-none">
                    <a class="btn btn-outline-secondary grey-text w-100 myHover-white">
                        <span class="font-weight-bold">Ordoneaza dupa</span>
                        <span class="font-size-12 d-block">Cele mai populare</span>
                    </a>
                </div>

                <div class="col-2 d-md-none">
                    <button class="btn btn-outline-secondary w-100 h-100">
                        <i class="fas fa-align-justify"></i>
                    </button>
                </div>
            </div>
            <!------------------------------------------------------------->
            <!------------------------------------------------------------->

            <!---------------------------------->
            <!----------- Products ------------->
            <!---------------------------------->
            <div class="row mt-3">
                <?php foreach ($products as $product): ?>
                    <div class="col-6 col-sm-4 col-md-3 myProdCard">
                        <div class="row">
                            <div class="col-4">
                                <p class="myProdCard__discPercentage">-<?php echo $product->discount ?>%</p>
                            </div>

                            <div class="col-4"></div>
                            <?php if ($product->getFavedStatus()): ?>
                                <div class="col-4">
                                    <a data-prod-id="<?php echo $product->id ?>"
                                       class="removeFromUserFavorites cursor-pointer">
                                        <i class="fas fa-ban myProdCard__addToFav emagLinkColor"></i>
                                    </a>
                                </div>
                            <?php else: ?>
                                <div class="col-4">
                                    <a data-prod-id="<?php echo $product->id ?>"
                                       class="myAddtoFavsBtn cursor-pointer">
                                        <i class="far fa-heart myProdCard__addToFav emagLinkColor"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-12">
                            <a target="_blank"
                               href="http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/product-page.php?id=<?php echo $product->id ?>">
                                <img class="img-fluid myProdCard__img"
                                     src="http://188.240.210.8/web-05/andrei/andrei/emag-new/assets/images/products/<?php echo $product->pictures ?>"
                                     alt="Product image">
                            </a>
                        </div>

                        <div class="col-12">
                            <a target="_blank"
                               href="http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/product-page.php?id=<?php echo $product->id ?>">
                                <p class="myProdCard__prodName"><?php echo $product->name ?></p>
                            </a>
                        </div>

                        <div class="row">
                            <a href="#" class="col-6">
                                <span class="myProdCard__revStars font-size-12">
                                    <?php echo outputReviewStars($product); ?>
                                </span>
                            </a>

                            <a href="#" class="col-6">
                                    <span class="myProdCard__revScore">
                                        <?php echo $product->getAverageReviewScore(); ?>

                                        <span class="myProdCard__nrOfReviewers">
                                            (<?php
                                            echo count($product->getReviews());
                                            ?>)
                                        </span>
                                    </span>
                            </a>
                        </div>

                        <div class="col-12 myProdCard__oldPrice">
                            <strike><?php echo $product->oldPrice ?> Lei</strike>
                            <span class="grey-text">(-<?php echo $product->discount ?>%)</span>
                        </div>

                        <div class="col-12 myProdCard__newPrice"><?php echo $product->getLastPrice() ?></div>

                        <a data-prod-id="<?php echo $product->id ?>"
                           class="col-12 btn btn-light myProdCard__addToCart-btn myAddToCartBtn">
                            Adauga in Cos
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <!------------------------------------------------------------->
            <!------------------------------------------------------------->
        </div>
    </div>
</div>

<!-------------------------------->
<!-------------------------------->
<!-------------------------------->

<!------------------------------------------------------>
<!----------- Small Screen Product filters ------------->
<!------------------------------------------------------>
<div class="row d-none">
    <?php include $_SERVER['DOCUMENT_ROOT'].'/web-05/andrei/andrei/emag-new/structure/components/myFiltersCard.php'; ?>
</div>

<!-------------------------------->
<!----------- Footer ------------->
<!-------------------------------->
<?php include '../components/footer.php' ?>
