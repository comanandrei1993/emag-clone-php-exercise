<?php
$mysqli = mysqli_connect("localhost", "root", "scoalait123", "web-05-andreiComan");

function includeFuncFiles($fileNames) {
    foreach ($fileNames as $fileName) {
        include $_SERVER['DOCUMENT_ROOT'].'/web-05/andrei/andrei/emag-new/functions/'.$fileName.'.php';
    }
}

function includeClass($fileNames) {
    foreach ($fileNames as $fileName) {
        include $_SERVER['DOCUMENT_ROOT'].'/web-05/andrei/andrei/emag-new/classes/'.$fileName.'.php';
    }
}

?>
