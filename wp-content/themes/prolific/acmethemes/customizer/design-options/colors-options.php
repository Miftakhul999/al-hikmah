<?php
/*customizing default colors section and adding new controls-setting too*/
$wp_customize->add_section( 'colors', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Colors', 'prolific' ),
    'panel'          => 'prolific-design-panel'
) );

/*Primary color*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-primary-color]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-primary-color'],
    'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'prolific_theme_options[prolific-primary-color]',
        array(
            'label'		=> __( 'Primary Color', 'prolific' ),
            'section'   => 'colors',
            'settings'  => 'prolific_theme_options[prolific-primary-color]',
            'type'	  	=> 'color'
        ) )
);