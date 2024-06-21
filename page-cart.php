<?php 
get_header();
do_action('webduel_hero_section');  
?>
<div class="body-container index-page">
    <div class="row-container cart-page">
        <?php 
            while(have_posts()){
                the_post(); 
               
                    ?>
        <h1 class="h1"><?php the_title();?></h1>

        <div class="cart-wrapper">
            <?php the_content();?>
        </div>

        <?php
            }
        ?>
    </div>
</div>


<?php 
    get_footer();
?>