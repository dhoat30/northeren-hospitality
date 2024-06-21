<?php 
// wrap qty field and add to cart button in div on product loop page 
add_action('woocommerce_after_shop_loop_item_title', function(){ 
    webduel_add_to_cart_button_wrapper();
 }, 10);
// wrap add to cart button with div 
function webduel_add_to_cart_button_wrapper(){ 
    global $product;

    ?>
<div class="loop-add-to-cart-btn-wrapper">
    <?php 
}

// -----------------------------------------------------------------------------------------

// Archive page -  remove read more button and change it with the custom buttons  
add_filter('woocommerce_loop_add_to_cart_link', function($button, $product){ 
    return webduel_custom_quote_buttons($button, $product); 
}, 20, 3);


// custom quote buttons 
function webduel_custom_quote_buttons($button, $product){ 


    if ((!$product->is_purchasable() || !$product->is_in_stock())  ) {
        return webduel_add_to_cart_button_html("Product enquiry", "secondary-button",  "enquire-now-button"); 
    }
    if (($product->is_purchasable() && $product->is_in_stock()) && $product->get_type() != 'variable'   ) {
        return webduel_add_to_cart_button_html("Add to cart", "primary-button",  "archive_add_to_cart_button"); 
    }


    // Return the normal Add to Cart button if the product is purchasable and in stock.
    return $button;
}

// Single Product page -  remove read more button and change it with the custom buttons on single product page 
// add_action('woocommerce_single_product_summary', 'customize_single_add_to_cart', 30);

function customize_single_add_to_cart() {
    global $product;
//    check if the shop is taking online orders. I have added an acf field to site settings 
$sellToggle = get_field('sell_online', 'option');
    if ((!$product->is_purchasable() || !$product->is_in_stock()) ) {
        return webduel_add_to_cart_button_html("Product enquiry", "secondary-button",  "enquire-now-button"); 
    }
    if (($product->is_purchasable() && $product->is_in_stock())    ) {
        return webduel_add_to_cart_button_html("Add to cart", "primary-button",  "archive_add_to_cart_button"); 
    }

  
}

function webduel_add_to_cart_button_html($button_label, $button_class, $cssClass){ 
    $product_id = get_the_ID();
$product = wc_get_product($product_id);

// Create an associative array of the product details
$product_details = array(
    'id' => $product_id,
    'title' => $product->get_name(),
    'image' =>  wp_get_attachment_image_url($product->get_image_id(), "woocommerce_single")
);
// Convert the array into a JSON string
$product_details_json = json_encode($product_details);
    ?>

    <div class="webduel-qty-wrapper">
        <label class="screen-reader-text" for="quantity_666e2a70ebfba">195mm dia Glass Plate quantity</label>
        <div class="quantity-button decrease">-</div>
        <div class="quantity">
            <input type="number" id="quantity_666e2b5a376b4" class="input-text qty text" name="quantity" value="1"
                aria-label="Product quantity" size="4" min="1" max="" step="1" placeholder="" inputmode="numeric"
                autocomplete="off">
        </div>
        <div class="quantity-button increase">+</div>
    </div>
    <?php
        echo '<button data-product-id="'.$product_id.'" data-product="' . esc_attr($product_details_json) . '"  
   class="'.$cssClass.' '. $button_class.'"><span data-product="' . esc_attr($product_details_json) . '"  >'.  $button_label.' </span></button>';  // This will not show any button if the product is not purchasable or not in stock.
    ?>
    <div class="success-message"></div>
    <div class="error-message"></div>
    <?php
}
// -----------------------------------------------------------------------------------------

// remove add to cart button if the store is not selling online 
// Remove Add to Cart button and quantity field from single product pages
// add_action( 'woocommerce_single_product_summary', 'remove_add_to_cart_button', 1 );

function remove_add_to_cart_button() {
    //    check if the shop is taking online orders. I have added an acf field to site settings 
    // if the shop is not selling online then remove the add to cart button 
$sellToggle = get_field('sell_online', 'option');
    if (is_product() && !$sellToggle) { // Checks if it is a single product page
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
        add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );
    }
}