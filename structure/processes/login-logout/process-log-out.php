<?php
include $_SERVER['DOCUMENT_ROOT'].'/web-05/andrei/andrei/emag-new/include.php';
includeFuncFiles(['functions', 'mysql-queries']);

session_destroy();
header("Location: http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/login.php");