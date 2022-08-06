<?php
/*adding sections for default layout options panel*/
$wp_customize->add_section( 'prolific-front-page-sidebar-layout', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Front/Home Sidebar Layout', 'prolific' ),
    'panel'          => 'prolific-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-front-page-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-front-page-sidebar-layout'],
    'sanitize_callback' => 'prolific_sanitize_select'
) );
$choices = prolific_sidebar_layout();
$wp_customize->add_control( 'prolific_theme_options[prolific-front-page-sidebar-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Front/Home Sidebar Layout', 'prolific' ),
    'section'   => 'prolific-front-page-sidebar-layout',
    'settings'  => 'prolific_theme_options[prolific-front-page-sidebar-layout]',
    'type'	  	=> 'select'
) );