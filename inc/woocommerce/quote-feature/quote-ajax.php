<?php 
add_action('wp_ajax_add_to_quote', 'handle_add_to_quote');
add_action('wp_ajax_nopriv_add_to_quote', 'handle_add_to_quote'); // If you want not logged in users to use this

function handle_add_to_quote() {
    // Check if the user is logged in (optional depending on your requirements)
    if (!is_user_logged_in()) {
        wp_send_json_error('You must be logged in to add items to the quote.');
        return;
    }

    // Ensure both product_id and quantity are passed
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;  // Default quantity to 1 if not specified

    if ($product_id <= 0) {
        wp_send_json_error('Invalid product.');
        return;
    }

    // Check for existing cookie and decode it
    $quote_products = array();
    if (isset($_COOKIE['quote_products'])) {
        $quote_products = json_decode(stripslashes($_COOKIE['quote_products']), true);
    }

    // Check if product already exists in the array and update quantity
    $found = false;
    foreach ($quote_products as &$item) {
        if ($item['id'] == $product_id) {
            $item['qty'] += $quantity;
            $found = true;
            break;
        }
    }

    // Add new item if not found
    if (!$found) {
        $quote_products[] = array('id' => $product_id, 'qty' => $quantity);
    }

    // Set or update the cookie
    setcookie('quote_products', json_encode($quote_products), time() + 86400, '/'); // 86400 = 1 day
    $_COOKIE['quote_products'] = json_encode($quote_products); // Update the local PHP copy as well

    wp_send_json_success('Product added to quote.');
}

// remove product from quote cookies 
function handle_remove_from_quote() {
    if (!isset($_POST['product_id'])) {
        wp_send_json_error('Product ID is required');
    }

    $product_id = intval($_POST['product_id']);
    $quote_products = isset($_COOKIE['quote_products']) ? json_decode(stripslashes($_COOKIE['quote_products']), true) : [];

    foreach ($quote_products as $key => $item) {
        if ($item['id'] == $product_id) {
            unset($quote_products[$key]);  // Remove the item from the array
            setcookie('quote_products', json_encode(array_values($quote_products)), time() + 86400, '/'); // Reset the cookie
            $_COOKIE['quote_products'] = json_encode(array_values($quote_products)); // Update PHP's cookie global
            wp_send_json_success('Product removed successfully');
        }
    }

    wp_send_json_error('Product not found');
}
add_action('wp_ajax_remove_from_quote', 'handle_remove_from_quote');
add_action('wp_ajax_nopriv_remove_from_quote', 'handle_remove_from_quote');  // If you want to allow non-logged-in users to use this