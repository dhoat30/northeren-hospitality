<?php

// remove sku code
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
// add product sku after the title 
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5);

// add back link and share button 
add_action('woocommerce_before_single_product', 'webduel_share_and_back_button', 10);

function webduel_share_and_back_button(){
    ?>
<div class="back-share-btn-wrapper">
    <div class="back-wrapper ">
        <a href="#" onclick="window.history.back(); return false;" class="link-button">
            <svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/"
                clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                viewBox="0 0 105 105">
                <path
                    d="m97.914 47.917h-81.608l26.221-26.221c1.629-1.629 1.629-4.262 0-5.891-1.63-1.629-4.263-1.629-5.892 0l-33.333 33.329c-.384.387-.688.85-.9 1.358-.421 1.017-.421 2.167 0 3.184.212.508.516.97.9 1.358l33.333 33.329c.812.813 1.879 1.221 2.946 1.221 1.066 0 2.133-.408 2.946-1.221 1.629-1.629 1.629-4.262 0-5.892l-26.221-26.22h81.608c2.3 0 4.167-1.867 4.167-4.167s-1.867-4.167-4.167-4.167z"
                    fill-rule="nonzero" />
            </svg>
            <span>Back<span></a>
    </div>

</div>
<?php 
}


// remove sidebar 
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

/**
 * Remove product page tabs
 */
add_filter('woocommerce_product_tabs', 'my_remove_all_product_tabs', 98);

function my_remove_all_product_tabs($tabs)
{
    unset($tabs['description']);        // Remove the description tab
    unset($tabs['reviews']);       // Remove the reviews tab
    unset($tabs['additional_information']);    // Remove the additional information tab
    return $tabs;
}


// remove short description on single product page
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
// add the short description 
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 7);



// add quantity label
add_action('woocommerce_before_add_to_cart_quantity',function (){ 
    echo '<div class="webduel-qty-wrapper">';
    echo '<div class="quantity-button decrease">-</div>';
}, 5);


add_action('woocommerce_after_add_to_cart_quantity', function(){ 
    echo '<div class="quantity-button increase">+</div>';
    echo '</div>'; 
}, 20);

// add product descriptions
add_action('woocommerce_after_add_to_cart_quantity', function() { 
    ?>
<div class="success-message">
    <p>Product Added! </p>
    <a href="<?php echo wc_get_cart_url(); ?>">View Cart</a>
</div>
<div class="error-message">
    <svg width="20" height="20" viewBox="0 0 320 320" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M144 208H176V240H144V208ZM144 80H176V176H144V80ZM159.84 0C71.52 0 0 71.68 0 160C0 248.32 71.52 320 159.84 320C248.32 320 320 248.32 320 160C320 71.68 248.32 0 159.84 0ZM160 288C89.28 288 32 230.72 32 160C32 89.28 89.28 32 160 32C230.72 32 288 89.28 288 160C288 230.72 230.72 288 160 288Z"
            fill="black" />
    </svg>

    <p>Something went wrong. Please try again.</p>
</div>
<?php     
}, 150); 


// add product description
add_action('woocommerce_after_single_product', function() { 
    ?>
<div class="product-tabs">
    <ul class="tab-links">
        <li class="active"><a class="subtitle1" href="#tab1">Features</a></li>
        <li><a href="#tab2" class="subtitle1">Specifications</a></li>
    </ul>
    <div class="tab-content">
        <div id="tab1" class="tab active">
            <?php
               // product description 
                    webduel_product_description_HTML();
                ?>
        </div>
        <div id="tab2" class="tab">
            <?php display_global_product_attributes_table(); ?>
        </div>
    </div>
</div>
<?php

    // product attributes table 

}, 40); 

function webduel_product_description_HTML(){ 
    global $product; 
    // check if the get_description is not empty 


    if (!empty($product->get_description())) {
        echo '
    <div class="description-wrapper">
        <div class="content description">
        '. $product->get_description().'
        </div> 
    </div>'; 
    }
}
function display_global_product_attributes_table() {
    global $product;

    // Get product attributes that are variations
    $attributes = $product->get_attributes();
    
    $html = '<table class="sm:table-fixed border-collapse border border-grey1-400">
                <tbody>';
    
    // Loop through each attribute and display it
    foreach ($attributes as $attribute) {
        // Check if the attribute is a taxonomy (global attribute)
        if ($attribute->is_taxonomy()) {
            $values = wc_get_product_terms($product->get_id(), $attribute->get_name(), array('fields' => 'names'));
            $attribute_label = wc_attribute_label($attribute->get_name());
            $attribute_values = apply_filters('woocommerce_attribute', wpautop(wptexturize(implode(', ', $values))), $attribute, $values);
        } else {
            // Handle custom attributes (local attributes)
            $attribute_label = wc_attribute_label($attribute->get_name());
            $attribute_values = apply_filters('woocommerce_attribute', wpautop(wptexturize($attribute->get_data()['value'])), $attribute);
        }

        $html .= '<tr class="bg-white">
                    <td class="border border-grey1-400 label"><b>' . $attribute_label . '</b></td>
                    <td class="border border-grey1-400 value">' . $attribute_values . '</td>
                  </tr>';
    }
    

    // Get brand details and add to the table
    $brand_terms = wc_get_product_terms($product->get_id(), 'product_brand', array('fields' => 'names'));
    if (!empty($brand_terms)) {
        $brand_name = implode(', ', $brand_terms);
        $html .= '<tr class="bg-white">
                    <td class="border border-grey1-400 label"><b>Brand</b></td>
                    <td class="border border-grey1-400 value">' . wpautop(wptexturize($brand_name)) . '</td>
                  </tr>';
    }
    
    $html .= '</tbody>
            </table>';

    echo '<div class="attributes-wrapper">' . $html . '</div>';
}