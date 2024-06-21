<?php
// change the breadcrumb location on product archive page 
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action('woocommerce_before_shop_loop', 'woocommerce_breadcrumb', 10);
// add wrapper around results and sorting form 
add_action('woocommerce_before_shop_loop', function(){
    ?>
<div class="webduel-sort-form-wrapper">
    <?php
    echo facetwp_display('facet', 'results'); 
}, 15);
// add wrapper around results and sorting form 
add_action('woocommerce_before_shop_loop', function(){
    ?>
</div>
<?php
}, 30);

// add filters on archive page 
add_action('woocommerce_before_shop_loop', 'add_filters_on_archive_page', 10);
function add_filters_on_archive_page()
{
   ?>
<div class="webduel-loop-wrapper">
    <div class="filter-wrapper">
        <div class="close-icon">
            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" enable-background="new 0 0 512 512" height="28px"
                viewBox="0 0 512 512" width="28px">
                <g id="close">
                    <g>
                        <path
                            d="m256 25c31.196 0 61.445 6.104 89.908 18.143 27.504 11.633 52.211 28.293 73.434 49.516s37.882 45.929 49.516 73.434c12.038 28.462 18.142 58.711 18.142 89.907s-6.104 61.445-18.143 89.908c-11.633 27.504-28.293 52.211-49.516 73.434s-45.929 37.882-73.434 49.516c-28.462 12.038-58.711 18.142-89.907 18.142s-61.445-6.104-89.908-18.143c-27.504-11.633-52.211-28.293-73.434-49.516s-37.882-45.929-49.516-73.434c-12.038-28.462-18.142-58.711-18.142-89.907s6.104-61.445 18.143-89.908c11.633-27.504 28.293-52.211 49.516-73.434s45.929-37.882 73.434-49.516c28.462-12.038 58.711-18.142 89.907-18.142m0-25c-141.385 0-256 114.615-256 256s114.615 256 256 256 256-114.615 256-256-114.615-256-256-256z"
                            fill="rgb(0,0,0)" />
                    </g>
                    <g>
                        <path
                            d="m358.2 370.7c-3.199 0-6.398-1.221-8.839-3.661l-204.4-204.4c-4.881-4.881-4.881-12.796 0-17.678 4.882-4.882 12.796-4.882 17.678 0l204.4 204.4c4.882 4.882 4.882 12.796 0 17.678-2.44 2.44-5.64 3.661-8.839 3.661z"
                            fill="rgb(0,0,0)" />
                    </g>
                    <g>
                        <path
                            d="m153.8 370.7c-3.199 0-6.398-1.221-8.839-3.661-4.881-4.882-4.881-12.796 0-17.678l204.4-204.4c4.881-4.882 12.797-4.882 17.678 0 4.882 4.881 4.882 12.796 0 17.678l-204.4 204.4c-2.441 2.44-5.639 3.661-8.839 3.661z"
                            fill="rgb(0,0,0)" />
                    </g>
                </g>
                <g />
                <g />
                <g />
                <g />
                <g />
                <g />
            </svg>
        </div>
        <?php 
            echo facetwp_display( 'facet', 'search' );
    echo facetwp_display( 'facet', 'categories' );
    echo facetwp_display( 'facet', 'brands' );


    echo facetwp_display( 'facet', 'colour' );
    echo facetwp_display( 'facet', 'reset_filters' );


        ?>
    </div>
    <div class="webduel-product-loop"> <?php
    // add facet user selection 
    echo facetwp_display( 'selections' ); 
} 

add_action('woocommerce_after_shop_loop', 'close_loop_wrapper', 40);
function close_loop_wrapper()
{    
    // add load more button 
    echo do_shortcode('[facetwp template=[facetwp facet="load_more"]');

   ?> </div>
</div>
<?php
}
// remove product anchor tag and add it right under the thumbnail
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 5);
// woocommerce variations 

// wrap product archive title with anchor 
add_action('woocommerce_shop_loop_item_title', 'wrap_title_with_anchor', 7);
function wrap_title_with_anchor()
{
   global $product;
   // echo do_shortcode('[design_board_button_code]')
?>
<a href="<?php echo get_permalink($product->get_id()); ?>" alt="<?php echo $product->get_name(); ?>"
    class="product-title">
    <?php
}
add_action('woocommerce_shop_loop_item_title', function () {
   ?>
</a>
<?php
}, 30);




add_action('pre_get_posts', 'customize_product_archive_query');
function customize_product_archive_query($query) {
    // Check if we're on the product archive page and it's the main query
    if (!is_admin() && $query->is_main_query() ) {
        $query->set('posts_per_page', 12);  // Set the number of products per page to 12
    }
}


// get rid of the decimal 00  
add_filter('woocommerce_get_price_html', 'webduel_adjust_price_display', 10, 2);
function webduel_adjust_price_display($price_html, $product) {
    // Check if the price ends with '.00', and if so, format without decimals
    if (preg_match('/\.00/', $price_html)) {
        // Strip out .00 from both regular and sale prices
        $price_html = preg_replace('/\.00/', '', $price_html);
    }

    return $price_html;
}

// remove pagination 
function remove_woocommerce_pagination() {
    remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
}
add_action('init', 'remove_woocommerce_pagination');

// show colour facet name instead of a slug 
add_filter( 'facetwp_facet_display_value', function( $label, $params ) {
    if ( 'colour' == $params['facet']['name'] ) { // Replace "my_color_facet_name" with the name of your Color facet.
      $label = $params['row']['facet_value']; // Use the facet_value (term slug) as label. By default, $label is empty.
      $label = ucwords(str_replace('-', ' ', $label)); // Replace dashes with  and capitalize the first letters.
    }
    return $label;
  }, 10, 2);

//   remove woocommerce results 
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

// add skeleton 
// Add skeleton loader before the product thumbnail
add_action('woocommerce_before_shop_loop_item_title', 'add_skeleton_loader', 5);

function add_skeleton_loader() {
    echo '<div class="skeleton"></div>';
}

// add lazy load to images 
function add_lazy_loading_to_woocommerce_images($attr, $attachment, $size) {
    // Ensure this only applies to WooCommerce product images on archive pages
    if (is_woocommerce()) {
        $attr['loading'] = 'lazy';
        // $attr['style'] = 'display: none;';
    }
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'add_lazy_loading_to_woocommerce_images', 10, 3);

// gst toggle code  
function add_hidden_price_fields($price_html, $product) {
    // Retrieve the base price (excluding GST)
    $base_price = (float) $product->get_price();
    // $gst_rate = get_option('woocommerce_gst_rate', 0.1); // Ensure this is configured correctly in your settings

    $gst_inclusive_price = $base_price * (1 + 0.15);

    // Append hidden inputs with these prices
    $price_html .= '<input type="hidden" class="hidden-price-excl-gst" value="' . esc_attr(number_format($base_price, 2)) . '">';
    $price_html .= '<input type="hidden" class="hidden-price-incl-gst" value="' . esc_attr(number_format($gst_inclusive_price, 2)) . '">';

    return $price_html;
}

add_filter('woocommerce_get_price_html', 'add_hidden_price_fields', 10, 2);

// add toggle button to navbar 
add_action('webduel_gst_toggle', 'gst_toggle_button', 15);

function gst_toggle_button() {
    ?>
<div class="gst-toggle">
    <label for="gstToggle" class="body2">
        <?php
 echo isset($_COOKIE['show_gst']) && $_COOKIE['show_gst'] === 'inclusive' ? __('PRICES INC. GST', 'webduelTheme'):__('PRICES EXCL. GST', 'webduelTheme'); ?>

    </label>

    <label class="switch">
        <input type="checkbox" class="gst-toggle-btn"
            <?php echo isset($_COOKIE['show_gst']) && $_COOKIE['show_gst'] === 'inclusive' ? 'checked' : ''; ?>>
        <span
            class="slider round  <?php echo isset($_COOKIE['show_gst']) && $_COOKIE['show_gst'] === 'inclusive' ? 'active' : ''; ?>"></span>
    </label>
</div>
<script>
jQuery(document).ready(function($) {
    $('.gst-toggle-btn').on('change', function() {
        var includeGST = $(this).is(':checked') ? 'inclusive' : 'exclusive';
        document.cookie = "show_gst=" + includeGST + ";path=/;max-age=" + 60 * 60 * 24 * 7;
        //   toggle the active class
        if (includeGST === 'inclusive') {
            $('.gst-toggle .slider').addClass('active')
        } else {
            $('.gst-toggle .slider').removeClass('active')
        }
        setTimeout(function() {
            window.location.reload();
        }, 1000);
        window.location.reload(); // Reload the page to apply the new setting
    });
});
</script>
<?php
}

// here we check if the inc gst cookie is set and if it is we update the woocommerce settings to display the price inclusive of gst
add_action('init', 'adjust_gst_display_settings');
function adjust_gst_display_settings() {
    if (isset($_COOKIE['show_gst']) && $_COOKIE['show_gst'] === 'inclusive') {
        update_option('woocommerce_tax_display_shop', 'incl');
        update_option('woocommerce_tax_display_cart', 'incl');
    } else {
        update_option('woocommerce_tax_display_shop', 'excl');
        update_option('woocommerce_tax_display_cart', 'excl');
    }
}
    // here is the code to display the price suffix based on the cookie value
    function get_price_suffix() {
        if (isset($_COOKIE['show_gst']) && $_COOKIE['show_gst'] === 'inclusive') {
            return " incl GST"; // Include GST in price display
        } else {
            return " excl GST"; // Exclude GST from price display
        }
    }
    //     // Add the GST suffix to product prices
    add_filter('woocommerce_get_price_html', 'add_gst_suffix_to_prices', 300, 2);

    function add_gst_suffix_to_prices($price, $product) {
        // check if this is a single product page 
        $suffix = get_price_suffix();

            $suffix = '<span class="gst-suffix">' . $suffix . '</span>';

    
        return $price . $suffix;
    }