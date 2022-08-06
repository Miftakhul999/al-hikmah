<?php
/**
 * Footer content
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('prolific_footer')) :

    function prolific_footer()
    {
        global $prolific_customizer_all_values;
        $bg_image = esc_url($prolific_customizer_all_values['prolific-footer-bg-img']);
        $bg_image_style = '';
        $bg_image_class = '';
        if (!empty($bg_image)) {
            $bg_image_style .= 'background-image:url(' . $bg_image . ');background-repeat:no-repeat;background-size:cover;background-attachment:fixed;background-position: center;';
            $bg_image_class = 'at-parallax';
        }
        ?>
        <div class="clearfix"></div>
        <footer class="site-footer at-remove-width <?php echo $bg_image_class; ?>" style="<?php echo $bg_image_style; ?>">
            <div class="footer-social-wrapper">
                <?php
                if (1 == $prolific_customizer_all_values['prolific-enable-social']) {
                    /**
                     * Social Sharing
                     * prolific_action_social_links
                     * @since Prolific 1.1.0
                     *
                     * @hooked prolific_social_links -  10
                     */

                    do_action('prolific_action_social_links');
                }
                ?>
            </div> <!-- .footer-social-wrapper -->
            <?php
            if (
                is_active_sidebar('prolific-footer-top-col-one') ||
                is_active_sidebar('prolific-footer-top-col-two') ||
                is_active_sidebar('prolific-footer-top-col-three')
            ) {
                ?>
                <div class="footer-top-wrapper">
                    <div class="container">
                        <div class="row">
                            <?php
                            $footer_top_col = 'col-sm-4';
                            ?>
                            <div class="footer-columns">
                                <?php if (is_active_sidebar('prolific-footer-top-col-one')) : ?>
                                    <div class="footer-sidebar init-animate fadeInDown1 <?php echo esc_attr($footer_top_col); ?>">
                                        <?php dynamic_sidebar('prolific-footer-top-col-one'); ?>
                                    </div>
                                <?php endif;
                                if (is_active_sidebar('prolific-footer-top-col-two')) : ?>
                                    <div class="footer-sidebar init-animate fadeInDown1 <?php echo esc_attr($footer_top_col); ?>">
                                        <?php dynamic_sidebar('prolific-footer-top-col-two'); ?>
                                    </div>
                                <?php endif;
                                if (is_active_sidebar('prolific-footer-top-col-three')) : ?>
                                    <div class="footer-sidebar init-animate fadeInDown1 <?php echo esc_attr($footer_top_col); ?>">
                                        <?php dynamic_sidebar('prolific-footer-top-col-three'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div><!-- footer-top-wrapper-->
            <?php
            }
            ?>
            <div class="footer-bottom-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 init-animate fadeInDown1">
                            <?php
                            if (isset($prolific_customizer_all_values['prolific-footer-copyright'])): ?>
                                <p class="text-center">
                                    <?php echo wp_kses_post($prolific_customizer_all_values['prolific-footer-copyright']); ?>
                                </p>
                            <?php endif;
                            ?>
                        </div>
                        <div class="col-sm-126 init-animate fadeInDown1">
                            <div class="footer-copyright border text-center">
                                <div class="site-info">
                                    <?php printf(esc_html__('%1$s by %2$s', 'prolific'), 'Prolific', '<a href="http://www.acmethemes.com/" rel="designer">Acme Themes</a>'); ?>
                                </div>
                                <!-- .site-info -->
                            </div>
                        </div>
                    </div>
                    <a href="#page" class="sm-up-container"><i class="fa fa-angle-up sm-up"></i></a>
                </div>
            </div>
        </footer>
    <?php
    }
endif;
add_action('prolific_action_footer', 'prolific_footer', 10);

/**
 * Page end
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('prolific_page_end')) :

    function prolific_page_end(){
        ?>
        </div><!-- #page -->
    <?php
    }
endif;
add_action('prolific_action_after', 'prolific_page_end', 10);