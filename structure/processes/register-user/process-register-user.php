<?php
include $_SERVER['DOCUMENT_ROOT'].'/web-05/andrei/andrei/emag-new/include.php';
includeFuncFiles(['functions', 'mysql-queries']);

if ($_POST['password'] != $_POST['retype-password']) {
    echo 'Ai introdus 2 parole diferite!';
    echo '<meta http-equiv="refresh" content="4;url=http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/register-user.php" />';
    die;
}

if (count(findBy('users', ['email' => $_POST['email']])) > 0) {
    echo 'Acel email este deja folosit!';
    echo '<meta http-equiv="refresh" content="4;url=http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/register-user.php" />';
    die;
}

insertInto('users', ['email' => $_POST['email'], 'password' => md5($_POST['password']), 'status' => 1]);

echo 'Cont creat cu succes!';
echo '<meta http-equiv="refresh" content="4;url=http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/login.php" />';
