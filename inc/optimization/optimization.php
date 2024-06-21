<?php 

function remove_block_library_css(){
    wp_dequeue_style( 'wp-block-library' ); // WordPress core
    wp_dequeue_style( 'wp-block-library-theme' ); // WordPress core
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
    // wp_dequeue_style( 'megamenu' ); // Remove WooCommerce block CSS

    if ( is_front_page() ) {
        // enqueue style for front page 
        
        wp_dequeue_style('jquery-selectBox');
        wp_dequeue_style('woocommerce_prettyPhoto_css');
        wp_dequeue_style('yith-wcwl-main');
        wp_dequeue_style('wt-import-export-for-woo');
        wp_dequeue_style('woocommerce-layout');
        wp_dequeue_style('woocommerce-smallscreen');
        wp_dequeue_style('woocommerce-general');
        wp_dequeue_style('woocommerce-inline');
        wp_dequeue_style( 'wphf-style' );

        // de register scripts
        wp_deregister_script('wp-polyfill-inert');
        wp_deregister_script('sourcebuster-js');
        wp_deregister_script('woocommerce');
        wp_deregister_script('jquery-blockui');


        //                 // new optimization 

        // wp_dequeue_style('dashicons'); 

    }
    else if ( is_shop() || is_product_category() || is_product_tag()){ 
        // wp_dequeue_style('woo-variation-swatches'); // remove wishlist
        wp_dequeue_style('woocommerce_prettyPhoto_css');
        wp_dequeue_style('wt-import-export-for-woo');
        wp_dequeue_style('woocommerce-smallscreen');
        wp_dequeue_style('woocommerce-inline');

         // new optimization 
        wp_dequeue_style('wcpa-frontend');
        // wp_dequeue_style('dashicons'); 



       
    } 
    else if (is_product()){ 
        wp_dequeue_style('jquery-selectBox');
        wp_dequeue_style('woocommerce_prettyPhoto_css');
        wp_dequeue_style('wt-import-export-for-woo');
        wp_dequeue_style('woocommerce-smallscreen');
        // new optimization 

    }

}

add_action( 'wp_enqueue_scripts', 'remove_block_library_css', 100 );

// function custom_dequeue_script() {
//     wp_dequeue_script('wcpa-front');
//     wp_dequeue_script('wcpa-front-js-extra');
// }
// add_action('wp_print_scripts', 'custom_dequeue_script', 200);

// enqeue scripts for variations on archive page 
function my_enqueue_woocommerce_scripts() {
    if (is_woocommerce() || is_shop() || is_product_category() || is_product_tag()) {
        wp_enqueue_script('wc-add-to-cart-variation');
    }
    if (class_exists('WooCommerce')) {
        wp_enqueue_script('wc-add-to-cart', plugins_url() . '/woocommerce/assets/js/frontend/add-to-cart.min.js', array('jquery'), WC_VERSION, true);
        wp_enqueue_script('wc-cart-fragments', plugins_url() . '/woocommerce/assets/js/frontend/cart-fragments.min.js', array('jquery', 'wc-add-to-cart'), WC_VERSION, true);
    }
}
add_action('wp_enqueue_scripts', 'my_enqueue_woocommerce_scripts');