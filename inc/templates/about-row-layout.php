<?php 
// Check value exists.
if( have_rows('layout') ){ 
     // Loop through rows.
     $trailingValue = 0; 
     while ( have_rows('layout') ){ 
        the_row(); 
        $trailingValue++; 
        // row layout 
        if(get_row_layout() === 'usp'){
        
              // Assume you have some ACF fields you want to pass to the template
              $itemArr = get_sub_field('item'); 
?>
<section class="row-container usp-section">
    <div class="wrapper">

        <?php
   foreach($itemArr as $item){
    $title = $item['title'];
    $description = $item['description'];
    $icon = $item['icon'];
    ?>
        <?php if($icon) { 
            ?>
        <div class="card">
            <div class="icon-title-wrapper">
                <div class="icon-wrapper">
                    <img src="<?php echo $icon['url'] ?> " alt="<?php echo $icon['alt'] ? $icon['alt'] : $title;  ?>"
                        width="50px" height="50px">
                </div>
                <h3 class="h4"> <?php echo $title;  ?></h3>
            </div>
            <p class="body1"> <?php echo $description;  ?></p>
        </div>

        <?php 
        } 
        else { 
            ?>
        <div class="card">
            <div class="title-wrapper">
                <h3 class="h3 center-align"> <?php echo $title;  ?></h3>
            </div>
            <p class="h4 center-align"> <?php echo $description;  ?></p>

        </div>
        <?php 
        }
        ?>
        <?php 
    }
    ?>
    </div>
</section>
<?php
            
        }
        else if (get_row_layout() === "image_and_content"){ 
            $title = get_sub_field('title');
            $content = get_sub_field('content');
            $image = get_sub_field('image');
            ?>
<section class="row-container image-and-content-section">
    <div class="content-wrapper">
        <h2 class="h2"> <?php echo $title;  ?></h2>
        <div class="body1"> <?php echo $content;  ?></div>
    </div>
    <style>
    .image-and-content-section .image-wrapper {
        padding-bottom: <?php echo ($image["height"]/$image['width'])*100 ?>%;

    }

    @media(max-width: 600px) {
        .image-and-content-section .image-wrapper {
            padding-bottom: <?php echo ($image["height"]/$image['width'])*100 ?>%;

        }
    }
    </style>
    <div class="image-wrapper">
        <picture>
            <source media="(min-width:600px)" srcset="<?php echo $image['sizes']['woocommerce_single']; ?>">
            <img src="<?php echo $image['sizes']['woocommerce_thumbnail']; ?>"
                alt="<?php echo $image['alt'] ? $image['alt'] : $title; ?>" width="100%" height="500px">
        </picture>

    </div>
</section>
<?php

        }
        else if (get_row_layout() === "just_content"){ 
            $title = get_sub_field('title');
            $contentArr = get_sub_field('content_columns');

            ?>
<section class="row-container just-content-section">
    <div class="content-wrapper">
        <h2 class="h2"> <?php echo $title;  ?></h2>
        <div class="grid">
            <?php 
        foreach($contentArr as $content){
            $column = $content['column'];
            ?>
            <div class="column">
                <?php echo $column;  ?>
            </div>
            <?php 
        }
            ?>
        </div>
    </div>


</section>
<?php

        }
        else if (get_row_layout() === "image_section"){ 
            $title = get_sub_field('title');
            $bgImage = get_sub_field('background_image');
            $image = get_sub_field('image');
            ?>
<section class="row-container about-image-section">
    <div class="wrapper">
        <div class="content-wrapper">
            <h2 class="h3"> <?php echo $title;  ?></h2>
            <img src="<?php echo $image['sizes']['woocommerce_single']; ?>" alt="<?php echo $image['alt']; ?>"
                width="195px" height="68px">
        </div>
        <style>
        .about-image-section .image-wrapper {
            padding-bottom: <?php echo ($bgImage["height"]/$bgImage['width'])*100 ?>%;

        }

        @media(max-width: 600px) {
            .about-image-section .image-wrapper {
                padding-bottom: 80%;
            }
        }
        </style>
        <div class=" image-wrapper">
            <picture>
                <source media="(min-width:600px)" srcset="<?php echo $bgImage['sizes']['large']; ?>">
                <img src="<?php echo $bgImage['sizes']['woocommerce_thumbnail']; ?>"
                    alt="<?php echo $bgImage['alt'] ? $bgImage['alt'] : $title; ?>" width="100%" height="500px">
            </picture>

        </div>
    </div>
</section>
<?php

        }
    }  

}
?>