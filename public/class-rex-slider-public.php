<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link  https://https://profiles.wordpress.org/wpvirtuoso/
 * @since 1.0.0
 *
 * @package    Rex_Slider
 * @subpackage Rex_Slider/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rex_Slider
 * @subpackage Rex_Slider/public
 * @author     Wp Virtuoso <zaxrana.pk@gmail.com>
 */
class Rex_Slider_Public
{

    /**
     * The ID of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since 1.0.0
     * @param string $plugin_name The name of the plugin.
     * @param string $version     The version of this plugin.
     */
    public function __construct( $plugin_name, $version )
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since 1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Rex_Slider_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Rex_Slider_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/rex-slider-public.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since 1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Rex_Slider_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Rex_Slider_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/rex-slider-public.js', array( 'jquery' ), $this->version, false);

    }

    function rex_slider_post_type()
    {
        $args = array(
        'public' => true,
        'label' => 'Rex Slider',
        'capability_type'     => 'post',
        'supports' => array(
        'title',
        'thumbnail',
        )
        );
        register_post_type('rex_slider', $args);
    }

    function rex_slider_meta_box()
    {
        add_meta_box(
            'rex_slider_mb',
            'Rex Slider options',
            array($this, 'rex_slider_mb_form'),
            'rex_slider'
        );
    }

    function rex_slider_mb_form()
    {

        global $post;
        // Get Value of Fields From Database
        $rex_heading = get_post_meta($post->ID, 'rex_heading', true);
        $rex_subheading = get_post_meta($post->ID, 'rex_subheading', true);
        ?>
    <div class="row">
        <div class="label"><b>Slider Heading</div>
        <div class="fields">
            <textarea style="width:50%" name="rex_heading"><?php echo $rex_heading; ?></textarea>
    </div>
    </div>
    <br>
    <div class="row">
        <div class="label"><b>Slider Sub heading</b></div>
        <div class="fields">
                <textarea style="width:50%" name="rex_subheading"><?php echo $rex_subheading; ?></textarea>
    </div>
    </div>
        </div>
        <?php
    }
    function rex_slider_save_options( $post_id )
    {

        if(isset($_POST['rex_heading'])) {
            update_post_meta($post_id, 'rex_heading', sanitize_text_field($_POST['rex_heading']));
        } else {
            delete_post_meta($post_id, 'rex_heading');
        }

        if(isset($_POST['rex_subheading'])) {
            update_post_meta($post_id, 'rex_subheading', sanitize_text_field($_POST['rex_subheading']));
        } else {
            delete_post_meta($post_id, 'rex_subheading');
        }

    }

    function rex_slider_shortcode($atts)
    {

        extract(
            shortcode_atts(
                array(
                'id' => '',
                ), $atts 
            )
        );

         $slider_id = $atts['id'];


        $args = array(
        'post_type' => 'rex_slider',
        'posts_per_page' => 1,
        );

        $the_query = new WP_Query($args);
        if ($the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();

                $slider_output  = '<div class="rex-slider-wrapper">';
                $slider_output .= '<div class="rex-slider-image">' . get_the_post_thumbnail($slider_id, 'full') . '</div>';
                $slider_output .= '<div class="rex-slider-text">';
                $slider_output .= '<h4>' . get_post_meta($slider_id, 'rex_heading', true) . '</h4>';
                $slider_output .= '<h5>' . get_post_meta($slider_id, 'rex_subheading', true) . '</h5>';
                $slider_output .= '</div>';
                $slider_output .= '</div>';

                return $slider_output;

            }
        }
        wp_reset_query();

    }

}
