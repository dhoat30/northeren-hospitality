
let $ = jQuery;
class EveryOwlCarousel {
    constructor() {
        this.nextArrow = `<div class="next-arrow"><svg width="36" height="36" viewBox="0 0 884 884" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="442" cy="442" r="441.5" transform="rotate(-90 442 442)" fill="white" />
        <path d="M341.801 646.798L341.801 646.798L546.246 442.353L546.599 441.999L546.246 441.645L341.801 237.2C333.4 228.798 333.4 215.195 341.801 206.799C350.202 198.403 363.806 198.398 372.201 206.799L372.534 206.467L372.202 206.799L592.2 426.799C596.399 430.997 598.5 436.5 598.5 441.999C598.5 447.498 596.399 453.001 592.2 457.199L372.202 677.199C363.8 685.6 350.197 685.6 341.801 677.199C333.405 668.798 333.4 655.194 341.801 646.798Z" fill="#44483E" />
        </svg></div>
        `;
        this.prevArrow = `<div class="prev-arrow"><svg width="36" height="36" viewBox="0 0 884 884" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="442" cy="442" r="441.5" transform="rotate(90 442 442)" fill="white" />
        <path d="M542.199 237.202L542.199 237.202L337.754 441.647L337.401 442.001L337.754 442.355L542.199 646.8C550.6 655.202 550.6 668.805 542.199 677.201C533.798 685.597 520.194 685.602 511.798 677.201L511.466 677.533L511.798 677.201L291.799 457.201C287.601 453.003 285.5 447.5 285.5 442.001C285.5 436.502 287.601 430.999 291.799 426.801L511.798 206.801C520.2 198.4 533.803 198.4 542.199 206.801C550.595 215.202 550.6 228.806 542.199 237.202Z" fill="#44483E" stroke="#44483E"/>
        </svg></div>
        `;
        this.events();
    }
    events() {

        $(window).on('load', () => {
            // home page hero slider 
            this.homeHeroSlider()

            // sale home page carousel 
            this.saleCarousel();
            this.testimonialCarousel()
            // woo gallery 
            this.wooGallery();
            // home page product carouel 
            this.productsCarousel('.product-list-container .products', true, false, true);

            this.productsCarousel('.up-sells ul', false, false, false);
            this.productsCarousel('.related ul', false, false, false);
            this.productsCarousel('.recently-viewed-products ul', false, false, false);

            this.cardsCarousel();

            // show this on mobile devices 
            if (window.matchMedia('(max-width: 900px)').matches) {
                this.uspSection('.usp-section .row-container');

            }
        });

    }
    productsCarousel(className, lazyLoad = false, autoplay = true, dots = true) {
        $(className).slick({
            lazyLoad: lazyLoad ? 'ondemand' : "",
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            dots: dots,
            centerMode: true,
            centerPadding: "40px",
            autoplay: false,
            adaptiveHeight: true,
            autoplaySpeed: 2000,
            nextArrow: this.nextArrow,
            prevArrow: this.prevArrow,
            responsive: [
                {
                    breakpoint: 1450,
                    settings: {
                        slidesToShow: 3,
                    }
                },

                {
                    breakpoint: 1000,
                    settings: {
                        slidesToShow: 2,

                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        arrows: false


                    }
                },
            ]
        });
    }
    // usp section 
    uspSection(className) {
        $(className).slick({
            infinite: true,
            slidesToShow: 2,
            dots: false,
            autoplay: true,
            adaptiveHeight: true,
            autoplaySpeed: 2000,
            centerMode: true,
            centerPadding: '24px',
            responsive: [

                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                    }
                },

            ]
        });
    }
    homeHeroSlider() {

        $('.slider-container .card-list').slick({
            infinite: true,
            lazyLoad: 'ondemand',
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            autoplay: true,
            autoplaySpeed: 3000,

        });
    }
    saleCarousel() {
        this.cardsCarousel('.specials-section .products', true, true, false);
    }
    // woo gallery carousel 
    wooGallery() {
        $('.custom-slick-slider').slick({
            slidesToShow: 8,
            dots: false,
            nextArrow: this.nextArrow,
            prevArrow: this.prevArrow,

            responsive: [
                {
                    breakpoint: 1100,
                    settings: {
                        slidesToShow: 6,
                    }
                },
                {
                    breakpoint: 720,
                    settings: {
                        slidesToShow: 4,
                    }
                },
                {
                    breakpoint: 350,
                    settings: {
                        slidesToShow: 3,
                    }
                },
            ]
        });
    }

    testimonialCarousel() {
        $(".testimonials-section .testimonials-wrapper").slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            dots: false,

            autoplay: true,
            autoplaySpeed: 3000,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
                        centerPadding: "40px",
                        centerMode: true,
                    }
                },
                {
                    breakpoint: 900,
                    settings: {
                        slidesToShow: 2,
                        centerPadding: "40px",
                        centerMode: true,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        centerPadding: "40px",
                        centerMode: true,
                    }
                },
            ]
        });
    }
    cardsCarousel(className, lazyLoad = true, autoplay = true, dots = true) {
        $(className).slick({
            lazyLoad: lazyLoad ? 'ondemand' : "",
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            dots: dots,
            nextArrow: this.nextArrow,
            prevArrow: this.prevArrow,
            autoplay: autoplay,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1450,
                    settings: {
                        slidesToShow: 4,
                    }
                },
                {
                    breakpoint: 1100,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 720,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 400,
                    settings: {
                        slidesToShow: 1,
                    }
                },
            ]
        });
    }







}
export default EveryOwlCarousel;