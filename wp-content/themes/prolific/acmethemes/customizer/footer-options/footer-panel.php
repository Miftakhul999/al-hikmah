<?php
/*adding footer options panel*/
$wp_customize->add_panel( 'prolific-footer-panel', array(
    'priority'       => 80,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Footer Options', 'prolific' ),
    'description'    => __( 'Customize your awesome site footer ', 'prolific' )
) );

/*
* file for footer background
*/
require prolific_file_directory('acmethemes/customizer/footer-options/footer-bg-img.php');

/*
* file for footer copyright
*/
require prolific_file_directory('acmethemes/customizer/footer-options/footer-copyright.php');

/*
* file for footer social
*/
require prolific_file_directory('acmethemes/customizer/footer-options/social-options.php');