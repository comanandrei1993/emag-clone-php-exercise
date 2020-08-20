/////////// My functions /////////////
$(document).ready(function () {
    /////////// Dropright Menu inside Dropdown Menu /////////////
    $('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');


        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
            $('.dropdown-submenu .show').removeClass("show");
        });

        return false;
    });

    /////////// Validate addProductToDb.php Form /////////////

    // Validate categories
    $('form#addProductToDb').submit(function (event) {
        const categs = [
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

        let foundIt = '';

        for (let i = 0; i < categs.length; i++) {
            if ($(this).find('#productCategory')[0].value === categs[i]) {
                foundIt = `Found it: ${categs[i]}!`;
            }
        }

        if (!foundIt) {
            alert(
                `You have introduced an invalid category!
                Valid categories are:
                ${categs}
                and they are CASE SENSITIVE`
            );

            event.preventDefault();
        }
    });

    /////////// Make myFiltersCard d-block/d-none /////////////
    $('#prodFilters').on('click', function (e) {
        $("#myFiltersCard").addClass("d-block");
    });

    $('#myFiltersCard-displayBtn').on('click', function (e) {
        $("#myFiltersCard").removeClass("d-block");
    });

    ///////////////////////////////////////////////////////////

    ////////////// Check filter input when clicking on parent link /////////////
    $('.myFilter-link').on('click', function (e) {
        if ($(this).find('input')[0].checked === false) {
            $(this).find('input')[0].checked = true;
        } else {
            $(this).find('input')[0].checked = false;
        }
    });

    $('.myFilter-link').find('label').on('click', function (e) {
        event.preventDefault();
        event.stopPropagation();

        if ($(this).siblings('input')[0].checked === false) {
            $(this).siblings('input')[0].checked = true;
        } else {
            $(this).siblings('input')[0].checked = false;
        }
    });

    $('.myFilter-link').find('input').on('click', function (e) {
        if ($(this)[0].checked === false) {
            $(this)[0].checked = true;
        } else {
            $(this)[0].checked = false;
        }
    });

    ////////////// Change Product Main Image on product page /////////////
    $('.smallProdImg').on('click', function (e) {
        let mainImg = $('#mainProdImg')[0].getAttribute('src');

        $('#mainProdImg').attr('src', $(this)[0].getAttribute('src'));
        $(this).attr('src', mainImg);
    });
});

























