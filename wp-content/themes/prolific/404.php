<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
                <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'prolific' ); ?></h1>
            </header>
            <?php
            if( 1 == $prolific_customizer_all_values['prolific-show-breadcrumb'] ){
                prolific_breadcrumbs();
            }
            ?>
        </div>
	</div>
</div>
<div id="content" class="site-content container clearfix">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="error-404 not-found">
				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'prolific' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- #content -->
<?php get_footer();