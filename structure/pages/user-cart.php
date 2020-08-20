<?php
include $_SERVER['DOCUMENT_ROOT'].'/web-05/andrei/andrei/emag-new/include.php';
includeFuncFiles(['functions', 'mysql-queries']);
includeClass(['BaseTable', 'Product', 'TempUser', 'User', 'ShopCart', 'CartItem', 'Favorite', 'ProductCategory', 'ProductSubcategory']);


////// make 'user_id'=cookie['value'] //////
if(!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['PHPSESSID'];
}
////////////////////////////////////////////////////


////// insert tempUser into the tempUsers table //////
if (!is_object(TempUser::findOneBy(['user_id' => $_SESSION['user_id']]))) {
    insertInto('tempUsers', ['user_id' => $_SESSION['user_id']]);
}
/////////////////////////////////////////////////////////////////////////////////


////// Create shop cart for temporary user //////
if (count(ShopCart::findBy(['user_id' => $_SESSION['user_id']])) == 0) {
    insertInto('shopCarts', ['user_id' => $_SESSION['user_id']]);
}
//////////////////////////////////////////////////////////////////////////////

/////////////// CLASSES /////////////////////
// User Class
/** @var User $user */

// Product Class
/** @var Product $product */
/** @var Product[] $products */

// ShopCart Class

// CartItem Class
/** @var CartItem $cartItem */
////////////////////////////////////////////

////// Important Variables //////
$cats = readMySqlTables(['productCategories', 'prodSubCats']);

// user var
if (is_object(User::find($_SESSION['user_id']))) {
    $user = User::find($_SESSION['user_id']);
} else {
    $user = TempUser::findOneBy(['user_id' => $_SESSION['user_id']]);
}
////////////////////////////////////////////////////////////////////////////

////// Get user cartItems and then get product objects //////
$products = [];

$userCartItems = $user->getCart()->getCartItems();

foreach ($userCartItems as $cartItem) {
    $products[] = Product::findOneBy(['id' => $cartItem->prod_id]);
}
/////////////////////////////////////////////////////////////////////////


/// test ///
//var_dump($user->getCart()->calcTotalPrice());
//die;
?>

<!-------------------------------->
<!----------- Header ------------->
<!-------------------------------->
<?php include '../components/header.php' ?>

<?php if (count($products) == 0): ?>
    <div class="container-fluid container-xl">
        <h1 class="display-4 font-weight-bold">Nu ai produse in cosul de cumparaturi!</h1>
    </div>
<?php else: ?>
    <div class="container-fluid container-xl">
        <div class="row">
            <div class="col-12">
                <h1>Total: <?php echo $user->getCart()->calcTotalPrice() ?></h1>
            </div>
        </div>

        <table class="table">
            <thead class="thead-dark">
            <tr class="row">
                <th class="col-2" scope="col">Cod produs</th>
                <th class="col-2" scope="col">Nume produs</th>
                <th class="col-2" scope="col">Imagine</th>
                <th class="col-2" scope="col">Pret Curent</th>
                <th class="col-2" scope="col">Nr.</th>
                <th class="col-2" scope="col">Actiuni</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $key => $product): ?>
                <tr class="row">
                    <th class="col-2" scope="row"><?php echo $product->code; ?></th>

                    <td class="col-2">
                        <a href="http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/product-page.php?id=<?php echo $product->id ?>">
                            <?php echo $product->name ?>
                        </a>
                    </td>

                    <td class="col-2">
                        <img class="w-75"
                             src="http://188.240.210.8/web-05/andrei/andrei/emag-new/assets/images/products/<?php echo $product->pictures ?>"
                             alt="Product Image">
                    </td>

                    <td class="col-2"><?php echo $product->getLastPrice() ?></td>

                    <td class="col-2">
                        <input class="w-25" type="text" name="product-qty"
                               data-prod-id="<?php echo $product->id ?>"
                               value="<?php echo CartItem::findOneBy(['prod_id' => $product->id, 'cart_id' => $user->getCart()->id])->qty; ?>">
                        <label for="product-qty">bucati</label>
                    </td>

                    <td class="col-2">
                        <button data-prod-id="<?php echo $product->id ?>"
                                class="btn btn-primary cursor-pointer white-text removeFromUserCart">-
                        </button>

                        <button data-prod-id="<?php echo $product->id ?>"
                                class="btn btn-primary cursor-pointer white-text myAddToCartBtn">+
                        </button>

                        <button data-prod-id="<?php echo $product->id ?>"
                                class="btn btn-primary cursor-pointer white-text removeFromUserCart">Sterge
                        </button>
                    </td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<!-------------------------------->
<!----------- Footer ------------->
<!-------------------------------->
<?php include '../components/footer.php' ?>
