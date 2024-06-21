import "../css/critical.scss"

import "../css/style.scss"

// owl carousel 
import EveryOwlCarousel from './modules/OwlCarousel/EveryOwlCarousel';
// warranty 
// import Warranty from './modules/Warranty';

//pop up cart
import PopUpCart from './modules/PopUpCart';

// Enquire Modal 
import ProductEnquiry from "./modules/Woocommerce/ProductEnquiry/ProductEnquiry";
import GeneralModal from './modules/GeneralModal';
// cart modal 
import CartModal from './modules/Modals/CartModal'
// import ExitIntentModal from "./modules/Modals/ExitIntentModal";


// search 
import Search from './modules/Search'
import MobileSearch from "./modules/MobileSearch";

// facet filter
import FacetFilter from './modules/FacetFilter/FacetFilter'
import SortProduct from "./modules/FacetFilter/SortProduct";



// woocommerce 
import WooGallery from './modules/Woocommerce/WooGallery'
import QuickView from "./modules/Woocommerce/ProductArchive/QuickView";
import SingleProductTabs from "./modules/Woocommerce/SingleProductTabs";
// variation swatches 
import VariationSwatches from "./modules/Woocommerce/VariationSwatches/VariationSwatches";
// import SingleProduct from "./modules/Woocommerce/SingleProduct";

// import Windcave from "./modules/Woocommerce/Checkout/Windcave";
// modals 
import ErrorModal from "./modules/ErrorModal/ErrorModal";
// import Checkout from "./modules/Woocommerce/Checkout/Checkout";

// header 
import Header from './modules/Header'
import FixedNavMobile from "./modules/Scroll/FixedNavMobile";
import PhoneModal from "./modules/Modals/PhoneModal";
import AjaxAddToCart from "./modules/Woocommerce/AjaxOperation/AjaxAddToCart";
import DesktopMenu from "./modules/DesktopMenu";
import MobileMenu from "./modules/MobileMenu";
import FAQ from "./modules/FAQ";
import Optimization from "./modules/Optimization";
import QuoteAjax from "./modules/QuoteFeature/QuoteAjax";

// form processor 
import FormProcessor from "./modules/FormProcessor/FormProcessor";
import QtyHandler from "./modules/Woocommerce/QtyHandler/QtyHandler";
let $ = jQuery;
const desktopMenu = new DesktopMenu('#main-menu .menu')
const mobileMenu = new MobileMenu()
const qtyHandler = new QtyHandler()
// search 
const search = new Search()
const mobileSearch = new MobileSearch()

// add to cart and remove from cart class 
const popUpCart = new PopUpCart();

// woo Gallery 
const wooGallery = new WooGallery()
// single product page accordion 
// single product 
// const singleProduct = new SingleProduct()

// every owl carousel
const everyOwlCarousel = new EveryOwlCarousel();

// product archive
const quickView = new QuickView()
// product options 
// track product options
// Initialize the ProductOptions class when document is ready
jQuery(document).ready(function ($) {

  // variation swatches
  const variationSwatches = new VariationSwatches();

  const ajaxAddToCart = new AjaxAddToCart();

  const faq = new FAQ('.faq-section')
});

// modals 
const errorModal = new ErrorModal()

// scroll events 
const fixedNavMobile = new FixedNavMobile()
// header 
const header = new Header();

// mobile menu 
const phoneModal = new PhoneModal()
window.onload = function () {
  // exit intent modal 
  // const exitIntentModal = new ExitIntentModal()


  const generalModal = new GeneralModal();
  // cart modal 
  const cartModal = new CartModal();
  // form data processing 





  // facet filter 
  const facetFilter = new FacetFilter()
  const sortProduct = new SortProduct()
  // optimization 
  const optimization = new Optimization()

  // quote ajax
  const quoteAjax = new QuoteAjax()
  // enquiry modal 
  const productEnquiry = new ProductEnquiry();

  // form processor 
  // arg1 = form wrapper id arg2 = success message, arg3 = send cookie object, arg4 = form type
  const sendCookieObject = true
  const footerContactForm = new FormProcessor("#footer-form-wrapper", "Form submitted successfully", false, "Footer Contact Form");
  const contactPageForm = new FormProcessor("#contact-form", "Form submitted successfully", false, "Contact Form");

  const quoteForm = new FormProcessor("#quote-form", "Form submitted successfully", sendCookieObject, "Quote Form");

  const singleProductTabs = new SingleProductTabs()

}









// jQuery(document).ready(function ($) {
//   // Listen for the 'removed_from_cart' event triggered by WooCommerce
//   $(document).on('click', 'button', function () {
//     // Option 1: Manually update the popup cart by fetching updated content via AJAX
//     // updateCustomPopupCart();
//     console.log('removed from cart')
//     // Option 2: Trigger a refresh of all cart fragments (might be less efficient)
//     $(document.body).trigger('wc_fragment_refresh');
//   });

//   // Function to manually update the custom popup cart
//   function updateCustomPopupCart() {
//     $.ajax({
//       url: wc_cart_fragments_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments'),
//       type: 'POST',
//       success: function (data) {
//         if (data && data.fragments) {
//           // Update your popup cart content
//           $('.cart-box').html(data.fragments['your_custom_fragment_key']);
//         }
//  
//     });
//   }
// });


$(window).load(function () {
  // On thumbnail click, change the main image src

  setTimeout(() => {
    $('.hero-slider .card-list').show()
  }, 0)
  setTimeout(() => {
    $('.hero-slider .skeleton').hide()
  }, 3000)
});

// jQuery(document).ready(function ($) {
//   $('.variation-swatch').on('click', function () {
//     console.log("swatch clicked ")
//     var imageSrc = $(this).data('main-image');
//     var variationId = $(this).data('variation-id');

//     setTimeout(() => {
//       $('input[name="variation_id"]').val(variationId).trigger('change');

//       $('.single_variation_wrap').show()
//       $('form.cart').trigger('update_variation_values');  // This triggers WooCommerce to refresh the form

//     }, 1000)



//     // image code 
//     $('.product-main-image img').attr('src', imageSrc);
//     $('.variation-swatch').removeClass('selected');
//     $(this).addClass('selected');
//   });
// });

// jQuery(document).ready(function ($) {
//   $('.variation-swatch').on('click', function () {
//     var $this = $(this);
//     var variationData = JSON.parse($this.attr('data-variation-data')); // Parse the JSON data
//     console.log(variationData.id)
//     $('input[name="variation_id"]').val(variationData.id).trigger('change');
//     $('.woocommerce-product-gallery__image img').attr('src', $this.attr('data-main-image'));
//     $('.single_variation_wrap').show(); // Ensure visibility
//     $('form.cart').trigger('found_variation', [variationData]); // Trigger the found_variation event

//     $('.variation-swatch').removeClass('selected');
//     $this.addClass('selected');
//   });
// });

// jQuery(document).ready(function ($) {
//   $('.variation-swatch').on('click', function () {
//     var $swatch = $(this);
//     var variationId = $swatch.data('variation-slug');
//     var selectorId = $swatch.parent().attr('id').replace('-swatches', '');
//     var mainImage = $swatch.data('main-image');
//     // Update hidden select and trigger change
//     $('#' + selectorId).val(variationId).trigger('change');
//     $('.product-main-image img').attr('src', mainImage);
//     // Update UI elements if necessary
//     $swatch.addClass('selected').siblings().removeClass('selected');
//     $('.selected-variation-label').text(variationId);
//   });
// });
