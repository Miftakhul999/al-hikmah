<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Prolific
 */
global $prolific_customizer_all_values;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-wrapper">
		<?php
		if ( $prolific_customizer_all_values['prolific-blog-archive-layout'] == 'full-image' && has_post_thumbnail() ) {
			?>
			<!--post thumbnal options-->
			<a href="<?php the_permalink(); ?>" class="full-image">
				<?php
				the_post_thumbnail( 'full', array( 'class' => 'aligncenter' ) );
				?>
			</a>
			<?php
		}
		?>
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<?php
			if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php prolific_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
			endif; ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			the_excerpt();
			?>
		</div><!-- .entry-content -->
		<div class="clearfix"></div>
		<footer class="entry-footer">
			<?php prolific_entry_footer(); ?>
		</footer><!-- .entry-footer -->
        <?php
        $prolific_blog_archive_read_more = prolific_blog_archive_more_text();
        if( !empty( $prolific_blog_archive_read_more )){
            ?>
            <a class="read-more btn btn-primary" href="<?php the_permalink(); ?> ">
                <?php echo $prolific_blog_archive_read_more; ?>
            </a>
            <?php
        }
        ?>
	</div>
</article><!-- #post-## -->