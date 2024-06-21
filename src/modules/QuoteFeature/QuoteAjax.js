const $ = jQuery
class QuoteAjax {
    constructor() {
        this.addToQuoteButton = $('.add-to-quote-button');
        this.removeProductButton = $('.remove-product-quote');
        this.bindEvents()
    }
    bindEvents() {
        $(this.addToQuoteButton).on('click', this.addToCart.bind(this));
        // remove product 
        $(this.removeProductButton).on('click', this.removeProduct.bind(this));
    }

    addToCart(e) {
        e.preventDefault();
        const $button = $(e.currentTarget); // Getting the actual clicked button
        const $buttonText = $button.find('span').text();
        const buttonHTML = $button.html();
        const productID = $(e.currentTarget).data('product-id');
        const quantity = $(e.currentTarget).prev('.webduel-quantity').find('.qty').val();

        const data = {
            action: 'add_to_quote',
            product_id: productID,
            quantity: quantity,
            security: webduelData.nonce,
        }
        // add html in the button 
        $(e.currentTarget).html('<div class="dots"></div>');

        this.ajaxRequest(data, $button, buttonHTML);
    }
    removeProduct(e) {
        var productId = $(e.currentTarget).data('product-id');  // Get the product ID from the data attribute
        var row = $(e.currentTarget).closest('.wc-block-cart-items__row');  // Get the closest row to remove from the UI later
        this.removeAjaxRequest(productId, row);
    }
    // reusable f
    ajaxRequest(data, $button, buttonHTML) {
        // add html in the button 
        $button.html('<div class="dots-loading"></div>');

        $.ajax({
            type: 'POST',
            url: webduelData.ajaxurl,
            data: data,
            success: function (response) {

                // if I get an error from the server
                // update the fragments 

                if (response.success === false) {
                    $button.html(buttonHTML);

                    // $('.single-product .error-message').show();
                    $button.siblings('.error-message').show()
                    $button.siblings('.error-message').text("Something went wrong, please try again later.");

                }
                else {
                    // add html in the button 
                    $button.html(buttonHTML);
                    $button.siblings('.success-message').show();
                    const quoteURL = `${location.protocol}//${location.host}/quote`
                    $button.siblings('.success-message').html(`<div>Product added! <a href="${quoteURL}">View quote</a></div>`);

                    $('.quote-modal-content').html(response.data.quote_html);
                }

                // add a pulse-loading class to the add to cart button 
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('AJAX error:', textStatus, errorThrown);
                $button.siblings('.error-message').show()
                $button.html(buttonHTML);
            },
            dataType: 'json'
        });
    }

    // remove product from quote
    removeAjaxRequest(productId, row) {
        $.ajax({
            url: webduelData.ajaxurl,  // Ensure my_ajax_object and ajax_url are correctly defined
            type: 'POST',
            data: {
                action: 'remove_from_quote',
                product_id: productId,
                security: webduelData.nonce,
            },
            success: function (response) {
                if (response.success) {
                    row.remove();  // Remove the row from the UI if AJAX call is successful
                } else {
                    alert('Failed to remove the item.');
                }
            },
            error: function () {
                alert('Failed to process the request.');
            }
        });
    }
}
export default QuoteAjax