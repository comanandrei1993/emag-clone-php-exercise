<?php
include $_SERVER['DOCUMENT_ROOT'].'/web-05/andrei/andrei/emag-new/include.php';
includeFuncFiles(['functions', 'mysql-queries']);
includeClass(['BaseTable', 'TempUser', 'User', 'ShopCart', 'CartItem', 'Favorite', 'ProductCategory', 'ProductSubcategory']);


////// make 'user_id'=cookie['value'] //////
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['PHPSESSID'];
}
///////////////////////////////////////////////////////


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
////////////////////////////////////////////


////// Important Variables //////
$cats = readMySqlTables(['productCategories', 'prodSubCats']);

// user var
if (is_object(User::find($_SESSION['user_id']))) {
    $user = User::find($_SESSION['user_id']);
} else {
    $user = TempUser::findOneBy(['user_id' => $_SESSION['user_id']]);
}
//////////////////////////////////////////////////////////////////////////

////// Redirect to Login Page if not logged in //////
mustBeLogIn();
////////////////////////////////////////////////////
?>
<!-------------------------------->
<!----------- Header ------------->
<!-------------------------------->
<?php include '../components/header.php' ?>

<div class="container-fluid container-xl">
    <?php if(isset($_SESSION['username'])): ?>
    <div class="row">
        <div class="col-12">
            <h1>Welcome, <?php echo $_SESSION['username'] ?>!</h1>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-2">
            <a href="http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/processes/login-logout/process-log-out.php" class="btn btn-primary">Log Out</a>
        </div>

        <div class="col-2">
            <a href="http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/user-favorites.php" class="btn btn-primary">Favorite</a>
        </div>
    </div>
</div>

<!-------------------------------->
<!----------- Footer ------------->
<!-------------------------------->
<?php include '../components/footer.php' ?>
