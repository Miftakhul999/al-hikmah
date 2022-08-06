<?php
/**
 * Select sidebar according to the options saved
 *
 * @since Restaurant Recipe 1.0.0
 *
 * @param null
 * @return string
 *
 */
if ( !function_exists('prolific_sidebar_selection') ) :
	function prolific_sidebar_selection( ) {
		wp_reset_postdata();
		$prolific_customizer_all_values = prolific_get_theme_options();
		global $post;
		if(
			isset( $prolific_customizer_all_values['prolific-single-sidebar-layout'] ) &&
			(
				'left-sidebar' == $prolific_customizer_all_values['prolific-single-sidebar-layout'] ||
				'both-sidebar' == $prolific_customizer_all_values['prolific-single-sidebar-layout'] ||
				'middle-col' == $prolific_customizer_all_values['prolific-single-sidebar-layout'] ||
				'no-sidebar' == $prolific_customizer_all_values['prolific-single-sidebar-layout']
			)
		){
			$prolific_body_global_class = $prolific_customizer_all_values['prolific-single-sidebar-layout'];
		}
		else{
			$prolific_body_global_class= 'right-sidebar';
		}

		if ( prolific_is_woocommerce_active() && ( is_product() || is_shop() || is_product_taxonomy() )) {
			if( is_product() ){
				$post_class = get_post_meta( $post->ID, 'prolific_sidebar_layout', true );
				$prolific_wc_single_product_sidebar_layout = $prolific_customizer_all_values['prolific-wc-single-product-sidebar-layout'];

				if ( 'default-sidebar' != $post_class ){
					if ( $post_class ) {
						$prolific_body_classes = $post_class;
					} else {
						$prolific_body_classes = $prolific_wc_single_product_sidebar_layout;
					}
				}
				else{
					$prolific_body_classes = $prolific_wc_single_product_sidebar_layout;

				}
			}
			else{
				if( isset( $prolific_customizer_all_values['prolific-wc-shop-archive-sidebar-layout'] ) ){
					$prolific_archive_sidebar_layout = $prolific_customizer_all_values['prolific-wc-shop-archive-sidebar-layout'];
					if(
						'right-sidebar' == $prolific_archive_sidebar_layout ||
						'left-sidebar' == $prolific_archive_sidebar_layout ||
						'both-sidebar' == $prolific_archive_sidebar_layout ||
						'middle-col' == $prolific_archive_sidebar_layout ||
						'no-sidebar' == $prolific_archive_sidebar_layout
					){
						$prolific_body_classes = $prolific_archive_sidebar_layout;
					}
					else{
						$prolific_body_classes = $prolific_body_global_class;
					}
				}
				else{
					$prolific_body_classes= $prolific_body_global_class;
				}
			}
		}
		elseif( is_front_page() ){
			if( isset( $prolific_customizer_all_values['prolific-front-page-sidebar-layout'] ) ){
				if(
					'right-sidebar' == $prolific_customizer_all_values['prolific-front-page-sidebar-layout'] ||
					'left-sidebar' == $prolific_customizer_all_values['prolific-front-page-sidebar-layout'] ||
					'both-sidebar' == $prolific_customizer_all_values['prolific-front-page-sidebar-layout'] ||
					'middle-col' == $prolific_customizer_all_values['prolific-front-page-sidebar-layout'] ||
					'no-sidebar' == $prolific_customizer_all_values['prolific-front-page-sidebar-layout']
				){
					$prolific_body_classes = $prolific_customizer_all_values['prolific-front-page-sidebar-layout'];
				}
				else{
					$prolific_body_classes = $prolific_body_global_class;
				}
			}
			else{
				$prolific_body_classes= $prolific_body_global_class;
			}
		}

		elseif ( is_singular() && isset( $post->ID ) ) {
			$post_class = get_post_meta( $post->ID, 'prolific_sidebar_layout', true );
			if ( 'default-sidebar' != $post_class ){
				if ( $post_class ) {
					$prolific_body_classes = $post_class;
				} else {
					$prolific_body_classes = $prolific_body_global_class;
				}
			}
			else{
				$prolific_body_classes = $prolific_body_global_class;
			}

		}
		elseif ( is_archive() ) {
			if( isset( $prolific_customizer_all_values['prolific-archive-sidebar-layout'] ) ){
				$prolific_archive_sidebar_layout = $prolific_customizer_all_values['prolific-archive-sidebar-layout'];
				if(
					'right-sidebar' == $prolific_archive_sidebar_layout ||
					'left-sidebar' == $prolific_archive_sidebar_layout ||
					'both-sidebar' == $prolific_archive_sidebar_layout ||
					'middle-col' == $prolific_archive_sidebar_layout ||
					'no-sidebar' == $prolific_archive_sidebar_layout
				){
					$prolific_body_classes = $prolific_archive_sidebar_layout;
				}
				else{
					$prolific_body_classes = $prolific_body_global_class;
				}
			}
			else{
				$prolific_body_classes= $prolific_body_global_class;
			}
		}
		else {
			$prolific_body_classes = $prolific_body_global_class;
		}
		return $prolific_body_classes;
	}
endif;