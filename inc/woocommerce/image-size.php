<?php 

add_theme_support( 'post-thumbnails' );

function remove_unused_image_sizes() {
    // Removes the predefined image sizes in WordPress that are not used.
    remove_image_size('medium');          // Removes Medium size
    remove_image_size('medium_large');    // Removes Medium Large size
}

add_action('init', 'remove_unused_image_sizes');

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
function mytheme_add_woocommerce_support(){
    add_theme_support( 'wc-product-gallery-zoom' );
        // add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

    // add_theme_support( 'wc-product-gallery-lightbox' );
    // add_theme_support( 'wc-product-gallery-slider' );
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 350,
        'gallery_thumbnail_image_width' => 80,
        'single_image_width' => 900,
    
        ));

  
    
}