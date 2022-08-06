<?php
/**
 * The front-page template file.
 *
 * @package Acme Themes
 * @subpackage Prolific
 * @since Prolific 1.1.0
 */
get_header();
/**
 * prolific_action_front_page hook
 * @since Prolific 1.1.0
 *
 * @hooked prolific_featured_slider -  10
 * @hooked prolific_front_page -  20
 */
do_action( 'prolific_action_front_page' );

get_footer();