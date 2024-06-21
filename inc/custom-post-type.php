<?php 
// enable featured image for cpt 
// $property  = new Cuztom_Post_Type( 'blogs', array(
//    'supports' => array('title', 'editor', 'thumbnail')
// ));
//custom post register

function register_custom_type2(){ 
   //Banner
   register_post_type("banners", array(
      "supports" => array("title"), 
      "public" => true, 
      "show_ui" => true, 
      "hierarchical" => true,
      "labels" => array(
         "name" => "Banner", 
         "add_new_item" => "Add New Banner", 
         "edit_item" => "Edit Banner", 
         "all_items" => "All Banners", 
         "singular_name" => "Banner"
      ), 
      "menu_icon" => "dashicons-align-wide"
   )
   ); 
   //blogs post type
   register_post_type("blogs", array(
      'show_in_rest' => true,
      "supports" => array("title", "page-attributes", 'editor', "thumbnail"), 
      "public" => true, 
      "show_ui" => true, 
      "hierarchical" => true,
      'has_archive' => true,
      "labels" => array(
         "name" => "Blogs", 
         "add_new_item" => "Add New Blog", 
         "edit_item" => "Edit Blog", 
         "all_items" => "All Blogs", 
         "singular_name" => "Blog"
      ), 
      "menu_icon" => "dashicons-welcome-write-blog"
   )
   );

   //Customer Services
   register_post_type("customer-service", array(
      "supports" => array("title", "editor"), 
      "public" => true, 
      "show_ui" => true, 
      "hierarchical" => true,
      "show_in_rest"=> true, 
      'has_archive'=> true, 
      "labels" => array(
         "name" => "Customer Service", 
         "add_new_item" => "Add New Customer Service Post", 
         "edit_item" => "Edit Customer Service Post", 
         "all_items" => "All Customer Service Posts", 
         "singular_name" => "Customer Service Post"
   ), 
      "menu_icon" => "dashicons-editor-alignleft"
   )
   ); 
  
}

add_action("init", "register_custom_type2"); 

//Banner taxonomy
function wpdocs_register_private_taxonomy() {

   // banner taxonomy 
   $argsBanner = array(
      'label'        => __( 'Banner Categories', 'textdomain' ),
      'public'       => true,
      'rewrite'      => true,
      'hierarchical' => true,
      'show_in_rest' => true
  );
   
  register_taxonomy( 'banners_categories', 'banners', $argsBanner );

 

   $argsBlog = array(
      'label'        => __( 'Blog Categories', 'textdomain' ),
      'public'       => true,
      'rewrite'      => true,
      'hierarchical' => true,
      'show_in_rest' => true
  );
   
  register_taxonomy( 'blog-category', 'blogs', $argsBlog );
}
add_action( 'init', 'wpdocs_register_private_taxonomy', 0 );