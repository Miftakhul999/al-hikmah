<?php
/*adding sections for sidebar options */
$wp_customize->add_section( 'prolific-design-sidebar-layout-option', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Default Sidebar Layout', 'prolific' ),
    'panel'          => 'prolific-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-single-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-single-sidebar-layout'],
    'sanitize_callback' => 'prolific_sanitize_select'
) );
$choices = prolific_sidebar_layout();
$wp_customize->add_control( 'prolific_theme_options[prolific-single-sidebar-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Default Sidebar Layout', 'prolific' ),
    'description'=> __( 'Generally home/front page does not have sidebar', 'prolific' ),
    'section'   => 'prolific-design-sidebar-layout-option',
    'settings'  => 'prolific_theme_options[prolific-single-sidebar-layout]',
    'type'	  	=> 'select'
) );