const $ = jQuery

class SingleProductTabs {
    constructor() {
        this.tabs = $('.single .product-tabs .tab-links a');
        this.bindEvents()
    }
    bindEvents(e) {
        $('.tab-links a').on('click', function (e) {
            e.preventDefault();

            var currentAttrValue = $(this).attr('href');

            // Show/Hide Tabs
            $('.tab').removeClass('active');
            $('.tab-links li').removeClass('active');
            $(this).parent('li').addClass('active');
            $(currentAttrValue).addClass('active');
        });
    }
}
export default SingleProductTabs;