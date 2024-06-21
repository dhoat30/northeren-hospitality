<?php 
get_header();
do_action('webduel_hero_section');  
?>
<div class="body-container index-page margin-row ">
    <div class="row-container">
        <?php 
            while(have_posts()){
                the_post(); 
                if(!is_cart() ){ 
                    ?>
        <h1 class="h2"><?php the_title();?></h1>
        <?php 
                }
                ?>
        <div>
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