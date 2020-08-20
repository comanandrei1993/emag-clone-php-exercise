<?php
include $_SERVER['DOCUMENT_ROOT'].'/web-05/andrei/andrei/emag-new/include.php';
includeFuncFiles(['functions', 'mysql-queries']);
includeClass(['BaseTable', 'User', 'ShopCart', 'CartItem', 'Favorite']);

/////////////// CLASSES /////////////////////
// User Class
/** @var User $user */

// Product Class
/** @var Product $product */
/** @var Product[] $products */

// Favorite Class
/** @var Favorite $favorite */
/** @var Favorite[] $favorites */

// ShopCart Class
/** @var ShopCart $shopCart */

// CartItem Class
/** @var CartItem $cartItem */
/** @var CartItem[] $cartItems */
////////////////////////////////////////////

$filters = [
    'email' => $_POST['email'],
    'password' => md5($_POST['password']),
    'status' => 1
];

$user = User::findOneBy($filters);
$tempUserFavs = Favorite::findBy(['user_id' => $_SESSION['user_id']]);
$tempUserCart = ShopCart::findOneBy(['user_id' => $_SESSION['user_id']]);
$tempUserCartItems = CartItem::findBy(['cart_id' => $tempUserCart->id]);

if ($user) {
    //// Merge Temporary User Favorite[] with User Favorite[] that is logging in ////
    foreach ($tempUserFavs as $favorite) {
        if(!Favorite::findBy(['product_id' => $favorite->product_id, 'user_id' => $user->id])) {
            updateData('favorites', ['product_id' => $favorite->product_id, 'user_id' => $_SESSION['user_id']], ['user_id' => $user->id]);
        } else {
            deleteData('favorites', ['product_id' => $favorite->product_id, 'user_id' => $_SESSION['user_id']]);
        };
    }
    /////////////////////////////////////////////////////////////////////


    //// Merge Temporary User ShopCart[] with User ShopCart[] that is logging in ////
    foreach ($tempUserCartItems as $cartItem) {
        if(!CartItem::findOneBy(['cart_id' => $user->getCart()->id, 'prod_id' => $cartItem->prod_id])) {
            updateData('cartItems', ['prod_id' => $cartItem->prod_id, 'cart_id' => $tempUserCart->id], ['cart_id' => $user->getCart()->id]);
        } else {
            updateData('cartItems', ['prod_id' => $cartItem->prod_id, 'cart_id' => $user->getCart()->id], ['qty' => $cartItem->qty]);
            deleteData('cartItems', ['prod_id' => $cartItem->prod_id, 'cart_id' => $tempUserCart->id]);
        }
    }
    /////////////////////////////////////////////////////////////////////


    /// Set Current User ///
    $_SESSION['user_id'] = $user->id;
    $emailArray = explode('@', $user->email);
    $_SESSION['username'] = $emailArray[0];
    //////////////////////////////////////////////////////


    //// Create shopping cart when user logs for the first time
    $userCart = ShopCart::findOneBy(['user_id' => $_SESSION['user_id']]);
    if (!is_object($userCart)) {
        insertInto('shopCarts', ['user_id' => $_SESSION['user_id']]);
    }
    /////////////////////////////////////////////////////////////////////


    header("Location: http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/user-profile.php?user_id=".$_SESSION['user_id']);
} else {
    echo 'Emailul sau parola sunt gresite!';
    echo '<meta http-equiv="refresh" content="4;url=http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/login.php" />';
    die;
}
?>