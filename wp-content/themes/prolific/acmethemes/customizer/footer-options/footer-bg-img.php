<?php
/*adding sections for footer background image*/
$wp_customize->add_section( 'prolific-footer-bg-img', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Footer Background Image', 'prolific' ),
    'panel'          => 'prolific-footer-panel',
) );

/*footer background image*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-footer-bg-img]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-footer-bg-img'],
    'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'prolific_theme_options[prolific-footer-bg-img]',
        array(
            'label'		=> __( 'Footer Background Image', 'prolific' ),
            'section'   => 'prolific-footer-bg-img',
            'settings'  => 'prolific_theme_options[prolific-footer-bg-img]',
            'type'	  	=> 'image',
            'priority'  => 10
        )
    )
);