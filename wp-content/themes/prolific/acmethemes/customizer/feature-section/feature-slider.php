<?php
/*adding sections for category section in front page*/
$wp_customize->add_section( 'prolific-feature-page', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Feature Slider Selection', 'prolific' ),
    'panel'          => 'prolific-feature-panel'
) );

/* feature parent page selection */
$wp_customize->add_setting( 'prolific_theme_options[prolific-feature-page]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-feature-page'],
    'sanitize_callback' => 'prolific_sanitize_number'
) );
$wp_customize->add_control( 'prolific_theme_options[prolific-feature-page]', array(
    'label'		    => __( 'Select Parent Page for Feature Slider', 'prolific' ),
    'description'   => __( 'Select parent page and its sub-pages will be shown as slides.', 'prolific' ),
    'section'       => 'prolific-feature-page',
    'settings'      => 'prolific_theme_options[prolific-feature-page]',
    'type'	  	    => 'dropdown-pages',
    'priority'      => 10
) );

/* number of slider*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-featured-slider-number]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-featured-slider-number'],
    'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'prolific_theme_options[prolific-featured-slider-number]', array(
    'label'		=> __( 'Number Of Slides', 'prolific' ),
    'section'   => 'prolific-feature-page',
    'settings'  => 'prolific_theme_options[prolific-featured-slider-number]',
    'type'	  	=> 'number',
    'priority'  => 20
) );

/*enable animation*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-feature-slider-enable-animation]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-feature-slider-enable-animation'],
    'sanitize_callback' => 'prolific_sanitize_checkbox'
) );
$wp_customize->add_control( 'prolific_theme_options[prolific-feature-slider-enable-animation]', array(
    'label'		    => __( 'Enable Animation', 'prolific' ),
    'section'       => 'prolific-feature-page',
    'settings'      => 'prolific_theme_options[prolific-feature-slider-enable-animation]',
    'type'	  	    => 'checkbox',
    'priority'      => 125
) );