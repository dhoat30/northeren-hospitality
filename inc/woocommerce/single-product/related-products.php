<?php 

// add a div around upsells, related products and recently viewed products 
add_action('woocommerce_after_single_product',function (){ 
    echo '<div class="products-loop-wrapper-webduel" >'; 

}, 50); 

// remove upsell hook  
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15); 
add_action('woocommerce_after_single_product', 'woocommerce_upsell_display', 60); 

// increase the number of related products that shown by default
add_filter('woocommerce_output_related_products_args', 'custom_related_products_args');
function custom_related_products_args($args) {
    $args['posts_per_page'] = 8; // Number of related products
    $args['columns'] = 4; // Number of columns
    return $args;
}
/**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 70 );


// recently viewed products - cookies
function add_recently_viewed_product() {
    global $post;

    if (!is_singular('product')) {
        return;
    }

    $viewed_products = !empty($_COOKIE['recently_viewed']) ? explode(',', $_COOKIE['recently_viewed']) : array();
    if (!in_array($post->ID, $viewed_products)) {
        $viewed_products[] = $post->ID;
        $viewed_products = array_slice($viewed_products, -10); // Store last 5 viewed products
        setcookie('recently_viewed', implode(',', $viewed_products), time() + 3600 * 24 * 30, COOKIEPATH, COOKIE_DOMAIN, false);
    }
}

add_action('template_redirect', 'add_recently_viewed_product', 80);
// add a div around upsells, related products and recently viewed products 
add_action('woocommerce_after_single_product',function (){ 
    echo '</div>'; 

}, 90); 
// recently viewed products - html 
function show_recently_viewed_products() {
    if (empty($_COOKIE['recently_viewed'])) return;
    
    $viewed_products = explode(',', $_COOKIE['recently_viewed']);
    $viewed_products = array_reverse($viewed_products); // Reverse array to show the most recent first

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 5,
        'post__in' => $viewed_products,
        'orderby' => 'post__in'
    );

    $loop = new WP_Query($args);

    if ($loop->have_posts()) {
        echo '<section class="recently-viewed-products"><h2 class="h2">Recently Viewed Products</h2><ul class="products columns-4">';

        while ($loop->have_posts()) : $loop->the_post();
            wc_get_template_part('content', 'product');
        endwhile;

        echo '</ul></section>';
    }

    wp_reset_query();
}

add_action('woocommerce_after_single_product', 'show_recently_viewed_products', 80);