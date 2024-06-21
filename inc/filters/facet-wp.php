<?php 

// add facet label for each facet
function fwp_add_facet_labels() {
  ?>
<script>
(function($) {
    $(document).on('facetwp-loaded', function() {
        $('.facetwp-facet').each(function() {
            var facet = $(this);
            var facet_name = facet.attr('data-name');
            var facet_type = facet.attr('data-type');
            var facet_label = FWP.settings.labels[facet_name];
            if (facet_type !== 'pager' && facet_type !== 'sort') {
                if (facet.closest('.facet-wrap').length < 1 && facet.closest('.facetwp-flyout')
                    .length < 1) {
                    facet.wrap('<div class="facet-wrap"></div>');
                    facet.before('<h3 class="facet-label">' + facet_label + '</h3>');
                }
            }
        });
    });
})(jQuery);
</script>
<?php
}
 
add_action( 'wp_head', 'fwp_add_facet_labels', 100 );