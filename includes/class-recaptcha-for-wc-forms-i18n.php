<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://luke-morgan.com
 * @since      1.0.0
 *
 * @package    Recaptcha_For_Wc_Forms
 * @subpackage Recaptcha_For_Wc_Forms/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Recaptcha_For_Wc_Forms
 * @subpackage Recaptcha_For_Wc_Forms/includes
 * @author     Luke Morgan <hello@spaced-web.xyz>
 */
class Recaptcha_For_Wc_Forms_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'recaptcha-for-wc-forms',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
