const $ = jQuery;

class GeneralModal {
    constructor() {
        this.shareModal = $('.share-modal');
        this.shareButton = $('.share-button');
        this.events();
    }

    events() {
        this.shareButton.on("click", (e) => {
            e.stopPropagation(); // Prevents click from immediately propagating to document
            this.openShareModal();
        });
        $(document).on('click', (e) => this.closeModalIfClickedOutside(e));
    }

    openShareModal() {
        this.shareModal.toggle();
    }

    closeShareModal() {
        this.shareModal.hide();
    }

    closeModalIfClickedOutside(e) {
        if (!this.shareModal.is(e.target) && this.shareModal.has(e.target).length === 0 && !this.shareButton.is(e.target)) {
            this.closeShareModal();
        }
    }
}

export default GeneralModal;
