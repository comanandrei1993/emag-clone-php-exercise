<?php
session_start();
//////////////////// User related functions ///////////////////////////////////////////
// Returns an array of products in current user fav list
function getUserFavs() {
    $userFavs = [];

    if (isset($_SESSION['user_id'])) {
        $products = readMySql('products');
        $favorites = findBy('favorites', ['user_id' => $_SESSION['user_id']]);

        foreach ($favorites as $favorite) {
            foreach ($products as $product) {
                if ($favorite['product_id'] == $product['id']) {
                    $userFavs[] = $product;
                }
            }
        }
    }

    if (count($userFavs) > 0) {
        return $userFavs;
    } else {
        return 0;
    }
}

// Returns an array of products in current user shop cart
function getUserCart() {
    $userCartItems = [];

    $products = readMySql('products');
    $shopCarts = findBy('shopCarts', ['user_id' => $_SESSION['user_id']]);

    foreach ($shopCarts as $cartItem) {
        foreach ($products as $product) {
            if ($cartItem['product_id'] == $product['id']) {
                $userCartItems[] = $product;
            }
        }
    }

    if (count($userCartItems) > 0) {
        return $userCartItems;
    } else {
        return 0;
    }
}

// Calculates total price of the shopping cart
function calcShopCart() {
    $userCartItems = getUserCart();
    $sum = 0;

    if ($userCartItems == 0) {
        return null;
    }

    foreach ($userCartItems as $cartItem) {
        $sum += $cartItem['price'];
    }

    return $sum;
}

//////////////////////////////////////////////////////////////////////////

////////////// MOVE THESE ////////////////////////
// Validate category name for addToProductDb
function validateProdCat($category) { // REFACTOR TO USE CATS FROM DB!!!
    $categories = [
        'Laptop, Tablete & Telefoane',
        'PC, Periferice & Software',
        'TV, Audio-Video & Foto',
        'Electrocasnice & Climatizare',
        'Gaming, Carti & Birotica',
        'Bacanie',
        'Fashion',
        'Ingrijire personala & Cosmetice',
        'Casa, Gradina & Bricolaj',
        'Sport & Activitati in aer liber',
        'Auto, Moto & RCA',
        'Jucarii, Copii & Bebe',
        'Spermarket'
    ];

    $isValidCat = false;

    for ($i = 0; $i < count($categories); $i++) {
        if ($category == $categories[$i]) {
            $isValidCat = true;
        }
    }

    return $isValidCat;
}

////////////////////////////////////////////////////////////////////

//////////////////////// Log in functions /////////////////////////
function is_loggedin() {
    if (gettype($_SESSION['user_id']) == 'number') {
        return $_SESSION['user_id'];
    }
}

function mustBeLogIn() {
    if (preg_match('/[A-Za-z]+/', $_SESSION['user_id'])) {
        echo '<meta http-equiv="refresh" content="0;url=http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/login.php" />';
//        echo '<h1>Trebuie sa fii logat pentru a accesa acesta pagina!</h1>';
        die;
    }
}

function checkIfTempUser() {
    if (preg_match('/[A-Za-z]+/', $_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}
//////////////////////////////////////////////////////////////////


//////////////////////// Misc. functions /////////////////////////
// Search function
function search($items, $key, $value) {
    $results = [];
    foreach ($items as $item) {
        if ($item[$key] == $value) {
            $results[] = $item;
        }
    }

    return $results;
}

// Preffix and suffix string
function prefSuffEl($el, $pref, $suff) {
    $newEl = '';

    $newEl = $pref.$el.$suff;

    return $newEl;
}

// Preffix and suffix array element
function prefSuffArrEl($array, $pref, $suff) {
    $newArray = [];

    foreach ($array as $arrayEl) {
        $newArray[] = $pref.$arrayEl.$suff;
    }

    return $newArray;
}

function decOfPrice($price) {
    if ((int)(($price - (int)($price)) * 100) > 0) {
        return (int)(($price - (int)($price)) * 100);
    } else {
        return null;
    }
}

function pairColWithVal($pairs) {
    global $mysqli;
    $pairsArr = [];

    foreach ($pairs as $column => $value) {
        $pairsArr[] = "`".$column."`='".mysqli_real_escape_string($mysqli, $value)."'";
    }

    return $pairsArr;
}

////////////////////////////////////////////////////////////////////


/////////////////// Front End Output functions ////////////////////
//Average
function averageScore($reviews, $prodId) {
    $productReviews = search($reviews, 'product_id', $prodId);
    $sum = 0;

    foreach ($productReviews as $review) {
        $sum += $review['score'];
    }

    if (count($productReviews) > 0) {
        return number_format((float)($sum / count($productReviews)), 2);
    } else {
        return 0;
    }
}

// Output Stars
function outputStars($reviews, $prodId) {
    $averageScoreInt = floor(averageScore($reviews, $prodId));
    $averageScoreDec = averageScore($reviews, $prodId) - floor(averageScore($reviews, $prodId));

    $result = '';


    for ($i = 1; $i <= $averageScoreInt; $i++) {
        $result .= '&#9733;';
    }

    if ($averageScoreDec == 0) {
        $result .= '';
    } elseif ($averageScoreDec >= 0.5) {
        $result .= '&#9733;';
    } elseif ($averageScoreDec < 0.5) {
        $result .= '&#9734';
    }

    for ($i = ceil(averageScore($reviews, $prodId)) + 1; $i <= 5; $i++) {
        $result .= '&#9734;';
    }
    return $result;
}

// output stars with font awesome icoons
function outputFontAwesomeStars($reviews, $prodId) {
    $averageScoreInt = floor(averageScore($reviews, $prodId));
    $averageScoreDec = averageScore($reviews, $prodId) - floor(averageScore($reviews, $prodId));

    $result = '';

    if (averageScore($reviews, $prodId) == 0) {
        return 'Nu sunt opinii';
    }


    for ($i = 1; $i <= $averageScoreInt; $i++) {
        $result .= '<i class="fas fa-star"></i>';
    }

    if ($averageScoreDec == 0) {
        $result .= '';
    } elseif ($averageScoreDec >= 0.5) {
        $result .= '<i class="fas fa-star-half-alt"></i>';
    } elseif ($averageScoreDec < 0.5) {
        $result .= '<i class="far fa-star"></i>';
    }

    for ($i = ceil(averageScore($reviews, $prodId)) + 1; $i <= 5; $i++) {
        $result .= '<i class="far fa-star"></i>';
    }

    return $result;
}

// receives a Product object as parameter and outputs review stars for html
function outputReviewStars($product) {
    $averageScoreInt = (int)$product->getAverageReviewScore();
    $averageScoreDec = $product->getAverageReviewScore() - $averageScoreInt;

    $result = '';

    if ($product->getAverageReviewScore() == 0) {
        return 'Nu sunt opinii';
    }

    for ($i = 1; $i <= $averageScoreInt; $i++) {
        $result .= '<i class="fas fa-star"></i>';
    }

    if ($averageScoreDec == 0) {
        $result .= '';
    } elseif ($averageScoreDec >= 0.5) {
        $result .= '<i class="fas fa-star-half-alt"></i>';
    } elseif ($averageScoreDec < 0.5) {
        $result .= '<i class="far fa-star"></i>';
    }

    for ($i = ceil($product->getAverageReviewScore()) + 1; $i <= 5; $i++) {
        $result .= '<i class="far fa-star"></i>';
    }

    return $result;
}

// outputs stars based on $review->score
// $review is an object. Attribute values are taken from reviews table
function outputUserReviewStars($review) {
    $result = '';

    for ($i = 1; $i <= $review->score; $i++) {
        $result .= '<i class="fas fa-star"></i>';
    }

    for ($i = $review->score + 1; $i <= 5; $i++) {
        $result .= '<i class="far fa-star"></i>';
    }

    return $result;
}

// Create Panic Buy Sticker

function panicBuySticker($product) {

    if ($product->stoc == 'stoc epuizat') {
        return '<p class="mb-0 small-text red-text">stoc epuizat</p>';
    } elseif ($product->stoc == 'stock limitat') {
        return '<p class="mb-0 small-text panic-buy">stoc limitat</p>';
    } elseif ($product->stoc == 'in stoc') {
        return '<p class="mb-0 small-text green-text">in stoc</p>';
    }
}

// Create eMag Genius button
function emagGenius($product) {

    if ($product['emagGenius'] == 'TRUE') {
        return '<p class="mb-0 emag-genius">genius</p>';
    }

}
