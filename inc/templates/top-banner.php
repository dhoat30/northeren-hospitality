<div class="top-banner ">
    <div class="wrapper row-container">

        <?php $uspData =  get_field('top_bar_usp', 'option'); 
                    if(!empty($uspData) ){ 
                        $uspText = $uspData['text'];
                        $uspBtnLabel  = $uspData['link']['title'];
                        $uspLink = $uspData['link']['url'];
                       ?>
        <div class="usp">
            <span class="text"><?php echo $uspText; ?></span>
            <a href="<?php echo $uspLink; ?>" class="primary-button"><?php echo $uspBtnLabel; ?></a>
        </div>
        <?php
                    }
                   
                ?>

    </div>
</div>