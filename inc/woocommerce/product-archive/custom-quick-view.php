<?php 
add_action('woocommerce_after_shop_loop_item', 'add_quick_view_button', 20);

function add_quick_view_button() {
    global $product;
    echo '<button class="quick-view-btn" data-product_id="' . $product->get_id() . '">Quick View</button>';
}

add_action('quick-view-modal-webduel', 'quick_view_modal');
function quick_view_modal(){ 
    if( is_archive()){ 
        ?>
<!-- Quick View Modal Structure -->
<div id="quick-view-modal">

    <div class="popup-overlay"></div>
    <div class="quick-view-wrapper">
        <!-- Close Button -->
        <div class="closePopupBtn"><svg width="20px" height="20px" viewBox="0 0 43 43" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M23.7421 21.7825L33.4747 31.5151L31.5141 33.4757L21.7815 23.7431L21.4987 23.4602L21.2159 23.7431L11.4833 33.4757L9.52272 31.5151L19.2553 21.7825L19.5381 21.4997L19.2553 21.2168L9.52272 11.4843L11.4833 9.52369L21.2159 19.2563L21.4987 19.5391L21.7815 19.2563L31.5141 9.52369L33.4747 11.4843L23.7421 21.2168L23.4593 21.4997L23.7421 21.7825Z"
                    fill="black" stroke="white" stroke-width="0.8" />
            </svg>
        </div>
        <!-- loading -->
        <div class="loading-wrapper">
            <?php 
        do_action('webduel_loading_icon'); 
        ?>
        </div>
        <div class="quick-view-content">

            <!-- Product details will be loaded here -->
        </div>

    </div>
</div>
<?php 
    }
 
}



// ajax to load the content for the modal 
add_action( 'wp_ajax_load_product_quick_view', 'load_product_quick_view' );
add_action( 'wp_ajax_nopriv_load_product_quick_view', 'load_product_quick_view' );
function load_product_quick_view() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'wp_rest')) {
        wp_die('Nonce verification failed!');
    }
    
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 4;

    if ($product_id) {
        global $product;
        $product = wc_get_product($product_id);

        if ($product) {
            wc_get_template('single-product/quick-view.php');
        } else {
            error_log('Quick view AJAX call: Product not found for ID ' . $product_id);
            wp_die('Product not found'); // Ensure this message is only for debugging and not shown to users
        }
    } else {
        error_log('Quick view AJAX call: No product ID provided.');
        wp_die('No product ID provided'); // Ensure this message is only for debugging and not shown to users
    }

    wp_die(); // Ensure this is at the end to properly terminate the AJAX request
}

add_filter( 'woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect' );
function custom_add_to_cart_redirect() {
    return false; // This will prevent redirection
}