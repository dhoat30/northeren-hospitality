const $ = jQuery
class Optimization {
    constructor() {
        this.bindEvents();
    }
    bindEvents() {
        this.singleProductPage()
        // Variable to ensure the function only gets called once when passing 200px
        let hasScrolledPast200px = false;

        window.addEventListener('scroll', function () {
            const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
            // Check if scrolled past 200 pixels and function has not yet been called
            if (scrollPosition > 200 && !hasScrolledPast200px) {
                this.singleProductLPageLoop();
                hasScrolledPast200px = true;  // Ensure function is not called repeatedly after passing 200px
            }
        }.bind(this));

        // product archive page skelton
        this.productArchiveSkelton()
        // product archive page skelton 
        $(document).on("click", ".webduel-loop-wrapper", this.productArchiveSkelton)

    }
    singleProductPage() {
        // check if the device is mobile or desktop 
        let timeOut
        if ($(window).width() < 600) {
            timeOut = 1000
        } else {
            timeOut = 1000
        }
        setTimeout(() => {
            $('.single .product-images .skeleton').hide()
            $('.single .product-images img').show()
        }, timeOut)
    }
    singleProductLPageLoop() {
        console.log("single product loop")
        const images = document.querySelectorAll('.single ul.products li.product img');

        $('.product .skeleton').hide()
        images.forEach(image => {
            image.style.display = 'block';
        });


    }
    productArchiveSkelton() {

        console.log("product archive and home page")
        // const images = document.querySelectorAll('.archive ul.products li.product img');
        setTimeout(() => {
            $('.product .skeleton').hide()

        }, 1000)


    }
}
export default Optimization;