<!-- footer section -->
<footer>

    <div class="flex-container row-container">
        <div class="item">
            <?php
                    $logo = get_field('dark_logo', 'option');
                ?>
            <a href="/">
                <img src="<?php echo $logo['sizes']['thumbnail']; ?>" alt="<?php echo $logo['alt']; ?>" width="192px"
                    height="50px" />
            </a>
            <div class="hubspot-form">
                <div class="h5 title">
                    stay up to date
                </div>

                <!-- Delayed HubSpot Embed Code -->
                <script type="text/javascript">
                setTimeout(function() {
                    var hsScript = document.createElement('script');
                    hsScript.src = "//js.hs-scripts.com/45030920.js";
                    hsScript.async = true;
                    hsScript.defer = true;
                    document.body.appendChild(hsScript);
                }, 5000); // Delay in milliseconds (15000ms = 15 seconds)
                </script>

                <!-- Delayed HubSpot Forms Embed Code -->
                <script type="text/javascript">
                setTimeout(function() {
                    var hsFormsScript = document.createElement('script');
                    hsFormsScript.charset = "utf-8";
                    hsFormsScript.src = "//js.hsforms.net/forms/embed/v2.js";
                    document.body.appendChild(hsFormsScript);

                    hsFormsScript.onload = function() {
                        hbspt.forms.create({
                            region: "na1",
                            portalId: "42810457",
                            formId: "c8bb9446-15d5-4a69-80d9-f7ba66142c50"
                        });
                    };
                }, 5000); // Delay in milliseconds
                </script>


            </div>
            <?php 
            $socialMediaData = get_field('social_links', 'option');
            if(!empty($socialMediaData)){ 
                ?>
            <div class="social-media-wrapper">
                <?php 
                foreach($socialMediaData as $socialMedia){
                    ?>
                <a class="item" href="<?php echo $socialMedia['link']; ?>" target="_blank" rel="nofollow">
                    <img src="<?php echo $socialMedia['social_media_icon']['url']; ?>"
                        alt="<?php echo $socialMedia['social_media_name']; ?>" width="40px" height="40px" />
                </a>
                <?php
                    }
                    ?>

            </div>
            <?php 
            }
            ?>

        </div>
        <div class="services-nav item">
            <div class="h5 title">
                Shop by category
            </div>
            <div class="nav">
                <?php
          wp_nav_menu(array(
            'theme_location' => 'footer_categories'
          ))
          ?>
            </div>
        </div>
        <div class="services-nav item">
            <div class="h5 title">
                Useful links
            </div>
            <div class="nav">
                <?php
          wp_nav_menu(array(
            'theme_location' => 'footer_useful_links'
          ))
          ?>
            </div>
        </div>
        <div class="services-nav item">
            <div class="h5 title">
                Account
            </div>
            <div class="nav">
                <?php
          wp_nav_menu(array(
            'theme_location' => 'footer_account_links'
          ))
          ?>
            </div>
        </div>
        <div class="contact item">
            <div class="h5 title">
                Contact
            </div>
            <?php
            $contactInfo = get_field('footer_contact', 'option'); 
            if(!empty($contactInfo)){
                ?>
            <div class="contact-info-wrapper">
                <?php 
                foreach($contactInfo as $contact){
                    ?>
                <a href="<?php echo $contact['url']; ?>" class="contact-info">
                    <img src="<?php echo $contact['icon']['url']; ?>" alt="<?php echo $contact['icon']['alt']; ?>"
                        width="28px" height="28px" />
                    <span class="text">
                        <?php echo $contact['label']; ?>
                    </span>
                </a>
                <?php 
                }
                ?>
            </div>
            <?php 
            } 
            ?>
            <?php 
                $paymentMethods = get_field('payment_logos', 'option');
                if(!empty($paymentMethods)){
                ?>
            <div class="payment-methods wrapper">
                <?php 
                    foreach($paymentMethods as $paymentMethod){
                        ?>
                <img src="<?php echo $paymentMethod['payment_logo']['url']; ?>"
                    alt="<?php echo $paymentMethod['payment_name']; ?>" width="51px" height="34px" />
                <?php 
                    }
                    ?>
            </div>
            <?php 
                
                } 
                ?>
        </div>

    </div>

    <!-- copyright section -->
    <div class="copyright-section row-container">
        <div class="columns">
            <div class="copyright">
                ©2024 Norhtern Hospitality. All Rights Reserved
            </div>
            <div class="copyright">|</div>
            <div class="agency">
                Developed by
                <a href="https://webduel.co.nz" target="_blank" rel="nofollow">
                    web<strong>DUEL</strong>
                </a>
            </div>
        </div>
    </div>
</footer>

<div class="go-to-header hide">
    <a href="#header">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" id="svg8" clip-rule="evenodd"
            fill-rule="evenodd" height="40px" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
            width="40px">
            <path id="path2" fill="white"
                d="m12 9.414-6.293 6.293c-.39.39-1.024.39-1.414 0s-.39-1.024 0-1.414l7-7c.39-.391 1.024-.391 1.414 0l7 7c.39.39.39 1.024 0 1.414s-1.024.39-1.414 0z" />
        </svg>

    </a>
</div>


<!-- overlay without loader  -->
<div class="dark-overlay">
</div>
<!-- overlay without loader  -->
<div class="white-overlay">
</div>

<!-- foreground overlay  -->
<div class="foreground-loader">
    <?php do_action('webduel_loading_icon'); ?>
</div>



<?php
do_action('quick-view-modal-webduel'); 
do_action('mobile-bottom-nav-bar'); 
get_template_part('inc/templates/product-enquiry'); 

?>

<!-- slick script  -->
<script defer type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>

<?php wp_footer(); ?>

<!-- Start of Asynchronous HubSpot Embed Code -->
<script type="text/javascript">
// Function to load the HubSpot script
// function loadHubSpotScript() {
//     var hsScript = document.createElement('script');
//     hsScript.id = 'hs-script-loader';
//     hsScript.async = true;
//     hsScript.defer = true;
//     hsScript.src = '//js.hs-scripts.com/45666247.js';
//     document.body.appendChild(hsScript);
// }

// // Delay the script loading by 15 seconds
// setTimeout(loadHubSpotScript, 15000);
</script>
<!-- End of Asynchronous HubSpot Embed Code -->


</body>

</html>