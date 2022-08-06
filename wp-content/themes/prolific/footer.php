<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acme Themes
 * @subpackage Prolific
 */

/**
 * prolific_action_after_content hook
 * @since Prolific 1.0.0
 *
 * @hooked null
 */
do_action( 'prolific_action_after_content' );

/**
 * prolific_action_before_footer hook
 * @since Prolific 1.0.0
 *
 * @hooked null
 */
do_action( 'prolific_action_before_footer' );

/**
 * prolific_action_footer hook
 * @since Prolific 1.0.0
 *
 * @hooked prolific_footer - 10
 */
do_action( 'prolific_action_footer' );

/**
 * prolific_action_after_footer hook
 * @since Prolific 1.0.0
 *
 * @hooked null
 */
do_action( 'prolific_action_after_footer' );

/**
 * prolific_action_after hook
 * @since Prolific 1.0.0
 *
 * @hooked prolific_page_end - 10
 */
do_action( 'prolific_action_after' );
wp_footer();
?>
</body>
</html>