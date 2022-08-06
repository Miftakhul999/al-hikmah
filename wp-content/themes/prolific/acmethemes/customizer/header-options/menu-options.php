<?php
/*Menu Section*/
$wp_customize->add_section( 'prolific-menu-options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Menu Options', 'prolific' ),
    'panel'          => 'prolific-header-panel'
) );

/*enable sticky menu*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-enable-sticky]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-enable-sticky'],
    'sanitize_callback' => 'prolific_sanitize_checkbox'
) );

$wp_customize->add_control( 'prolific_theme_options[prolific-enable-sticky]', array(
    'label'		=> __( 'Enable Sticky', 'prolific' ),
    'section'   => 'prolific-menu-options',
    'settings'  => 'prolific_theme_options[prolific-enable-sticky]',
    'type'	  	=> 'checkbox',
    'priority'  => 20
) );