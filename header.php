<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <!-- optimization -->
    <!-- slick script  -->
    <script defer type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>


    <!-- fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">

    <?php wp_head(); ?>

    <!-- google merchante center verification  -->
    <!-- <meta name="google-site-verification" content="MWqy-NjUuyKLYN1mhia3eZLW6u9WmtQzjatA5DyXU9E" /> -->
    <!-- Google Tag Manager -->
    <!-- Google Tag Manager -->
    <!-- <script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime(),
            event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-TTP7MHPP');
    </script> -->
    <!-- End Google Tag Manager -->
    <!-- End Google Tag Manager -->

</head>

<body id="header" <?php body_class(); ?>>
    <!-- Google Tag Manager (noscript) -->
    <!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TTP7MHPP" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript> -->
    <!-- End Google Tag Manager (noscript) -->

    <section class="header desktop-header">
        <!-- top banner -->
        <?php 
        get_template_part('inc/templates/top-banner');
        ?>


        <section class="middle-section">
            <div class="row-container">
                <!-- desktop logo -->
                <div class="logo-container">
                    <?php
                    $logo = get_field('logo', 'option');

                ?>
                    <a href="/">
                        <img src="<?php echo $logo['sizes']['thumbnail']; ?>" alt="<?php echo $logo['alt']; ?>"
                            width="<?php echo $logo['sizes']['thumbnail-width']*1.5;  ?>"
                            height="<?php echo $logo['sizes']['thumbnail-height']*1.5;  ?>" />
                    </a>
                </div>
                <!-- search bar  -->
                <div class="search-container">
                    <svg class="close-search-icon" width="24px" height="24px" viewBox="0 0 748 748" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="374" cy="374" r="374" fill="#9C9C9C" />
                        <path
                            d="M206.97 541.03C208.102 542.163 209.446 543.062 210.926 543.675C212.405 544.288 213.991 544.604 215.593 544.604C217.195 544.604 218.781 544.288 220.26 543.675C221.74 543.062 223.084 542.163 224.216 541.03L374 391.245L523.845 541.03C526.132 543.317 529.234 544.601 532.468 544.601C535.702 544.601 538.804 543.317 541.091 541.03C543.377 538.743 544.662 535.641 544.662 532.407C544.662 529.173 543.377 526.071 541.091 523.784L391.245 374L541.03 224.155C543.317 221.868 544.601 218.766 544.601 215.532C544.601 212.298 543.317 209.196 541.03 206.909C538.743 204.623 535.641 203.338 532.407 203.338C529.173 203.338 526.071 204.623 523.784 206.909L374 356.755L224.155 206.97C221.823 204.974 218.824 203.93 215.757 204.049C212.69 204.167 209.78 205.439 207.609 207.609C205.439 209.78 204.167 212.69 204.049 215.757C203.93 218.824 204.974 221.823 206.97 224.155L356.755 374L206.97 523.845C204.7 526.129 203.426 529.218 203.426 532.438C203.426 535.657 204.7 538.746 206.97 541.03Z"
                            fill="white" />
                    </svg>
                    <div class="search-code">
                        <div class="search-bar">
                            <svg class="desktop-search search" width="15.605" height="15.605"
                                viewBox="0 0 15.605 15.605">
                                <g id="Group_12" data-name="Group 12" transform="translate(-2.354 -2.354)">
                                    <circle id="Ellipse_5" data-name="Ellipse 5" cx="5.689" cy="5.689" r="5.689"
                                        transform="translate(2.854 2.854)" fill="none" stroke="#000"
                                        stroke-miterlimit="10" stroke-width="1" />
                                    <path id="Path_26" data-name="Path 26" d="M18.451,18.451l4.757,4.757"
                                        transform="translate(-5.956 -5.956)" fill="none" stroke="#000"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                        stroke-width="1" />
                                </g>
                            </svg>
                            <input autocomplete="off" type="text" class="search-input" placeholder="Search..."
                                id="search-term" />
                            <?php 
                         do_action('webduel_loading_icon'); 
                        ?>


                        </div>
                        <div class="result-div"></div>
                    </div>
                </div>

                <!-- usefull links  -->
                <?php 
                get_template_part('inc/templates/usefull-links-header');
                ?>
            </div>
        </section>
        <!--  main menu-->
        <div class="main-navbar-section">
            <nav class="navbar row-container">
                <div class="mobile-logo-wrapper">
                    <a href="/">
                        <img src="<?php echo $logo['sizes']['thumbnail']; ?>" alt="<?php echo $logo['alt']; ?>"
                            width="<?php echo $logo['sizes']['thumbnail-width'];  ?>px"
                            height="<?php echo $logo['sizes']['thumbnail-height'];  ?>px" />
                    </a>
                    <svg class=" close-menu-icon" width="24px" height="24px" viewBox="0 0 748 748" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="374" cy="374" r="374" fill="#9C9C9C" />
                        <path
                            d="M206.97 541.03C208.102 542.163 209.446 543.062 210.926 543.675C212.405 544.288 213.991 544.604 215.593 544.604C217.195 544.604 218.781 544.288 220.26 543.675C221.74 543.062 223.084 542.163 224.216 541.03L374 391.245L523.845 541.03C526.132 543.317 529.234 544.601 532.468 544.601C535.702 544.601 538.804 543.317 541.091 541.03C543.377 538.743 544.662 535.641 544.662 532.407C544.662 529.173 543.377 526.071 541.091 523.784L391.245 374L541.03 224.155C543.317 221.868 544.601 218.766 544.601 215.532C544.601 212.298 543.317 209.196 541.03 206.909C538.743 204.623 535.641 203.338 532.407 203.338C529.173 203.338 526.071 204.623 523.784 206.909L374 356.755L224.155 206.97C221.823 204.974 218.824 203.93 215.757 204.049C212.69 204.167 209.78 205.439 207.609 207.609C205.439 209.78 204.167 212.69 204.049 215.757C203.93 218.824 204.974 221.823 206.97 224.155L356.755 374L206.97 523.845C204.7 526.129 203.426 529.218 203.426 532.438C203.426 535.657 204.7 538.746 206.97 541.03Z"
                            fill="white" />
                    </svg>

                </div>
                <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'main_menu',
                            'container_id' => 'main-menu'
                        )
                    );
                    ?>
                <a class="primary-button account-button"
                    href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"
                    title="<?php _e('My Account',''); ?>"><svg width="14px" height="14px" viewBox="0 0 256 256"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M128 128C163.36 128 192 99.36 192 64C192 28.64 163.36 0 128 0C92.64 0 64 28.64 64 64C64 99.36 92.64 128 128 128ZM128 160C85.28 160 0 181.44 0 224V256H256V224C256 181.44 170.72 160 128 160Z"
                            fill="var(--light-on-primary-container)" />
                    </svg>
                    <span>My Account</span></a>
                <!-- add toggle button -->
                <div class="desktop-gst-toggle-wrapper">
                    <?php 
                        do_action('webduel_gst_toggle'); 
                        ?>
                </div>
            </nav>


            <div class="mobile-menu-wrapper row-container">
                <div class="hamburger-menu">
                    <svg width="40px" height="40px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"
                        id="fi_14267374">
                        <g id="_04" data-name="04">
                            <path fill="var(--light-primary)" d="m57 30h-50a2 2 0 0 0 0 4h50a2 2 0 0 0 0-4z">
                            </path>
                            <path fill="var(--light-primary)" d="m7 19h50a2 2 0 0 0 0-4h-50a2 2 0 0 0 0 4z">
                            </path>
                            <path fill="var(--light-primary)" d="m57 45h-50a2 2 0 0 0 0 4h50a2 2 0 0 0 0-4z">
                            </path>
                        </g>
                    </svg>
                </div>

                <a href="/" class="mobile-logo-header">
                    <img src="<?php echo $logo['sizes']['thumbnail']; ?>" alt="<?php echo $logo['alt']; ?>"
                        width="<?php echo $logo['sizes']['thumbnail-width'];  ?>px"
                        height="<?php echo $logo['sizes']['thumbnail-height'];  ?>px" />
                </a>

                <div class="mobile-header-actions">
                    <svg class="mobile-search-icon" width="24px" height="24px" viewBox="0 0 15.605 15.605">
                        <g id="Group_12" data-name="Group 12" transform="translate(-2.354 -2.354)">
                            <circle stroke="var(--light-primary)" id="Ellipse_5" data-name="Ellipse 5" cx="5.689"
                                cy="5.689" r="5.689" transform="translate(2.854 2.854)" fill="none" stroke="#000"
                                stroke-miterlimit="10" stroke-width="1" />
                            <path id="Path_26" data-name="Path 26" d="M18.451,18.451l4.757,4.757"
                                transform="translate(-5.956 -5.956)" stroke="var(--light-primary)"
                                stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                stroke-width="1" />
                        </g>
                    </svg>
                </div>


            </div>

        </div>
    </section>
    <!-- usp section -->
    <?php
    get_template_part('inc/templates/usp');
    ?>