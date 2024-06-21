<?php
if (is_user_logged_in()){ 
    $current_user = wp_get_current_user();
    $user_email = $current_user->user_email;
    $user_name = $current_user->first_name; // or use $current_user->first_name . ' ' . $current_user->last_name;
    $user_phone = get_user_meta($current_user->ID, 'billing_phone', true); // Assuming WooCommerce is storing phone numbers in user meta
    ?>
<form id="quote-form" method="POST">
    <div class="input-wrapper">
        <label for="name">Name*</label>
        <input placeholder="John Doe" type="text" name="name" id="name" value="<?php echo esc_attr($user_name); ?>"
            required>
    </div>
    <div class="input-wrapper">
        <label for="name">Email*</label>
        <input placeholder="john_doe@gmail.com" type="email" name="email" id="email"
            value="<?php echo esc_attr($user_email); ?>" required>
    </div>
    <div class="input-wrapper">
        <label for="name">Phone*</label>
        <input placeholder="027 000 0000" type="text" name="phone" id="phone"
            value="<?php echo esc_attr($user_phone); ?>" required>
    </div>
    <div class="input-wrapper">
        <label for="name">Message</label>
        <textarea placeholder="Write message" name="message" id="message" rows="6"></textarea>
    </div>
    <div class="button-wrapper"><button class="primary-button">Get a quote</button></div>

</form>
<?php } ?>