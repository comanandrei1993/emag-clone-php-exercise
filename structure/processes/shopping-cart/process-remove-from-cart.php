<?php
include $_SERVER['DOCUMENT_ROOT'].'/web-05/andrei/andrei/emag-new/include.php';
includeFuncFiles(['functions', 'mysql-queries']);
includeClass(['BaseTable', 'TempUser', 'User', 'ShopCart', 'CartItem']);

////// CLASES //////
// User Class
/** @var User $user */

// TempUser Class
/** @var TempUser $user */

// ShopCart Class
/** @var ShopCart $shopCart */

// CartItem Class
/** @var CartItem $cartItem */
///////////////////

if (!isset($_SESSION['user_id'])) {
    echo 'Operatie imposibila';
    die;
}

if (checkIfTempUser()) {
    $user = TempUser::findOneBy(['user_id' => $_SESSION['user_id']]);
    $shopCart = ShopCart::findOneBy(['user_id' => $user->user_id]);
} else {
    $user = User::find($_SESSION['user_id']);
    $shopCart = ShopCart::findOneBy(['user_id' => $user->id]);
}

$cartItem = CartItem::findOneBy(['cart_id' => $shopCart->id, 'prod_id' => $_POST['prodId']]);

if (is_object($cartItem)) {
    $oldQty = $cartItem->qty;
    $newQty = $oldQty - $_POST['qty'];

    if ($newQty > 0) {
        updateData('cartItems', ['prod_id' => $cartItem->prod_id, 'cart_id' => $shopCart->id], ['qty' => $newQty]);
    } else {
        deleteData('cartItems', ['cart_id' => $shopCart->id, 'prod_id' => $_POST['prodId']]);
    }
} else {
    echo 'Operatie imposibila!';
    die;
}
?>