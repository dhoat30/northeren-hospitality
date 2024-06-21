<?php 
// add custom field to the product 
add_action('woocommerce_product_options_general_product_data', 'add_custom_fields_to_products');

function add_custom_fields_to_products() {
    echo '<div class="options_group">';

    // Checkbox to indicate if the product is sold by weight
    woocommerce_wp_checkbox(array(
        'id' => '_sold_by_weight',
        'label' => __('Sold by Weight?', 'your-text-domain'),
        'description' => __('Check this if the product is sold by weight', 'your-text-domain'),
    ));

    // Number input for minimum value
    woocommerce_wp_text_input(array(
        'id' => '_minimum_value',
        'label' => __('Minimum Value', 'your-text-domain'),
        'type' => 'number',
        'custom_attributes' => array(
            'step' => 'any',
            'min' => '0',
        ),
        'description' => __('Enter the minimum value for weight', 'your-text-domain'),
        'desc_tip' => true,
    ));

    // Number input for step increment
    woocommerce_wp_text_input(array(
        'id' => '_step_increment',
        'label' => __('Step Increment', 'your-text-domain'),
        'type' => 'number',
        'custom_attributes' => array(
            'step' => 'any',
            'min' => '0',
        ),
        'description' => __('Enter the step increment for weight', 'your-text-domain'),
        'desc_tip' => true,
    ));

    echo '</div>';
}
// save the custom data 
add_action('woocommerce_admin_process_product_object', 'save_custom_fields_data', 10, 1);

function save_custom_fields_data($product) {
    // Sold by weight checkbox
    $sold_by_weight = isset($_POST['_sold_by_weight']) ? 'yes' : 'no';
    $product->update_meta_data('_sold_by_weight', $sold_by_weight);

    // Minimum value field
    if (isset($_POST['_minimum_value'])) {
        $product->update_meta_data('_minimum_value', sanitize_text_field($_POST['_minimum_value']));
    }

    // Step increment field
    if (isset($_POST['_step_increment'])) {
        $product->update_meta_data('_step_increment', sanitize_text_field($_POST['_step_increment']));
    }
}


// add custom field on product that are sold by weight
function add_custom_weight_field_and_price() {
    global $product;
    $sell_by_weight = get_post_meta( $product->get_id(), '_sold_by_weight', true );
    if ( 'yes' === $sell_by_weight ) {
        $price = $product->get_price();
   // Fetching minimum value and step increment from product meta
   $minimum_value = get_post_meta( $product->get_id(), '_minimum_value', true );
   $step_increment = get_post_meta( $product->get_id(), '_step_increment', true );


        // Setting default values in case they are not set
        $minimum_value = !empty($minimum_value) ? $minimum_value : '0.3'; // Default minimum value
        $step_increment = !empty($step_increment) ? $step_increment : '0.1'; // Default step increment

        echo '<div class="custom-weight-field">';
        echo '<label for="customWeight">Enter weight (kg):</label>';
        echo '<input class="custom-weight" type="number" name="custom-weight" min="' . esc_attr($minimum_value) . '" step="' . esc_attr($step_increment) . '" value="1" required>';
        echo '</div>';
        echo '<input type="hidden" class="productPrice" value="' . esc_attr($price) . '">';
    } 
}
add_action('woocommerce_before_add_to_cart_button', 'add_custom_weight_field_and_price');

// add input field on product loop page 
function add_custom_weight_field_and_price_product_loop() {
    global $product;
    $price = $product->get_price();

    $sell_by_weight = get_post_meta( $product->get_id(), '_sold_by_weight', true );
    if ( 'yes' === $sell_by_weight ) {
   // Fetching minimum value and step increment from product meta
   $minimum_value = get_post_meta( $product->get_id(), '_minimum_value', true );
   $step_increment = get_post_meta( $product->get_id(), '_step_increment', true );


        // Setting default values in case they are not set
        $minimum_value = !empty($minimum_value) ? $minimum_value : '0.3'; // Default minimum value
        $step_increment = !empty($step_increment) ? $step_increment : '0.1'; // Default step increment
        ?>
<style>
/* .loop-add-to-cart-btn-wrapper {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 0 !important;

} */
</style>
<?php 
        echo '<div class="custom-weight-field">';
        echo '<label for="customWeight">Enter weight (kg):</label>';
        echo '<input class="custom-weight" type="number" name="custom-weight" min="' . esc_attr($minimum_value) . '" step="' . esc_attr($step_increment) . '" value="1" required>';
        echo '</div>';
        echo '<input type="hidden" class="productPrice" value="' . esc_attr($price) . '">';
    } 
    else { 
        echo '<div class="custom-weight-field">';
        echo '<input class="custom-weight" type="number" name="custom-weight" min="1" step="1" value="1" required>';
        echo '</div>';
    }
}
add_action('woocommerce_after_shop_loop_item_title', 'add_custom_weight_field_and_price_product_loop', 20);


add_filter('woocommerce_get_item_data', function($item_data, $cart_item) {
    if (isset($cart_item['customQuantity'])) {
        $item_data[] = array(
            'name' => __('Weight in kg', 'your-plugin-textdomain'),
            'value' => wc_clean($cart_item['customQuantity'])
        );
    }
    return $item_data;
}, 10, 2);

// hide the default qty input if the product is sold by weight
function hide_default_quantity_input_css() {
    if ( ! is_singular( 'product' ) ) {
        return; // Exit if not on a single product page
    }
    
    global $product;

    // Ensure $product is correctly initialized
    if ( ! is_a( $product, 'WC_Product' ) ) {
        $product = wc_get_product( get_the_ID() );
    }

    // Now proceed with your logic, since $product is guaranteed to be a WC_Product object
    $sell_by_weight = get_post_meta( $product->get_id(), '_sold_by_weight', true );

    if ( 'yes' === $sell_by_weight ) {
        echo '<style>.quantity { display: none !important; }</style>';
    }
}
add_action( 'wp_head', 'hide_default_quantity_input_css' );