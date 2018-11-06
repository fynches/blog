<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class WPClapsApplause {

    public function __construct(){

        $this->plugin_name = 'wp-claps-applause';
        $this->version = '1.0.0';

        add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
        add_action( 'wp_enqueue_scripts', array($this, 'pt_claps_applause_scripts'), 100 );
        add_action( 'wp_ajax_nopriv_pt_claps_applause', array($this, 'pt_claps_applause'));
        add_action( 'wp_ajax_pt_claps_applause', array($this, 'pt_claps_applause'));
        add_filter( 'the_content',array($this,'wpli_content_filter'));
        add_shortcode( 'wp_claps_applause', array($this,'wp_claps_applause_shortcode') );
    }

    /**
     * Load Text Domain
     *
     * Loads the textdomain for translations
     *
     * @author wowthemesnet
     * @since 1.0.0
     *
     */
    public function load_textdomain() {
        load_plugin_textdomain( $this->plugin_name, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }

    /**
     * Generate claps button HTML
     *
     *
     * @author wowthemesnet
     * @since 1.0.0
     *
     */
    private function claps_applause_button_html() {
        $button_html = '';
        $link = get_permalink();

        if ( is_single() ) {
            $post_id = get_the_ID();
            $claps = get_post_meta( get_the_ID(), '_pt_claps', true );
            $claps = ( empty( $claps ) ) ? 0 : $claps;

            $ids = ! empty($_COOKIE['wp_claps_applause_ids']) ? explode(',', $_COOKIE['wp_claps_applause_ids']) : array();
            if ( in_array( get_the_ID(), $ids) ) {
                $rated = ' has_rated';
                $text  = __( '<span class="lovedit">Already applauded!</span>', $this->plugin_name );
                $href = '';
            } else {
                $rated = '';
                $text  = '';
                $href = 'href="'.$link.'"';
            }

            $nonce_field = wp_nonce_field( 'wpli-'.$post_id, '_wpnonce', true, false );

            $button_html = '
                        <div id="pt-claps-applause-'.$post_id.'" class="pt-claps-applause'.$rated.'">
                            <a class="claps-button" '.$href.' data-id="' . $post_id . '">' . $text .
                            '</a>
                            <span id="claps-count-'.get_the_ID().'" class="claps-count">' . $claps . '</span>'
                            . $nonce_field .
                        '</div>';
        }
        return $button_html;
    }

    /**
     * Content filter to add (or not) add the Love it button to post
     * Use filter 'wpli/position' to choose the button position, three values accepted: top, bottom, none
     * Use filter 'wpli/autoadd' to choose whether the button to be automatically added to the post, 2 boolean values accepted: true, false
     *
     * @author wowthemesnet
     * @since 1.0.0
     *
     */
    public function wpli_content_filter( $content ){
        $positions = 'bottom';       
        // You can use below filter to choose where to display the Love it button
        $positions = apply_filters( 'wpli/position', $positions );
        $auto      = apply_filters( 'wpli/autoadd', true );
        
        $topBtn = $bottomBtn  = '';

        if ( $auto == true ) {
            if ( $positions == 'top' ) {
                $topBtn = $this->claps_applause_button_html();
            } elseif ( $positions == 'bottom' ) {
                $bottomBtn = $this->claps_applause_button_html();
            }
        }
        return $topBtn . $content . $bottomBtn;

    }

    /**
     * Add the support for shortcode of [wp_claps_applause]
     *
     * @author wowthemesnet
     * @since 1.0.0
     *
     */
    public function wp_claps_applause_shortcode() {
        return $this->claps_applause_button_html();
    }

    /**
     * Clapse Applause function
     *
     *
     * @author wowthemesnet
     * @since 1.0.0
     *
     */
    public function pt_claps_applause() {

        $data   = array(
            'status'    => false,
            'message'   => '',
        );

        $post_id        = $_POST['post_id'];
        $nonce_action   = 'wpli-'.$post_id;

        // Don’t use a nonce on the front end for non-logged in users
        // if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], $nonce_action ) ) {

            $claps = get_post_meta( $_POST['post_id'], '_pt_claps', true );
            $claps = ( empty( $claps ) ) ? 0 : $claps;
            $new_claps = $claps + 1;

            if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {

                update_post_meta( $_POST['post_id'], '_pt_claps', $new_claps );
                $data['status'] = true;
                $data['message'] = $new_claps;

            } else {
                
                $data['status'] = false;
                $data['message'] = __( 'An error is found, please try again later.', $this->plugin_name );
            }

        /*} else {

            $data['status'] = false;
            $data['message'] = __( 'No naughty business please.', $this->plugin_name );
        }*/

        echo json_encode($data);
        die();
    }

    /**
     * Enqueue Assets
     *
     * Adds the scripts and styles needed for the plugin to work. wp_localize_script() is used to add translations to our
     * javascript and to pass the admin ajax url.
     *
     * @author wowthemesnet
     * @since 1.0.0
     *
     */
    public function pt_claps_applause_scripts() {

            wp_enqueue_style( 'claps-applause', trailingslashit( plugin_dir_url( __FILE__ ) ).'css/claps-applause.css' );
            
            if ( ! wp_script_is( 'jquery', 'enqueued' )) {
                wp_enqueue_script( 'jquery' ); // Comment this line if you theme has already loaded jQuery
            }
            wp_enqueue_script( 'jquery-cookie', trailingslashit( plugin_dir_url( __FILE__ ) ).'js/js.cookie.js', array('jquery'), '2.1.1', true);
            wp_enqueue_script( 'wp-claps-applause', trailingslashit( plugin_dir_url( __FILE__ ) ).'js/claps-applause.js', array('jquery'), $this->version, true );

            wp_localize_script( 'wp-claps-applause', 'clapsapplause', array(
                'ajax_url'  => admin_url( 'admin-ajax.php' ),
                'lovedText' => '',
                'loveText' => '',
            ));
    }
}