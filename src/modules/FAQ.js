const $ = jQuery
class FAQ {
    constructor(selector) {
        this.faqSection = $(selector);
        this.navItems = this.faqSection.find('.faq-nav .nav-item');
        this.contentPanes = this.faqSection.find('.faq-content .content-pane');
        this.bindEvents();
    }

    bindEvents() {
        // nav event
        this.navItems.click((event) => {
            this.handleNavItemClick(event);
        });

        // accordion event
        this.initAccordion();
    }
    initAccordion() {
        this.faqSection.find('.question').on('click', function () {
            const answer = $(this).next('.answer');
            const isOpen = answer.is(':visible');

            // Close all open answers
            $('.faq-content .answer').slideUp("fast").prev('.question').find('.arrow-icon').css('transform', '');

            if (!isOpen) {
                answer.slideDown("fast");
                $(this).find('.arrow-icon').css('transform', 'rotate(180deg)');
            }
        });
    }
    handleNavItemClick(event) {
        const targetId = $(event.currentTarget).data('target');
        this.navItems.removeClass('active');
        $(event.currentTarget).addClass('active');

        this.contentPanes.removeClass('show active');
        $('#' + targetId).addClass('show active');
    }
}

export default FAQ;