<?php
/**
 * Setting global variables for all theme options saved values
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'prolific_set_global' ) ) :
    function prolific_set_global() {
        /*Getting saved values start*/
        $prolific_saved_theme_options = prolific_get_theme_options();
        $GLOBALS['prolific_customizer_all_values'] = $prolific_saved_theme_options;
        /*Getting saved values end*/
    }
endif;
add_action( 'prolific_action_before_head', 'prolific_set_global', 0 );

/**
 * Doctype Declaration
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'prolific_doctype' ) ) :
    function prolific_doctype() {
        ?><!DOCTYPE html><html <?php language_attributes(); ?>>
        <?php
    }
endif;
add_action( 'prolific_action_before_head', 'prolific_doctype', 10 );

/**
 * Code inside head tage but before wp_head funtion
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'prolific_before_wp_head' ) ) :

    function prolific_before_wp_head() {
        ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php
    }
endif;
add_action( 'prolific_action_before_wp_head', 'prolific_before_wp_head', 10 );

/**
 * Add body class
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'prolific_body_class' ) ) :

    function prolific_body_class( $prolific_body_classes ) {
        global $prolific_customizer_all_values;

        if ( 'no-image' == $prolific_customizer_all_values['prolific-blog-archive-layout'] ) {
            $prolific_body_classes[] = 'blog-no-image';
        }
        $prolific_body_classes[] = prolific_sidebar_selection();

        return $prolific_body_classes;
    }
endif;
add_action( 'body_class', 'prolific_body_class', 10, 1);

/**
 * Start site div
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'prolific_site_start' ) ) :

    function prolific_site_start() {
        ?>
        <div class="site" id="page">
        <?php
    }
endif;
add_action( 'prolific_action_before', 'prolific_site_start', 20 );

/**
 * Skip to content
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'prolific_skip_to_content' ) ) :

    function prolific_skip_to_content() {
        ?>
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'prolific' ); ?></a>
        <?php
    }
endif;
add_action( 'prolific_action_before_header', 'prolific_skip_to_content', 10 );

/**
 * Main header
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'prolific_header' ) ) :
    function prolific_header() {
        global $prolific_customizer_all_values;
        $prolific_header_top_left_option = $prolific_customizer_all_values['prolific-header-top-left-option'];
        $prolific_header_top_right_option = $prolific_customizer_all_values['prolific-header-top-right-option'];
		if( prolific_trt_front_page() ):
		echo '<div class="front-page-header">';
		endif;
        if( 'none' != $prolific_header_top_left_option || 'none' != $prolific_header_top_right_option){
            ?>
            <div class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <?php if( 'none' != $prolific_header_top_left_option ) {
                                 $prolific_phone_number = $prolific_customizer_all_values['prolific-phone-number'];
                                 $prolific_top_email = $prolific_customizer_all_values['prolific-top-email'];
                                 if( !empty( $prolific_phone_number ) && ( 'phone' == $prolific_header_top_left_option || 'both' == $prolific_header_top_left_option ) ){
                                    echo "<a class='top-phone' href='tel:".esc_attr( esc_html( $prolific_phone_number ))."'><i class='fa fa-phone'></i>".esc_html( $prolific_phone_number )."</a>";
                                 }
                                 if( !empty( $prolific_top_email ) && ('email' == $prolific_header_top_left_option || 'both' == $prolific_header_top_left_option ) ){
                                    echo "<a class='top-email' href='mailto:".esc_attr( esc_html( $prolific_top_email ))."'><i class='fa fa-envelope-o'></i>".esc_html( $prolific_top_email )."</a>";
                                 }
                            }
                            ?>
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            if( 'social' ==  $prolific_header_top_right_option ) {
                                do_action('prolific_action_social_links');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
         $prolific_nav_class = '';
         $prolific_enable_sticky = $prolific_customizer_all_values['prolific-enable-sticky'];
         if( 1 == $prolific_enable_sticky ){
            $prolific_nav_class .= ' prolific-sticky';
        }
        ?>
        <div class="navbar at-navbar <?php echo $prolific_nav_class; ?>" id="navbar" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
                    <?php
                    if ( 'disable' != $prolific_customizer_all_values['prolific-header-id-display-opt'] ):
                        if ( 'logo-only' == $prolific_customizer_all_values['prolific-header-id-display-opt'] && function_exists( 'the_custom_logo' ) ):
                           the_custom_logo();
                        else:/*else is title-only or title-and-tagline*/
                            if ( is_front_page() && is_home() ) : ?>
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                </h1>
                            <?php else : ?>
                                <p class="site-title">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                </p>
                            <?php endif;
                            if ( 'title-and-tagline' == $prolific_customizer_all_values['prolific-header-id-display-opt'] ):
                                $description = get_bloginfo( 'description', 'display' );
                                if ( $description || is_customize_preview() ) : ?>
                                    <p class="site-description"><?php echo esc_html( $description ); ?></p>
                                <?php endif;
                            endif;
                        endif;
                    endif;
                    ?>
                </div>
                <div class="main-navigation navbar-collapse collapse">
                    <?php
                    if( is_front_page() && !is_home() && has_nav_menu( 'one-page') ){
                        wp_nav_menu(
                            array(
                                'theme_location' => 'one-page',
                                'menu_id' => 'primary-menu',
                                'menu_class' => 'nav navbar-nav navbar-right acme-one-page',
                            )
                        );
                    }
                    else{
                     wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_id' => 'primary-menu',
                            'menu_class' => 'nav navbar-nav navbar-right acme-normal-page',
                        )
                    );
                    }
                   ?>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
        <?php
		if(prolific_trt_front_page()):
		echo '</div>';
		endif;
    }
endif;
add_action( 'prolific_action_header', 'prolific_header', 10 );