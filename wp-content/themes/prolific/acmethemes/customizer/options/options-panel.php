<?php
/*adding theme options panel*/
$wp_customize->add_panel( 'prolific-options', array(
    'priority'       => 210,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Theme Options', 'prolific' ),
    'description'    => __( 'Customize your awesome site with theme options ', 'prolific' )
) );

/*
* file for header breadcrumb options
*/
require prolific_file_directory('acmethemes/customizer/options/breadcrumb.php');

/*
* file for header search options
*/
require prolific_file_directory('acmethemes/customizer/options/search.php');

/*
* file for header search options
*/
require prolific_file_directory('acmethemes/customizer/options/store-title.php');