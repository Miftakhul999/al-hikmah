<?php
/**
 * Template part for displaying recent posts from widgets.
 *
 * @package Acme Themes
 * @subpackage Prolific
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="content-wrapper">
        <?php
        if (has_post_thumbnail()) {
            ?>
            <div class="blog-cell post-widget-image">
                <a href="<?php the_permalink(); ?>" class="full-image">
                    <?php
                    the_post_thumbnail('large', array('class' => 'aligncenter'));
                    ?>
                </a>
            </div>
        <?php
        }
        ?>
        <div class="blog-cell post-widget-content">
            <header class="entry-header">
                <?php
                the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
                if ('post' === get_post_type()) : ?>
                    <div class="entry-meta">
                        <?php prolific_posted_on(); ?>
                    </div><!-- .entry-meta -->
                <?php
                endif; ?>
            </header>
            <!-- .entry-header -->
        </div>
    </div>
</article><!-- #post-## -->