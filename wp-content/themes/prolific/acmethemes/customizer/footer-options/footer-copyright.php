<?php
/*adding sections for footer options*/
$wp_customize->add_section( 'prolific-footer-option', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Copyright Text', 'prolific' ),
    'panel'          => 'prolific-footer-panel',
) );

/*copyright*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-footer-copyright]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-footer-copyright'],
    'sanitize_callback' => 'wp_kses_post'
) );
$wp_customize->add_control( 'prolific_theme_options[prolific-footer-copyright]', array(
    'label'		=> __( 'Copyright Text', 'prolific' ),
    'section'   => 'prolific-footer-option',
    'settings'  => 'prolific_theme_options[prolific-footer-copyright]',
    'type'	  	=> 'text',
    'priority'  => 10
) );