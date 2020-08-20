<!-- PHP -->
<?php
include $_SERVER['DOCUMENT_ROOT'].'/web-05/andrei/andrei/emag-new/include.php';
includeFuncFiles(['functions', 'mysql-queries']);
includeClass(['BaseTable', 'Product', 'Picture', 'TempUser', 'User', 'ShopCart', 'CartItem', 'Review', 'Favorite', 'ProductCategory', 'ProductSubcategory']);

////// make 'user_id'=cookie['value'] //////
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['PHPSESSID'];
}

//////////////////////////////////////////////////////


////// insert tempUser into the tempUsers table //////
if (!is_object(TempUser::findOneBy(['user_id' => $_SESSION['user_id']]))) {
    insertInto('tempUsers', ['user_id' => $_SESSION['user_id']]);
}
///////////////////////////////////////////////////////////////////////////


////// Create shop cart for temporary user //////
if (count(ShopCart::findBy(['user_id' => $_SESSION['user_id']])) == 0) {
    insertInto('shopCarts', ['user_id' => $_SESSION['user_id']]);
}
//////////////////////////////////////////////////////////////////////////////


///////////////////// CLASSES /////////////////////
// User Class
/** @var User $user */

// Product Class
/** @var Product $product */
/** @var Product[] $products */

// Picture Class
/** @var Picture $picture */
/** @var Picture[] $pictures */

// Favorite Class
/** @var Favorite $favorite */
/** @var Favorite[] $favorites */
//////////////////////////////////////////////////


////// Important Variables //////
$cats = readMySqlTables(['productCategories', 'prodSubCats']);

// user var
if (is_object(User::find($_SESSION['user_id']))) {
    $user = User::find($_SESSION['user_id']);
} else {
    $user = TempUser::findOneBy(['user_id' => $_SESSION['user_id']]);
}
//////////////////////////////////////////////////////////////////////////


////// Page Dependant Variables //////
$product = Product::find($_GET['id']);

$pictures = $product->getPictures();

$favorites = $user->getFavorites();
///////////////////////////////////////


// test
//var_dump($pictures);
//die;
?>

<!-------------------------------->
<!----------- Header ------------->
<!-------------------------------->
<?php include '../components/header.php' ?>

<!-------------------------------->
<!-------------------------------->
<!-------------------------------->

<!-------------------------------->
<!----------- Product ------------>
<!-------------------------------->
<div class="container-fluid container-xl">

    <!----------- Breadcrumbs ------------>
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/category-page.php?category=<?php echo $product->getCategory()->catName ?>&subcategory=<?php echo $product->getsubCategory()->subcatName ?>">
                            <?php echo $product->getSubcategory()->subcatName; ?>
                        </a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page"><?php echo $product->name; ?></li>
                </ol>
            </nav>
        </div>
    </div>

    <!----------- Product name ------------>
    <div class="row">
        <div class="col-12">
            <h3 class="myFont-size-18"><?php echo $product->name ?></h3>
        </div>
    </div>

    <!----------- Product code + share/compare ------------>
    <div class="row">
        <div class="col-5 col-md-8 grey-text">Cod produs: <?php echo $product->code ?></div>

        <!----------- Facebook button ------------>
        <div class="col-3 col-md-2 text-right">
            <div id="fb-root"></div>

            <script>(function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>

            <div class="fb-share-button"
                 data-href="https://www.your-domain.com/your-page.html"
                 data-layout="button_count">
            </div>
        </div>

        <div class="col-4 col-md-2 text-right">
            <a class="cursor-pointer myFilter-link">
                <input class="cursor-pointer" type="checkbox" name="prodCompare" id="prodCompare"
                       aria-label="Checkbox for following text input">
                <label class="cursor-pointer" for="prodCompare">Compara</label>
            </a>
        </div>
    </div>

    <!----------- Product ------------>
    <div class="row">
        <!----------- Product images ------------>
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <img id="mainProdImg" class="w-100"
                         src="<?php echo 'http://188.240.210.8/web-05/andrei/andrei/emag-new/assets/images/products/'.$product->pictures ?>"
                         alt="Product Main Image">
                </div>
            </div>

            <div class="row">
                <?php foreach ($pictures as $picture): ?>
                    <div class="col-3">
                        <img class="img-fluid cursor-pointer smallProdImg"
                             src="<?php echo 'http://188.240.210.8/web-05/andrei/andrei/emag-new/assets/images/products/'.$picture->picture ?>"
                             alt="Product Main Image">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!----------- Product delivery info ------------>
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12"><p class="grey-text mb-0">Opinia clientilor:</p></div>

                <div class="col-12"></div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-4 col-md-5 font-size-12 pt-1"><?php echo outputReviewStars($product); ?></div>
                        <div class="col-3"><?php echo $product->getAverageReviewScore(); ?></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12"><span class="grey-text">Vandut si livrat de: </span>eMAG</div>
            </div>

            <div class="row">
                <div class="col-12">
                    <span class="grey-text">Ajunge in: </span>
                    <span class="font-weight-bold">Craiova (Dolj)</span>
                    <a href="#">schimba</a>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-2 align-self-center"><i class="fas fa-truck-loading"></i></div>

                        <div class="col-6">
                            <div class="row"><p class="col-12 mb-0">Livrare standard</p></div>
                            <div class="row"><p class="col-12  font-size-14 green-text">Joi, 6 Aug. - Sambata, 8
                                    Aug.</p></div>
                        </div>

                        <div class="col-3 align-self-center ml-auto">14<sup>99</sup> Lei</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12"><span class="grey-text">Beneficii:</span></div>

                <div class="col-12 mt-1">
                    <div class="row">
                        <div class="col-2 d-flex"><i class="fas fa-gift align-self-center"></i></div>

                        <div class="col-10">
                            <p class="font-size-14 my-0">
                                <span class="font-weight-bold">4 puncte</span> prin cardul eMAG-Raiffeisen
                                <a href="#">detalii</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-1">
                    <div class="row">
                        <div class="col-2 d-flex"><i class="fas fa-box-open align-self-center"></i></div>

                        <div class="col-10"><p class="font-size-14 my-0">Dechiderea coletului la livrare</p></div>
                    </div>
                </div>

                <div class="col-12 mt-1">
                    <div class="row">
                        <div class="col-2 d-flex"><i class="far fa-calendar align-self-center"></i></div>

                        <div class="col-10">
                            <p class="font-size-14 my-0">
                                Retur gratuit 30 de zile
                                <a href="#">detalii</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-1">
                    <div class="row">
                        <div class="col-2 d-flex"><i class="fab fa-goodreads align-self-center"></i></div>

                        <div class="col-10">
                            <p class="font-size-14 my-0">
                                Extra beneficii cu eMAG Genius
                                <a href="#">detalii</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-1">
                    <div class="row">
                        <div class="col-2 d-flex"><i class="fas fa-file-signature align-self-center"></i></div>

                        <div class="col-10">
                            <p class="font-size-14 my-0">
                                Garantie incluse:
                                <a href="#">detalii</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <ul class="ml-3">
                        <li>
                            <p class="font-size-14 my-0">
                                Persoane fizice: 36 luni
                                <a href="#">extinde</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!----------- Product buy area ------------>
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="col-12">
                            <p class="mb-0 font-size-14">
                                <s><?php echo (int)($product->oldPrice) ?>
                                    <sup><?php echo decOfPrice($product->oldPrice) ?></sup> Lei</s>
                                <span class="grey-text">(-<?php echo $product->discount ?>%)</span>
                            </p>
                        </div>

                        <div class="col-12">
                            <p class="mb-0 myFont-size-16 font-weight-bold red-text">
                                <?php echo (int)($product->getLastPrice()) ?>
                                <sup><?php echo decOfPrice($product->getLastPrice()) ?></sup>
                                Lei
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-4"></div>

                <div class="col-4 font-weight-bold font-size-14 align-self-center">
                    <div class="row">
                        <div class="col-12"><span>Rate lunare</span></div>
                    </div>

                    <div class="row">
                        <div class="col-12"><span>de la 30 Lei</span></div>
                    </div>

                    <div class="row">
                        <div class="col-12 font-weight-normal font-size-12"><a href="#">vezi detalii</a></div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-5"><?php echo panicBuySticker($product); ?></div>
            </div>

            <div id="myAddToCartBtn" class="row px-3 mt-3 myAddToCartBtn">
                <div class="col-2 py-2 d-flex myAddToCartBtn__iconSide"><i
                            class="fas fa-shopping-cart mx-auto myFont-size-24"></i></div>

                <div class="col-10 py-2 text-center myAddToCartBtn__textSide">
                    <span class="myFont-size-16">Adauga in cos</span>
                </div>
            </div>

            <?php if (!$product->getFavedStatus()): ?>
                <div id="myAddtoFavsBtn" class="row px-3 mt-2 myAddtoFavsBtn">
                    <div class="col-2 py-2 d-flex myAddtoFavsBtn__iconSide"><i
                                class="far fa-heart mx-auto myFont-size-24"></i></div>

                    <div class="col-10 py-2 text-center myAddtoFavsBtn__textSide">
                        <span class="myFont-size-16">Adauga la favorite</span>
                    </div>
                </div>
            <?php else: ?>
                <div id="myRemoveFromFavsBtn" class="row px-3 mt-2 removeFromUserFavorites">
                    <div class="col-2 py-2 d-flex myAddtoFavsBtn__iconSide"><i
                                class="fas fa-ban mx-auto myFont-size-24 red-text"></i></div>

                    <div class="col-10 py-2 text-center myAddtoFavsBtn__textSide">
                        <span class="myFont-size-16 red-text">Sterge de la favorite</span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!----------- Product Review ------------>
    <div class="container-fluid container-xl">
        <?php foreach ($product->getReviews() as $review): ?>
            <div class="row">
                <h3 class="col-12"><?php echo $review->author ?></h3>

                <div class="col-12"><?php echo outputUserReviewStars($review); ?></div>

                <p class="col-12"><?php echo $review->comment ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-------------------------------->
<!----------- Footer ------------->
<!-------------------------------->
<?php include '../components/footer.php' ?>
