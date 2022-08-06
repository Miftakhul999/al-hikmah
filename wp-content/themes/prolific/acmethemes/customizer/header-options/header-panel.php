<?php
/*adding header options panel*/
$wp_customize->add_panel( 'prolific-header-panel', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Header Options', 'prolific' ),
    'description'    => __( 'Customize your awesome site header ', 'prolific' )
) );

/*
* file for header top options
*/
require prolific_file_directory('acmethemes/customizer/header-options/header-top.php');

/*
* file for header logo options
*/
require prolific_file_directory('acmethemes/customizer/header-options/header-logo.php');

/*
* file for social options
*/
require prolific_file_directory('acmethemes/customizer/header-options/social-options.php');

/*
 * file for menu options
*/
require prolific_file_directory('acmethemes/customizer/header-options/menu-options.php');

/*adding header image inside this panel*/
$wp_customize->get_section( 'header_image' )->panel = 'prolific-header-panel';
$wp_customize->get_section( 'header_image' )->description = __( 'Applied to header image of inner pages.', 'prolific' );