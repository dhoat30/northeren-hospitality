<?php 
 //add nav menu
 function webduel_config(){ 
    register_nav_menus( 
       array(
          "main_menu" => "Main Menu",
          "footer_categories" => "Footer Categories", 
          "footer_useful_links" => "Footer Useful Links", 
          "footer_account_links" => "Footer Account Links", 

       )
       );  

       add_theme_support( "title-tag");
         
         add_theme_support( 'woocommerce' );
  }
 
  add_action("after_setup_theme", "webduel_config", 0);

  // show brand in menu 
  function my_custom_attribute_menu_items() {
    $taxonomy     = 'pa_brand'; // replace 'your-attribute' with your attribute name
    $orderby      = 'name';  
    $show_count   = 0;      // 1 for yes, 0 for no
    $pad_counts   = 0;      // 1 for yes, 0 for no
    $hierarchical = 1;      // 1 for yes, 0 for no  
    $title        = '';  

    $args = array(
        'taxonomy'     => $taxonomy,
        'orderby'      => $orderby,
        'show_count'   => $show_count,
        'pad_counts'   => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li'     => $title
    );

    $all_categories = get_categories($args);
    foreach ($all_categories as $cat) {
        if ($cat->category_parent == 0) {
            $category_id = $cat->term_id;       
            echo '<li><a href="'. get_term_link($cat->slug, 'pa_brand') .'">'. $cat->name .'</a></li>';
        }
    }
}
?>