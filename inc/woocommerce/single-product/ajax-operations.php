<?php
add_action('wp_ajax_webduel_ajax_add_to_cart', 'webduel_ajax_add_to_cart');
add_action('wp_ajax_nopriv_webduel_ajax_add_to_cart', 'webduel_ajax_add_to_cart');

function webduel_ajax_add_to_cart() {
    check_ajax_referer('wp_rest', 'security');

    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $variation_id = isset($_POST['variation_id']) ? absint($_POST['variation_id']) : 0;
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);

    // Handle attributes if necessary and only if a variation ID is provided
    $variations = [];
    if ($variation_id) {
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'attribute_') === 0) {
                $variations[$key] = $value;
            }
        }
    }

    // Check if product ID is provided, and if it's a variable product, check for variation ID
    if (!$product_id || ($variation_id && empty($variations))) {
        wp_send_json_error('Product ID or Variation ID is missing.');
        wp_die();
    }

    $added = WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variations);

    if (!$added) {
        wp_send_json_error("Failed to add product to the cart.");
    } else {
        WC()->session->set('refresh_totals', true); // Ensure totals are recalculated
        WC_AJAX::get_refreshed_fragments();
    }

    wp_die();
}



// Define the callback function outside the 'webduel_ajax_add_to_cart' function
function set_custom_price($price, $product) {
    // Check if the global variable is set and return the custom price
    if (isset($GLOBALS['customPriceForProduct'])) {
        return $GLOBALS['customPriceForProduct'];
    }
    return $price; // Return the default price if no custom price is set
}

// Adjusts the cart item's price if a custom price is set
add_filter('woocommerce_before_calculate_totals', 'adjust_cart_items_prices', 10, 1);
function adjust_cart_items_prices($cart) {
    if (is_admin() && !defined('DOING_AJAX')) return;

    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        if (isset($cart_item['customPrice'])) {
            $cart_item['data']->set_price($cart_item['customPrice']);
        }
    }
}

// Hook into the process of adding item to the cart
add_filter('woocommerce_add_cart_item_data', 'add_custom_price_to_cart_item', 10, 4);
function add_custom_price_to_cart_item($cart_item_data, $product_id, $variation_id, $quantity) {
    if (isset($_POST['customPrice'])) {
        $customPrice = floatval($_POST['customPrice']);
        $cart_item_data['customPrice'] = $customPrice;
    }
    return $cart_item_data;
}



// show live cart item number in the header on add to cart
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_item_fragment');

function woocommerce_header_add_to_cart_item_fragment($fragments)
{
    global $woocommerce;
    ob_start();
    get_template_part('inc/templates/cart-count');

    $fragments['span.cart-item-count'] = ob_get_clean();
    return $fragments;
}
// show live cart item number in the mobile bottom navbar on add to cart
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_bottom_navbar_add_to_cart_item_fragment');

function woocommerce_bottom_navbar_add_to_cart_item_fragment($fragments)
{
    global $woocommerce;
    ob_start();
    get_template_part('inc/templates/nav-cart-count');

    $fragments['.mobile-bottom-nav-cart-link'] = ob_get_clean();
    return $fragments;
}


//add to cart ajax
/**
 * Show cart contents / total Ajax
 */

add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;
    ob_start();
    get_template_part('inc/templates/custom-cart-popup');

    $fragments['.cart-box'] = ob_get_clean();
    return $fragments;
}