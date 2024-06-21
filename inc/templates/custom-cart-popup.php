<!-- cart drop down -->
<div class="cart-box">
    <div class="title-section">
        <div class="title">My Cart</div>
        <div class="close-cart">
            <svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                viewBox="0 0 340.8 340.8" style="enable-background:new 0 0 340.8 340.8;" xml:space="preserve">
                <g>
                    <g>
                        <path
                            d="M170.4,0C76.4,0,0,76.4,0,170.4s76.4,170.4,170.4,170.4s170.4-76.4,170.4-170.4S264.4,0,170.4,0z M170.4,323.6    c-84.4,0-153.2-68.8-153.2-153.2S86,17.2,170.4,17.2S323.6,86,323.6,170.4S254.8,323.6,170.4,323.6z" />
                    </g>
                </g>
                <g>
                    <g>
                        <path
                            d="M182.4,169.6l50-50c3.2-3.2,3.2-8.8,0-12c-3.2-3.2-8.8-3.2-12,0l-50,50l-50-50c-3.2-3.2-8.8-3.2-12,0    c-3.2,3.2-3.2,8.8,0,12l50,50l-50,49.6c-3.2,3.2-3.2,8.8,0,12c1.6,1.6,4,2.4,6,2.4s4.4-0.8,6-2.4l50-50l50,50c1.6,1.6,4,2.4,6,2.4    s4.4-0.8,6-2.4c3.2-3.2,3.2-8.8,0-12L182.4,169.6z" />
                    </g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
            </svg>
        </div>


    </div>
    <div class="flex-card">
        <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
    $_product = $cart_item['data'];
    $product_id = $cart_item['product_id'];
    $variation_id = $cart_item['variation_id'];
    $quantity = $cart_item['quantity'];
    $sold_by_weight = get_post_meta($product_id, '_sold_by_weight', true);
    $price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
    $customPrice = isset($cart_item['customPrice']) ? $cart_item['customPrice'] :null; // Custom price if set
    $customQuantity = isset($cart_item['customQuantity']) ? $cart_item['customQuantity'] : null; // Custom quantity (weight) if set

    $product_name = $_product->get_name();
    $subtotal = WC()->cart->get_product_subtotal($_product, $cart_item['quantity']);
    $permalink = $_product->is_type('variation') ? get_permalink($variation_id) : $_product->get_permalink();
    $thumbnail_id = $_product->get_image_id();
    $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'woocommerce_gallery_thumbnail');
    if (!$thumbnail_url && $_product->is_type('variation')) {
        // Fallback to parent product image if variation image not set
        $parent_product = wc_get_product($_product->get_parent_id());
        $thumbnail_id = $parent_product->get_image_id();
        $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'woocommerce_gallery_thumbnail');
    }
?>
        <div class="product-card">
            <a href="<?php echo esc_url($permalink); ?>" class="mini_cart_item">
                <div class="row">
                    <div class="img-container">
                        <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($product_name); ?>"
                            height="50px" />
                    </div>
                    <div class="meta-info-wrapper">
                        <div class="product-title">
                            <?php echo esc_html($product_name); ?></h5>
                        </div>
                        <div class="action-row">
                            <div class="price-container">
                                <?php if ($customQuantity && $customPrice): ?>

                                <span class="subtotal"> Total: <span>
                                        $<?php echo wp_kses_post($customPrice); ?></span></span>
                                <?php else: ?>
                                <span class="quantity"><?php echo esc_html($quantity); ?> x </span>
                                <span class="cart-price"><?php echo wp_kses_post($subtotal); ?></span>
                                <?php endif; ?>
                            </div>
                            <button class="remove-product secondary-button"
                                data-product-id="<?php echo $variation_id ? $variation_id : $product_id;  ?>"
                                data-cart_item_key="<?php echo $cart_item_key; ?>">
                                Remove
                            </button>
                        </div>

                    </div>
                </div>
            </a>
        </div>
        <?php } ?>
    </div>
    <div class="cta-wrapper">
        <a class="primary-button" href="<?php echo get_site_url(); ?>/cart"><span> View Cart</span></a>
    </div>
</div>