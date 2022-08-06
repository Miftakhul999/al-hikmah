<?php
/**
 * Display default slider
 *
 * @since Prolific 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if (!function_exists('prolific_default_slider')) :
    function prolific_default_slider() {
        $bg_image_style = '';
        if (get_header_image()) :
            $bg_image_style .= 'background-image:url(' . esc_url(get_header_image()) . ');background-repeat:no-repeat;background-size:cover;background-attachment:scroll;background-position: center;';
        else:
            $bg_image_style .= 'background-image:url(' . esc_url(get_template_directory_uri() . "/assets/img/startup-slider.jpg") . ');background-repeat:no-repeat;background-size:cover;background-attachment:scroll;background-position: center;';
        endif; // End header image check.

        ?>
        <div class="image-slider-wrapper home-fullscreen ">
            <div class="item no-slider" style="<?php echo $bg_image_style; ?>">
                <div class="slider-content">
                    <div class="slider-content-block init-animate fadeInLeftBig2">
                        <div class="banner-title">
                            <?php _e('Welcome to Prolific', 'prolific'); ?>
                        </div>
                        <div class="image-slider-caption">
                            <?php _e('Really Awesome Theme For Your Business-Corporate House or Personal Freelancing Sites', 'prolific'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
endif;

/**
 * Featured Slider display
 *
 * @since Prolific 1.0.0
 *
 * @param null
 * @return void
 */

if (!function_exists('prolific_feature_slider')) :

    function prolific_feature_slider() {
        global $prolific_customizer_all_values;
        $prolific_feature_page = $prolific_customizer_all_values['prolific-feature-page'];
        $prolific_featured_slider_number = $prolific_customizer_all_values['prolific-featured-slider-number'];
        $prolific_feature_slider_enable_animation = $prolific_customizer_all_values['prolific-feature-slider-enable-animation'];
        if (0 != $prolific_feature_page) :
            $prolific_child_page_args = array(
                'post_parent' => $prolific_feature_page,
                'posts_per_page' => $prolific_featured_slider_number,
                'post_type' => 'page',
                'no_found_rows' => true,
                'post_status' => 'publish'
            );
            $slider_query = new WP_Query($prolific_child_page_args);
            if (!$slider_query->have_posts()) {
                $prolific_child_page_args = array(
                    'page_id' => $prolific_feature_page,
                    'posts_per_page' => $prolific_featured_slider_number,
                    'post_type' => 'page',
                    'no_found_rows' => true,
                    'post_status' => 'publish'
                );
                $slider_query = new WP_Query($prolific_child_page_args);
            }
            /*The Loop*/
            if ($slider_query->have_posts()):
                ?>
                <div class="image-slider-wrapper home-fullscreen" id="acme-full-slider">
                    <div class="acme-owl-carausel">
                        <?php
                        $prolific_fs_animation = '';
                        if( 1 == $prolific_feature_slider_enable_animation ){
                            $prolific_fs_animation = 'init-animate fadeInLeftBig2';
                        }
                        while ($slider_query->have_posts()):$slider_query->the_post();
                            if (has_post_thumbnail()) {
                                $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                            } else {
                                $image_url[0] = get_template_directory_uri() . '/assets/img/startup-slider.jpg';
                            }
                            $bg_image_style = 'background-image:url(' . esc_url($image_url[0]) . ');background-repeat:no-repeat;background-size:cover;background-attachment:scroll;background-position: center;';
                            ?>
                            <div class="item" style="<?php echo $bg_image_style; ?>">
                                <div class="slider-content">
                                    <div class="slider-content-block <?php echo $prolific_fs_animation; ?>">
                                        <div class="banner-title"> <a href="<?php the_permalink(); ?>"> <?php the_title() ?> </a> </div>
                                        <div class="image-slider-caption">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile;
                        ?>
                    </div>
                </div>
            <?php
            endif;
        else:
            prolific_default_slider();
        endif;
        wp_reset_postdata();
    }
endif;
add_action('prolific_action_feature_slider', 'prolific_feature_slider', 0 );