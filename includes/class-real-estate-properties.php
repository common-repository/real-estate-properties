<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://themeforest.net/user/pearlthemes/portfolio
 * @since      1.0.0
 *
 * @package    Real_Estate_Properties
 * @subpackage Real_Estate_Properties/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Real_Estate_Properties
 * @subpackage Real_Estate_Properties/includes
 * @author     Pearl Themes <hello@pearlthemes.com>
 */
class Real_Estate_Properties {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Real_Estate_Properties_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'REAL_ESTATE_PROPERTIES_VERSION' ) ) {
			$this->version = REAL_ESTATE_PROPERTIES_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'real-estate-properties';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Real_Estate_Properties_Loader. Orchestrates the hooks of the plugin.
	 * - Real_Estate_Properties_i18n. Defines internationalization functionality.
	 * - Real_Estate_Properties_Admin. Defines all hooks for the admin area.
	 * - Real_Estate_Properties_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-real-estate-properties-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-real-estate-properties-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-real-estate-properties-admin.php';

		/**
		 * The class responsible for the instance of property to render its data
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-property-post-type.php';

		/**
		 * This class is responsible for the price and its format management.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/helper-class-price-format.php';

		/**
		 * This class responsible for defining all actions and stuff related to the property.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/helper-class-property.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-real-estate-properties-public.php';

		$this->loader = new Real_Estate_Properties_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Real_Estate_Properties_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Real_Estate_Properties_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Real_Estate_Properties_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// initiating property post type
		$property_cpt = new Pearl_Property_Post_Type();
		$this->loader->add_action( 'init', $property_cpt, 'register_property_post_type' );
		$this->loader->add_action( 'init', $property_cpt, 'register_location_taxonomy' );
		$this->loader->add_action( 'init', $property_cpt, 'register_status_taxonomy' );
		$this->loader->add_action( 'init', $property_cpt, 'register_type_taxonomy' );
		$this->loader->add_action( 'init', $property_cpt, 'register_feature_taxonomy' );
		$this->loader->add_filter( 'rwmb_meta_boxes', $property_cpt, 'register_meta_boxes' );
		$this->loader->add_filter( 'manage_property_posts_columns', $property_cpt, 'edit_property_columns' );
		$this->loader->add_filter( 'manage_pages_custom_column', $property_cpt, 'property_custom_columns' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Real_Estate_Properties_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Real_Estate_Properties_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
