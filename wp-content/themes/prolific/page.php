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
$prolific_enable_feature = $prolific_customizer_all_values['prolific-enable-feature'];
?>
<div class="wrapper inner-main-title">
    <div class="container">
        <div class="row">
            <header class="entry-header col-md-12 init-animate fadeInDown1">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->
            <?php
            if( 1 == $prolific_customizer_all_values['prolific-show-breadcrumb'] ){
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
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
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