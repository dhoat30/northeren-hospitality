<?php 

// add check box field to select if the variation swatch is needed 
function my_edit_wc_attribute_my_field() {
    global $wpdb;
    // Get the current attribute ID from the URL if on the edit attribute page
    $attribute_id = isset($_GET['edit']) ? absint($_GET['edit']) : 0;


    $attribute_slug = $wpdb->get_var(
        $wpdb->prepare("
            SELECT attribute_name
            FROM {$wpdb->prefix}woocommerce_attribute_taxonomies
            WHERE attribute_id = %d
        ", $attribute_id)
    );
    $field_id = "attribute_pa_{$attribute_slug}_enable_swatches";
    // Retrieve the current value of the checkbox
    $current_value = get_option($field_id, 0);
    ?>
<tr class="form-field">
    <th scope="row" valign="top">
        <label for="<?php echo esc_attr($field_id); ?>"><?php _e('Enable Swatches', 'webduelTheme');  ?></label>
    </th>
    <td>
        <input type="checkbox" id="<?php echo esc_attr($field_id); ?>" name="<?php echo esc_attr($field_id); ?>"
            value="1" <?php checked($current_value, 1); ?> />
        <p class="description"><?php _e('Check this to enable swatches for this attribute.', 'webduelTheme'); ?></p>
    </td>
</tr>
<?php
}
add_action('woocommerce_after_add_attribute_fields', 'my_edit_wc_attribute_my_field');
add_action('woocommerce_after_edit_attribute_fields', 'my_edit_wc_attribute_my_field');

// save the checkbox field
add_action('woocommerce_attribute_updated', 'save_enable_swatches_attribute', 10, 3);
function save_enable_swatches_attribute($attribute_id, $data, $attribute) {
    global $wpdb;

    $attribute_slug = $wpdb->get_var(
        $wpdb->prepare("
            SELECT attribute_name
            FROM {$wpdb->prefix}woocommerce_attribute_taxonomies
            WHERE attribute_id = %d
        ", $attribute_id)
    );
    $field_id = "attribute_pa_{$attribute_slug}_enable_swatches";
  

    if (isset($_POST[$field_id])) {
        // Save the option value
        update_option($field_id, $_POST[$field_id] ? 1 : 0);
    } else {
        update_option($field_id, 0);
    }
}



//    check if the swatch is needed 
function is_swatches_enabled_for_attribute($attribute_name) {
    // The ID used in `get_option` should match how you saved it in `save_enable_swatches_attribute`.
    // Assuming $attribute_name is something like 'pa_color'
    $option_name = "attribute_{$attribute_name}_enable_swatches";
    return (bool) get_option($option_name, 0); // Cast the return value as boolean to ensure true or false
}

add_filter('woocommerce_dropdown_variation_attribute_options_html', 'custom_variation_swatches_html', 10, 2);
function custom_variation_swatches_html($html, $args) {
    $options = $args['options'];
    $product = $args['product'];
    $attribute = $args['attribute'];
     // Correctly format the attribute taxonomy name
     $attribute_taxonomy_name = wc_attribute_taxonomy_name($attribute);
    $name = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title($attribute);
    $id = $args['id'] ? $args['id'] : sanitize_title($attribute);
    $class = $args['class'];
  
    // Check if swatches are enabled for this attribute
    if (!is_swatches_enabled_for_attribute($attribute)) {
        return $html; // Return the default dropdown if swatches are not enabled
    }
    // Start by hiding the default select element
    $swatches_html = '<select style="display:none;" id="' . esc_attr($id) . '" name="' . esc_attr($name) . '" class="' . esc_attr($class) . '">';
    foreach ($options as $option) {
        $swatches_html .= '<option value="' . esc_attr($option) . '">' . esc_html(apply_filters('woocommerce_variation_option_name', $option)) . '</option>';
    }
    $swatches_html .= '</select>';

    // Add custom swatch images
    $swatches_html .= '<div class="swatches" id="' . esc_attr($id) . '-swatches">
    <div class="selected-variation-label"></div>
    ';
    if (!empty($options) && taxonomy_exists($attribute)) {
        $terms = wc_get_product_terms($product->get_id(), $attribute, array('fields' => 'all'));
        foreach ($terms as $term) {
            
            if (in_array($term->slug, $options)) {
                $variation = find_variation_by_attribute($product, $attribute, $term->slug);
                if ($variation) {
                    $image_id = $variation->get_image_id();
                    $thumbnail = wp_get_attachment_image_url($image_id, 'thumbnail');
                    $mainImage = wp_get_attachment_image_url($image_id, 'woocommerce_single');
                    $variation_data_encoded = htmlspecialchars(json_encode($variation->get_data()), ENT_QUOTES, 'UTF-8');

                    $swatches_html .= '<img loading="lazy" defer width="80px" height="80px" style="object-fit: cover; " data-variation-label="'.$term->name.'" data-main-image="'.$mainImage.'" data-variation-slug="'.$term->slug.'" class="variation-swatch" src="' . esc_url($thumbnail) . '" alt="' . esc_attr($term->name) . '" data-variation-id="' . esc_attr($variation->get_id()) . '" data-attributes=\'' . $variation_data_encoded . '\' />';
                }
            }
        }
    }
    $swatches_html .= '

    </div>';

    return $swatches_html;
}



// archive page loop ---------------------------------------------------
add_action('woocommerce_shop_loop_item_title', 'add_swatch_to_loop', 6);
function add_swatch_to_loop() {
    global $product;
    if ($product->is_type('variable')) { // Ensure the product has variations



        echo '<div class="loop-swatch-wrapper">';
        echo render_swatches_for_loop($product);
        echo '</div>';
    }
}

function render_swatches_for_loop($product) {
    $attributes = $product->get_variation_attributes();
    $swatches_html = '<div class="swatches">';
    $count = 0;  // Initialize a counter for the swatches

    foreach ($attributes as $attr_name => $options) {
        $attribute_taxonomy_name = wc_attribute_taxonomy_name(str_replace('attribute_pa_', '', $attr_name));

        if (!is_swatches_enabled_for_attribute($attr_name)) {
            continue;  // Skip if swatches are not enabled for this attribute
        }

        foreach ($options as $option) {
            if ($count >= 4) {
                // Add a link to view more if there are more than 4 swatches
                $swatches_html .= sprintf('<a href="%s" class="view-more-swatches">View More</a>', get_permalink($product->get_id()));
                break 2;  // Break out of both loops
            }

            $term = get_term_by('slug', $option, $attr_name);
            if ($term && !is_wp_error($term)) {
                $variation = find_variation_by_attribute($product, $attr_name, $term->slug);
                if ($variation) {
                    $image_id = $variation->get_image_id();
                    if ($image_id) {
                        $thumbnail = wp_get_attachment_image_url($image_id, 'thumbnail');
                        $loopThumbnail = wp_get_attachment_image_url($image_id, 'woocommerce_thumbnail');
                        $swatches_html .= sprintf('<img width="40px" height="40px" style="object-fit: cover;" defer loading="lazy" class="variation-swatch" src="%s" alt="%s" data-attribute_name="%s" data-value="%s" data-loop-main-image="%s" />', esc_url($thumbnail), esc_attr($term->name), esc_attr($attribute_taxonomy_name), esc_attr($option), esc_url($loopThumbnail));
                        $count++;
                    }
                }
            }
        }
    }

    if ($count < 4) {
        // No need for "view more" if there are less than 4 swatches
        $swatches_html .= '</div>';
    } else {
        // Close the swatches div if "view more" link has not been added
        $swatches_html .= '</div>';
    }

    return $swatches_html;
}


// find varition by attributes. used for both single product page and loop page 
function find_variation_by_attribute($product, $attribute, $value) {
    if (!$product instanceof WC_Product || empty($attribute) || empty($value)) {
        error_log('Invalid input parameters provided to find_variation_by_attribute function.');
        return false;
    }

    foreach ($product->get_available_variations() as $variation_array) {
        $variation_obj = new WC_Product_Variation($variation_array['variation_id']);
        $attributes = $variation_obj->get_attributes();
        
        if (isset($attributes[$attribute]) && $attributes[$attribute] == $value) {
            return $variation_obj;
        }
    }
    return false;
}