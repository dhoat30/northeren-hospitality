const $ = jQuery;

class PopUpCart {
    constructor() {
        this.cartContainer = $('.cart-popup-container'); // Reference to the cart container

        this.events();
    }

    events() {

        $('.open-cart-wrapper').on('click', this.openCart.bind(this));
        $(document).on('click', '.cart-box .close-cart', this.closeCart.bind(this));

        // $('.cart-popup-container .fa-times').on('click', this.closeCart)
        // remove item from cart ajax 
        $(document).on('click', '.cart-popup-container .remove-product', this.removeItem);
        $(document).on('click', this.handleDocumentClick.bind(this)); // Listening to document click

    }

    //remove item from cart function 
    removeItem(e) {
        e.preventDefault(); // Prevent the default action

        var product_id = $(this).data('product-id');
        var cart_item_key = $(this).data('cart_item_key');
        // Send AJAX request to remove the item
        $.ajax({
            url: webduelData.ajaxurl, // Make sure to properly localize your script with the correct ajax URL
            type: 'POST',
            data: {
                action: 'remove_item_from_cart',
                product_id: product_id,
                cart_item_key: cart_item_key,
                security: webduelData.nonce
            },
            success: function (response) {
                if (response.success) {
                    // Optionally, refresh part of the page here, such as the cart count or cart contents
                    if (response.data.fragments) {
                        $.each(response.data.fragments, function (selector, html) {
                            $(selector).replaceWith(html);
                        });
                    }
                } else {
                    console.log('Failed to remove the item');
                }
            }
        });
    }


    //close cart

    // open cart
    openCart(event) {
        event.preventDefault();
        this.cartContainer.slideToggle('fast');
        $('.header .shopping-cart a i').toggleClass('fa-chevron-up');
    }


    closeCart() {
        this.cartContainer.slideUp('fast');
        $('.header .shopping-cart a i').removeClass('fa-chevron-up');
    }

    // Handles clicks outside the cart
    handleDocumentClick(e) {
        // Check if the click was outside the cart and the cart is open
        if (!this.cartContainer.is(e.target) && this.cartContainer.has(e.target).length === 0 && this.cartContainer.is(':visible') && !$(e.target).closest('.open-cart-wrapper').length) {
            this.closeCart();
        }
    }

}

export default PopUpCart;