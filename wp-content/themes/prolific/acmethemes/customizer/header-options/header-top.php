<?php
/*active callback function for header top left*/
if ( !function_exists('prolific_active_callback_header_top_left_email') ) :
    function prolific_active_callback_header_top_left_email() {
        $prolific_customizer_all_values = prolific_get_theme_options();
        $prolific_header_top_left_option = $prolific_customizer_all_values['prolific-header-top-left-option'];
        if( 'email' == $prolific_header_top_left_option || 'both' == $prolific_header_top_left_option ){
            return true;
        }
        return false;
    }
endif;

/*active callback function for header top left*/
if ( !function_exists('prolific_active_callback_header_top_left_phone') ) :
    function prolific_active_callback_header_top_left_phone() {
        $prolific_customizer_all_values = prolific_get_theme_options();
        $prolific_header_top_left_option = $prolific_customizer_all_values['prolific-header-top-left-option'];
        if( 'phone' == $prolific_header_top_left_option || 'both' == $prolific_header_top_left_option ){
            return true;
        }
        return false;
    }
endif;

/*adding sections for header options*/
$wp_customize->add_section( 'prolific-header-top-option', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Header Top', 'prolific' ),
    'panel'          => 'prolific-header-panel',
) );

/*header top left options*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-header-top-left-option]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-header-top-left-option'],
    'sanitize_callback' => 'prolific_sanitize_select'
) );
$choices = prolific_header_top_left_options();
$wp_customize->add_control( 'prolific_theme_options[prolific-header-top-left-option]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Email and Phone No. Options', 'prolific' ),
    'section'   => 'prolific-header-top-option',
    'settings'  => 'prolific_theme_options[prolific-header-top-left-option]',
    'type'	  	=> 'select'
) );

/*phone number*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-phone-number]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-phone-number'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'prolific_theme_options[prolific-phone-number]', array(
    'label'		=> __( 'Phone Number', 'prolific' ),
    'section'   => 'prolific-header-top-option',
    'settings'  => 'prolific_theme_options[prolific-phone-number]',
    'type'	  	=> 'text',
    'active_callback'   => 'prolific_active_callback_header_top_left_phone'
) );

/*Email*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-top-email]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-top-email'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'prolific_theme_options[prolific-top-email]', array(
    'label'		=> __( 'Email', 'prolific' ),
    'section'   => 'prolific-header-top-option',
    'settings'  => 'prolific_theme_options[prolific-top-email]',
    'type'	  	=> 'text',
    'active_callback'   => 'prolific_active_callback_header_top_left_email'
) );

/*header top right options*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-header-top-right-option]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-header-top-right-option'],
    'sanitize_callback' => 'prolific_sanitize_select'
) );
$choices = prolific_header_top_right_options();
$wp_customize->add_control( 'prolific_theme_options[prolific-header-top-right-option]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Social Options', 'prolific' ),
    'section'   => 'prolific-header-top-option',
    'settings'  => 'prolific_theme_options[prolific-header-top-right-option]',
    'type'	  	=> 'select'
) );