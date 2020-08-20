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
//////////////////////////////////////////////////////////////////////////////


/////////////// CLASSES /////////////////////
// User Class
/** @var User $user */

// Product Class
/** @var Product $product */
/** @var Product[] $products */

// Favorite Class
/** @var Favorite $favorite */
/** @var Favorite[] $$favorites */
////////////////////////////////////////////


////// Important Variables //////
$cats = readMySqlTables(['productCategories', 'prodSubCats']);

// user var
if (is_object(User::find($_SESSION['user_id']))) {
    $user = User::find($_SESSION['user_id']);
} else {
    $user = TempUser::findOneBy(['user_id' => $_SESSION['user_id']]);
}
////////////////////////////////////////////////////////////////////////////////


////// Get favorites as Product[] //////
$products = [];
$favorites = $user->getFavorites();
foreach ($favorites as $favorite) {
    $products[] = $favorite->getProduct();
}
/////////////////////////////////////////////

//test


?>

<!-------------------------------->
<!----------- Header ------------->
<!-------------------------------->
<?php include '../components/header.php' ?>

<?php if (count($products) == 0): ?>
    <div class="container-fluid container-xl">
        <h1 class="display-4 font-weight-bold">Nu ai produse in lista de favorite!</h1>
    </div>
<?php else: ?>
    <div class="container-fluid container-xl">
        <div class="row">
            <div class="col-12">
                <h1>Favorite:</h1>
            </div>
        </div>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Cod produs</th>
                <th scope="col">Nume produs</th>
                <th scope="col">Pret Curent</th>
                <th scope="col">Actiuni</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <th scope="row"><?php echo $product->code ?></th>
                    <td>
                        <a href="http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/product-page.php?id=<?php echo $product->id ?>">
                            <?php echo $product->name ?>
                        </a>
                    </td>
                    <td><?php echo $product->getLastPrice() ?></td>
                    <td>
                        <button data-prod-id="<?php echo $product->id; ?>"
                                class="btn btn-primary cursor-pointer white-text removeFromUserFavorites">Sterge
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
