<?php
/**
 * Sample implementation of the Custom Header feature.
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Acme Themes
 * @subpackage Prolific
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses prolific_header_style()
 */
if ( ! function_exists( 'prolific_custom_header_setup' ) ) :
	function prolific_custom_header_setup() {
		add_theme_support( 'custom-header', apply_filters( 'prolific_custom_header_args', array(
			'default-image'          => '',
			'width'                  => 1920,
			'height'                 => 1280,
			'flex-height'            => true,		
			'header-text'        => false
		) ) );
	}
endif;
add_action( 'after_setup_theme', 'prolific_custom_header_setup' );