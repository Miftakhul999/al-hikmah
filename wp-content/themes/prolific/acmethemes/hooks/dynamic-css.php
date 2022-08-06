<?php
/**
 * Dynamic css
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'prolific_dynamic_css' ) ) :

    function prolific_dynamic_css() {

        $prolific_customizer_all_values = prolific_get_theme_options();

        /*Color options */
        $prolific_primary_color = esc_attr( $prolific_customizer_all_values['prolific-primary-color'] );
        $custom_css = '';

        /*background*/
        if( get_header_image() ){
            $bg_image_url = esc_url( get_header_image() );
            $custom_css .= "
              .inner-main-title {
                background-image:url('{$bg_image_url}');
                background-repeat:no-repeat;
                background-size:cover;
                background-attachment:fixed;
                background-position: center;
                background-color: {$prolific_primary_color};
            }";
        }
        else{
            $custom_css .= "
              .inner-main-title {
                background-color: {$prolific_primary_color};
              }";
        }
        /*color*/
        $custom_css .= "
            a:hover,
            a:active,
            a:focus,
            .btn-primary:hover,
            .top-phone i,
            .top-email i,
            .wpcf7-form input.wpcf7-submit:hover,
            .widget li a:hover,
            .posted-on a:hover,
            .cat-links a:hover,
            .comments-link a:hover,
            article.post .entry-header .entry-title a:hover, 
            article.page .entry-header .entry-title a:hover,
            .edit-link a:hover,
            .tags-links a:hover,
            .byline a:hover,
            .nav-links a:hover,
            .owl-buttons >div i:hover,
            .col-details > h2,
            .main-navigation ul ul a:hover,
             .image-slider-wrapper .banner-title a:hover,
			 .front-page-header .top-header a:hover,
			 .front-page-header .site-title a:hover,
            .btn-primary:focus,
            .wpcf7-form input.wpcf7-submit:focus,
            .widget li a:focus,
            .posted-on a:focus,
            .cat-links a:focus,
            .comments-link a:focus,
            article.post .entry-header .entry-title a:focus, 
            article.page .entry-header .entry-title a:focus,
            .edit-link a:focus,
            .tags-links a:focus,
            .byline a:focus,
            .nav-links a:focus,
            .owl-buttons >div i:focus,
            .main-navigation ul ul a:focus,
             .image-slider-wrapper .banner-title a:focus,
			 .front-page-header .top-header a:focus,
			 .front-page-header .site-title a:focus,
			 .contact-form i,
              .primary-color,
             .front-page-header .navbar-fixed-top .site-title a{
                color: {$prolific_primary_color};
            }";

        /*background color*/
        $custom_css .= "
            .navbar .navbar-toggle:hover,
            .navbar .navbar-toggle:focus,
            .comment-form .form-submit input,
            .btn.btn-primary:before,
            .circle,
            .rectangle,
            .wpcf7-form input.wpcf7-submit,
            .breadcrumb,
            .owl-buttons >div i,
            .sm-up-container,
            .testimonial-item,
            .primary-bg-color,
            .post-widget-image,
            .secondary-sidebar .widget-header-block:after,
            .team-author-details:hover,
            .team-author-details:focus{
                background-color: {$prolific_primary_color};
                color:#fff;
            }";

        /*borders*/
        $custom_css .= "
            .comment-form .form-submit input,
            .read-more,
            .btn-primary,
            .btn-primary:hover,
            .btn-primary:focus,
            .wpcf7-form input.wpcf7-submit,
            .rectangle,
            .contact-form i{
                border: 1px solid {$prolific_primary_color};
            }";

        $custom_css .= "
            .blog article.sticky {
                border-top: 2px solid {$prolific_primary_color};
            }";

        $custom_css .= "
             .breadcrumb::after {
                border-left: 5px solid {$prolific_primary_color};
            }
            .rtl .breadcrumb::after {
                border-right: 5px solid {$prolific_primary_color};
                border-left:medium none;
            }
            ";

        $custom_css .= "
             .main-navigation .acme-normal-page .current_page_item,
             .main-navigation .acme-normal-page .current-menu-item,
             .main-navigation .active,
              .main-navigation li:hover,
              .main-navigation li:focus{
                border-bottom: 5px solid {$prolific_primary_color};
                color: {$prolific_primary_color};
            }";
        $custom_css .= "
             .main-navigation .acme-normal-page .current_page_item a,
             .main-navigation .acme-normal-page .current-menu-item a,
             .main-navigation .active a,
             .main-navigation li:hover a,
             .image-slider-wrapper .image-slider-caption,
             .about-item:hover h4 a,
             .about-icon i.fa,
              .site-footer .calendar_wrap a{
                color: {$prolific_primary_color};
            }";
        $custom_css .= "
             .main-navigation li:focus-within a,
             .about-item:focus-within h4 a{
                color: {$prolific_primary_color};
            }";
        $custom_css .= "
             .about-item:hover .about-icon::before {
                 border: 3px solid {$prolific_primary_color};
            }";

        $custom_css .= "
             .about-item:focus-within .about-icon::before {
                 border: 3px solid {$prolific_primary_color};
            }";

        $custom_css .= "
            .team-author-details:hover:after{
                border-right-color: {$prolific_primary_color};
            }
            .rtl .team-author-details:hover:after{
                border-left-color: {$prolific_primary_color};
            }
        ";
        $custom_css .= "
            .team-author-details:focus-within:after{
                border-right-color: {$prolific_primary_color};
            }
            .rtl .team-author-details:focus-within:after{
                border-left-color: {$prolific_primary_color};
            }
        ";
        wp_add_inline_style( 'prolific-style', $custom_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'prolific_dynamic_css', 99 );