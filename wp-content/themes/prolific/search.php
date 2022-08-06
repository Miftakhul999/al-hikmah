<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package AcmeThemes
 * @subpackage Prolific
 */
get_header();
global $prolific_customizer_all_values;
?>
    <div class="wrapper inner-main-title">
        <div class="container">
            <div class="row">
                <header class="entry-header col-md-12 init-animate fadeInDown1">
                    <h1 class="page-title"><?php printf(esc_html__('Search Results for: %s', 'prolific'), '<span>' . get_search_query() . '</span>'); ?></h1>
                </header>
                <?php
                if (1 == $prolific_customizer_all_values['prolific-show-breadcrumb']) {
                    prolific_breadcrumbs();
                }
                ?>
            </div>
        </div>
    </div>
    <div id="content" class="site-content container clearfix">
	    <?php
	    $sidebar_layout = prolific_sidebar_selection(get_the_ID());
	    if( 'both-sidebar' == $sidebar_layout ) {
		    echo '<div id="primary-wrap" class="clearfix">';
	    }
	    ?>
        <section id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php
                if (have_posts()) : ?>
                    <?php
                    /* Start the Loop */
                    while (have_posts()) : the_post();

                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part('template-parts/content', 'search');

                    endwhile;

                    the_posts_navigation();
                else :
                    get_template_part('template-parts/content', 'none');
                endif; ?>
            </main>
            <!-- #main -->
        </section>
        <!-- #primary -->
        <?php
        get_sidebar('left');
        get_sidebar();
        if( 'both-sidebar' == $sidebar_layout ) {
	        echo '</div>';
        }
        ?>
    </div><!-- #content -->
<?php get_footer();