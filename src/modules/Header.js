const $ = jQuery

class Header {
    constructor() {
        this.events()
    }
    events() {
        // show phone modal 
        $('.useful-links-container .help-wrapper').hover(
            (e) => {
                this.showSignInModal('.useful-links-container', '.contact-modal')
            },
            (e) => {
                this.hideSignInModal('.useful-links-container', '.contact-modal')
            },
        )
        // show sign in modal 
        $('.useful-links-container .sign-in-container').hover(
            (e) => {
                this.showSignInModal('.useful-links-container', '.sign-in-modal')
            },
            (e) => {
                this.hideSignInModal('.useful-links-container', '.sign-in-modal')
            },
        )
        // show design board in modal 
        $('.useful-links-container .design-board-icon-container ').hover(
            (e) => {
                this.showSignInModal('.useful-links-container', '.design-board-header-modal')
            },
            (e) => {
                this.hideSignInModal('.useful-links-container', '.design-board-header-modal')
            }
        )

    }
    // show phone modal 

    // sign in modal 
    showSignInModal(e, modalClass) {
        console.log("showing modal ")
        $(e).find(modalClass).addClass('show-header-modal')
    }
    hideSignInModal(e, modalClass) {

        $(e).find(modalClass).removeClass('show-header-modal')


    }

}
export default Header