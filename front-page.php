<?php
get_header();
?>

<?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            $sliderArr = get_field("hero_slider"); 
            if(!empty($sliderArr)){
           $bottomPadding; 
            ?>
<!-- home page -->
<section class="slider-container hero-slider" style="padding-bottom: <?php echo $bottomPadding?>%">
    <div class="skeleton"></div>
    <div class="card-list">
        <?php 
            foreach ($sliderArr as $slider) {
              
   // Access the 'desktop_image' array
   $desktop_image = $slider['desktop_image'];
   $mobile_image = $slider['mobile_image'];
   $cta = $slider['link'];
   $bottomPadding = 60; 
   ?>

        <a href="<?php echo $cta['url']; ?> " aria-label="Show Now">
            <picture>
                <source media="(min-width:1366px)" srcset="<?php echo $desktop_image['sizes']['2048x2048']; ?>">
                <source media="(min-width:600px)" srcset="<?php echo $desktop_image['sizes']['large']; ?>">
                <img data-lazy="<?php echo $mobile_image['sizes']['woocommerce_thumbnail']; ?>"
                    alt="<?php echo $mobile_image['alt']; ?>" width="100%" height="400px">
            </picture>
        </a>

        <?php 
            } 
            ?>
    </div>
    <?php 
    }
?>
</section>
<?php 
            }
            ?>

<?php
} 
else {
    echo 'No content found for the home page';
}
    ?>

<!-- layouts -->
<?php 
// Check value exists.
if( have_rows('sections') ){ 
     // Loop through rows.
     $trailingValue = 0; 
     while ( have_rows('sections') ){ 
        the_row(); 
        $trailingValue++; 
        // row layout 
        if(get_row_layout() === 'row'){
        
              // Assume you have some ACF fields you want to pass to the template
            $sectionTitle = get_sub_field('section_title');
            $rowTitle = get_sub_field('title');
            $description = get_sub_field('description');
            $image = get_sub_field('image');
            $imageAlignment = get_sub_field('image_alignment');
            $iconsArr = get_sub_field('icons');
            $ctaData = get_sub_field('cta');
?>

<section class="row-container row-layout">
    <?php 
    // check if the section title exists 
    if($sectionTitle){ 
        ?>
    <h2 class="center-align h3"><?php echo $sectionTitle;  ?></h2>
    <?php 
    }
    ?>
    <div class="wrapper" style="flex-direction:<?php echo $imageAlignment === "left" ? "row-reverse" : "row";  ?>">
        <div class="content-wrapper">
            <div class="icon-wrapper">
                <?php 
                if($iconsArr){ 
                // Loop through the icons array
                foreach($iconsArr as $icon){
                    $svgIcon = $icon['svg_icon'];
                    $iconLabel = $icon['label'];
                    ?>
                <div class="icon"
                    style="border-radius:<?php echo $iconLabel ? "50px" : "50%" ?>; width: <?php echo $iconLabel ? "auto" : "73px" ?>">
                    <div class="svg-wrapper"> <img src="<?php echo $svgIcon['url']; ?>"
                            alt="<?php echo $svgIcon['alt'] ? $svgIcon['alt'] : "svg icons" ?> " height="30px"
                            width="30px" defer loading="lazy">
                    </div>
                    <p class="body1 icon-text"><?php echo $iconLabel;  ?></p>
                </div>
                <?php
                }
            }
                ?>
            </div>
            <h3 class="h3"><?php  echo $rowTitle;  ?></h3>
            <div class="body1"><?php echo $description;  ?></div>
            <a class="primary-button" href="<?php echo $ctaData['url']; ?>">

                <span><?php echo $ctaData['title'];  ?>
                </span>
                <svg width="28px" height="28px" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                    viewBox="0 0 512.009 512.009" style="enable-background:new 0 0 512.009 512.009;"
                    xml:space="preserve">
                    <g>
                        <g>
                            <path fill="var(--light-on-tertiary-container)"
                                d="M508.625,247.801L508.625,247.801L392.262,131.437c-4.18-4.881-11.526-5.45-16.407-1.269    c-4.881,4.18-5.45,11.526-1.269,16.407c0.39,0.455,0.814,0.88,1.269,1.269l96.465,96.582H11.636C5.21,244.426,0,249.636,0,256.063    s5.21,11.636,11.636,11.636H472.32l-96.465,96.465c-4.881,4.18-5.45,11.526-1.269,16.407s11.526,5.45,16.407,1.269    c0.455-0.39,0.88-0.814,1.269-1.269l116.364-116.364C513.137,259.67,513.137,252.34,508.625,247.801z" />
                        </g>
                    </g>

                </svg>
            </a>
        </div>
        <style>
        <?php echo ".row-layout .image-wrapper-".$trailingValue;

        ?> {
            padding-bottom: <?php echo ($image['height']/$image['width'])*50?>%;
        }

        @media(max-width: 1020px) {
            <?php echo ".row-layout .image-wrapper-".$trailingValue;

            ?> {
                padding-bottom: <?php echo ($image['height']/$image['width'])*100?>%;
            }
        }
        </style>
        <div class="image-wrapper image-wrapper-<?php echo $trailingValue;  ?>">
            <picture>
                <source media="(min-width:600px)" srcset="<?php echo $image['sizes']['large']; ?>">
                <img data-lazy="<?php echo $image['sizes']['woocommerce_thumbnail']; ?>"
                    alt="<?php echo $image['alt'] ? $image['alt'] : $rowTitle; ?>" width="100%" height="400px" defer
                    loading="lazy">
            </picture>
        </div>
    </div>
</section>
<?php
            
        }
           // title layout 
           else if(get_row_layout() === 'list_of_products'){
        
            // Assume you have some ACF fields you want to pass to the template
          $title = get_sub_field('title');
            $products = get_sub_field('select_product');
          $ctaData = get_sub_field('cta');
          // Assume $products is your array of WP_Post objects
            $product_ids = array(); // This will store the product IDs
            foreach ($products as $product) {
                $product_ids[] = $product->ID; // Add each product's ID to the new array
            }
?>

<section class="product-list-container row-container">
    <?php 
  // check if the section title exists 
  if($title){ 
      ?>
    <h2 class="center-align h3"><?php echo $title;  ?></h2>
    <?php 
  }
  ?>
    <?php
        // Ensure WooCommerce is active
        if (class_exists('WooCommerce')) {

            // Query parameters
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1, // Set to -1 to show all, or set a specific limit
                'post__in' => $product_ids, // Use the 'post__in' parameter to specify the array of IDs
                'orderby' => 'post__in' // This ensures the products are ordered as in your array
            );

            // The Query
            $loop = new WP_Query($args);

            // The Loop
            if ($loop->have_posts()) {
                echo '<ul class="products">'; // Start a wrapper for the products
                while ($loop->have_posts()) : $loop->the_post();
                    wc_get_template_part('content', 'product'); // Get the WooCommerce product template
                endwhile;
                echo '</ul>';
            } else {
                echo '<p>No products found</p>';
            }

            // Restore original Post Data
            wp_reset_postdata();
        }
    ?>
    <?php 
    if($ctaData){
    ?>
    <a class="border-button section-link" href="<?php echo $ctaData['url']; ?>">
        <span><?php echo $ctaData['title'];  ?></span>
    </a>
    <?php } ?>
</section>
<?php
          
      }
        // title layout 
        else if(get_row_layout() === 'list_of_categories'){
        
            // Assume you have some ACF fields you want to pass to the template
          $title = get_sub_field('title');
            $selectedCategories = get_sub_field('select_categories');
          $ctaData = get_sub_field('cta');
          
       
?>

<section class="product-list-container category-container ">
    <div class="row-container">
        <?php 
  // check if the section title exists 
  if($title){ 
      ?>
        <h2 class="center-align h3"><?php echo $title;  ?></h2>
        <?php 
  }
  ?>
        <div class="products">
            <?php 
  foreach ($selectedCategories as $category_id) {
    $term = get_term_by('id', $category_id, 'product_cat');

    if ($term) {
        // Get the category name
        $category_name = $term->name;

        // Get the category URL
        $category_link = get_term_link($term);

        // Get the category image URL
        $thumbnail_id = get_term_meta($category_id, 'thumbnail_id', true);

        if ($thumbnail_id) {
            $image_details = wp_get_attachment_image_src($thumbnail_id, 'woocommerce_thumbnail');
        
            $thumbnail_url =  $image_details[0]; 
        } else {
            $thumbnail_url = false;
        }
        // Output the category name, link, and image
        ?>
            <div class="product">
                <a href="<?php echo $category_link;  ?>"
                    class="woocommerce-LoopProduct-link woocommerce-loop-product__link" tabindex="0">
                    <div class="skeleton"></div>
                    <img width="430" height="430" src="<?php echo $thumbnail_url;  ?>"
                        class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                        alt="<?php echo $category_name ?>" decoding="async" title="<?php echo $category_name ?>"
                        loading="lazy" defer>
                </a><a href="<?php echo $category_link;  ?>" alt="<?php echo $category_name ?>" class="product-title">
                    <h2 class="woocommerce-loop-product__title"><span><?php echo $category_name ?></span>
                        <svg width="28px" height="28px" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                            viewBox="0 0 512.009 512.009" style="enable-background:new 0 0 512.009 512.009;"
                            xml:space="preserve">
                            <g>
                                <g>
                                    <path fill="var(--light-on-tertiary-container)"
                                        d="M508.625,247.801L508.625,247.801L392.262,131.437c-4.18-4.881-11.526-5.45-16.407-1.269    c-4.881,4.18-5.45,11.526-1.269,16.407c0.39,0.455,0.814,0.88,1.269,1.269l96.465,96.582H11.636C5.21,244.426,0,249.636,0,256.063    s5.21,11.636,11.636,11.636H472.32l-96.465,96.465c-4.881,4.18-5.45,11.526-1.269,16.407s11.526,5.45,16.407,1.269    c0.455-0.39,0.88-0.814,1.269-1.269l116.364-116.364C513.137,259.67,513.137,252.34,508.625,247.801z" />
                                </g>
                            </g>

                        </svg>
                    </h2>
                </a>

            </div>
            <?php 
    } else {
        echo "Category not found for ID: " . $category_id . "<br>";
    }
}

  ?>
        </div>
    </div>
</section>
<?php
          
      }
       // promo cards layout 
       else if(get_row_layout() === 'promo_cards'){
        
        // Assume you have some ACF fields you want to pass to the template
      $title = get_sub_field('title');
        $promoCardsArr = get_sub_field('cards');
      
   
?>

<section class="promo-container">
    <div class="row-container">
        <?php 
// check if the section title exists 
if($title){ 
  ?>
        <h2 class="center-align h3"><?php echo $title;  ?></h2>
        <?php 
}
?>
        <div class="cards">
            <?php 
foreach ($promoCardsArr as $card) {
    ?>
            <div class="card" style="position: relative; padding-bottom: 100%; 
            width: 100%;  ">
                <img style="position: absolute; width: 100%; height: 100%; object-fit: cover; "
                    src="<?php echo $card['image']['sizes']['medium'] ?$card['image']['sizes']['medium'] : $card['image']['url']; ?>"
                    alt="<?php echo $card['image']['alt']; ?>" width="100%" height="300px">
            </div>
            <?php

}

?>
        </div>
    </div>
</section>
<?php
      
  }
      
     }
}
?>

<?php 
        $testimonials = get_field('testimonials', 'option');
        if(!empty($testimonials)){
            ?>
<section class="testimonials-section">
    <div class="row-container">

        <?php 
                    $sectionTitle=$testimonials['title']; 
                    $sectionSubtitle = $testimonials['subtitle'];
                    $testimonialsArr= $testimonials['testimonial'];    
                    ?>
        <div class="title-wrapper">
            <p class="subtitle1 subtitle center-align"><?php echo $sectionSubtitle;  ?></p>
            <h2 class="center-align title h3"><?php echo $sectionTitle;  ?></h2>
        </div>
        <div class="testimonials-wrapper">
            <?php 
            foreach( $testimonialsArr as $data){ 
                $testimonial = $data['content'];
                $name = $data['name'];
                ?>
            <div class="testimonial-card">
                <div class="testimonial-name h4">
                    <?php  echo $name; ?>
                </div>
                <div class="rating-stars">
                    <?php 
                    for($i=0; $i<5; $i++){
                        ?>
                    <svg width="16px" height="16px" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <polygon style="fill:#FCC153;"
                            points="256,12.652 177.157,173.261 0,198.569 128.486,323.164 98.314,499.348 256,416.609   413.686,499.348 383.514,323.164 512,198.569 334.843,173.261 " />

                    </svg>
                    <?php
                    } 
                    ?>

                </div>
                <div class="content body1">
                    <?php echo $testimonial;  ?>
                </div>
            </div>
            <?php 
            }
            ?>
        </div>
    </div>
</section>
<?php 
        } 

?>

<?php get_footer(); ?>