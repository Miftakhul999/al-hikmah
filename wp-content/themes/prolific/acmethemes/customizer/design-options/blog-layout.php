<?php
/*adding sections for blog layout options*/
$wp_customize->add_section( 'prolific-design-blog-layout-option', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Default Blog/Archive Layout', 'prolific' ),
    'panel'          => 'prolific-design-panel'
) );

/*blog layout*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-blog-archive-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-blog-archive-layout'],
    'sanitize_callback' => 'prolific_sanitize_select'
) );
$choices = prolific_blog_layout();
$wp_customize->add_control( 'prolific_theme_options[prolific-blog-archive-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Default Blog/Archive Layout', 'prolific' ),
    'description'=> __( 'Image display options', 'prolific' ),
    'section'   => 'prolific-design-blog-layout-option',
    'settings'  => 'prolific_theme_options[prolific-blog-archive-layout]',
    'type'	  	=> 'select'
) );

/*Read More Text*/
$wp_customize->add_setting( 'prolific_theme_options[prolific-blog-archive-more-text]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['prolific-blog-archive-more-text'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'prolific_theme_options[prolific-blog-archive-more-text]', array(
    'label'		=> __( 'Read More Text', 'prolific' ),
    'section'   => 'prolific-design-blog-layout-option',
    'settings'  => 'prolific_theme_options[prolific-blog-archive-more-text]',
    'type'	  	=> 'text'
) );