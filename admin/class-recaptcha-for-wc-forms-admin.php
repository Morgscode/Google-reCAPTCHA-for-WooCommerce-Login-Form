<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://luke-morgan.com
 * @since      1.0.0
 *
 * @package    Recaptcha_For_Wc_Forms
 * @subpackage Recaptcha_For_Wc_Forms/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Recaptcha_For_Wc_Forms
 * @subpackage Recaptcha_For_Wc_Forms/admin
 * @author     Luke Morgan <hello@spaced-web.xyz>
 */
class Recaptcha_For_Wc_Forms_Admin
{

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/recaptcha-for-wc-forms-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

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

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/recaptcha-for-wc-forms-admin.js', array('jquery'), $this->version, false);
	}

	public final function lwmd_recaptcha_validation_register_errors(WP_Error $errors, string $login, string $email)
	{
		if (empty($_POST['g-recaptcha-response'])) {
			$errors->add('registerfail', __('<strong>PROVE YOU\'RE HUMAN</strong>: You must fill in the captcha challenge!'));
		} else {
			$valid_captcha = $this->lmwd_validate_recaptcha($_POST['g-recaptcha-response']);

			if (!$valid_captcha) {
				$errors->add('registerfail', __('<strong>PROVE YOU\'RE HUMAN</strong>: You must successfuly complete the captcha challenge!'));
			}
		}
		return $errors;
	}

	public final function lmwd_validate_recaptcha(string $captcha)
	{
		$valid = false;
		$secret = get_option('lmwd_recaptcha_secret_key');
		$response = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', [
			'method' => 'POST',
			'httpversion' => '1.0',
			'body' => [
				'secret'   => $secret,
				'response' => $captcha,
			],
		]);

		if (is_wp_error($response)) {
			return $valid = false;
		}

		if (wp_remote_retrieve_response_code($response) !== 200) {
			return $valid = false;
		}

		$body = json_decode(wp_remote_retrieve_body($response));

		if ($body->success === true) {
			$valid = true;
		}

		return $valid;
	}

	public final function lmwd_register_admin_settings()
	{
		register_setting('general', 'lmwd_recaptcha_site_key');
		register_setting('general', 'lmwd_recaptcha_secret_key');
	}

	public final function lmwd_add_admin_settings_fields()
	{
		add_settings_field('lmwd_recaptcha_site_key', 'reCaptcha site key', array($this, 'lmwd_recaptcha_site_key_field_html'), 'general', 'default', array('label_for' => 'lmwd_recaptcha_site_key'));
		add_settings_field('lmwd_recaptcha_secret_key', 'reCaptcha secret key', array($this, 'lmwd_recaptcha_secret_key_field_html'), 'general', 'default', array('label_for' => 'lmwd_recaptcha_secret_key'));
	}

	public final function lmwd_recaptcha_site_key_field_html()
	{
		$key = get_option('lmwd_recaptcha_site_key');
?>
		<input type="password" name="lmwd_recaptcha_site_key" id="lmwd_recaptcha_site_key" value="<?php echo esc_attr($key); ?>" />
	<?php
	}

	public final function lmwd_recaptcha_secret_key_field_html()
	{
		$key = get_option('lmwd_recaptcha_secret_key');
	?>
		<input type="password" name="lmwd_recaptcha_secret_key" id="lmwd_recaptcha_secret_key" value="<?php echo esc_attr($key); ?>" />
<?php
	}
}
