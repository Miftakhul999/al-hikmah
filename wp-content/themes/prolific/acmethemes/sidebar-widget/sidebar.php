<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function prolific_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'prolific' ),
        'id'            => 'prolific-sidebar',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="widget-header-block"><h2 class="widget-title">',
        'after_title'   => '</h2></div>',
    ) );

    if ( is_customize_preview() ) {
        $prolific_home_description = sprintf( __( 'Displays widgets on home page main content area.%1$s Note : Please go to %2$s "Static Front Page"%3$s setting, Select "A static page" then "Front page" and "Posts page" to show added widgets', 'prolific' ), '<br />','<b>','</b>' );
    }
    else{
        $prolific_home_description = __( 'Displays widgets on Front/Home page. Note : Please go to Setting => Reading, Select "A static page" then "Front page" and "Posts page" to show added widgets', 'prolific' );
    }

    register_sidebar(array(
        'name' => __('Home Main Content Area', 'prolific'),
        'id'   => 'prolific-home',
        'description' => $prolific_home_description,
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Left', 'prolific' ),
		'id'            => 'prolific-sidebar-left',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

    register_sidebar(array(
        'name' => __('Footer Column One', 'prolific'),
        'id' => 'prolific-footer-top-col-one',
        'description' => __('Displays items on footer section.', 'prolific'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="widget-header-block"><h3 class="widget-title"><span>',
        'after_title' => '</span></h3></div>',
    ));
    register_sidebar(array(
        'name' => __('Footer Column Two', 'prolific'),
        'id' => 'prolific-footer-top-col-two',
        'description' => __('Displays items on footer section.', 'prolific'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="widget-header-block"><h3 class="widget-title"><span>',
        'after_title' => '</span></h3></div>',
    ));
    register_sidebar(array(
        'name' => __('Footer Column Three', 'prolific'),
        'id' => 'prolific-footer-top-col-three',
        'description' => __('Displays items on footer section.', 'prolific'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="widget-header-block"><h3 class="widget-title"><span>',
        'after_title' => '</span></h3></div>',
    ));
}
add_action( 'widgets_init', 'prolific_widgets_init' );