<?php

/**
 * This class is responsible for the custom post types slugs.
 *
 * @link       http://themeforest.net/user/PearlThemes
 * @since      1.0.0
 *
 * @package    Pearl_Post_Type_slugs
 * @subpackage Pearl_Post_Type_slugs/includes
 */
class Pearl_Post_Type_slugs {

	/**
	 * Instance variable for singleton pattern
	 *
	 * @var object class instance
	 */
	private static $instance = null;
	/**
	 * Contains plugin url slugs options value
	 *
	 * @var mixed|void $url_slugs_options Contains url slugs options value.
	 */
	protected $url_slugs_options;

	/**
	 * Define the $price_format_options and $url_slugs_options
	 *
	 * @since    1.0.0
	 */
	private function __construct() {
		$this->url_slugs_options = get_option( 'pearl_url_slugs_option' );
	}

	/**
	 * Return class instance
	 *
	 * @return Pearl_Post_Type_slugs|null
	 */
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function modify_property_slug( $existing_slug ) {
		$property_url_slug = $this->get_property_url_slug();
		if ( $property_url_slug ) {
			return $property_url_slug;
		}

		return $existing_slug;
	}

	public function get_property_url_slug() {
		if ( isset( $this->url_slugs_options['property_url_slug'] ) ) {
			return sanitize_title( $this->url_slugs_options['property_url_slug'] );
		}

		return null;
	}

	public function modify_property_type_slug( $existing_slug ) {
		$property_type_url_slug = $this->get_property_type_url_slug();
		if ( $property_type_url_slug ) {
			return $property_type_url_slug;
		}

		return $existing_slug;
	}

	public function get_property_type_url_slug() {
		if ( isset( $this->url_slugs_options['property_type_url_slug'] ) ) {
			return sanitize_title( $this->url_slugs_options['property_type_url_slug'] );
		}

		return null;
	}

	public function modify_property_status_slug( $existing_slug ) {
		$property_status_url_slug = $this->get_property_status_url_slug();
		if ( $property_status_url_slug ) {
			return $property_status_url_slug;
		}

		return $existing_slug;
	}

	public function get_property_status_url_slug() {
		if ( isset( $this->url_slugs_options['property_status_url_slug'] ) ) {
			return sanitize_title( $this->url_slugs_options['property_status_url_slug'] );
		}

		return null;
	}

	public function modify_property_city_slug( $existing_slug ) {
		$property_city_url_slug = $this->get_property_city_url_slug();
		if ( $property_city_url_slug ) {
			return $property_city_url_slug;
		}

		return $existing_slug;
	}

	public function get_property_city_url_slug() {
		if ( isset( $this->url_slugs_options['property_city_url_slug'] ) ) {
			return sanitize_title( $this->url_slugs_options['property_city_url_slug'] );
		}

		return null;
	}

	public function modify_property_feature_slug( $existing_slug ) {
		$property_feature_url_slug = $this->get_property_feature_url_slug();
		if ( $property_feature_url_slug ) {
			return $property_feature_url_slug;
		}

		return $existing_slug;
	}

	public function get_property_feature_url_slug() {
		if ( isset( $this->url_slugs_options['property_feature_url_slug'] ) ) {
			return sanitize_title( $this->url_slugs_options['property_feature_url_slug'] );
		}

		return null;
	}

	public function modify_agent_slug( $existing_slug ) {
		$agent_url_slug = $this->get_agent_url_slug();
		if ( $agent_url_slug ) {
			return $agent_url_slug;
		}

		return $existing_slug;
	}

	public function get_agent_url_slug() {
		if ( isset( $this->url_slugs_options['agent_url_slug'] ) ) {
			return sanitize_title( $this->url_slugs_options['agent_url_slug'] );
		}

		return null;
	}

}
