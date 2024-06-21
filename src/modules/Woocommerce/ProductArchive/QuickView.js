const $ = jQuery
class QuickView {
    constructor() {
        this.initEvents();
    }

    initEvents() {
        // open quick view and load content 
        $('.quick-view-btn').on('click', (e) => this.openQuickView(e));
        // close quick view 
        $('.popup-overlay').on('click', (e) => this.closeQuickView(e));
        $(document).on('click', '.closePopupBtn', (e) => this.closeQuickView(e));

        // send ajax request to add a product to the cart 
        $('body').on('submit', '#quick-view-modal .cart', (e) => this.handleAddToCart(e));

        // show variation for changing image 
        $('#quick-view-modal').on('show_variation', (event, variation) => this.updateImage(variation));
    }

    openQuickView(e) {
        e.preventDefault();
        const product_id = $(e.currentTarget).data('product_id');
        // Display the modal
        $('#quick-view-modal').show();
        $('#quick-view-modal .quick-view-content').html("");
        $('#quick-view-modal .loading-wrapper').show();

        $.ajax({
            url: webduelData.ajaxurl,
            type: 'POST',
            data: {
                'action': 'load_product_quick_view',
                'product_id': product_id,
                'nonce': webduelData.nonce // Make sure this matches the nonce name used in wp_localize_script
            },
            success: (result) => {
                // Load the result into the modal
                $('#quick-view-modal .quick-view-content').html(result);
                $('#quick-view-modal .loading-wrapper').hide();

                // Reinitialize variation forms
                $('#quick-view-modal .variations_form').each(function () {
                    $(this).wc_variation_form();
                    $(this).trigger('check_variations');
                });

            }
        });
    }
    closeQuickView() {
        $('#quick-view-modal').hide();
    }

    handleAddToCart(e) {
        e.preventDefault();
        const $form = jQuery(e.currentTarget);

        const product_id = $form.find('[name=add-to-cart]').val() || $form.find('.single_add_to_cart_button').val();
        const variation_id = $form.find('[name=variation_id]').val();
        const quantity = $form.find('[name=quantity]').val();

        let data = {
            action: 'webduel_ajax_add_to_cart',
            product_id: product_id,
            quantity: quantity,
            product_variation_id: variation_id,
            'nonce': webduelData.nonce // Make sure this matches the nonce name used in wp_localize_script

        };

        // Include selected variation attributes if present
        $form.find('.variations select').each(function () {
            const attribute_name = jQuery(this).attr('name');
            data[attribute_name] = jQuery(this).val();
        });


        this.sendAjaxRequest(data);
    }

    sendAjaxRequest(data) {
        $('#quick-view-modal .cart .button').addClass('pulse-loading');
        jQuery.post(webduelData.ajaxurl, data, (response) => {

            if (!response.error && response.fragments) {
                // Update cart fragments
                jQuery(document.body).trigger('wc_fragment_refresh');
                this.showAddToCartNotification("Product added!");
                // $('#quick-view-modal .cart .button').removeClass('pulse-loading');

            }
            else {
                // Handle error
                this.showAddToCartNotification('Failed to add product to cart.', true);
            }

        });
    }

    // change variation image on selection 
    updateImage(variation) {
        // Ensure variation data is valid
        if (variation && variation.image && variation.image.src) {
            jQuery('#quick-view-main-image').attr('src', variation.image.src);
        }
    }

    showAddToCartNotification(message, isError = false) {
        let notificationElement = $('#add-to-cart-notification');
        notificationElement.text(message);

        if (isError) {
            notificationElement.addClass('error');
        } else {
            notificationElement.removeClass('error');
        }

        notificationElement.fadeIn(400).delay(3000).fadeOut(400);
    }
}

export default QuickView

