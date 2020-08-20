<!-- PHP -->
<?php
include $_SERVER['DOCUMENT_ROOT'].'/web-05/andrei/andrei/emag-new/include.php';
includeFuncFiles(['functions', 'mysql-queries']);
includeClass(['BaseTable', 'TempUser', 'User', 'ShopCart', 'CartItem', 'Favorite', 'ProductCategory', 'ProductSubcategory']);

////// make 'user_id'=cookie['value'] //////
if(!isset($_SESSION['user_id'])) {
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
////////////////////////////////////////////////////////////////////////////


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
///////////////////////////////////////////////////////////////////////
?>
<!-------------------------------->
<!----------- Header ------------->
<!-------------------------------->
<?php include '../components/header.php' ?>

<div class="container-fluid container-xl">
    <div class="row">
        <div class="col-12 col-md-4"></div>

        <div class="col-12 col-md-4">
            <form action="http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/processes/login-logout/process-login.php"
                  method="post" id="addProductToDb">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email"
                           placeholder="Email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password"
                           placeholder="Password" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

                <a href="http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/register-user.php"
                   class="btn btn-primary">Create Account</a>
            </form>
        </div>

        <div class="col-12 col-md-4"></div>
    </div>
</div>

<!-------------------------------->
<!----------- Footer ------------->
<!-------------------------------->
<?php include '../components/footer.php' ?>
