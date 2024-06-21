<?php 
                    $contactFormData = get_field('footer_contact_form', 'option');
                    $title = $contactFormData['title'];
                    $description = $contactFormData['description'];
                    $image = $contactFormData['image'];
?>

<section class="footer-contact-form" id="footer-form-wrapper">
    <div class="wrapper ">
        <div class="contact-form-wrapper">
            <h2 class="footer-title h2">
                <?php echo $title; ?>
            </h2>
            <p class="subtitle1"> <?php echo $description; ?> </p>
            <form id="footer-contact-form" method="POST">
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
                <div class="input-wrapper">
                    <label for="name">Message</label>
                    <textarea placeholder="Write message" name="message" id="message" rows="6"></textarea>
                </div>

            </form>
        </div>
        <div class="image-wrapper" style="padding-bottom:<?php echo ($image['height']/$image['width'])*50 ?>%">
            <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
                width="100%">
        </div>
        <button class="primary-button"><span>Send</span></button>

    </div>
</section>