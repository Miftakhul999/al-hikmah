<?php
/*adding sections for default layout options panel*/
$wp_customize->add_section( 'prolific-archive-sidebar-layout', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Archive Sidebar Layout', 'prolific' ),
    'panel'          => 'prolific-design-panel'
) );

/*Sidebar Layout*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-archive-sidebar-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-archive-sidebar-layout'],
    'sanitize_callback' => 'prolific_sanitize_select'
) );
$choices = prolific_sidebar_layout();
$wp_customize->add_control( 'prolific_theme_options[prolific-archive-sidebar-layout]', array(
    'choices'  	    => $choices,
    'label'		    => __( 'Archive Sidebar Layout', 'prolific' ),
    'description'   => __( 'Sidebar Layout for listing pages like category, author etc', 'prolific' ),
    'section'       => 'prolific-archive-sidebar-layout',
    'settings'      => 'prolific_theme_options[prolific-archive-sidebar-layout]',
    'type'	  	    => 'select'
) );