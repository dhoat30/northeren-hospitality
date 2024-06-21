const $ = jQuery

class FacetFilter {
    constructor() {


        // mobile and desktop filter show/hide
        this.closeButton = $('.close-icon')
        // desktop filter show 
        this.filterButton = $('.bottom-nav-bar .Filter')
        // facet label button
        this.labelButton = $('.facet-label-button')
        this.events()

    }
    events() {
        //    set cookie to false every page load to hide the facet container 
        Cookies.set('showingProductFacetContainer', 'false')


        // show filter container
        this.filterButton.on('click', this.showFilterWrapper)

        // hide filter container
        this.closeButton.on('click', this.hideFilterWrapper)
        $('.dark-overlay').on('click', this.hideFilterWrapper);

    }



    // show desktop filter container on button click
    showFilterWrapper() {
        const showContainer = Cookies.get('showingProductFacetContainer')
        $('.dark-overlay').toggle();
        $('.filter-wrapper').toggleClass('show');

    }

    hideFilterWrapper() {
        $('.filter-wrapper').removeClass('show');
        $('.dark-overlay').hide();

    }


}

export default FacetFilter