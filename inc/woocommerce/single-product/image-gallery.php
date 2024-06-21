<?php 
// remove sale badge
// add_filter('woocommerce_sale_flash', 'webduel_hide_sale_flash');
// function webduel_hide_sale_flash(){
// return false;
// }
// vertical gallery 


add_action('woocommerce_before_single_product', 'woocommerce_breadcrumb', 10);

add_action('woocommerce_before_single_product_summary', function(){ 
      echo '<div class="product-images">';
  
  }, 5);
// add images 
add_action('woocommerce_before_single_product_summary', function(){ 
      echo '</div>';
}, 20);



// add custom product image & gallery 
function custom_woocommerce_product_gallery() {
      global $product;
  
       // Get the main (featured) image URL with a fallback to the full image if the 'woocommerce_single' size isn't available.
       $main_image_id = $product->get_image_id();
       $main_image_url = wp_get_attachment_image_url($main_image_id, 'woocommerce_single');
       if (!$main_image_url) {
           $main_image_url = wp_get_attachment_url($main_image_id); // Fallback to the original image
       }
  
      // Show the main product image first
      echo '<div class="product-main-image"><div class="skeleton"></div><img style="display:none;" src="' . esc_url($main_image_url) . '" alt="'.$product->name.'" data-main_image="'.esc_url($main_image_url).'" width="100%" height="400px" loading="lazy"></div>';
      $images = $product->get_gallery_image_ids();

      if(   !empty($images)){ 

  
      echo '<ul class="custom-slick-slider gallery">'; // Slick Slider Wrapper
// Include the main image in the slider with fallback
$thumbnail_url = wp_get_attachment_image_url($main_image_id, 'woocommerce_gallery_thumbnail');
if (!$thumbnail_url) {
    $thumbnail_url = wp_get_attachment_url($main_image_id); // Fallback to the original image
}

       // Loop through gallery images
      foreach ($images as $image_id) {
           $thumbnail_url = wp_get_attachment_image_url($image_id, 'woocommerce_gallery_thumbnail');
        if (!$thumbnail_url) {
            $thumbnail_url = wp_get_attachment_url($image_id); // Fallback to the original image
        }
        $image_url = wp_get_attachment_image_url($image_id, 'woocommerce_single');
        if (!$image_url) {
            $image_url = wp_get_attachment_url($image_id); // Fallback to the original image
        }
        
          echo '<li><div class="skeleton"></div><img style="display:none;" alt="'.$product->name.'" width="100px" height="100px" loading="lazy" src="' . esc_url($thumbnail_url) . '" data-large_image="' . esc_url($image_url) . '"></li> ';
      }
      echo '</ul>';
    }
  }
  add_action('woocommerce_before_single_product_summary', 'custom_woocommerce_product_gallery', 10);
  

//   remove default gallery 
add_action( 'woocommerce_before_single_product_summary', 'custom_remove_default_gallery', 1 );

function custom_remove_default_gallery() {
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
}