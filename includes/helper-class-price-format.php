<?php

/**
 * This class is responsible for the price and its format management.
 *
 * @link       http://themeforest.net/user/PearlThemes
 * @since      1.0.0
 *
 * @package    Pearl_Price_Format
 * @subpackage Pearl_Price_Format/includes
 */
class Pearl_Price_Format {


	/**
	 * Instance variable for singleton pattern
	 *
	 * @var object class instance
	 */
	private static $instance = null;
	/**
	 * Contains plugin price format options value
	 *
	 * @var mixed|void $price_format_options Contains price format options value.
	 */
	protected $price_format_options;

	/**
	 * Define the $price_format_options and $url_slugs_options
	 *
	 * @since    1.0.0
	 */
	private function __construct() {

		$this->price_format_options['currency_sign']      = get_option( 'pearl_currency_sign', '$' );
		$this->price_format_options['currency_position']  = get_option( 'pearl_currency_position', 'before' );
		$this->price_format_options['thousand_separator'] = get_option( 'pearl_thousands_separator', ',' );
		$this->price_format_options['decimal_separator']  = get_option( 'pearl_decimal_separator', '.' );
		$this->price_format_options['number_of_decimals'] = get_option( 'pearl_decimal_point', '0' );
		$this->price_format_options['empty_price_text']   = get_option( 'pearl_empty_price_text', esc_html__( 'Empty Price Text', 'pearl-homefind' ) );

	}

	/**
	 * Return class instance
	 *
	 * @return Pearl_Price_Format|null
	 */
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function get_currency_sign() {
		$this->refresh();
		if ( isset( $this->price_format_options['currency_sign'] ) ) {
			return $this->price_format_options['currency_sign'];
		}

		return '$';
	}

	private function refresh() {
		if ( function_exists( 'icl_object_id' ) ) {
			// re-read only for WPML
			$this->price_format_options = get_option( 'pearl_price_format_option' );

		}
	}

	public function get_currency_position() {
		if ( isset( $this->price_format_options['currency_position'] ) ) {
			return $this->price_format_options['currency_position'];
		}

		return 'before';
	}

	public function get_thousand_separator() {
		if ( isset( $this->price_format_options['thousand_separator'] ) ) {
			return $this->price_format_options['thousand_separator'];
		}

		return ',';
	}

	public function get_decimal_separator() {
		if ( isset( $this->price_format_options['decimal_separator'] ) ) {
			return $this->price_format_options['decimal_separator'];
		}

		return '.';
	}

	public function get_number_of_decimals() {
		if ( isset( $this->price_format_options['number_of_decimals'] ) ) {
			return intval( $this->price_format_options['number_of_decimals'] );
		}

		return 2;
	}

	public function get_empty_price_text() {
		$this->refresh();
		if ( isset( $this->price_format_options['empty_price_text'] ) ) {
			return $this->price_format_options['empty_price_text'];
		}

		return null;
	}

}
