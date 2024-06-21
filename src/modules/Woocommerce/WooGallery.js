const $ = jQuery
class WooGallery {
    constructor() {
        this.$largeImageContainer = $('.single .product-main-image'); // Cache reused selector
        this.$largeImage = this.$largeImageContainer.find('img'); // Cache the image itself
        this.initializeEvents();
    }

    initializeEvents() {
        this.bindGalleryImageClicks();
        this.bindVariationChanges();
        // this.bindLargeImageContainerClick();
    }

    bindGalleryImageClicks() {
        const $galleryImages = $('.single .gallery li img');
        $galleryImages.on('click', (event) => {
            const largeImageSrc = $(event.currentTarget).data('large_image');
            this.replaceImage(largeImageSrc);
        });
    }

    bindVariationChanges() {
        $('.variations_form').on('change', '.variations select', (event) => {
            // Extract the current variations data
            const variationData = $(event.currentTarget).closest('form').data('product_variations');
            const selectedOptions = {};
            $('.variations select').each(function () {
                selectedOptions[$(this).data('attribute_name')] = $(this).val();
            });
            // Find matching variation
            const matchedVariation = variationData.find(variation => {
                return Object.entries(selectedOptions).every(([key, value]) => variation.attributes[key] === value);
            });
            if (matchedVariation && matchedVariation.image && matchedVariation.image.src) {
                this.replaceImage(matchedVariation.image.src);
            }
        });

    }

    bindLargeImageContainerClick() {
        this.$largeImageContainer.on('click', () => {
            this.$largeImageContainer.fadeOut();
        });
    }

    replaceImage(imageSrc) {
        this.$largeImageContainer.fadeIn();
        this.$largeImage.attr('src', imageSrc).on('load', () => {
            this.$largeImage.show(); // Ensure image is shown after loading
        });
    }
}

export default WooGallery;
