<?php
/**
 * Prolific Theme Customizer.
 *
 * @package Acme Themes
 * @subpackage Prolific
 */

/*
* file for upgrade to pro
*/
require prolific_file_directory('acmethemes/customizer/customizer-pro/class-customize.php');

/*
* file for customizer core functions
*/
require prolific_file_directory('acmethemes/customizer/customizer-core.php');

/*
* file for customizer sanitization functions
*/
require prolific_file_directory('acmethemes/customizer/sanitize-functions.php');

/**
 * Adding different options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( !function_exists('prolific_customize_register') ) :
    function prolific_customize_register( $wp_customize ) {

        $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
        $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

        /*saved options*/
        $options  = prolific_get_theme_options();

        /*defaults options*/
        $defaults = prolific_get_default_theme_options();

        /*
         * file for feature panel of home page
         */
        require prolific_file_directory('acmethemes/customizer/feature-section/feature-panel.php');

        /*
        * file for header panel
        */
        require prolific_file_directory('acmethemes/customizer/header-options/header-panel.php');

        /*
        * file for customizer footer section
        */
        require prolific_file_directory('acmethemes/customizer/footer-options/footer-panel.php');

        /*
        * file for design/layout panel
        */
        require prolific_file_directory('acmethemes/customizer/design-options/design-panel.php');

        /*
         * file for options panel
         */
        require prolific_file_directory('acmethemes/customizer/options/options-panel.php');

	    /*sorting core and widget for ease of theme use*/
	    $wp_customize->get_section( 'static_front_page' )->priority = 10;

	    $prolific_home_section = $wp_customize->get_section( 'sidebar-widgets-prolific-home' );
	    if ( ! empty( $prolific_home_section ) ) {
		    $prolific_home_section->panel = '';
		    $prolific_home_section->title = __( 'Home Main Content Area ', 'prolific' );
		    $prolific_home_section->priority = 80;
	    }
    }
endif;
add_action( 'customize_register', 'prolific_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( !function_exists('prolific_customize_preview_js') ) :

    function prolific_customize_preview_js() {
        wp_enqueue_script( 'prolific-customizer', get_template_directory_uri() . '/acmethemes/core/js/customizer.js', array( 'customize-preview' ), '1.1.0', true );
    }
endif;
add_action( 'customize_preview_init', 'prolific_customize_preview_js' );