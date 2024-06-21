const $ = jQuery;

class DesktopMenu {
    constructor(menuSelector) {
        this.menu = $(menuSelector);
        if (window.matchMedia('(min-width: 1300px)').matches) {
            this.initEvents();
        }
    }

    initEvents() {
        // Attach mouseenter and mouseleave to first-level menu items to handle first to second level interactions
        this.menu.find('> li.menu-item-has-children').mouseenter(this.handleMouseEnter.bind(this));
        this.menu.find('> li.menu-item-has-children').mouseleave(this.handleMouseLeave.bind(this));


        // Optionally keep the document click to close all submenus when clicking outside
        $(document).on('click', this.handleOutsideClick.bind(this));
    }

    handleMouseEnter(e) {
        var $currentTarget = $(e.currentTarget);
        var $submenu = $currentTarget.children('ul.sub-menu');

        // Show submenu
        $submenu.stop(true, true).addClass('show-mega-menu');


        $currentTarget.addClass('submenu-opened').addClass('arrow-rotated');
    }

    handleMouseLeave(e) {
        var $currentTarget = $(e.currentTarget);
        var $submenu = $currentTarget.children('ul.sub-menu');
        // Hide submenu
        $submenu.stop(true, true).removeClass('show-mega-menu')

        $currentTarget.removeClass('submenu-opened arrow-rotated');
    }

    handleSecondLevelMouseEnter(e) {
        e.stopPropagation(); // Stop the event from bubbling up to parent li
        var $currentTarget = $(e.currentTarget);
        var $submenu = $currentTarget.children('ul.sub-menu');

        // Show submenu
        $submenu.stop(true, true).slideDown('slow');
        $currentTarget.addClass('submenu-opened').addClass('arrow-rotated');
    }

    handleSecondLevelMouseLeave(e) {
        // e.stopPropagation(); // Stop the event from bubbling up to parent li
        var $currentTarget = $(e.currentTarget);
        var $submenu = $currentTarget.children('ul.sub-menu');


        $submenu.stop(true, true).slideUp('fast');
        $currentTarget.removeClass('submenu-opened arrow-rotated');
    }

    handleOutsideClick(e) {
        if (!$(e.target).closest(this.menu).length) {
            // Close all submenus
            this.menu.find('ul.sub-menu').slideUp('fast');
            this.menu.find('li.menu-item-has-children').removeClass('submenu-opened arrow-rotated');
        }
    }
}

export default DesktopMenu;
