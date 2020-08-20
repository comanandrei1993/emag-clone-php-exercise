$(document).ready(function () {
    /////////////////// Add to User Favorites ///////////////////
    $('.myAddtoFavsBtn').on('click', function (e) {
        let pageLocation = window.location.pathname;

        if (pageLocation === '/web-05/andrei/andrei/emag-new/structure/pages/product-page.php') {
            let urlParams = new URLSearchParams(window.location.search);
            let prodId = urlParams.get('id');

            $.post(
                'http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/processes/user-favorites/process-addToFavs.php',
                {prodId: prodId},
                function (resp) {
                    location.reload();
                }
            );
        } else if (pageLocation === '/web-05/andrei/andrei/emag-new/structure/pages/category-page.php') {
            let prodId = $(this)[0].attributes['data-prod-id'].value;

            $.post(
                'http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/processes/user-favorites/process-addToFavs.php',
                {prodId: prodId},
                function (resp) {
                    location.reload();
                }
            );
        }
    });
    //////////////////////////////////////////////////////////////////////////////////

    /////////////////// Remove from User Favorites ///////////////////
    $('.removeFromUserFavorites').on('click', function (e) {
        let pageLocation = window.location.pathname;

        /////////////////// Remove from User Favorites by $_GET['id'] ///////////////////
        if (pageLocation === '/web-05/andrei/andrei/emag-new/structure/pages/product-page.php') {
            let urlParams = new URLSearchParams(window.location.search);
            let prodId = urlParams.get('id');

            $.post(
                'http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/processes/user-favorites/process-remFromFavs.php',
                {prodId: prodId},
                function (resp) {
                    location.reload();
                }
            );
        }
        /////////////////// Remove from User Favorites by data attribute data-prod-id ///////////////////
        else if (
            pageLocation === '/web-05/andrei/andrei/emag-new/structure/pages/user-favorites.php' ||
            pageLocation === '/web-05/andrei/andrei/emag-new/structure/pages/category-page.php'
        ) {
            let prodId = $(this)[0].attributes['data-prod-id'].value;

            $.post(
                'http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/processes/user-favorites/process-remFromFavs.php',
                {prodId: prodId},
                function (resp) {
                    location.reload();
                }
            );
        }
    });
    //////////////////////////////////////////////////////////////////////////////////

    /////////////////// Add to User Shopping Cart ///////////////////

    $('.myAddToCartBtn').on('click', function (e) {
        let pageLocation = window.location.pathname;

        if (pageLocation === '/web-05/andrei/andrei/emag-new/structure/pages/product-page.php') {
            let urlParams = new URLSearchParams(window.location.search);
            let prodId = urlParams.get('id');
            let qty = 1;

            $.post(
                'http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/processes/shopping-cart/process-add-to-cart.php',
                {prodId: prodId, qty: qty},
                function (resp) {
                    location.reload();
                }
            );
        } else if (
            pageLocation === '/web-05/andrei/andrei/emag-new/structure/pages/user-cart.php' ||
            pageLocation === '/web-05/andrei/andrei/emag-new/structure/pages/category-page.php'
        ) {
            let prodId = $(this)[0].attributes['data-prod-id'].value;
            let qty = 1;

            $.post(
                'http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/processes/shopping-cart/process-add-to-cart.php',
                {prodId: prodId, qty: qty},
                function (resp) {
                    location.reload();
                }
            );
        }
    });

    //////////////////////////////////////////////////////////////////////////////////


    /////////////////// Remove from User Shopping Cart ///////////////////

    $('.removeFromUserCart').on('click', function (e) {
        let pageLocation = window.location.pathname;

        if (pageLocation === '/web-05/andrei/andrei/emag-new/structure/pages/user-cart.php') {
            let prodId = $(this)[0].attributes['data-prod-id'].value;
            let qty = $(this).parent().prev().find('input')[0].value;

            if($(this)[0].innerText === '-') {
                $.post(
                    'http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/processes/shopping-cart/process-remove-from-cart.php',
                    {prodId: prodId, qty: 1},
                    function (resp) {
                        location.reload();
                    }
                );
            } else if ($(this)[0].innerText === 'Sterge') {
                $.post(
                    'http://188.240.210.8/web-05/andrei/andrei/emag-new/structure/processes/shopping-cart/process-remove-from-cart.php',
                    {prodId: prodId, qty: qty},
                    function (resp) {
                        location.reload();
                    }
                );
            }
        }
    });

    //////////////////////////////////////////////////////////////////////////////////
});

























