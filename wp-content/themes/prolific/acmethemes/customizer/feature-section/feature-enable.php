<?php
/*adding sections for enabling feature section in front page*/
$wp_customize->add_section( 'prolific-enable-feature', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Enable Feature Section', 'prolific' ),
    'panel'          => 'prolific-feature-panel'
) );

/*enable feature section*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-enable-feature]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-enable-feature'],
    'sanitize_callback' => 'prolific_sanitize_checkbox'
) );

$wp_customize->add_control( 'prolific_theme_options[prolific-enable-feature]', array(
    'label'		=> __( 'Enable Feature Section', 'prolific' ),
    'description'	=> sprintf( __( 'Feature section will display on front/home page. %1$s Note : Please go to %2$s "Static Front Page"%3$s setting, Select "A static page" then "Front page" and "Posts page" before enable it', 'prolific' ), '<br />','<b>','</b>' ),
    'section'   => 'prolific-enable-feature',
    'settings'  => 'prolific_theme_options[prolific-enable-feature]',
    'type'	  	=> 'checkbox',
    'priority'  => 10
) );