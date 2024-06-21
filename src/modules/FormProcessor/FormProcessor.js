const $ = jQuery

class FormProcessor {
    constructor(formWrapperID, successMessage, sendCookieObject = false, formType) {
        this.sendCookieObject = sendCookieObject;
        this.form = $(formWrapperID);
        this.formType = formType;
        this.submitButton = this.form.find('button');
        this.successMessage = successMessage;

        this.initEvents();
    }

    initEvents() {

        this.submitButton.click((event) => this.handleSubmit(event));
    }
    // validate input 
    validateInput(inputElement, message) {
        const inputWrapper = inputElement.closest(".input-wrapper");
        inputWrapper.find('.error-message').remove();
        if (inputElement.val().trim() === '') {
            inputWrapper.append(`<p class='error-message'>${message}</p>`);
            inputWrapper.find('.error-message').show();
            // Scroll to the input element
            $('html, body').animate({
                scrollTop: inputElement.offset().top - 40 // Adjust the -20 to whatever suits your design
            }, 100);
            return false;
        }
        return true;
    }

    // validate email 
    validateEmail(emailElement) {
        const inputWrapper = emailElement.closest(".input-wrapper");
        inputWrapper.find('.error-message').remove();
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailRegex.test(emailElement.val())) {
            inputWrapper.append(`<p class='error-message'>Please enter a valid email address.</p>`);
            inputWrapper.find('.error-message').show();
            return false;
        }
        return true;
    }

    handleSubmit(event) {
        event.preventDefault();
        let valid = true;
        let formData = {};

        // Validate Name
        const name = this.form.find('#name');
        if (!this.validateInput(name, 'Name is required')) {
            valid = false;
        } else {
            formData.name = name.val();
        }

        // Validate Email
        const email = this.form.find('#email');
        if (!this.validateEmail(email, 'Email is required')) {
            valid = false;
        } else {
            formData.email = email.val();
        }

        // Validate Phone
        const phone = this.form.find('#phone');
        if (!this.validateInput(phone, 'Phone is required')) {
            valid = false;
        } else {
            formData.phone = phone.val();
        }

        // Collect Message (optional)
        const message = this.form.find('#message');
        formData.message = message.val();
        // send cookie object
        if (this.sendCookieObject) {
            formData.quote_product_arr = JSON.parse(this.getCookie('quote_products'));

        }
        if (this.formType) {
            formData.subject = this.formType
        }
        // Process form if valid
        if (valid) {
            this.sendData(formData);
        }
    }

    sendData(formData) {
        formData.action = 'send_contact_email';  // This is the name of the WP AJAX action hook
        formData.contact_form_nonce = webduelData.nonce
        const buttonHTML = this.submitButton.html();

        // add html in the button 
        this.submitButton.html('<div class="dots-loading"></div>');
        $.ajax({
            type: 'POST',
            url: webduelData.ajaxurl,
            data: formData,
            success: (response) => {
                this.submitButton.css("display", "none ");
                this.submitButton.closest('div').append(`<p class='success-message'>${this.successMessage}</p>`);
                this.form.find('.success-message').show();
            },
            error: (error) => {
                this.submitButton.html(buttonHTML);
                this.submitButton.closest('div').append(`<p class='error-message'>Something went wrong. Please try again.</p>`);
                this.form.find('.error-message').show();
                console.error('Error:', error);
            }
        });
    }

    getCookie(name) {
        // Get all cookies as a single string, and add a semicolon at the end for uniform parsing
        let cookieString = document.cookie + ";";
        // Prepare the search key to find the cookie in the string
        let key = name + "=";
        // Start position of the cookie
        let start = cookieString.indexOf(key);
        if (start !== -1) {
            // Find the start position of the value by skipping the key
            start += key.length;
            // Find the end position of the value by locating the semicolon
            let end = cookieString.indexOf(";", start);
            // Extract and decode the cookie value
            return decodeURIComponent(cookieString.substring(start, end));
        }
        return null; // Return null if the cookie with the specified name isn't found
    }
}

export default FormProcessor