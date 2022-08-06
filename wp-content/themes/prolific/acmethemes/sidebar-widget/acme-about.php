<?php
/**
 * Class for adding About Section Widget
 *
 * @package AcmeThemes
 * @subpackage Prolific
 * @since 1.0.0
 */
if ( ! class_exists( 'Prolific_about' ) ) {

    class Prolific_about extends WP_Widget {
        /*defaults values for fields*/
        private $defaults = array(
            'unique_id'     => '',
            'title'         => '',
            'page_id'       => '', 
            'post_number'   => 4
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'prolific_about',
                /*Widget name will appear in UI*/
                __('AT About Section', 'prolific'),
                /*Widget description*/
                array( 'description' => __( 'Show About Section.', 'prolific' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults );
            /*default values*/
            $unique_id = esc_attr( $instance[ 'unique_id' ] );
            $title = esc_attr( $instance[ 'title' ] );
            $page_id = absint( $instance[ 'page_id' ] );
            $post_number = absint( $instance[ 'post_number' ] );
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'unique_id' ); ?>"><?php _e( 'Section ID', 'prolific' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'unique_id' ); ?>" name="<?php echo $this->get_field_name( 'unique_id' ); ?>" type="text" value="<?php echo $unique_id; ?>" />
                <br />
                <small><?php _e('Enter a Unique Section ID. You can use this ID in Menu item for enabling One Page Menu.','prolific')?></small>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'prolific' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Select Parent Page For About', 'prolific' ); ?>:</label>
                <br />
                <small><?php _e( 'Select parent page and its subpages will display in the frontend. If pages does not have any subpages, then selected single page will display', 'prolific' ); ?></small>
                <?php
                /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
                $args = array(
                    'selected'              => $page_id,
                    'name'                  => $this->get_field_name( 'page_id' ),
                    'id'                    => $this->get_field_id( 'page_id' ),
                    'class'                 => 'widefat',
                    'show_option_none'      => __('Select Page','prolific'),
                );
                wp_dropdown_pages( $args );
                ?>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'post_number' ); ?>"><?php _e( 'Post Number', 'prolific' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" type="number" value="<?php echo $post_number; ?>" />
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
        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance[ 'unique_id' ] = sanitize_key( $new_instance[ 'unique_id' ] );
            $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
            $instance[ 'page_id' ] = absint( $new_instance[ 'page_id' ] );
            $instance[ 'post_number' ] = absint( $new_instance[ 'post_number' ] );

            return $instance;
        }

        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return void
         *
         */
        public function widget($args, $instance) {
            $prolific_sidebar_id = isset($args['id'])?$args['id']:'';
            $instance = wp_parse_args( (array) $instance, $this->defaults);

            $init_animate_title = '';
            $init_animate_content = '';
            if ( 'prolific-home' == $prolific_sidebar_id ){
                $init_animate_title = "init-animate fadeInDown2";
                $init_animate_content = "init-animate fadeInDown1";
            }

            /*default values*/
            $unique_id = !empty( $instance[ 'unique_id' ] ) ? esc_attr( $instance[ 'unique_id' ] ) : esc_attr( $this->id );
            $title = apply_filters( 'widget_title', !empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
            $page_id = absint( $instance[ 'page_id' ] );
            $post_number = absint( $instance[ 'post_number' ] );
            if( 1 == $post_number ){
                $init_animate_content .= " col-md-12";
            }
            else{
                $init_animate_content .= " col-md-6";
            }
            echo $args['before_widget'];
            ?>
            <section id="<?php echo $unique_id;?>" class="acme-widgets acme-about-block <?php echo esc_attr( $prolific_sidebar_id );?>">
                <div class="container">
                    <div class="main-title <?php echo esc_attr( $init_animate_title ); ?>">
                        <?php
                        if( !empty( $title ) ) {
                            echo $args['before_title'] .esc_html( $title ).$args['after_title'];
                        }
                        ?>
                    </div>
                    <div class="row">
                        <?php
                        if( !empty ( $page_id ) ) :
                        $prolific_child_page_args = array(
                            'post_parent'         => $page_id,
                            'posts_per_page'      => $post_number,
                            'post_type'           => 'page',
                            'no_found_rows'       => true,
                            'post_status'         => 'publish'
                        );
                        $about_query = new WP_Query( $prolific_child_page_args );
                        if ( !$about_query->have_posts() ){
                            $prolific_child_page_args = array(
                                'page_id'         => $page_id,
                                'posts_per_page'      => 1,
                                'post_type'           => 'page',
                                'no_found_rows'       => true,
                                'post_status'         => 'publish'
                            );
                            $about_query = new WP_Query( $prolific_child_page_args );
                        }
                        /*The Loop*/
                        if ( $about_query->have_posts() ):
                        $i = 1;
                        while( $about_query->have_posts() ):$about_query->the_post();
                            ?>
                            <div class="<?php echo esc_attr( $init_animate_content ); ?>">
                                <div class="about-item clearfix">
                                    <div class="about-icon">
                                        <?php
                                        $prolific_icon = get_post_meta( get_the_ID(), 'prolific-featured-icon', true );
                                        $prolific_icon = isset( $prolific_icon ) ? esc_attr( $prolific_icon ) : '';
                                        if( !empty ( $prolific_icon ) ) { ?>
                                            <i class="fa <?php echo esc_attr( $prolific_icon ); ?>"></i>
                                        <?php
                                        }
                                        else{
                                            echo '<i class="fa fa-suitcase"></i>';
                                        }
                                        ?>
                                    </div>
                                    <h4>
                                        <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h4>
                                    <p>
                                        <?php echo esc_html( get_the_excerpt() );?>
                                    </p>
                                </div>
                            </div>
                            <?php
                            $i++;
                        endwhile;
                        ?>
                    </div>
                    <?php
                    else:
                    /*do nothing for now*/
                    endif;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </section>
            <?php
            echo $args['after_widget'];
        }
    } // Class Prolific_about ends here
}

/**
 * Function to Register and load the widget
 *
 * @since 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( ! function_exists( 'prolific_about' ) ) :

    function prolific_about() {
        register_widget( 'Prolific_about' );
    }
endif;
add_action( 'widgets_init', 'prolific_about' );