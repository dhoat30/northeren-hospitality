<?php
//remove product from cart 
add_action('wp_ajax_remove_item_from_cart', 'remove_item_from_cart_callback');
add_action('wp_ajax_nopriv_remove_item_from_cart', 'remove_item_from_cart_callback'); // Enable for logged-out users too, if needed

function remove_item_from_cart_callback() {
    check_ajax_referer('wp_rest', 'security');

   
    $cart_item_key = isset($_POST['cart_item_key']) ? wc_clean($_POST['cart_item_key']) : '';
    if (!empty($cart_item_key)) {
        WC()->cart->remove_cart_item($cart_item_key);
    }

    // Generate cart fragments to return.
    $cart_fragments = get_custom_cart_fragments();

    wp_send_json_success(array('fragments' => $cart_fragments));

    wp_die(); // This is required to terminate immediately and return a proper response
}


function get_custom_cart_fragments() {
    ob_start();
   // Adjust path as needed
   get_template_part('inc/templates/custom-cart-popup');
   $popup_cart = ob_get_clean();

//    update count 
   ob_start();
   get_template_part('inc/templates/cart-count');
    $cart_count = ob_get_clean();

//    update count mobile bottom nav
ob_start();
get_template_part('inc/templates/nav-cart-count');
$bottom_nav_cart_count = ob_get_clean();
    // You can add more fragments if needed
    return array(
        '.cart-box' => $popup_cart, 
        '.cart-item-count' => $cart_count, 
        '.mobile-bottom-nav-cart-link'=> $bottom_nav_cart_count

    );
}