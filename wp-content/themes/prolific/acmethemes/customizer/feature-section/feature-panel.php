<?php
/*adding feature options panel*/
$wp_customize->add_panel( 'prolific-feature-panel', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Featured Section Options', 'prolific' ),
    'description'    => __( 'Customize your awesome site feature section ', 'prolific' )
) );

/*
* file for feature section enable
*/
require prolific_file_directory('acmethemes/customizer/feature-section/feature-enable.php');

/*
* file for feature slider category
*/
require prolific_file_directory('acmethemes/customizer/feature-section/feature-slider.php');