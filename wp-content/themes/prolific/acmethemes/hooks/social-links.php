<?php
/**
 * Display Social Links
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return void
 *
 */

if ( !function_exists('prolific_social_links') ) :

    function prolific_social_links( ) {

        global $prolific_customizer_all_values;
        ?>
        <ul class="socials">
            <?php
            if ( !empty( $prolific_customizer_all_values['prolific-facebook-url'] ) ) { ?>
                <li class="facebook">
                    <a href="<?php echo esc_url( $prolific_customizer_all_values['prolific-facebook-url'] ); ?>" title="<?php esc_attr_e( 'Facebook','prolific');?>" target="_blank"><i class="fa fa-facebook"></i></a>
                </li>
            <?php }
            if ( !empty( $prolific_customizer_all_values['prolific-twitter-url'] ) ) { ?>
                <li class="twitter">
                    <a href="<?php echo esc_url( $prolific_customizer_all_values['prolific-twitter-url'] ); ?>"  title="<?php esc_attr_e( 'Twitter','prolific');?>" target="_blank"><i class="fa fa-twitter"></i></a>
                </li>
            <?php }
            if ( !empty( $prolific_customizer_all_values['prolific-youtube-url'] ) ) { ?>
                <li class="youtube">
                    <a href="<?php echo esc_url( $prolific_customizer_all_values['prolific-youtube-url'] ); ?>" title="<?php esc_attr_e( 'Youtube','prolific');?>" target="_blank"><i class="fa fa-youtube"></i></a>
                </li>
            <?php }
            if ( !empty( $prolific_customizer_all_values['prolific-google-plus-url'] ) ) {
                ?>
                <li class="google-plus">
                    <a href="<?php echo esc_url( $prolific_customizer_all_values['prolific-google-plus-url'] ); ?>" title="<?php esc_attr_e( 'Google Plus','prolific');?>"  target="_blank"><i class="fa fa-google-plus"></i></a>
                </li>
                <?php
            }
            ?>
        </ul>
        <?php
    }
endif;
add_filter( 'prolific_action_social_links', 'prolific_social_links', 10 );