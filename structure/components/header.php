<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d228af2b8f.js" crossorigin="anonymous"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>

    <!-- My Javascript -->
    <script src="../../javascript/script.js"></script>
    <script src="../../javascript/requests.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <title>My New eMag</title>
</head>
<body>
<!-------------------------------->
<!----------- Header ------------->
<!-------------------------------->

<!-------------------------------->
<!-- Top Search and Account Bar -->
<!-------------------------------->

<!-- Small Screens -->
<div class="container-fluid container-sm">
    <div class="row pt-sm-3 pb-sm-3 mySearchBar">
        <!--    Products Button    -->
        <div class="col-2 d-sm-none dropdown">
            <button class="btn dropdown-toggle myProductDropdown" type="button" id="smProductsMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-align-justify"></i>
            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php foreach (ProductCategory::findByLike(['id' => '%%']) as $prodCat): ?>
                    <div class="btn-group dropright">
                        <a type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <?php echo $prodCat->catName ?>
                        </a>

                        <div class="dropdown-menu">
                            <?php foreach (ProductSubcategory::findByLike(['id' => '%%']) as $subCat): ?>
                                <?php if ($prodCat->id == $subCat->catId): ?>
                                    <a href="http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/category-page.php?category=<?php echo $prodCat->catName ?>&subcategory=<?php echo $subCat->subcatName ?>"
                                       class="d-block"><?php echo $subCat->subcatName ?></a>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!--    Brand Logo    -->
        <div class="col-2">
            <a href="http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/homepage.php">
                <img class="img-fluid myBrandLogo myPt-12-fix p-md-2 p-lg-0"
                     src="http://188.240.210.8/web-05/andrei/andrei/emag-new/assets/images/branding/logo.svg"
                     alt="eMag">
            </a>
        </div>

        <!--    Empty space instead of search bar for sm screens    -->
        <div class="col-4 d-sm-none">&nbsp;</div>

        <!--    Search bar    -->
        <div class="col-sm-6 d-none d-sm-block">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Ai libertatea sa alegi ce vrei"
                       aria-label="Searchbar" aria-describedby="basic-addon1">
                <div class="input-group-append">
                    <span class="input-group-text" id="search-icon"><a href="#"><i class="fas fa-search"></i></a></span>
                </div>
            </div>
        </div>

        <!--    Search, Favorites, Cart buttons & User Account    -->
        <div class="col-4 col-sm-4 text-right">
            <div class="row">
                <!--  Search  -->
                <div class="col-4 d-sm-none myPt-8-fix">
                    <a href="#"><i class="fas fa-search"></i></a>
                </div>

                <!--  User Account  -->
                <div class="d-none d-sm-block col-4 myPt-8-fix">
                    <a href="http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/user-profile.php">
                        <i class="far fa-user"></i>

                        <span class="d-none d-xl-inline font-size-12"> Contul meu</span>
                    </a>
                </div>

                <!--  Favorites  -->
                <div class="col-4 myPt-8-fix">
                    <a href="http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/user-favorites.php">
                        <i class="far fa-heart position-relative">
                            <?php if (count($user->getFavorites()) > 0): ?>
                                <span class="myNotificationBadge">
                                <?php echo count($user->getFavorites()); ?>
                            </span>
                            <?php endif; ?>
                        </i>

                        <span class="d-none d-xl-inline font-size-12"> Favorite</span>
                    </a>
                </div>

                <!--  Cart  -->
                <div class="col-4 myPt-8-fix">
                    <a href="http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/user-cart.php">
                        <i class="fas fa-shopping-cart position-relative">
                            <?php if (count($user->getCart()->getCartItems()) > 0): ?>
                                <span class="myNotificationBadge">
                                <?php echo count($user->getCart()->getCartItems()); ?>
                            </span>
                            <?php endif; ?>
                        </i>

                        <span class="d-none d-xl-inline font-size-12"> Cosul meu</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!---------------------------------->
<!-- Genius Deals & eMag Help bar -->
<!---------------------------------->
<div class="container-fluid myGeniusDealsBar">
    <div class="container-sm">
        <div class="row">
            <!--    Products Button    -->
            <div class="d-none d-sm-block col-2 dropdown">
                <button class="btn btn-light dropdown-toggle myProductDropdown font-size-12" type="button"
                        id="smProductsMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-align-justify"></i>

                    <span>Produse</span>
                </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php foreach (ProductCategory::findByLike(['id' => '%%']) as $prodCat): ?>
                        <div class="btn-group dropright d-block">
                            <a type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <?php echo $prodCat->catName ?>
                            </a>

                            <div class="dropdown-menu">
                                <?php foreach (ProductSubcategory::findByLike(['id' => '%%']) as $subCat): ?>
                                    <?php if ($prodCat->id == $subCat->catId): ?>
                                        <a href="http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/pages/category-page.php?category=<?php echo $prodCat->catName ?>&subcategory=<?php echo $subCat->subcatName ?>"
                                           class="d-block"><?php echo $subCat->subcatName ?></a>
                                        <?php
                                        ?>
                                    <?php endif ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!--    Other Menu    -->
            <div class="col-10 font-size-14">
                <div class="row myGeniusDealsBar__otherMenu">
                    <ul class="col-8 list-inline myGeniusDealsBar__list">
                        <li class="d-none d-md-inline myGeniusDealsBar__listItem"><a href="#">Genius Deals</a></li>

                        <li class="d-none d-md-inline myGeniusDealsBar__listItem"><a href="#">Resigilate</a></li>

                        <li class="d-none d-lg-inline myGeniusDealsBar__listItem"><a href="#">Necesare Zi de Zi</a></li>

                        <li class="d-none"><a href="#">Extra-reducerile momentului</a></li>

                        <li class="d-none"><a href="#">Outlet</a></li>

                        <li class="d-none"><a href="#">Vazute la TV</a></li>

                        <li class="list-inline-item myGeniusDealsBar__listItem">
                            <div class="dropdown show">
                                <a class="dropdown-toggle font-size-14" href="#" role="button" id="dropdownMenuLink"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Dropdown link
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item d-md-none" href="#">Genius Deals</a>

                                    <a class="dropdown-item d-md-none" href="#">Resigilate</a>

                                    <a class="dropdown-item d-lg-none" href="#">Necesare Zi de Zi</a>

                                    <a class="dropdown-item" href="#">Extra-reducerile momentului</a>

                                    <a class="dropdown-item" href="#">Outlet</a>

                                    <a class="dropdown-item" href="#">Vazute la TV</a>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="col-4 text-right font-size-14 myGeniusDealsBar__listItem"><a href="#"><i
                                    class="fas fa-headset"></i> eMAG help</a></div>
                </div>

            </div>


        </div>
    </div>
</div>

<!---------------------------------->
<!---------- Add Carousel ---------->
<!---------------------------------->
<div class="container-fluid container-xl">
    <div class="row">
        <div id="myAddCarousel" class="carousel p-0 w-100 slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myAddCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myAddCarousel" data-slide-to="1"></li>
                <li data-target="#myAddCarousel" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="#">
                        <img src="http://188.240.210.8/web-05/andrei/andrei/emag-new/assets/images/adds/casa-si-gradina.jpeg"
                             class="d-block w-100" alt="Casa si gradina">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="#">
                        <img src="http://188.240.210.8/web-05/andrei/andrei/emag-new/assets/images/adds/philips-sonicare.jpeg"
                             class="d-block w-100" alt="Philips sonicare">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="#">
                        <img src="http://188.240.210.8/web-05/andrei/andrei/emag-new/assets/images/adds/shop-assistant.jpeg"
                             class="d-block w-100" alt="Shop assistant">
                    </a>
                </div>
            </div>
            <a class="carousel-control-prev" href="#myAddCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myAddCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>



























