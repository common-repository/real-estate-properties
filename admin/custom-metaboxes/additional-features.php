<?php
/**
 *  This class is responsible for the property additional features metabox.
 *
 * @link       https://themeforest.net/user/pearlthemes/portfolio
 * @since      1.0.0
 *
 * @package    Real_Estate_Properties
 * @subpackage Real_Estate_Properties/admin/custom-metaboxes
 * @author     Pearl Themes <hello@pearlthemes.com>
 */

class Additional_Features_Meta_Box {

	// A reference to the single instance of this class.
	private static $instance = null;

	// Represents the nonce value used to save the post media.
	private $nonce = 'pearl_additional_features_nonce';

	/**
	 * Provides access to a single instance of this class.
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;

	}


	/**
	 * Sets up JavaScript, and displays the meta box
	 */
	private function __construct() {

		// enqueue related css and js.
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

		// setup the metabox hooks.
		add_action( 'add_meta_boxes', array( $this, 'add_additional_features_metabox' ) );
		add_action( 'save_post', array( $this, 'save_additional_features' ) );

	}


	/**
	 * Provides related css
	 */
	public function register_admin_styles() {

		wp_enqueue_style( 'pearl-admin-metabox-styles', plugin_dir_url( __FILE__ ) . '../css/admin-metaboxes.css', array(), '1.0' );

	}

	/**
	 * Provides related javascript
	 */
	public function register_admin_scripts() {

		wp_enqueue_script( 'pearl-admin-metabox-script', plugin_dir_url( __FILE__ ) . '../js/admin-metaboxes.js', array(
			'jquery',
			'jquery-ui-sortable',
		), '1.0' );

	}

	/**
	 * Call core function and call back to generate user interface
	 */
	public function add_additional_features_metabox() {

		add_meta_box( 'additional-features-meta-box', esc_html__( 'Additional Features', 'real-estate-properties' ), array(
			$this,
			'display_additional_features',
		), 'property', 'normal', 'core' );

	}

	/**
	 * Provides user interface
	 */
	public function display_additional_features( $post ) {

		// nonce field for better security.
		wp_nonce_field( 'pearl_additional_features_metabox', $this->nonce );

		?>
		<div class="pearl-features-wrapper">

			<div class="pearl-feature labels">
				<div class="pearl-feature-control">&nbsp;</div>
				<div class="pearl-feature-title"><label><?php esc_html_e( 'Title', 'real-estate-properties' ); ?></label></div>
				<div class="pearl-feature-value"><label><?php esc_html_e( 'Value', 'real-estate-properties' ); ?></label></div>
				<div class="pearl-feature-control">&nbsp;</div>
			</div>

			<!-- additional features container -->
			<div id="pearl-additional-features-container">
				<?php
					// output existing features.
					$additional_features = get_post_meta( $post->ID, 'pearl_additional_features', true );

					// get status if published once.
					$published_one = get_post_meta( $post->ID, 'pearl_is_published', true );

					// if not published once then apply the 'pearl_additional_features' hook.
					if ( 'yes' !== $published_one ) {
						$default_features = apply_filters( 'pearl_default_property_additional_features', array() );
					}


					if ( ! empty( $additional_features ) ) {

						foreach ( $additional_features as $title => $value ) {
							?>
							<div class="pearl-feature inputs">
								<div class="pearl-feature-control">
									<span class="sort-feature dashicons dashicons-menu"></span>
								</div>
								<div class="pearl-feature-title">
									<input type="text" name="feature-titles[]" value="<?php echo esc_attr( $title ); ?>"/>
								</div>
								<div class="pearl-feature-value">
									<input type="text" name="feature-values[]" value="<?php echo esc_attr( $value ); ?>"/>
								</div>
								<div class="pearl-feature-control">
									<a class="remove-feature" href="#"><span class="dashicons dashicons-dismiss"></span></a>
								</div>
							</div>
							<?php
						}
					} elseif ( ! empty( $default_features ) ) {

						foreach ( $default_features as $title => $value ) {
							?>
							<div class="pearl-feature inputs">
								<div class="pearl-feature-control">
									<span class="sort-feature dashicons dashicons-menu"></span>
								</div>
								<div class="pearl-feature-title">
									<input type="text" name="feature-titles[]" value="<?php echo esc_attr( $title ); ?>"/>
								</div>
								<div class="pearl-feature-value">
									<input type="text" name="feature-values[]" value="<?php echo esc_attr( $value ); ?>"/>
								</div>
								<div class="pearl-feature-control">
									<a class="remove-feature" href="#"><span class="dashicons dashicons-dismiss"></span></a>
								</div>
							</div>
							<?php
						}
					} else {
						?>
						<div class="pearl-feature inputs">
							<div class="pearl-feature-control">
								<span class="sort-feature dashicons dashicons-menu"></span>
							</div>
							<div class="pearl-feature-title">
								<input type="text" name="feature-titles[]" value=""/>
							</div>
							<div class="pearl-feature-value">
								<input type="text" name="feature-values[]" value=""/>
							</div>
							<div class="pearl-feature-control">
								<a class="remove-feature" href="#"><span class="dashicons dashicons-dismiss"></span></a>
							</div>
						</div>
						<?php
					}
				?>
			</div><!-- end of additional features container -->

			<div class="pearl-feature">
				<div class="pearl-feature-control">&nbsp;</div>
				<div class="pearl-feature-control">
					<a class="add-feature" href="#"><span class="dashicons dashicons-plus-alt"></span></a>
				</div>
			</div>

		</div>
		<?php

	}

	/**
	 * Updated additional features information
	 *
	 * @param    int $post_id The ID of the post being saved.
	 */
	public function save_additional_features( $post_id ) {

		// First, make sure the user can save the post.
		if ( $this->user_can_save( $post_id, $this->nonce ) ) {

			$published_once = get_post_meta( $post_id, 'pearl_is_published', true );

			// Check if 'pearl_is_published' meta value is empty.
			if ( empty( $published_once ) ) {

				$published_once = 'yes';
			}

			// Store pearl_is_published value when first time published/updated.
			update_post_meta( $post_id, 'pearl_is_published', $published_once );

			if ( isset( $_POST['feature-titles'] ) && isset( $_POST['feature-values'] ) ) {

				$additional_features_titles = $_POST['feature-titles'];
				$additional_features_values = $_POST['feature-values'];

				// data sanitization.
				$additional_features_titles = array_map( 'sanitize_text_field', $additional_features_titles );
				$additional_features_titles = array_map( 'stripslashes', $additional_features_titles );

				$additional_features_values = array_map( 'sanitize_text_field', $additional_features_values );
				$additional_features_values = array_map( 'stripslashes', $additional_features_values );

				if ( ! empty( $additional_features_titles ) && ! empty( $additional_features_values ) ) {

					$additional_features = array_combine( $additional_features_titles, $additional_features_values );
					$additional_features = array_filter( $additional_features );  // remove empty values.
					if ( ! empty( $additional_features ) ) {
						update_post_meta( $post_id, 'pearl_additional_features', $additional_features );

						return;
					}
				}
			}
			// remove additional features.
			delete_post_meta( $post_id, 'pearl_additional_features' );

		}

	}

	/**
	 * Determines whether or not the current user has the ability to save meta data associated with this post.
	 *
	 * @param integer $post_id The ID of the post being save.
	 * @param string $nonce    nonce for verification.
	 *
	 * @return bool returns true or false based on current user ability and nonce verification.
	 */
	public function user_can_save( $post_id, $nonce ) {

		$is_autosave    = wp_is_post_autosave( $post_id );
		$is_revision    = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ $nonce ] ) && wp_verify_nonce( $_POST[ $nonce ], 'pearl_additional_features_metabox' ) );

		// Return true if the user is able to save; otherwise, false.
		return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;

	}

} // end class

// Get an instance of the class.
Additional_Features_Meta_Box::get_instance();
