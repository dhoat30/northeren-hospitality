<?php
// add free shipping if it exist for the given product 
function bottomNavBar(){ 
    ?>
<section class="bottom-nav-bar">
    <div class="wrapper row-container">
        <?php 
            $itemArr = get_field('bottom_navbar', 'option');
            if(!$itemArr){
                return; 
            }
            foreach ($itemArr as $item) { 
                // Check if it's a WooCommerce product archive page
                if (is_post_type_archive('product') || is_shop() || is_product_category() || is_product_tag()) {
                    if ($item['link']['title'] == 'Filter') {
                        ?>
        <div class="item">
            <a class="<?php echo $item['link']['title']; ?>" href="<?php echo $item['link']['url']; ?>"
                title="<?php echo $item['link']['title']; ?>">
                <img src="<?php echo $item['svg_icon']['url'];  ?> " width="32px" height="32px"
                    alt="<?php echo $item['svg_icon']['alt'] ? $item['svg_icon']['alt'] : "filter icon" ?>">
                <span><?php echo $item['link']['title']; ?></span>
            </a>
        </div>
        <?php
                    }
                    elseif ($item['link']['title'] !== 'Contact'){ 
                        ?>
        <div class="item">
            <a class="<?php echo $item['link']['title']; ?>" href="<?php echo $item['link']['url']; ?>"
                title="<?php echo $item['link']['title']; ?>">
                <img src="<?php echo $item['svg_icon']['url'];  ?> " width="32px" height="32px"
                    alt="<?php echo $item['svg_icon']['alt'] ? $item['svg_icon']['alt'] : "SVG icon" ?>">
                <span><?php echo $item['link']['title']; ?></span>
            </a>
        </div>
        <?php
                    }
                
                } else {
                    // Show 'Contact' on all other pages
                    if ($item['link']['title'] !== 'Filter') {
                        ?>
        <div class="item">
            <a class="<?php echo $item['link']['title']; ?>" href="<?php echo $item['link']['url']; ?>"
                title="<?php echo $item['link']['title']; ?>">
                <img src="<?php echo $item['svg_icon']['url'];  ?> " width="32px" height="32px"
                    alt="<?php echo $item['svg_icon']['alt'] ? $item['svg_icon']['alt'] : "SVG icon" ?>">
                <span><?php echo $item['link']['title']; ?></span>
            </a>
        </div>
        <?php
                    }
                }
            }
        ?>
        <!-- add cart link -->
        <div class="item mobile-nav-cart-wrapper">
            <?php get_template_part('inc/templates/nav-cart-count'); ?>

        </div>


    </div>
</section>
<?php 
}
add_action('mobile-bottom-nav-bar', "bottomNavBar", 10); 

// add free shipping if it exist for the given product 
function signInModal()
{
?>
<div class="sign-in-modal">
    <ul class="list">
        <li class="list-item">
            <?php
                if (is_user_logged_in()) {
                ?>
            <a href="<?php echo get_site_url(); ?>/my-account" class="anchor">
                <svg width="320" height="320" viewBox="0 0 320 320" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M160 0C71.68 0 0 71.68 0 160C0 248.32 71.68 320 160 320C248.32 320 320 248.32 320 160C320 71.68 248.32 0 160 0ZM85.6 264C106.56 248.96 132.16 240 160 240C187.84 240 213.44 248.96 234.4 264C213.44 279.04 187.84 288 160 288C132.16 288 106.56 279.04 85.6 264ZM258.24 241.92C231.2 220.8 197.12 208 160 208C122.88 208 88.8 220.8 61.76 241.92C43.2 219.68 32 191.2 32 160C32 89.28 89.28 32 160 32C230.72 32 288 89.28 288 160C288 191.2 276.8 219.68 258.24 241.92Z"
                        fill="black" />
                    <path
                        d="M160 64C129.12 64 104 89.12 104 120C104 150.88 129.12 176 160 176C190.88 176 216 150.88 216 120C216 89.12 190.88 64 160 64ZM160 144C146.72 144 136 133.28 136 120C136 106.72 146.72 96 160 96C173.28 96 184 106.72 184 120C184 133.28 173.28 144 160 144Z"
                        fill="black" />
                </svg>



                <span>My Account </span>
            </a>
            <?php
                } else {
                ?>
            <a href="<?php echo get_site_url(); ?>/my-account" class="anchor">
                <svg width="20px" height="20px" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12.9258 1C8.9687 1 5.78328 4.20209 5.78328 8.14246C5.78328 12.0009 8.82405 15.1415 12.6564 15.2703C12.6928 15.2715 12.7292 15.2705 12.7654 15.2672C12.8705 15.2576 12.9837 15.2584 13.0642 15.2664C13.103 15.2703 13.1421 15.2716 13.181 15.2703C17.014 15.1415 20.0522 12.001 20.0682 8.14611L20.0682 8.14246C20.0682 4.20081 16.8674 1 12.9258 1ZM7.53856 8.14246C7.53856 5.16894 9.94068 2.75528 12.9258 2.75528C15.8974 2.75528 18.3119 5.16916 18.313 8.14049C18.3 11.0404 16.0318 13.3913 13.1728 13.5141C13.0089 13.5016 12.833 13.5021 12.6671 13.5142C9.80577 13.3926 7.53856 11.0405 7.53856 8.14246Z"
                        fill="#282828" />
                    <path
                        d="M21.5089 18.8448C19.119 17.4659 16.0157 16.8029 12.9591 16.8029C9.90213 16.8029 6.79209 17.466 4.3873 18.8434L4.38415 18.8452C2.21465 20.0999 0.948128 21.8854 1.00163 23.8424C1.01488 24.3269 1.4184 24.709 1.90293 24.6957C2.38745 24.6825 2.7695 24.2789 2.75625 23.7944C2.72653 22.7072 3.42264 21.4295 5.26128 20.3657C7.33596 19.1778 10.1251 18.5582 12.9591 18.5582C15.7942 18.5582 18.5745 19.1782 20.6317 20.3652L20.633 20.3659C22.4674 21.4202 23.1641 22.6913 23.1378 23.7761C23.1261 24.2607 23.5093 24.663 23.9939 24.6747C24.4785 24.6865 24.8808 24.3032 24.8926 23.8186C24.9399 21.866 23.6739 20.0895 21.5089 18.8448Z"
                        fill="#282828" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12.9258 1C8.9687 1 5.78328 4.20209 5.78328 8.14246C5.78328 12.0009 8.82405 15.1415 12.6564 15.2703C12.6928 15.2715 12.7292 15.2705 12.7654 15.2672C12.8705 15.2576 12.9837 15.2584 13.0642 15.2664C13.103 15.2703 13.1421 15.2716 13.181 15.2703C17.014 15.1415 20.0522 12.001 20.0682 8.14611L20.0682 8.14246C20.0682 4.20081 16.8674 1 12.9258 1ZM7.53856 8.14246C7.53856 5.16894 9.94068 2.75528 12.9258 2.75528C15.8974 2.75528 18.3119 5.16916 18.313 8.14049C18.3 11.0404 16.0318 13.3913 13.1728 13.5141C13.0089 13.5016 12.833 13.5021 12.6671 13.5142C9.80577 13.3926 7.53856 11.0405 7.53856 8.14246Z"
                        stroke="#F7F6F2" stroke-width="0.469184" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M21.5089 18.8448C19.119 17.4659 16.0157 16.8029 12.9591 16.8029C9.90213 16.8029 6.79209 17.466 4.3873 18.8434L4.38415 18.8452C2.21465 20.0999 0.948128 21.8854 1.00163 23.8424C1.01488 24.3269 1.4184 24.709 1.90293 24.6957C2.38745 24.6825 2.7695 24.2789 2.75625 23.7944C2.72653 22.7072 3.42264 21.4295 5.26128 20.3657C7.33596 19.1778 10.1251 18.5582 12.9591 18.5582C15.7942 18.5582 18.5745 19.1782 20.6317 20.3652L20.633 20.3659C22.4674 21.4202 23.1641 22.6913 23.1378 23.7761C23.1261 24.2607 23.5093 24.663 23.9939 24.6747C24.4785 24.6865 24.8808 24.3032 24.8926 23.8186C24.9399 21.866 23.6739 20.0895 21.5089 18.8448Z"
                        stroke="#F7F6F2" stroke-width="0.469184" stroke-linecap="round" stroke-linejoin="round" />
                </svg>


                <span>Sign In / Create Account </span>
            </a>
            <?php } ?>
        </li>


        <?php
            if (is_user_logged_in()) {
            ?>
        <li class="list-item">
            <a href="<?php echo wc_get_account_endpoint_url('orders')?>" class=" anchor">
                <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7.57084 14.5961L6.50683 12.2331C6.41983 12.0421 6.19583 11.9561 6.00383 12.0421C5.81183 12.1281 5.72683 12.3541 5.81283 12.5451L7.07483 15.3481C7.12283 15.4541 7.21684 15.5331 7.32984 15.5611C7.36084 15.5691 7.39183 15.5721 7.42183 15.5721C7.50483 15.5721 7.58684 15.5451 7.65484 15.4931L13.2828 11.1491C13.4488 11.0211 13.4798 10.7821 13.3518 10.6151C13.2228 10.4491 12.9848 10.4171 12.8178 10.5461L7.57084 14.5961Z"
                        fill="#282828" />
                    <path
                        d="M0.170921 18.0211C0.170921 18.2311 0.340926 18.4011 0.551926 18.4011H17.0539C17.2639 18.4011 17.4349 18.2311 17.4349 18.0211V4.75905C17.4349 4.75605 17.4329 4.75405 17.4329 4.75105C17.4319 4.70705 17.4229 4.66405 17.4069 4.62305C17.4029 4.61205 17.3969 4.60205 17.3919 4.59205C17.3839 4.57705 17.3789 4.56005 17.3689 4.54605L15.0459 1.12305C14.9749 1.01905 14.8569 0.956055 14.7309 0.956055H2.87392C2.74792 0.956055 2.62992 1.01805 2.55892 1.12305L0.235924 4.54605C0.225924 4.56005 0.220921 4.57705 0.212921 4.59205C0.207921 4.60205 0.201922 4.61205 0.197922 4.62305C0.181922 4.66505 0.172921 4.70705 0.171921 4.75105C0.171921 4.75405 0.169922 4.75605 0.169922 4.75905L0.170921 18.0211ZM16.6729 17.6411H0.931923V5.14005H6.96992V10.2601C6.96992 10.3981 7.04393 10.5251 7.16393 10.5921C7.28393 10.6601 7.43093 10.6571 7.54893 10.5851L8.80193 9.82005L10.0549 10.5851C10.1159 10.6221 10.1849 10.6411 10.2539 10.6411C10.3179 10.6411 10.3819 10.6251 10.4399 10.5921C10.5599 10.5251 10.6339 10.3981 10.6339 10.2601V5.14005H16.6719L16.6729 17.6411ZM9.87292 1.71705V4.37805H7.82392L8.40993 1.71705H9.87292ZM7.73093 5.14005H9.87292V9.58205L8.99992 9.04905C8.93892 9.01205 8.86993 8.99305 8.80193 8.99305C8.73293 8.99305 8.66392 9.01205 8.60292 9.04905L7.72993 9.58205L7.73093 5.14005ZM16.3349 4.37805H10.6339V1.71705H14.5279L16.3349 4.37805ZM3.07592 1.71705H7.63092L7.04492 4.37805H1.26992L3.07592 1.71705Z"
                        fill="#282828" />
                </svg>
                <span>View Orders </span>
            </a>
        </li>
        <?php
            } ?>
        <?php
            if (is_user_logged_in()) {
            ?>
        <li class="list-item">
            <a href="<?php echo get_home_url() ?>/wp-login.php?action=logout" class="anchor">
                <svg id="Group_10" data-name="Group 10" width="18" height="18" viewBox="0 0 18 18">
                    <rect id="Rectangle_25" data-name="Rectangle 25" width="18" height="18" fill="none" />
                    <path id="Path_24" data-name="Path 24" d="M174.011,86l2.973,2.974-2.973,2.974"
                        transform="translate(-161.691 -79.911)" fill="none" stroke="#000" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="1" />
                    <line id="Line_6" data-name="Line 6" x2="7.928" transform="translate(7.363 9.063)" fill="none"
                        stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                    <path id="Path_25" data-name="Path 25"
                        d="M44.531,52.461H40.566A.566.566,0,0,1,40,51.895V40.566A.566.566,0,0,1,40.566,40h3.965"
                        transform="translate(-37.168 -37.168)" fill="none" stroke="#000" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="1" />
                </svg>

                <span>Sign Out </span>
            </a>
        </li>
        <?php
            } ?>

    </ul>
</div>
<?php
}

add_shortcode('sign-in-modal', 'signInModal');
// loading icon 
add_action('webduel_loading_icon', 'wd_loading_icon', 20); 

function wd_loading_icon(){ 
   
    ?>
<div class="lds-ring loading-icon">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>
<?php 
}

// webduel phone modal 
add_action('webduel_phone_modal', 'wd_phone_modal', 10); 

function wd_phone_modal(){ 
    $data = get_field('contact_info', 'option');
    $phoneArr = $data['phone']['phone_number'];
    ?>
<div class="wd-phone-modal-container">
    <div class="content-container">
        <?php 
   
        foreach($phoneArr as $phone){ 
           ?>
        <div class="content">
            <div class="phone-number">
                <a href="tel:<?php echo $phone['phone'] ?>">
                    <?php echo $phone['phone']; ?>
                </a>
            </div>
        </div>
        <?php 
        }
    ?>
    </div>
</div>

<?php 
}
// loading icon 
add_action('webduel_sticky_phone_btn', 'wd_sticky_phone_btn', 20); 

function wd_sticky_phone_btn(){ 
    ?>
<div class="sticky-phone-button">
    <?php 
            do_action('webduel_phone_modal');
        ?>
    <button class="btn" aria-label="Phone Button">
        <div class="phone-icon">
            <svg width="20.672" height="20.356" viewBox="0 0 20.672 20.356">
                <path id="Icon_awesome-phone-alt" data-name="Icon awesome-phone-alt"
                    d="M18.121,12.958l-4.08-1.719a.884.884,0,0,0-1.02.247l-1.807,2.17A13.391,13.391,0,0,1,4.758,7.31L6.966,5.534a.848.848,0,0,0,.251-1L5.468.52a.884.884,0,0,0-1-.5L.678.882A.863.863,0,0,0,0,1.719,16.761,16.761,0,0,0,16.9,18.337a.871.871,0,0,0,.852-.666l.874-3.725A.866.866,0,0,0,18.121,12.958Z"
                    transform="translate(1 1.019)" fill="none" stroke="#384238" stroke-width="2" />
            </svg>
            <span>Call</span>
        </div>
        <div class="close-icon">
            <svg width="15.735" height="15.735" viewBox="0 0 15.735 15.735">
                <path id="Icon_ionic-md-close" data-name="Icon ionic-md-close"
                    d="M23.258,9.1,21.685,7.523l-6.294,6.294L9.1,7.523,7.523,9.1l6.294,6.294L7.523,21.685,9.1,23.258l6.294-6.294,6.294,6.294,1.573-1.573-6.294-6.294Z"
                    transform="translate(-7.523 -7.523)" fill="#384238" />
            </svg>
        </div>
    </button>

</div>
<?php 
  
}

// webduel social icons 
add_action('webduel_social_icons', 'wd_social_icons', 10);
function wd_social_icons() { 
    ?>
<div class="title">
    Get Social
</div>
<div class="social-icons">
    <?php
          $argsContact = array(
            'pagename' => 'contact'
          );
          $queryContact = new WP_Query($argsContact);
          while ($queryContact->have_posts()) {
            $queryContact->the_post();
          ?>
    <a href="<?php echo get_field("facebook"); ?>" aria-label="Follow Our Facebook Page">
        <svg width="20" height="20" viewBox="0 0 20 20">
            <path id="Path_31" data-name="Path 31"
                d="M20.9,2H3.1A1.1,1.1,0,0,0,2,3.1V20.9A1.1,1.1,0,0,0,3.1,22h9.58V14.25h-2.6v-3h2.6V9a3.64,3.64,0,0,1,3.88-4,20.26,20.26,0,0,1,2.33.12v2.7H17.3c-1.26,0-1.5.6-1.5,1.47v1.93h3l-.39,3H15.8V22h5.1A1.1,1.1,0,0,0,22,20.9V3.1A1.1,1.1,0,0,0,20.9,2Z"
                transform="translate(-2 -2)" fill="#636363" />
        </svg>

    </a>
    <a href="<?php echo get_field("instagram"); ?>" aria-label="Follow Our Instagram Page">
        <svg width="20" height="20" viewBox="0 0 20 20">
            <path id="Path_32" data-name="Path 32"
                d="M12,9.52A2.48,2.48,0,1,0,14.48,12,2.48,2.48,0,0,0,12,9.52Zm9.93-2.45a6.53,6.53,0,0,0-.42-2.26,4,4,0,0,0-2.32-2.32,6.53,6.53,0,0,0-2.26-.42C15.64,2,15.26,2,12,2s-3.64,0-4.93.07a6.53,6.53,0,0,0-2.26.42A4,4,0,0,0,2.49,4.81a6.53,6.53,0,0,0-.42,2.26C2,8.36,2,8.74,2,12s0,3.64.07,4.93a6.86,6.86,0,0,0,.42,2.27,3.94,3.94,0,0,0,.91,1.4,3.89,3.89,0,0,0,1.41.91,6.53,6.53,0,0,0,2.26.42C8.36,22,8.74,22,12,22s3.64,0,4.93-.07a6.53,6.53,0,0,0,2.26-.42,3.89,3.89,0,0,0,1.41-.91,3.94,3.94,0,0,0,.91-1.4,6.6,6.6,0,0,0,.42-2.27C22,15.64,22,15.26,22,12s0-3.64-.07-4.93Zm-2.54,8a5.73,5.73,0,0,1-.39,1.8A3.86,3.86,0,0,1,16.87,19a5.73,5.73,0,0,1-1.81.35H8.94A5.73,5.73,0,0,1,7.13,19,3.722,3.722,0,0,1,5,16.87a5.49,5.49,0,0,1-.34-1.81c0-.79,0-1,0-3.06V8.94A5.49,5.49,0,0,1,5,7.13a3.51,3.51,0,0,1,.86-1.31A3.59,3.59,0,0,1,7.13,5a5.73,5.73,0,0,1,1.81-.35h6.12A5.73,5.73,0,0,1,16.87,5,3.722,3.722,0,0,1,19,7.13a5.73,5.73,0,0,1,.35,1.81c0,.79,0,1,0,3.06s.07,2.27.04,3.06Zm-1.6-7.44a2.38,2.38,0,0,0-1.41-1.41A4,4,0,0,0,15,6H9a4,4,0,0,0-1.38.26A2.38,2.38,0,0,0,6.21,7.62,4.27,4.27,0,0,0,6,9v6a4.27,4.27,0,0,0,.26,1.38,2.38,2.38,0,0,0,1.41,1.41A4.27,4.27,0,0,0,9,18.05h6a4,4,0,0,0,1.38-.26,2.38,2.38,0,0,0,1.41-1.41A4,4,0,0,0,18.05,15V9a3.78,3.78,0,0,0-.26-1.38ZM12,15.82A3.81,3.81,0,0,1,8.19,12h0A3.82,3.82,0,1,1,12,15.82Zm4-6.89a.9.9,0,0,1,0-1.79h0a.9.9,0,0,1,0,1.79Z"
                transform="translate(-2 -2)" fill="#636363" />
        </svg>


    </a>
    <a href="<?php echo get_field("pintrest_"); ?>" aria-label="Follow Our Pinterest Page">
        <svg width="20" height="19.953" viewBox="0 0 20 19.953">
            <path id="Path_33" data-name="Path 33"
                d="M17.5,19.953H3.98A3.239,3.239,0,0,1,.742,16.721V3.232A3.239,3.239,0,0,1,3.98,0H17.5a3.238,3.238,0,0,1,3.238,3.232v13.49A3.238,3.238,0,0,1,17.5,19.953ZM7.861,18.367A33.242,33.242,0,0,0,10.118,13.4l.131-.352.281.249a2.622,2.622,0,0,0,1.562.548,3.552,3.552,0,0,0,1.338-.243c1.921-.706,3.009-2.751,2.759-5.235a4.688,4.688,0,0,0-4.859-4.234C8.9,4.049,6.75,5.282,6.194,7.442a4.982,4.982,0,0,0,.577,3.893c.323.431.694.58,1,.448a.55.55,0,0,0,.373-.733A2.769,2.769,0,0,0,8,10.6l-.045-.109-.058-.139a3.472,3.472,0,0,1-.3-1.086,2.951,2.951,0,0,1,.773-2.276A3.659,3.659,0,0,1,11.087,5.98a3.033,3.033,0,0,1,2.538,1.37,3.4,3.4,0,0,1-.09,3.517,2.085,2.085,0,0,1-1.591.973,1.412,1.412,0,0,1-.791-.264c-.344-.312-.31-.623.019-1.53A4.375,4.375,0,0,0,11.525,8.6a1.118,1.118,0,0,0-1.16-1.129,1.1,1.1,0,0,0-1.139.74A2.575,2.575,0,0,0,9.2,9.485a1.465,1.465,0,0,1-.1.872c-.138.387-.509,2.13-.821,3.472a40.535,40.535,0,0,0-.843,4.419q0,.078,0,.594Q7.836,18.4,7.861,18.367Z"
                transform="translate(-0.742)" fill="#636363" />
        </svg>

    </a>
    <a href="<?php echo get_field("youtube"); ?>" aria-label="Follow Our Youtube Channel">
        <svg width="19.924" height="19.924" viewBox="0 0 19.924 19.924">
            <g id="youtube__x2C__social__x2C_media__x2C__icons_x2C_" transform="translate(-16 -16)">
                <path id="Path_34" data-name="Path 34" d="M222.9,205.461v3.9l3.591-1.941-1.973-1.073Z"
                    transform="translate(-198.311 -181.597)" fill="#636363" fill-rule="evenodd" />
                <path id="Path_35" data-name="Path 35"
                    d="M33.371,16H18.554A2.563,2.563,0,0,0,16,18.554V33.371a2.563,2.563,0,0,0,2.554,2.554H33.371a2.563,2.563,0,0,0,2.554-2.554V18.554A2.563,2.563,0,0,0,33.371,16ZM32.6,25.627v.857a22.372,22.372,0,0,1-.13,2.245,3.061,3.061,0,0,1-.526,1.376,1.858,1.858,0,0,1-1.33.588c-1.862.139-4.656.145-4.656.145S22.5,30.8,21.44,30.7a2.2,2.2,0,0,1-1.467-.592,3.058,3.058,0,0,1-.523-1.376,22.478,22.478,0,0,1-.129-2.245V25.433a22.454,22.454,0,0,1,.129-2.244,3.074,3.074,0,0,1,.525-1.377,1.834,1.834,0,0,1,1.332-.577c1.86-.14,4.652-.13,4.652-.13h.006s2.791-.01,4.653.129a1.848,1.848,0,0,1,1.331.583,3.044,3.044,0,0,1,.524,1.374,22.293,22.293,0,0,1,.13,2.242Z"
                    fill="#636363" fill-rule="evenodd" />
            </g>
        </svg>

    </a>
    <?php
          }
          wp_reset_postdata();
          ?>
</div>
<?php 
}


// contact section 
add_action('webduel_contact_info', 'wd_contact_info', 10); 

function wd_contact_info(){ 
    ?>
<div class="title">
    Contact Us
</div>
<div class="contact-links">
    <?php 
                  do_action('webduel_phone_modal');

        ?>

</div>
<?php 
}