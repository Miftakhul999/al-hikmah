<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Prolific
 */
get_header();
global $prolific_customizer_all_values;
?>
    <div class="wrapper inner-main-title">
        <div class="container">
            <header class="entry-header col-md-6 init-animate fadeInDown1">
                <h1 class="entry-title">
	                <?php
	                if ( isset( $prolific_customizer_all_values['prolific-store-title']) ):
		                $prolific_store_title = $prolific_customizer_all_values['prolific-store-title'];
		                echo esc_html( $prolific_store_title );
	                endif;
	                ?>
                </h1>
            </header><!-- .entry-header -->
            <?php
            if( 1 == $prolific_customizer_all_values['prolific-show-breadcrumb'] ){
                prolific_breadcrumbs();
            }
            ?>
        </div>
    </div>
    <div id="content" class="site-content container clearfix">
	    <?php
	    $sidebar_layout = prolific_sidebar_selection(get_the_ID());
	    if( 'both-sidebar' == $sidebar_layout ) {
		    echo '<div id="primary-wrap" class="clearfix">';
	    }
	    ?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php if ( have_posts() ) :
                    woocommerce_content();
                endif;
                ?>
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php
        get_sidebar( 'left' );
        get_sidebar();
        if( 'both-sidebar' == $sidebar_layout ) {
	        echo '</div>';
        }
        ?>
    </div><!-- #content -->
<?php get_footer();