<?php 
function handle_contact_form_submission() {
    // Check if nonce field is set and is valid
    if (!isset($_POST['contact_form_nonce']) || !wp_verify_nonce($_POST['contact_form_nonce'], 'wp_rest')) {
        wp_send_json_error('Nonce verification failed!', 403); // Send a JSON error if verification fails
        wp_die();
    }

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);

      // Start building the email body
      $body = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message";

      // Check if product data is included
      if (isset($_POST['product'])) {
          $product = $_POST['product'];
          $productId = sanitize_text_field($product['id']);
          $productTitle = sanitize_text_field($product['title']);
      
  
          // Append product details to the email body
          $body .= "\n\nProduct ID: $productId\nProduct Title: $productTitle";
      }

    // Check if product data is included and iterate over each product
    if (isset($_POST['quote_product_arr']) && is_array($_POST['quote_product_arr'])) {
        $body .= "\n\nProducts:\n";
        foreach ($_POST['quote_product_arr'] as $product) {
            $productId = sanitize_text_field($product['id']);
            $productQty = sanitize_text_field($product['qty']);
            $body .= "Product ID: $productId, Quantity: $productQty\n";
        }
    }

      $to = 'designer@webduel.co.nz';
      $headers = array('Content-Type: text/plain; charset=UTF-8');
  
      if(wp_mail($to, $subject, $body, $headers)) {
          wp_send_json_success(array('message' => 'Email sent successfully!'));
      } else {
          wp_send_json_error(array('message' => 'Failed to send email.'));
      }
      wp_die();
}
add_action('wp_ajax_send_contact_email', 'handle_contact_form_submission');
add_action('wp_ajax_nopriv_send_contact_email', 'handle_contact_form_submission');