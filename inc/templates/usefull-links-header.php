<div class="useful-links-container">
    <?php 
    $contactInfoData = get_field('contact_info', 'option');
    if(!empty($contactInfoData)){
        $contactTitle = $contactInfoData['title'];
        $contactIcon = $contactInfoData['icon'];
        $contactInfo = $contactInfoData['info'];
    ?>
    <div class="container help-wrapper">
        <img src="<?php echo $contactIcon['url'] ?>" alt="<?php echo $contactIcon['alt'] ?>" height="28px" width="28px">
        <span class="body1"><?php echo $contactTitle;  ?></span>
        <div class="contact-modal hide-header-modal">
            <ul class="list">
                <?php 
                foreach ($contactInfo as $info ) {
                    ?>
                <li class="list-item">
                    <a href="<?php echo $info['url']; ?>" title="<?php echo $info['label']; ?>">
                        <img src="<?php echo $info['icon']['url'];  ?>" alt="<?php echo $info['icon']['alt'];  ?>"
                            width="28px" height="28px">
                        <span class="body1"><?php echo $info['label']; ?></span>
                    </a>
                </li>
                <?php
                } 
                ?>

            </ul>
        </div>
    </div>
    <?php 
    } 
    ?>


    <?php 
        $accountData = get_field('account_info', 'option');
        if(!empty($accountData)){
            $accountTitle = $accountData['title'];
            $accountIcon = $accountData['icon'];
            $accountInfo = $accountData['info']; 
            ?>
    <div class="sign-in-container container">
        <img src="<?php echo $accountIcon['url'] ?>" alt="<?php echo $accountIcon['alt'] ?>" height="28px" width="28px">
        <!-- get logged in user -->
        <a class="body1" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"
            title="<?php _e('My Account',''); ?>" style="text-decoration: none; ">
            <span><?php  echo $accountTitle; ?></span>
        </a>
        <div class="sign-in-modal hide-header-modal">
            <ul class="list">
                <?php 
                foreach ($accountInfo as $info ) {
                    ?>
                <li class="list-item">
                    <a href="<?php echo $info['url']; ?>" title="<?php echo $info['label']; ?>">
                        <span class="body1"><?php echo $info['label']; ?></span>
                    </a>
                </li>
                <?php
                } 
                ?>

            </ul>
        </div>
    </div>
    <?php
            
        } 
    ?>


    <?php

                            if(!is_cart() ){ ?>
    <div class="cart-container container shopping-cart ">
        <div class="open-cart-wrapper">
            <svg width="28px" height="28px" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                viewBox="0 0 459.361 459.361" style="enable-background:new 0 0 459.361 459.361;" xml:space="preserve">
                <g>
                    <g>
                        <path
                            d="M371.2,325.731c19.1-0.2,35.8-13.1,40.7-31.6l47.1-175.4c1.5-5.7-1.8-11.5-7.5-13.1c-0.9-0.2-1.8-0.4-2.7-0.4H94.5    l-24.1-89c-1.2-4.6-5.4-7.9-10.2-7.9H0v21.3h51.8l23.3,87c-0.1,0.7-0.1,1.4,0,2.1l48,176c0.3,1.4,0.8,2.9,1.3,4.3l16.2,59    c-15.6,8.3-26.2,24.7-26.2,43.6c0,27.3,22.1,49.4,49.4,49.4c27.3,0,49.4-22.1,49.4-49.4c0-8.5-2.2-16.6-6-23.6    c-0.9-1.6-1.8-3.2-2.9-4.8H330c-5.6,8-9,17.8-9,28.4c0,27.3,22.1,49.4,49.4,49.4s49.4-22.1,49.4-49.4c0-12.9-4.9-24.6-13-33.4    c-8.7-9.9-21.5-16.2-35.8-16.3H161.9l-7.5-27.5c3.2,0.8,6.5,1.3,9.8,1.3H371.2z M370.5,373.231c15.7,0,28.4,12.7,28.4,28.4    s-12.7,28.4-28.4,28.4c-15.7,0-28.4-12.7-28.4-28.4S354.8,373.231,370.5,373.231z M163.8,373.231c15.7,0,28.3,12.8,28.3,28.4    c0,15.7-12.7,28.4-28.4,28.4c-15.7,0-28.3-12.7-28.3-28.4S148.1,373.231,163.8,373.231z M144.8,290.931l-23.9-87.4l-21.3-76.8    h334.9l-43.3,162.6c-2.4,9.3-10.7,15.8-20.3,16H164C155.3,304.831,147.7,299.231,144.8,290.931z" />
                    </g>
                </g>

            </svg>

            <?php 
                                get_template_part('inc/templates/cart-count'); 
                           
                           ?>

        </div>
        <div class="cart-popup-container">

            <!-- add pop up template  -->
            <?php get_template_part('inc/templates/custom-cart-popup'); ?>
        </div>
    </div>
    <?php } ?>



</div>