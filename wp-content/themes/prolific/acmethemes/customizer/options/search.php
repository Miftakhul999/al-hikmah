<?php
/*adding sections for Search Placeholder*/
$wp_customize->add_section( 'prolific-search', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Search', 'prolific' ),
    'panel'          => 'prolific-options'
) );

/*Search Placeholder*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-search-placholder]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-search-placholder'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'prolific_theme_options[prolific-search-placholder]', array(
    'label'		=> __( 'Search Placeholder', 'prolific' ),
    'section'   => 'prolific-search',
    'settings'  => 'prolific_theme_options[prolific-search-placholder]',
    'type'	  	=> 'text',
    'priority'  => 10
) );