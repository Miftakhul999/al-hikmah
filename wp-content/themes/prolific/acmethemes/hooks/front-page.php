<?php
/**
 * Front page hook for all WordPress Conditions
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'prolific_featured_slider' ) ) :

    function prolific_featured_slider() {
        global $prolific_customizer_all_values;

        $prolific_enable_feature = $prolific_customizer_all_values['prolific-enable-feature'];
        if( prolific_trt_front_page()  ) :
            do_action( 'prolific_action_feature_slider' );
        endif;
    }
endif;
add_action( 'prolific_action_front_page', 'prolific_featured_slider', 10 );

if ( ! function_exists( 'prolific_front_page' ) ) :

    function prolific_front_page() {
        global $prolific_customizer_all_values;

        $prolific_hide_front_page_content = $prolific_customizer_all_values['prolific-hide-front-page-content'];

        /*
         * show widget in front page, now user are forced to use front page
         * */
        if( is_active_sidebar( 'prolific-home' ) && !is_home() ){
            dynamic_sidebar( 'prolific-home' );
        }
        if ( 'posts' == get_option( 'show_on_front' ) ) {
            include( get_home_template() );
        }
        else {
            if( 1 != $prolific_hide_front_page_content ){
                include( get_page_template() );
            }
        }
    }
endif;
add_action( 'prolific_action_front_page', 'prolific_front_page', 20 );