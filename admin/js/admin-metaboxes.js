(function($) {
    "use strict";

    $(function() {

        /* Apply jquery ui sortable on additional features */
        $( "#pearl-additional-features-container" ).sortable({
            revert: 100,
            placeholder: "feature-placeholder",
            handle: ".sort-feature",
            cursor: "move"
        });

        $( '.add-feature' ).click(function( event ){
            event.preventDefault();
            var newPearlDetail = '<div class="pearl-feature inputs">' +
                '<div class="pearl-feature-control"><span class="sort-feature dashicons dashicons-menu"></span></div>' +
                '<div class="pearl-feature-title"><input type="text" name="feature-titles[]" /></div>' +
                '<div class="pearl-feature-value"><input type="text" name="feature-values[]" /></div>' +
                '<div class="pearl-feature-control"><a class="remove-feature" href="#"><span class="dashicons dashicons-dismiss"></span></a></div>' +
                '</div>';

            $( '#pearl-additional-features-container').append( newPearlDetail );
            bindAdditionalDetailsEvents();
        });

        function bindAdditionalDetailsEvents(){

            /* Bind click event to remove feature icon button */
            $( '.remove-feature').click(function( event ){
                event.preventDefault();
                var $this = $( this );
                $this.closest( '.pearl-feature' ).remove();
            });

        }
        bindAdditionalDetailsEvents();

    });

}(jQuery));