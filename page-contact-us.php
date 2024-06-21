 <?php 
get_header(); 
    ?>
 <section class="row-container contact-form-wrapper">
     <h1 class="h1 center-align"><?php echo get_the_title();  ?></h1>
     <p class="center-align body1"><?php echo get_the_content();?></p>

 </section>
 <section class="stores-info-container row-container">
     <h2 class="h1 center-align">Our Stores</h2>
     <div class="store-wrapper">

         <?php               
         $stores = get_field('stores', 'option'); 
              if(!empty($stores)){ 
                    //  loop through the stores
                    foreach($stores as $store){
                        // print_r($store);
                        $store_name = $store['store_name'];
                        $store_address= $store['address'];
                        $store_phone = $store['phone'];
                        $store_opening_hours = $store['opening_hours'];
                        $google_map_url = $store['google_map'];
              
                        ?>
         <div class="store-info">
             <?php echo $google_map_url; ?>
             <div class="content-wrapper">
                 <h3 class="h4 store-title"><?php echo $store_name; ?></h3>
                 <div class="address">
                     <div class="subtitle1">Address </div>
                     <div class="body1 "><?php echo $store_address; ?></div>
                 </div>
                 <div class="body1">
                     <div class="subtitle1">Phone </div>
                     <div><?php echo $store_phone; ?></div>
                 </div>
                 <div class="opening-hours">
                     <p class="subtitle1">Opening Hours</p>
                     <p class="body1"><?php echo $store_opening_hours; ?></p>
                 </div>
             </div>

         </div>
         <?php
                    }
            }
        ?>

     </div>
 </section>
 <?php
get_footer();
?>