<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://themeforest.net/user/pearlthemes/portfolio
 * @since      1.0.0
 *
 * @package    Real_Estate_Properties
 * @subpackage Real_Estate_Properties/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Real_Estate_Properties
 * @subpackage Real_Estate_Properties/includes
 * @author     Pearl Themes <hello@pearlthemes.com>
 */
class Real_Estate_Properties_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'real-estate-properties',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
