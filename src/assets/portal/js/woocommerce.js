jQuery(document).ready(init);

function init($) {
    // instead of overriding almost all woocommerce templates to style them,
    // I am removing/adding styles with JS
    products($);
    product($);
    cart($);
    checkout($);

    // because wordpress/woocommerce is the jankiest of janky and I can get the custom
    // events fired after the div has been updated (to re-classify the DOM w/JS)
    // I am removing the woocommerce-cart-form class ffrom the form as soon as we click the remove button.
    // woocommerce has logic that says if that doesnt exist in the dom they dont know how to update w/AJAX.
    $('body').on('click', '.woocommerce-cart-form .product-remove > a', function () {
        $('.woocommerce-cart-form').removeClass('woocommerce-cart-form');
    });
}

function products($) {
    var products = $('ul.products');
    if (!products.length) {
        return;
    }

    products
        .find('.add_to_cart_button')
        .removeClass('button')
        .addClass('btn btn-danger');
}

function product($) {
    var product = $('.product');

    var gallery = product.find('.woocommerce-product-gallery');
    var summary = product.find('.summary');
    var tabs = product.find('.wc-tabs-wrapper');

    product.append('<div class="row"><div class="col-md-4 gallery"></div><div class="col-md-8 details"></div></div>');
    product.find('.row .gallery').append(gallery);
    product.find('.row .details').append(summary).append(tabs);

    var cart = $('.product').find('form.cart');

    cart
        .find('input[type="text"]')
        .removeClass('input-text')
        .addClass('form-control input-sm');

    cart
        .find('[type="submit"]')
        .removeClass('single_add_to_cart_button button alt')
        .addClass('btn btn-danger')

    $('.woocommerce-tabs')
        .find('.wc-tabs')
        .removeClass('wc-tabs')
        .addClass('nav nav-tabs');

    $('.woocommerce-tabs')
        .removeClass('woocommerce-tabs')
        .addClass('tab-container')

    $('body').append(`
        <div id="image-gallery" tabindex="-1" role="dialog" style="display: none;" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="#" />
                    </div>
                </div>
            </div>
        </div>
    `);

    $('.woocommerce-product-gallery')
        .find('img')
        .addClass('img-thumbnail');

    $('.woocommerce-product-gallery')
        .find('img')
        .first()
        .removeClass('img-thumbnail');

    $('.woocommerce-product-gallery')
        .on('click', 'a', function (event) {
            event.preventDefault();
            var href = $(this).attr('href');
            $('#image-gallery img').attr('src', href);
            $('#image-gallery').modal();
        });
}

function cart($) {
    $('.woocommerce')
        .find('table.shop_table')
        .removeClass('shop_table shop_table_responsive cart woocommerce-cart-form__contents')
        .addClass('table table-striped');

    $('.woocommerce')
        .find('.checkout-button')
        .removeClass('checkout-button button alt wc-forward')
        .addClass('btn btn-danger btn-lg btn-block');

    var shippingForm = $('.woocommerce')
        .find('.shipping-calculator-form');

    shippingForm
        .find('[type="submit"]')
        .removeClass('button')
        .addClass('btn btn-default');

    shippingForm
        .find('input[type="text"], select')
        .removeClass('input-text')
        .addClass('form-control input-sm');

    var actions = $('.woocommerce').find('td.actions');

    actions
        .find('input[type="submit"]')
        .removeClass('button')
        .addClass('btn btn-default');

    actions
        .find('input[type="text"]')
        .removeClass('input-text')
        .addClass('form-control input-xs')
        .width('auto')
        .css('display', 'inline-block');

    $('.woocommerce')
        .find('th.product-thumbnail')
        .width('180');

    $('.woocommerce')
        .find('td.product-thumbnail img')
        .width(70)
        .height(70);
}

function checkout($) {
    var checkoutCouponForm = $('.woocommerce').find('form.checkout_coupon');
    var checkoutForm = $('.woocommerce').find('form.checkout');

    if (!checkoutForm.length) {
        return;
    }

    checkoutCouponForm
        .find('button')
        .removeClass('button')
        .addClass('btn btn-default');

    checkoutCouponForm
        .find('input')
        .removeClass('input-text')
        .addClass('form-control input-sm');

    checkoutForm
        .find('input[type=text], input[type="tel"], input[type="email"]')
        .removeClass('input-text')
        .addClass('form-control input-sm');

    checkoutForm
        .find('textarea')
        .removeClass('input-text')
        .addClass('form-control');


    checkoutForm
        .find('#order_review table')
        .removeClass('shop_table woocommerce-checkout-review-order-table')
        .addClass('table table-condensed table-bordered');

    checkoutForm
        .find('#order_review_heading')
        .appendTo('.col-2');

    checkoutForm
        .find('#order_review')
        .appendTo('.col-2');

    checkoutForm
        .find('.woocommerce-additional-fields')
        .appendTo('.col-1');

    setTimeout(function () {
        checkoutForm
            .find('.payment_method_stripe input')
            .removeClass('input-text')
            .addClass('form-control input-sm');

        checkoutForm
            .find('.place-order input[type="submit"]')
            .removeClass('button alt')
            .addClass('btn btn-danger btn-lg btn-block');
    }, 1500);
}