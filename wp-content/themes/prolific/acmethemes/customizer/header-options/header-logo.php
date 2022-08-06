<?php
/*header logo/text display options*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-header-id-display-opt]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-header-id-display-opt'],
    'sanitize_callback' => 'prolific_sanitize_select'
) );
$choices = prolific_header_id_display_opt();
$wp_customize->add_control( 'prolific_theme_options[prolific-header-id-display-opt]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Logo/Site Title-Tagline Display Options', 'prolific' ),
    'section'   => 'title_tagline',
    'settings'  => 'prolific_theme_options[prolific-header-id-display-opt]',
    'type'	  	=> 'radio',
    'priority'  => 30
) );