const $ = jQuery;

class MobileMenu {
    constructor() {
        this.hamburgerMenu = $('.hamburger-menu');
        this.closeIcon = $('.navbar .close-menu-icon');
        this.navbar = $('.navbar'); // Reference to your menu
        this.overlay = $('.dark-overlay');
        this.mobileSearch = $('.mobile-search-icon');
        this.closeSearchIcon = $('.close-search-icon');
        if (window.matchMedia('(max-width: 1300px)').matches) {
            this.initEvents();
        }
    }

    initEvents() {
        this.hamburgerMenu.on('click', this.toggleMenu.bind(this));
        this.closeIcon.on('click', this.toggleMenu.bind(this));
        this.overlay.on('click', this.hideMenu.bind(this));
        this.mobileSearch.on('click', this.showSearch.bind(this));
        this.closeSearchIcon.on('click', this.hideSearch.bind(this));

        // Setup submenu toggle events
        this.navbar.find('li.menu-item-has-children > a').on('click', this.toggleSubMenu.bind(this));

        // show mobile search 
        this.mobileSearch.on('click', this.showSearch.bind(this))
        this.closeSearchIcon.on('click', this.hideSearch.bind(this))
    }

    toggleMenu() {
        this.navbar.toggleClass('open');
        this.overlay.toggle();
    }

    hideMenu() {
        this.navbar.removeClass('open');
        this.overlay.hide();
    }

    showSearch() {
        $('.search-container').show();
    }

    hideSearch() {
        $('.search-container').hide();
    }

    toggleSubMenu(e) {
        e.preventDefault(); // Prevent default link behavior
        const $target = $(e.currentTarget);
        const $parentLi = $target.parent('li');
        const $submenu = $target.next('ul.sub-menu');

        if ($parentLi.hasClass('open')) {
            // If already open and submenu exists, navigate if clicked again

            window.location.href = $target.attr('href');
            return;

        }

        // Open or close the submenu
        $submenu.slideToggle(200, () => {
            // Toggle open class after animation completes
            $parentLi.toggleClass('open');
        });

        // Close other submenus at the same level
        $parentLi.siblings().find('ul.sub-menu').slideUp(200).parent().removeClass('open');
    }
}

export default MobileMenu;
