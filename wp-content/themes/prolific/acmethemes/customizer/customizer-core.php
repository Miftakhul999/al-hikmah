<?php
/**
 * Header Top Left Options
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return array $prolific_header_top_left_options
 *
 */
if ( !function_exists('prolific_header_top_left_options') ) :
    function prolific_header_top_left_options() {
        $prolific_header_top_left_options =  array(
            'email' => __( 'Email', 'prolific' ),
            'phone' => __( 'Phone', 'prolific' ),
            'both' =>  __( 'Both', 'prolific' ),
            'none' =>  __( 'None', 'prolific' )
        );
        return apply_filters( 'prolific_header_top_left_options', $prolific_header_top_left_options );
    }
endif;

/**
 * Header Top Right Options
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return array $prolific_header_top_right_options
 *
 */
if ( !function_exists('prolific_header_top_right_options') ) :
    function prolific_header_top_right_options() {
        $prolific_header_top_right_options =  array(
            'social' => __( 'Social Links', 'prolific' ),
            'none' =>  __( 'None', 'prolific' )
        );
        return apply_filters( 'prolific_header_top_right_options', $prolific_header_top_right_options );
    }
endif;

/**
 * Header logo/text display options alternative
 *
 * @since Prolific 1.0.2
 *
 * @param null
 * @return array $prolific_header_id_display_opt
 *
 */
if ( !function_exists('prolific_header_id_display_opt') ) :
    function prolific_header_id_display_opt() {
        $prolific_header_id_display_opt =  array(
            'logo-only' => __( 'Logo Only ( First Select Logo Above )', 'prolific' ),
            'title-only' => __( 'Site Title Only', 'prolific' ),
            'title-and-tagline' =>  __( 'Site Title and Tagline', 'prolific' ),
            'disable' => __( 'Disable', 'prolific' )
        );
        return apply_filters( 'prolific_header_id_display_opt', $prolific_header_id_display_opt );
    }
endif;

/**
 * Sidebar layout options
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return array $prolific_sidebar_layout
 *
 */
if ( !function_exists('prolific_sidebar_layout') ) :
    function prolific_sidebar_layout() {
        $prolific_sidebar_layout =  array(
            'right-sidebar'=> __( 'Right Sidebar', 'prolific' ),
            'left-sidebar'=> __( 'Left Sidebar' , 'prolific' ),
            'both-sidebar'  => __( 'Both Sidebar' , 'prolific' ),
            'middle-col'  => __( 'Middle Column' , 'prolific' ),
            'no-sidebar'=> __( 'No Sidebar', 'prolific' )
        );
        return apply_filters( 'prolific_sidebar_layout', $prolific_sidebar_layout );
    }
endif;

/**
 * Blog layout options
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return array $prolific_blog_layout
 *
 */
if ( !function_exists('prolific_blog_layout') ) :
    function prolific_blog_layout() {
        $prolific_blog_layout =  array(
            'full-image' => __( 'Show Image', 'prolific' ),
            'no-image' => __( 'No Image', 'prolific' )
        );
        return apply_filters( 'prolific_blog_layout', $prolific_blog_layout );
    }
endif;