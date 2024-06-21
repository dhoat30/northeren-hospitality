const $ = jQuery;

class VariationSwatches {
    constructor() {
        this.swatchesContainer = $('.single form .variation-swatch');
        this.loopSwatchContainer = $('.loop-swatch-wrapper .variation-swatch');
        this.initEvents();
    }

    initEvents() {
        // archive page swatches
        // $(document).on('click', '.archive .variation-swatches .swatch', (event) => {
        //     this.changeArchivePageImage(event);
        // });
        // single page swatches
        this.swatchesContainer.on('click', this.onSwatchClick);
        this.loopSwatchContainer.on('click', this.loopProductSwatchClick);
        // Reset swatches button click event
        $(document).on('click', '.reset_variations', () => {
            this.resetSwatches();
        });
    }

    loopProductSwatchClick(event) {

        const swatch = $(event.currentTarget);
        const imageUrl = swatch.data('loop-main-image');


        // Find the closest product container and update its main image with lazy loading
        const productContainer = swatch.closest('.product');
        const mainImage = productContainer.find('.woocommerce-loop-product__link img').first();
        // Update the main product image src attributes
        mainImage.attr('src', imageUrl).attr('srcset', '').attr('sizes', '');

        // update selected class 
        swatch.addClass('selected').siblings().removeClass('selected');

    }

    onSwatchClick(event) {
        const $swatch = $(event.currentTarget);
        const variationSlug = $swatch.data('variation-slug');
        const variationLabel = $swatch.data('variation-label');
        var selectorId = $swatch.parent().attr('id').replace('-swatches', '');
        // update image
        const mainImage = $swatch.data('main-image');
        $('.product-main-image img').attr('src', mainImage);

        // Update hidden select and trigger change
        $('#' + selectorId).val(variationSlug).trigger('change');

        // update selected class 
        $swatch.addClass('selected').siblings().removeClass('selected');

        // Update hidden input fields and main image using jQuery
        $('.selected-variation-label').html(`<span class="title">Selected: </span><span class="value">${variationLabel}</span>`);
        $('.selected-variation-label').addClass('selected-variation-label-active');
    }




    // Reset all swatches and return to default image
    resetSwatches() {
        // Trigger the change event on the select element to reset it
        // reset the selections 
        $('.variations select').val('').trigger('change');
        // reset the image 
        const defaultMainImage = $('.product-main-image img').data('main_image')
        $('.product-main-image img').attr('src', defaultMainImage);
        // reset the swatches selected label value 
        $('.selected-variation-label').html("");
        $('.selected-variation-label').removeClass('selected-variation-label-active');

        // remove selected class from swatches 
        $('.variation-swatch').removeClass('selected');

    }
}

export default VariationSwatches;