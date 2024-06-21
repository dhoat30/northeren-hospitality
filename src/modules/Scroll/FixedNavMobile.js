const $ = jQuery

class FixedNavMobile {
    constructor() {
        this.myID = $(".go-to-header");
        // this.myScrollFunc = this.myScrollFunc.bind(this); // Bind 'this' to the method

        this.events()
    }

    events() {
        window.addEventListener("scroll", this.myScrollFunc.bind(this));
    }
    myScrollFunc() {
        var y = window.scrollY;
        if (y >= 1200) {
            this.myID.addClass("show");
        } else if (y <= 1200) {
            this.myID.removeClass("show");
        }
    }
}
export default FixedNavMobile

// scroll arrow 


