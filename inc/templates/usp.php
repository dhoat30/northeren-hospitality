<?php 
$uspData =  get_field('usp', 'option');
if(!empty($uspData) ){ 
    ?>
<section class="usp-section">
    <div class="row-container">
        <?php
   foreach ($uspData as $usp) {
   $title = $usp['title'];
   $icon = $usp['icon'];
    ?>
        <div class="usp">
            <img loading="lazy" class="icon" src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>"
                height="36px" width="36px">
            <div class="title body1"> <?php echo $title;  ?></div>

        </div>
        <?php 
   } 
   ?>
    </div>
</section>
<?php
} 
?>