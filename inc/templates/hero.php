<?php 
    $heroData = get_field('hero_section');
    $heroTitle = $heroData['title'];
    $desktop_image= $heroData['desktop_image'];
    $mobile_image = $heroData['mobile_image'];

    if(!$heroData){ 
        return; 
    }
?>
<!-- home page -->
<section class="hero">

    <!-- <div class="skeleton"></div> -->
    <!-- add this to card-list style="display: none;" -->
    <style>
    /* add padding dynamicall for the card */
    .hero .card {
        padding-bottom: <?php echo ($desktop_image["height"]/$desktop_image['width'])*100 ?>%;

    }

    @media(max-width: 600px) {
        .hero .card {
            padding-bottom: <?php echo ($mobile_image["height"]/$mobile_image['width'])*100 ?>%;

        }
    }
    </style>
    <div class="card">
        <div class="image-wrapper">
            <picture>
                <source media="(min-width:1366px)" srcset="<?php echo $desktop_image['sizes']['2048x2048']; ?>">
                <source media="(min-width:600px)" srcset="<?php echo $desktop_image['sizes']['large']; ?>">
                <img src="<?php echo $mobile_image['sizes']['woocommerce_thumbnail']; ?>"
                    alt="<?php echo $mobile_image['alt']; ?>" width="100%">
            </picture>
        </div>
        <div class="content-wrapper">
            <div class="wrapper row-container">
                <div class="content">
                    <h1 class="h1 title"><?php echo $heroTitle;  ?></h1>

                </div>

            </div>


        </div>
    </div>

</section>