<?php
/*adding sections for footer social options */
$wp_customize->add_section( 'prolific-front-page-content', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Front Page Content Options', 'prolific' ),
    'panel'          => 'prolific-design-panel'
) );

/*enable social*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-hide-front-page-content]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-hide-front-page-content'],
    'sanitize_callback' => 'prolific_sanitize_checkbox',
) );
$wp_customize->add_control( 'prolific_theme_options[prolific-hide-front-page-content]', array(
    'label'		 => __( 'Hide Front Page Content', 'prolific' ),
    'description'=> __( 'You may want to hide front page content( Blog or Static page content). Check this to hide them', 'prolific' ),
    'section'   => 'prolific-front-page-content',
    'settings'  => 'prolific_theme_options[prolific-hide-front-page-content]',
    'type'	  	=> 'checkbox',
    'priority'  => 100
) );