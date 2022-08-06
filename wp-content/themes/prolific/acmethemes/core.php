<?php
/*It is underscores functions.php file and its modification*/
if ( ! function_exists( 'prolific_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function prolific_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Prolific, use a find and replace
         * to change 'prolific' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'prolific', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for custom logo.
         *
         *  @since Prolific 1.0.0
          */
        add_theme_support( 'custom-logo', array(
            'height'      => 70,
            'width'       => 290,
            'flex-height' => true,
            'flex-width' => true
        ) );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 340, 240, true );

        // Adding excerpt for page
        add_post_type_support( 'page', 'excerpt' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary', 'prolific' ),
            'one-page' => esc_html__( 'One Page Menu for Front Page', 'prolific' )
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'prolific_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        /*woocommerce support*/
        add_theme_support( 'woocommerce' );
    }
endif;
add_action( 'after_setup_theme', 'prolific_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function prolific_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'prolific_content_width', 640 );
}
add_action( 'after_setup_theme', 'prolific_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function prolific_scripts() {
    /*google font*/
    wp_enqueue_style( 'prolific-googleapis', '//fonts.googleapis.com/css?family=Open+Sans|Vollkorn', array(), null );

    /*Bootstrap*/
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/library/bootstrap/css/bootstrap.min.css', array(), '3.3.6' );
    wp_style_add_data( 'bootstrap', 'rtl', 'replace' );

    /*Font-Awesome-master*/
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/Font-Awesome/css/font-awesome.min.css', array(), '4.7.0' );
    wp_style_add_data( 'font-awesome', 'rtl', 'replace' );

    /*owl css*/
    wp_enqueue_style( 'jquery-owl-carousel', get_template_directory_uri() . '/assets/library/owl-carousel/owl.carousel.css', array(), '1.3.3' );
    wp_style_add_data( 'jquery-owl-carousel', 'rtl', 'replace' );

    wp_enqueue_style( 'prolific-style', get_stylesheet_uri(),'','1.0.46' );
    wp_style_add_data( 'prolific-style', 'rtl', 'replace' );

    wp_enqueue_script( 'prolific-skip-link-focus-fix', get_template_directory_uri() . '/acmethemes/core/js/skip-link-focus-fix.js', array(), '20130115', true );

    /*jquery start*/
    /*html5*/
    wp_enqueue_script('html5', get_template_directory_uri() . '/assets/library/html5shiv/html5shiv.min.js', array('jquery'), '3.7.3', false);
    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

    /*respond*/
    wp_enqueue_script('respond', get_template_directory_uri() . '/assets/library/respond/respond.min.js', array('jquery'), '1.1.2', false);
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

    /*Bootstrap*/
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/library/bootstrap/js/bootstrap.min.js', array('jquery'), '3.3.6', 1);

    /*owl js*/
    wp_enqueue_script('jquery-owl-carousel', get_template_directory_uri() . '/assets/library/owl-carousel/owl.carousel.js', array('jquery'), '1.3.3', 1);
    
    /*wow*/
    wp_enqueue_script('wow', get_template_directory_uri() . '/assets/library/wow/js/wow.min.js', array('jquery'), '1.1.2', 1);

    /*Parallax effect*/
    wp_enqueue_script('parallax', get_template_directory_uri() . '/assets/library/jquery-parallax/jquery.parallax.js', array('jquery'), '1.1.3', 1);
    
    /*theme custom js*/
    wp_enqueue_script('prolific-custom', get_template_directory_uri() . '/assets/js/prolific-custom.js', array('jquery'), '0.0.2', 1);

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'prolific_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function prolific_is_edit_page() {
	//make sure we are on the backend
	if ( !is_admin() ){
		return false;
	}
	global $pagenow;
	return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
}
/**
 * Enqueue admin scripts and styles.
 */
function prolific_admin_scripts( $hook ) {

	if ( 'widgets.php' == $hook || prolific_is_edit_page() ) {
        wp_enqueue_media();
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_script( 'prolific-widgets-script', get_template_directory_uri() . '/assets/js/acme-widget.js', array( 'jquery' ), '1.0.0' );
    }
}
add_action( 'admin_enqueue_scripts', 'prolific_admin_scripts' );

/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/acmethemes/core/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/acmethemes/core/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require_once get_template_directory() . '/acmethemes/core/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require_once get_template_directory() . '/acmethemes/core/jetpack.php';