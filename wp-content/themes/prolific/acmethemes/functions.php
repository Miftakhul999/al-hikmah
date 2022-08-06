<?php
/**
 * Callback functions for comments
 *
 * @since Prolific 1.0.0
 *
 * @param $comment
 * @param $args
 * @param $depth
 * @return void
 *
 */
if ( !function_exists('prolific_commment_list') ) :

    function prolific_commment_list($comment, $args, $depth) {
        extract($args, EXTR_SKIP);
        if ('div' == $args['style']) {
            $tag = 'div';
            $add_below = 'comment';
        }
        else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
        ?>
        <<?php echo $tag ?>
        <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
        <?php if ('div' != $args['style']) : ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
        <?php endif; ?>
        <div class="comment-author vcard">
            <?php
            if ($args['avatar_size'] != 0) echo get_avatar($comment, '64');
            printf(__('<cite class="fn">%s</cite>', 'prolific' ), get_comment_author_link());
            ?>
        </div>
        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'prolific'); ?></em>
            <br/>
        <?php endif; ?>
        <div class="comment-meta commentmetadata">
            <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                <i class="fa fa-clock-o"></i>
                <?php
                /* translators: 1: date, 2: time */
                printf(__('%1$s at %2$s', 'prolific'), get_comment_date(), get_comment_time()); ?>
            </a>
            <?php edit_comment_link(__('(Edit)', 'prolific'), '  ', ''); ?>
        </div>
        <?php comment_text(); ?>
        <div class="reply">
            <?php comment_reply_link( array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
        <?php if ('div' != $args['style']) : ?>
            </div>
        <?php endif;
    }
endif;

/**
 * BreadCrumb Settings
 */
if( ! function_exists( 'prolific_breadcrumbs' ) ):
    function prolific_breadcrumbs() {
        if ( ! function_exists( 'breadcrumb_trail' ) ) {
            require prolific_file_directory('acmethemes/library/breadcrumbs/breadcrumbs.php');
        }
        $breadcrumb_args = array(
            'container'   => 'div',
            'show_browse' => false
        );
        echo "<div class='breadcrumbs col-md-12 init-animate fadeInDown1'><div id='prolific-breadcrumbs'><div class='breadcrumb-container'>";
        breadcrumb_trail( $breadcrumb_args );
        echo "</div></div></div>";
    }
endif;

/**
 * Generate excerpt.
 *
 * @since Prolific 1.0.3
 *
 * @param int     $length Excerpt length in words.
 * @param WP_Post $post_obj WP_Post instance (Optional).
 * @return string Excerpt.
 */
if ( ! function_exists( 'prolific_excerpt' ) ) :

    function prolific_excerpt( $length = 50, $post_obj = null ) {

        global $post;
        if ( is_null( $post_obj ) ) {
            $post_obj = $post;
        }

        $length = absint( $length );

        if ( 0 === $length  ) {
            return '';
        }

        $source_content = $post_obj->post_content;
        if ( ! empty( $post_obj->post_excerpt ) ) {
            $source_content = $post_obj->post_excerpt;
        }

        $source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
        $trimmed_content = wp_trim_words( $source_content, $length, '...' );
        return $trimmed_content;
    }
endif;

/**
 * More Text
 *
 * @since prolific 1.0.0
 *
 * @param null
 * @return string
 *
 */
if ( !function_exists('prolific_blog_archive_more_text') ) :
    function prolific_blog_archive_more_text( ) {
        global $prolific_customizer_all_values;
        $prolific_blog_archive_read_more = $prolific_customizer_all_values['prolific-blog-archive-more-text'];
        $prolific_blog_archive_read_more = esc_html( $prolific_blog_archive_read_more );
        return $prolific_blog_archive_read_more;
    }
endif;

/**
 * Front Page check
 *
 * @since prolific 1.0.2
 *
 * @param null
 * @return string
 *
 */
if ( !function_exists('prolific_trt_front_page') ) :
    function prolific_trt_front_page( ) {
        global $prolific_customizer_all_values;
        $prolific_enable_feature = $prolific_customizer_all_values['prolific-enable-feature'];
        if( is_front_page() && 1 == $prolific_enable_feature && !is_home() ){
            return true;
        }
        return false;
    }
endif;

/**
 * check if WooCommerce activated
 */
function prolific_is_woocommerce_active() {
	return class_exists( 'WooCommerce' ) ? true : false;
}