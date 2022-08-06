<?php
/**
 * Main include functions ( to support child theme ) that child theme can override file too
 *
 * @since Prolific 1.0.0
 *
 * @param string $file_path, path from the theme
 * @return string full path of file inside theme
 *
 */
if( !function_exists('prolific_file_directory') ){

    function prolific_file_directory( $file_path ){
        return trailingslashit( get_template_directory() ) . $file_path;
    }
}

/**
 * Check empty or null
 *
 * @since Prolific 1.0.0
 *
 * @param string $str, string
 * @return boolean
 *
 */
if( !function_exists('prolific_is_null_or_empty') ){
	function prolific_is_null_or_empty( $str ){
		return ( !isset($str) || trim($str)==='' );
	}
}

/*file for library*/
require prolific_file_directory('acmethemes/library/tgm/class-tgm-plugin-activation.php');

/*
* file for customizer theme options
*/
require prolific_file_directory('acmethemes/customizer/customizer.php');

/*
* file for additional functions files
*/
require prolific_file_directory('acmethemes/functions.php');

require prolific_file_directory('acmethemes/functions/sidebar-selection.php');

/*
* files for hooks
*/
/*
* files for hooks
*/
require prolific_file_directory('acmethemes/hooks/tgm.php');

require prolific_file_directory('acmethemes/hooks/front-page.php');

require prolific_file_directory('acmethemes/hooks/slider-selection.php');

require prolific_file_directory('acmethemes/hooks/header.php');

require prolific_file_directory('acmethemes/hooks/social-links.php');

require prolific_file_directory('acmethemes/hooks/dynamic-css.php');

require prolific_file_directory('acmethemes/hooks/footer.php');

require prolific_file_directory('acmethemes/hooks/comment-forms.php');

require prolific_file_directory('acmethemes/hooks/excerpts.php');

require prolific_file_directory('acmethemes/hooks/siteorigin-panels.php');

require prolific_file_directory('acmethemes/hooks/acme-demo-setup.php');


/*
* file for sidebar and widgets
*/

require prolific_file_directory('acmethemes/sidebar-widget/acme-about.php');

require prolific_file_directory('acmethemes/sidebar-widget/acme-featured.php');

require prolific_file_directory('acmethemes/sidebar-widget/acme-service.php');

require prolific_file_directory('acmethemes/sidebar-widget/acme-testimonial.php');

require prolific_file_directory('acmethemes/sidebar-widget/acme-team.php');

require prolific_file_directory('acmethemes/sidebar-widget/acme-client.php');

require prolific_file_directory('acmethemes/sidebar-widget/acme-contact.php');

require prolific_file_directory('acmethemes/sidebar-widget/acme-col-posts.php');

require prolific_file_directory('acmethemes/sidebar-widget/sidebar.php');

/*file for metaboxes*/
require prolific_file_directory('acmethemes/metabox/metabox.php');

require prolific_file_directory('acmethemes/metabox/metabox-defaults.php');

/*
* file for core functions imported from functions.php while downloading Underscores
*/
require prolific_file_directory('acmethemes/core.php');
require prolific_file_directory('acmethemes/gutenberg/gutenberg-init.php');

/**
 * Theme options page.
 */
if ( is_admin() ) {
    require_once prolific_file_directory('acmethemes/at-theme-info/class-at-theme-info.php');
    require_once prolific_file_directory('acmethemes/admin-notice/class-admin-notice-handler.php');
}