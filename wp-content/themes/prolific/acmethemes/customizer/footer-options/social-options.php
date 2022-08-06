<?php
/*adding sections for footer social options */
$wp_customize->add_section( 'prolific-footer-social', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Social Options', 'prolific' ),
    'panel'          => 'prolific-footer-panel'
) );

/*enable social*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-enable-social]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-enable-social'],
    'sanitize_callback' => 'prolific_sanitize_checkbox',
) );
$wp_customize->add_control( 'prolific_theme_options[prolific-enable-social]', array(
    'label'		=> __( 'Enable social', 'prolific' ),
    'section'   => 'prolific-footer-social',
    'settings'  => 'prolific_theme_options[prolific-enable-social]',
    'type'	  	=> 'checkbox',
    'priority'  => 100
) );