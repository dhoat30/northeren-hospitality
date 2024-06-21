const $ = jQuery;
class AjaxAddToCart {
    constructor() {
        this.bindEvents();
    }
    bindEvents() {

        $('.single .single_add_to_cart_button').on('click', this.addToCart.bind(this));
        // Correctly bind `this` for loopAddToCart
        $('.archive_add_to_cart_button').on('click', this.loopAddToCart.bind(this));
    }


    loopAddToCart(e) {
        e.preventDefault();
        var $button = $(e.currentTarget); // Getting the actual clicked button

        // Use 'this' to refer to the clicked button and navigate the DOM
        var $wrapper = $button.closest('.loop-add-to-cart-btn-wrapper');

        const productID = $button.data('product-id');
        const quantity = $wrapper.find('.qty').val();
        let customData = {};

        const data = {
            action: 'webduel_ajax_add_to_cart',
            product_id: productID,
            variation_id: null,
            quantity: quantity,
            security: webduelData.nonce,
        }
        this.ajaxRequest(data, $button);
    }
    addToCart(e) {
        e.preventDefault();
        var $button = $(e.currentTarget); // Target the button that was clicked
        var $form = $button.closest('form'); // Find the closest form for complete data

        if ($button.hasClass('disabled') || $button.hasClass('wc-variation-selection-needed')) {
            return; // Prevent adding if button is disabled or selection is needed
        }

        // For variable products, product ID comes from a hidden field, and for simple products, it's from the button value
        const productID = $form.find('input[name="product_id"]').val() || $button.val();
        const variationID = $form.find('input[name="variation_id"]').val() || ''; // For variable products
        const quantity = $form.find('.qty').val() || 1; // Default to 1 if no quantity input found

        // Prepare data for AJAX request
        const data = {
            action: 'webduel_ajax_add_to_cart',
            product_id: productID,
            variation_id: variationID ? variationID : null, // Make sure to send the variation ID
            quantity: quantity,
            security: webduelData.nonce
        };

        // Optionally, send attribute selections by finding selected attributes in the form
        $('.variations_form select').each(function () {
            const attribute_name = $(this).attr('name');
            data[attribute_name] = $(this).val();
        });



        this.ajaxRequest(data, $button);

    }
    // reusable f
    ajaxRequest(data, $button) {
        // add html in the button 
        $button.html('<div class="dots-loading"></div>')

        $.ajax({
            type: 'POST',
            url: webduelData.ajaxurl,
            data: data,
            success: function (response) {


                // if I get an error from the server
                // update the fragments 
                if (response.fragments) {
                    $.each(response.fragments, function (key, value) {
                        $(key).replaceWith(value);
                    });
                }
                if (response.fragments && response.cart_hash) {
                    // $button.text('ADD TO CART');
                    // add text in the button 
                    $button.siblings('.success-message').show().html(`Product has been added to your cart. <a href="${webduelData.cart_url}">View Cart</a>`);// Show and update the success message
                    $button.html('Added to cart') // Update button text on success

                    $(document.body).trigger('wc_fragment_refresh'); // Optionally, refresh fragments

                }
                else {
                    $button.siblings('.error-message').show().html(`something went wrong. Please try again`);// Show and update the success message
                    $button.html('Added to cart') // Update button text on success


                }

                // add a pulse-loading class to the add to cart button 
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('AJAX error:', textStatus, errorThrown);
                $button.siblings('.error-message').show()
                $button.html('somehting went wront');
            },
            dataType: 'json'
        });
    }
}

export default AjaxAddToCart;
