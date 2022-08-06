<?php
/**
 * Add ... for more view
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( !function_exists('prolific_excerpt_more') ) :
    function prolific_excerpt_more($more) {
        if ( is_admin() ) {
            return $more;
        }
        return '&hellip;';
    }
endif;
add_filter('excerpt_more', 'prolific_excerpt_more');