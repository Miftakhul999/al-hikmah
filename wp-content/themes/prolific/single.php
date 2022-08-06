<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Acme Themes
 * @subpackage Prolific
 */
get_header();
global $prolific_customizer_all_values;
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
			get_template_part( 'template-parts/content', 'single' );
			
			if ( is_singular( 'attachment' ) ) {
				// Parent post navigation.
				the_post_navigation( array(
					'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'prolific' ),
				) );
			} elseif ( is_singular( 'post' ) ) {
				// Previous/next post navigation.
				the_post_navigation( array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'prolific' ) . ':<span class="icon"><i class="fa fa-long-arrow-right"></i></span></span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'prolific' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true"><span class="icon"><i class="fa fa-long-arrow-left"></i></span>' . __( 'Previous', 'prolific' ) . ':</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'prolific' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );
			}
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