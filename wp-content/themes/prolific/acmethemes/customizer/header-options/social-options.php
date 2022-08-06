<?php
/*adding sections for header social options */
$wp_customize->add_section( 'prolific-header-social', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Social Options', 'prolific' ),
    'panel'          => 'prolific-header-panel'
) );

/*facebook url*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-facebook-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-facebook-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'prolific_theme_options[prolific-facebook-url]', array(
    'label'		=> __( 'Facebook url', 'prolific' ),
    'section'   => 'prolific-header-social',
    'settings'  => 'prolific_theme_options[prolific-facebook-url]',
    'type'	  	=> 'url',
    'priority'  => 10
) );

/*twitter url*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-twitter-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-twitter-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'prolific_theme_options[prolific-twitter-url]', array(
    'label'		=> __( 'Twitter url', 'prolific' ),
    'section'   => 'prolific-header-social',
    'settings'  => 'prolific_theme_options[prolific-twitter-url]',
    'type'	  	=> 'url',
    'priority'  => 20
) );

/*youtube url*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-youtube-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-youtube-url'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'prolific_theme_options[prolific-youtube-url]', array(
    'label'		=> __( 'Youtube url', 'prolific' ),
    'section'   => 'prolific-header-social',
    'settings'  => 'prolific_theme_options[prolific-youtube-url]',
    'type'	  	=> 'url',
    'priority'  => 30
) );

/*
 * plus.google url*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-google-plus-url]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-google-plus-url'],
    'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( 'prolific_theme_options[prolific-google-plus-url]', array(
    'label'		=> __( 'Google Plus Url', 'prolific' ),
    'section'   => 'prolific-header-social',
    'settings'  => 'prolific_theme_options[prolific-google-plus-url]',
    'type'	  	=> 'url',
    'priority'  => 40
) );