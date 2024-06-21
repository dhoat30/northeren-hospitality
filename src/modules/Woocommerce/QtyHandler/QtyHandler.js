const $ = jQuery
class QtyHandler {
    constructor() {
        this.initEvents();
    }

    initEvents() {
        // Increase quantity
        $('.quantity-button.increase').on('click', (event) => {
            this.changeQuantity(event.currentTarget, true);
        });

        // Decrease quantity
        $('.quantity-button.decrease').on('click', (event) => {
            this.changeQuantity(event.currentTarget, false);
        });
    }

    changeQuantity(button, isIncreasing) {
        const $button = $(button);
        const $parentForm = $button.closest('.webduel-qty-wrapper');
        const $quantityField = $parentForm.find('.input-text.qty.text');

        let currentQty = parseInt($quantityField.val());
        if (isNaN(currentQty)) {
            currentQty = 1;
        }

        if (isIncreasing) {
            $quantityField.val(currentQty + 1);
        } else {
            if (currentQty > 1) {
                $quantityField.val(currentQty - 1);
            }
        }
    }
}

export default QtyHandler;