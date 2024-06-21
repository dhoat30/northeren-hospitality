const $ = jQuery

class ProductEnquiry {
    constructor() {
        this.productEnquiryContainer = $('.enquiry-form-section')
        this.enquireButton = $('.enquire-now-button ')
        // form submission 
        this.form = $("#enquiry-form");
        this.submitButton = this.form.find('button');
        this.successMessage = "Form submitted successfully";
        this.productDetails = {}
        this.bindEvents()
    }
    bindEvents() {
        $(this.enquireButton).on('click', this.showEnquiryForm.bind(this));
        $('.close-menu-icon').on('click', this.closeEnquiryForm.bind(this));
        $(".dark-overlay").on('click', this.closeEnquiryForm.bind(this));
        // form submission 
        this.submitButton.click((event) => this.handleSubmit(event));

    }

    showEnquiryForm(e) {
        this.productDetails = $(e.target).data('product');
        this.productEnquiryContainer.find('.product-name').text(this.productDetails.title)
        // add url to image src 
        this.productEnquiryContainer.find('.product-image').attr('src', this.productDetails.image)
        this.productEnquiryContainer.show()
        $('.dark-overlay').show()

        // replace the button html every time the modal is opened. This is to avoid successfull message from previous form submission
        this.submitButton.html('<span>Enquire Now</span>')
        this.submitButton.css("display", "block");
        $('.success-message').remove();
        $('.error-message').remove();
    }

    closeEnquiryForm() {
        this.productEnquiryContainer.hide()
        $('.dark-overlay').hide()
        this.productEnquiryContainer.find('.product-name').text("")
        // add url to image src 
        this.productEnquiryContainer.find('.product-image').attr('src', "")
    }
    // form submission 
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

        formData.product = this.productDetails
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
}
export default ProductEnquiry