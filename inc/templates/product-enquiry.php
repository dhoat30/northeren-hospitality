<?php 
// check if the page is shop page, single product page, archive page, category page or tag page 

if( is_front_page() || is_product() || is_shop() || is_product_category() || is_product_tag() || is_archive() || is_search()  || is_post_type_archive('product')){ 
    global $product;
    ?>
<section class="enquiry-form-section row-container">
    <svg class="close-menu-icon" width="32px" height="32px" viewBox="0 0 748 748" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <circle cx="374" cy="374" r="374" fill="#9C9C9C"></circle>
        <path
            d="M206.97 541.03C208.102 542.163 209.446 543.062 210.926 543.675C212.405 544.288 213.991 544.604 215.593 544.604C217.195 544.604 218.781 544.288 220.26 543.675C221.74 543.062 223.084 542.163 224.216 541.03L374 391.245L523.845 541.03C526.132 543.317 529.234 544.601 532.468 544.601C535.702 544.601 538.804 543.317 541.091 541.03C543.377 538.743 544.662 535.641 544.662 532.407C544.662 529.173 543.377 526.071 541.091 523.784L391.245 374L541.03 224.155C543.317 221.868 544.601 218.766 544.601 215.532C544.601 212.298 543.317 209.196 541.03 206.909C538.743 204.623 535.641 203.338 532.407 203.338C529.173 203.338 526.071 204.623 523.784 206.909L374 356.755L224.155 206.97C221.823 204.974 218.824 203.93 215.757 204.049C212.69 204.167 209.78 205.439 207.609 207.609C205.439 209.78 204.167 212.69 204.049 215.757C203.93 218.824 204.974 221.823 206.97 224.155L356.755 374L206.97 523.845C204.7 526.129 203.426 529.218 203.426 532.438C203.426 535.657 204.7 538.746 206.97 541.03Z"
            fill="white"></path>
    </svg>
    <div class="enquiry-modal-container">


        <div class="product-container beige-color-bc flex-center flex-column align-center">
            <img class="product-image" src="" alt="Product Image">
            <div class="product-name h4 center-align">


            </div>

        </div>

        <div class="form-container">

            <div class="h3 title">
                Product Enquiry
            </div>
            <div class="body1">
                Please fill in the form and one of our team member will respond to your enquiry as quickly as
                possible.
            </div>
            <div class="form-wrapper">
                <form id="enquiry-form" method="POST">
                    <div class="grid">
                        <div class="input-wrapper">
                            <label for="name">Name*</label>
                            <input placeholder="John Doe" type="text" name="name" id="name" required>
                        </div>
                        <div class="input-wrapper">
                            <label for="name">Email*</label>
                            <input placeholder="john_doe@gmail.com" type="email" name="email" id="email" required>
                        </div>
                        <div class="input-wrapper">
                            <label for="name">Phone*</label>
                            <input placeholder="027 000 0000" type="text" name="phone" id="phone" required>
                        </div>
                    </div>
                    <div class="input-wrapper">
                        <label for="name">Message</label>
                        <textarea placeholder="Write message" name="message" id="message" rows="6"></textarea>
                    </div>
                    <div class="button-wrapper">
                        <button class="primary-button"><span>Enquire Now</span></button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</section>
<?php 
}