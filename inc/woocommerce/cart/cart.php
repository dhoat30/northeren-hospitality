<?php



add_filter('woocommerce_cart_item_name', 'add_remove_button_next_to_cart_item_name', 10, 3);

function add_remove_button_next_to_cart_item_name($product_name, $cart_item, $cart_item_key) {
    $remove_link = wc_get_cart_remove_url($cart_item_key);
    $remove_button_html = sprintf(
        '<a href="%s" class="remove" style="color: #ff0000; margin-left: 10px;">&times;</a>',
        esc_url($remove_link)
    );

    return $product_name . ' ' . $remove_button_html;
}