<?php
/**
 * Class for adding Contact Section Widget
 *
 * @package Acme Themes
 * @subpackage Prolific
 * @since 1.0.0
 */
if (!class_exists('Prolific_contact')) {

    class Prolific_contact extends WP_Widget {
        /*defaults values for fields*/
        private $defaults = array(
            'unique_id' => '',
            'title' => '',
            'shortcode' => '',
            'page_id' => '',
            'map' => ''
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'prolific_contact',
                /*Widget name will appear in UI*/
                __('AT Contact Section', 'prolific'),
                /*Widget description*/
                array('description' => __('Show Contact Section.', 'prolific'),)
            );
        }

        /*Widget Backend*/
        public function form($instance) {
            $instance = wp_parse_args((array)$instance, $this->defaults);
            /*default values*/
            $unique_id = esc_attr( $instance['unique_id'] );
            $title = esc_attr( $instance['title'] );
            $map = esc_html ($instance['map'] );
            $shortcode = esc_attr( $instance['shortcode'] );
            $page_id = absint( $instance['page_id'] );
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('unique_id'); ?>"><?php _e('Section ID', 'prolific'); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id('unique_id'); ?>" name="<?php echo $this->get_field_name('unique_id'); ?>" type="text" value="<?php echo $unique_id; ?>"/>
                <br/>
                <small><?php _e('Enter a Unique Section ID. You can use this ID in Menu item for enabling One Page Menu.', 'prolific') ?></small>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'prolific'); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('shortcode'); ?>"><?php _e('Enter Shortcode', 'prolific'); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id('shortcode'); ?>" name="<?php echo $this->get_field_name('shortcode'); ?>" type="text" value="<?php echo $shortcode; ?>"/>
                <small>
                    <?php
                    printf( __( 'Download contact form 7 from %1$shere%2$s', 'prolific' ), "<a target='_blank' href='".esc_url( 'https://wordpress.org/plugins/contact-form-7/' )."''>","</a>" );
                    ?>
                </small>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('map'); ?>"><?php _e('Google Map', 'prolific'); ?>:</label>
                <br/>
                <small><?php _e('Google Map Iframe code', 'prolific'); ?></small>
                <textarea class="widefat" rows="5" cols="15" id="<?php echo $this->get_field_id('map'); ?>" name="<?php echo $this->get_field_name('map'); ?>"><?php echo $map; ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('page_id'); ?>"><?php _e('Select Page For Contact', 'prolific'); ?>:</label>
                <br/>
                <small><?php _e('Select a page to show the contact details', 'prolific'); ?></small>
                <?php
                /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
                $args = array(
                    'selected' => $page_id,
                    'name' => $this->get_field_name('page_id'),
                    'id' => $this->get_field_id('page_id'),
                    'class' => 'widefat',
                    'show_option_none' => __('Select Page', 'prolific'),
                );
                wp_dropdown_pages($args);
                ?>
            </p>
        <?php
        }

        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         * @return array
         *
         */
        public function update($new_instance, $old_instance) {
            $allowed_html = array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array(),
                'iframe' => array(
                    'align' => array(),
                    'frameborder' => array(),
                    'height' => array(),
                    'longdesc' => array(),
                    'marginheight' => array(),
                    'marginwidth' => array(),
                    'name' => array(),
                    'scrolling' => array(),
                    'src' => array(),
                    'srcdoc' => array(),
                    'width' => array(),
                ),
            );

            $instance = $old_instance;
            $instance['unique_id'] = sanitize_key($new_instance['unique_id']);
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['map'] =  wp_kses($new_instance[ 'map' ] , $allowed_html );
            $instance['shortcode'] = wp_kses_post($new_instance['shortcode']);
            $instance['page_id'] = absint($new_instance['page_id']);

            return $instance;
        }

        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return void
         *
         */
        public function widget($args, $instance) {
            $init_animate_title = "init-animate fadeInDown2";
            $animation1 = 'init-animate fadeInLeftBig1';
            $animation2 = 'init-animate fadeInRightBig1';

            $instance = wp_parse_args((array)$instance, $this->defaults);

            /*default values*/
            $unique_id = !empty($instance['unique_id']) ? esc_attr($instance['unique_id']) : esc_attr($this->id);
            $title = apply_filters('widget_title', !empty($instance['title']) ? $instance['title'] : '', $instance, $this->id_base);
            $shortcode = wp_kses_post($instance['shortcode']);
            $map = esc_html( $instance['map'] );
            $map = htmlspecialchars_decode( esc_html( (string)$map ) );
            $page_id = absint($instance['page_id']);
            echo $args['before_widget'];
            ?>
            <section id="<?php echo $unique_id; ?>" class="acme-widgets acme-contact">
                <div class="contact-form">
                    <div class="container">
                        <div class="row">
                            <div class="main-title col-sm-12 <?php echo $init_animate_title; ?>">
                                <?php
                                if (!empty($title)) {
                                    echo $args['before_title'] . esc_html($title) . $args['after_title'];
                                }
                                ?>
                            </div>
                            <?php if (!empty($shortcode)) : ?>
                                <div class="col-sm-12 contact-form-block clearfix <?php echo $animation1; ?>">
                                    <?php echo do_shortcode($shortcode); ?>
                                </div>
                            <?php endif;
                            if (!empty ($page_id)) :
                                $prolific_child_page_args = array(
                                    'page_id' => $page_id,
                                    'posts_per_page' => 1,
                                    'post_type' => 'page',
                                    'no_found_rows' => true,
                                    'post_status' => 'publish'
                                );
                                $service_query = new WP_Query($prolific_child_page_args);
                                /*The Loop*/
                                if ($service_query->have_posts()):
                                    while ($service_query->have_posts()):$service_query->the_post();
                                        ?>
                                        <div class="col-sm-6  <?php echo $animation1; ?>">
                                            <?php the_title('<h2 class="entry-title">', '</h2>'); ?>
                                            <div class="contact-page-content">
                                                <?php
                                                the_excerpt();
                                                ?>
                                            </div>
                                        </div>
                                    <?php
                                    endwhile;
                                endif;
                            endif;
                            ?>
                            <div class="col-sm-6  <?php echo $animation2; ?>">
                                <?php echo $map; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            echo $args['after_widget'];
        }
    } // Class Prolific_contact ends here
}

/**
 * Function to Register and load the widget
 *
 * @since 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('prolific_contact')) :

    function prolific_contact() {
        register_widget('Prolific_contact');
    }
endif;
add_action('widgets_init', 'prolific_contact');