<?php
include $_SERVER['DOCUMENT_ROOT'].'/web-05/andrei/andrei/emag-new/include.php';
includeFuncFiles(['functions', 'mysql-queries']);

if (!isset($_SESSION['user_id']) || !isset($_POST['prodId'])) {
    echo 'Operatie imposibila';
    die;
}

if (!findOneBy('favorites', ['user_id' => $_SESSION['user_id'], 'product_id' => $_POST['prodId']])) {
    echo 'Acest produs nu exista in lista de favorite!';
    die;
}

deleteData('favorites', ['user_id' => $_SESSION['user_id'], 'product_id' => $_POST['prodId']]);
echo 'Produsul a fost eliminat din lista de favorite!';
?>