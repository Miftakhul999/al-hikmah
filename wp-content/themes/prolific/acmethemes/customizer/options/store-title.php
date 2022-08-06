<?php
if( class_exists('woocommerce')){
	/*adding sections for store title*/
	$wp_customize->add_section( 'prolific-store-title', array(
		'priority'       => 20,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Store Title', 'prolific' ),
		'panel'          => 'prolific-options'
	) );

	/*store title*/
	$wp_customize->add_setting( 'prolific_theme_options[prolific-store-title]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['prolific-store-title'],
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'prolific_theme_options[prolific-store-title]', array(
		'label'		=> __( 'Store Title', 'prolific' ),
		'section'   => 'prolific-store-title',
		'settings'  => 'prolific_theme_options[prolific-store-title]',
		'type'	  	=> 'text',
		'priority'  => 10
	) );
}