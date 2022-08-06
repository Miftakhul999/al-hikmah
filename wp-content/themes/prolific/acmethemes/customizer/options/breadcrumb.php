<?php
/*adding sections for breadcrumb */
$wp_customize->add_section( 'prolific-breadcrumb-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Breadcrumb Options', 'prolific' ),
    'panel'          => 'prolific-options'
) );

/*show breadcrumb*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-show-breadcrumb]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-show-breadcrumb'],
    'sanitize_callback' => 'prolific_sanitize_checkbox'
) );

$wp_customize->add_control( 'prolific_theme_options[prolific-show-breadcrumb]', array(
    'label'		=> __( 'Enable Breadcrumb', 'prolific' ),
    'section'   => 'prolific-breadcrumb-options',
    'settings'  => 'prolific_theme_options[prolific-show-breadcrumb]',
    'type'	  	=> 'checkbox',
    'priority'  => 10
) );