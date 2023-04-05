<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://luke-morgan.com
 * @since      1.0.0
 *
 * @package    Recaptcha_For_Wc_Forms
 * @subpackage Recaptcha_For_Wc_Forms/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Recaptcha_For_Wc_Forms
 * @subpackage Recaptcha_For_Wc_Forms/public
 * @author     Luke Morgan <hello@spaced-web.xyz>
 */
class Recaptcha_For_Wc_Forms_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Recaptcha_For_Wc_Forms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Recaptcha_For_Wc_Forms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/recaptcha-for-wc-forms-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Recaptcha_For_Wc_Forms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Recaptcha_For_Wc_Forms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/recaptcha-for-wc-forms-public.js', array( 'jquery' ), $this->version, false );

	}

	public final function lmwd_output_recaptcha_html()
    {
        if (is_checkout()) : 
			$key = get_option('lmwd_recaptcha_site_key');
		?>
            <div class="recaptcha-group">
                <div class="recaptcha-msg"></div>
                <div class="g-recaptcha js-recaptcha-el" data-sitekey="<?php echo esc_attr($key); ?>"></div>
            </div>
        <?php
        endif;
    }

}
