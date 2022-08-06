<?php
/**
 * Custom Metabox
 * Only added icon not special data
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return void
 *
 */
if( !function_exists( 'prolific_add_metabox_side' )):
    function prolific_add_metabox_side() {
        add_meta_box(
            'prolific_meta_fields', // $id
            __( 'Featured Icon', 'prolific' ), // $title
            'prolific_meta_fields_callback', // $callback
            'page', // $page
            'side', // $context
            'core'// $priority
        );
    }
endif;
add_action('add_meta_boxes', 'prolific_add_metabox_side');

/**
 * Callback function for metabox
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('prolific_meta_fields_callback') ) :
    function prolific_meta_fields_callback(){
        global $post;
        $prolific_featured_icon = get_post_meta( $post->ID, 'prolific-featured-icon', true );
        wp_nonce_field( basename( __FILE__ ), 'prolific_meta_fields_nonce' );
       ?>
        <table class="form-table page-meta-box">
            <tr>
                <td>
                    <label class="description" for="prolific-featured-icon"><?php _e( 'Enter Featured Icon', 'prolific' ); ?></label>
                    <input class="widefat" id="prolific-featured-icon" type="text" name="prolific-featured-icon" value="<?php echo esc_attr( $prolific_featured_icon ); ?>" placeholder="fa-desktop"/>
                    <br />
                    <small>
                        <?php 
                        _e( 'Featured Icon Used in Widgets', 'prolific' );
                        printf( __( '%1$sRefer here%2$s for icon class. For example: %3$sfa-desktop%4$s', 'prolific' ), '<br /><a href="'.esc_url( 'http://fontawesome.io/cheatsheet/' ).'" target="_blank">','</a>',"<code>","</code>" );
                        ?>
                    </small>
                </td>
            </tr>
        </table>
    <?php
}
endif;

/**
 * Save the custom metabox data
 * @hooked to save_post hook
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('prolific_save_featured_icon') ) :
    function prolific_save_featured_icon( $post_id ) {

        /*
          * A Guide to Writing Secure Themes – Part 4: Securing Post Meta
          *https://make.wordpress.org/themes/2015/06/09/a-guide-to-writing-secure-themes-part-4-securing-post-meta/
          * */
        if (
            !isset( $_POST[ 'prolific_meta_fields_nonce' ] ) ||
            !wp_verify_nonce( $_POST[ 'prolific_meta_fields_nonce' ], basename( __FILE__ ) ) || /*Protecting against unwanted requests*/
            ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || /*Dealing with autosaves*/
            ! current_user_can( 'edit_post', $post_id )/*Verifying access rights*/
        ){
            return;
        }

        // Stop WP from clearing custom fields on autosave
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;

        //Execute this saving function
        if(isset($_POST['prolific-featured-icon'])){
            $new = sanitize_text_field( $_POST['prolific-featured-icon'] );
            update_post_meta( $post_id, 'prolific-featured-icon', $new );

        }
    }
endif;
add_action('save_post', 'prolific_save_featured_icon');