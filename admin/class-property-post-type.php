<?php
/**
 * This class is responsible for the property post type
 * and related stuff. E.g: property taxonomies, metadata
 *
 * @since      1.0.0
 * @package    Real_Estate_Proerperties
 * @subpackage Real_Estate_Proerperties/admin
 * @author     PearlThemes <hello@pearlthemes.com>
 */

class Pearl_Property_Post_Type {

	// Register Property Post Type
	function register_property_post_type() {

		$labels = array(
			'name'                  => esc_html_x( 'Properties', 'Post Type General Name', 'real-estate-properties' ),
			'singular_name'         => esc_html_x( 'Property', 'Post Type Singular Name', 'real-estate-properties' ),
			'menu_name'             => esc_html__( 'Properties', 'real-estate-properties' ),
			'name_admin_bar'        => esc_html__( 'Property', 'real-estate-properties' ),
			'archives'              => esc_html__( 'Property Archives', 'real-estate-properties' ),
			'attributes'            => esc_html__( 'Property Attributes', 'real-estate-properties' ),
			'parent_item_colon'     => esc_html__( 'Parent Property:', 'real-estate-properties' ),
			'all_items'             => esc_html__( 'All Properties', 'real-estate-properties' ),
			'add_new_item'          => esc_html__( 'Add New Property', 'real-estate-properties' ),
			'add_new'               => esc_html__( 'Add New', 'real-estate-properties' ),
			'new_item'              => esc_html__( 'New Property', 'real-estate-properties' ),
			'edit_item'             => esc_html__( 'Edit Property', 'real-estate-properties' ),
			'update_item'           => esc_html__( 'Update Property', 'real-estate-properties' ),
			'view_item'             => esc_html__( 'View Property', 'real-estate-properties' ),
			'view_items'            => esc_html__( 'View Properties', 'real-estate-properties' ),
			'search_items'          => esc_html__( 'Search Property', 'real-estate-properties' ),
			'not_found'             => esc_html__( 'Not found', 'real-estate-properties' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'real-estate-properties' ),
			'featured_image'        => esc_html__( 'Featured Image', 'real-estate-properties' ),
			'set_featured_image'    => esc_html__( 'Set featured image', 'real-estate-properties' ),
			'remove_featured_image' => esc_html__( 'Remove featured image', 'real-estate-properties' ),
			'use_featured_image'    => esc_html__( 'Use as featured image', 'real-estate-properties' ),
			'insert_into_item'      => esc_html__( 'Insert into Property', 'real-estate-properties' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this property', 'real-estate-properties' ),
			'items_list'            => esc_html__( 'Properties list', 'real-estate-properties' ),
			'items_list_navigation' => esc_html__( 'Properties list navigation', 'real-estate-properties' ),
			'filter_items_list'     => esc_html__( 'Filter properties list', 'real-estate-properties' ),
		);
		$args   = array(
			'label'               => esc_html__( 'Property', 'real-estate-properties' ),
			'description'         => esc_html__( 'A real estate listing that allows users to publish their properties.', 'real-estate-properties' ),
			'labels'              => $labels,
			'supports'            => array(
				'title',
				'editor',
				'thumbnail',
				'author',
				'revisions',
				'comments',
				'page-attributes'
			),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-building',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
		);
		$args = apply_filters('pearl_property_post_type_args', $args);
		register_post_type( 'property', $args );
	}

	// register locations taxonomy
	function register_location_taxonomy() {

		$labels = array(
			'name'                       => esc_html_x( 'Property Locations', 'Taxonomy General Name', 'real-estate-properties' ),
			'singular_name'              => esc_html_x( 'Property Location', 'Taxonomy Singular Name', 'real-estate-properties' ),
			'menu_name'                  => esc_html__( 'Locations', 'real-estate-properties' ),
			'all_items'                  => esc_html__( 'All Property Locations', 'real-estate-properties' ),
			'parent_item'                => esc_html__( 'Parent Property Location', 'real-estate-properties' ),
			'parent_item_colon'          => esc_html__( 'Parent Property Location:', 'real-estate-properties' ),
			'new_item_name'              => esc_html__( 'New Property Location Name', 'real-estate-properties' ),
			'add_new_item'               => esc_html__( 'Add New Property Location', 'real-estate-properties' ),
			'edit_item'                  => esc_html__( 'Edit Property Location', 'real-estate-properties' ),
			'update_item'                => esc_html__( 'Update Property Location', 'real-estate-properties' ),
			'view_item'                  => esc_html__( 'View Property Location', 'real-estate-properties' ),
			'separate_items_with_commas' => esc_html__( 'Separate property locations with commas', 'real-estate-properties' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove property locations', 'real-estate-properties' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'real-estate-properties' ),
			'popular_items'              => esc_html__( 'Popular Property Locations', 'real-estate-properties' ),
			'search_items'               => esc_html__( 'Search Property Locations', 'real-estate-properties' ),
			'not_found'                  => esc_html__( 'Not Found', 'real-estate-properties' ),
			'no_terms'                   => esc_html__( 'No items', 'real-estate-properties' ),
			'items_list'                 => esc_html__( 'Property Locations list', 'real-estate-properties' ),
			'items_list_navigation'      => esc_html__( 'Property Locations list navigation', 'real-estate-properties' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'show_in_rest'      => false,
		);
		register_taxonomy( 'property-location', array( 'property' ), $args );

	}

	// register status taxonomy
	function register_status_taxonomy() {

		$labels = array(
			'name'                       => esc_html_x( 'Property Statuses', 'Taxonomy General Name', 'real-estate-properties' ),
			'singular_name'              => esc_html_x( 'Property Status', 'Taxonomy Singular Name', 'real-estate-properties' ),
			'menu_name'                  => esc_html__( 'Statuses', 'real-estate-properties' ),
			'all_items'                  => esc_html__( 'All Property Statuses', 'real-estate-properties' ),
			'parent_item'                => esc_html__( 'Parent Property Status', 'real-estate-properties' ),
			'parent_item_colon'          => esc_html__( 'Parent Property Status:', 'real-estate-properties' ),
			'new_item_name'              => esc_html__( 'New Property Status Name', 'real-estate-properties' ),
			'add_new_item'               => esc_html__( 'Add New Property Status', 'real-estate-properties' ),
			'edit_item'                  => esc_html__( 'Edit Property Status', 'real-estate-properties' ),
			'update_item'                => esc_html__( 'Update Property Status', 'real-estate-properties' ),
			'view_item'                  => esc_html__( 'View Property Status', 'real-estate-properties' ),
			'separate_items_with_commas' => esc_html__( 'Separate property statuses with commas', 'real-estate-properties' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove property statuses', 'real-estate-properties' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'real-estate-properties' ),
			'popular_items'              => esc_html__( 'Popular Property Statuses', 'real-estate-properties' ),
			'search_items'               => esc_html__( 'Search Property Statuses', 'real-estate-properties' ),
			'not_found'                  => esc_html__( 'Not Found', 'real-estate-properties' ),
			'no_terms'                   => esc_html__( 'No items', 'real-estate-properties' ),
			'items_list'                 => esc_html__( 'Property Statuses list', 'real-estate-properties' ),
			'items_list_navigation'      => esc_html__( 'Property Statuses list navigation', 'real-estate-properties' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'show_in_rest'      => false,
		);
		register_taxonomy( 'property-status', array( 'property' ), $args );

	}

	// register type taxonomy
	function register_type_taxonomy() {

		$labels = array(
			'name'                       => esc_html_x( 'Property Types', 'Taxonomy General Name', 'real-estate-properties' ),
			'singular_name'              => esc_html_x( 'Property Type', 'Taxonomy Singular Name', 'real-estate-properties' ),
			'menu_name'                  => esc_html__( 'Types', 'real-estate-properties' ),
			'all_items'                  => esc_html__( 'All Property Types', 'real-estate-properties' ),
			'parent_item'                => esc_html__( 'Parent Property Type', 'real-estate-properties' ),
			'parent_item_colon'          => esc_html__( 'Parent Property Type:', 'real-estate-properties' ),
			'new_item_name'              => esc_html__( 'New Property Type Name', 'real-estate-properties' ),
			'add_new_item'               => esc_html__( 'Add New Property Type', 'real-estate-properties' ),
			'edit_item'                  => esc_html__( 'Edit Property Type', 'real-estate-properties' ),
			'update_item'                => esc_html__( 'Update Property Type', 'real-estate-properties' ),
			'view_item'                  => esc_html__( 'View Property Type', 'real-estate-properties' ),
			'separate_items_with_commas' => esc_html__( 'Separate property types with commas', 'real-estate-properties' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove property types', 'real-estate-properties' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'real-estate-properties' ),
			'popular_items'              => esc_html__( 'Popular Property Types', 'real-estate-properties' ),
			'search_items'               => esc_html__( 'Search Property Types', 'real-estate-properties' ),
			'not_found'                  => esc_html__( 'Not Found', 'real-estate-properties' ),
			'no_terms'                   => esc_html__( 'No items', 'real-estate-properties' ),
			'items_list'                 => esc_html__( 'Property Types list', 'real-estate-properties' ),
			'items_list_navigation'      => esc_html__( 'Property Types list navigation', 'real-estate-properties' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'show_in_rest'      => false,
		);
		register_taxonomy( 'property-type', array( 'property' ), $args );

	}

	// register feature taxonomy
	function register_feature_taxonomy() {

		$labels = array(
			'name'                       => esc_html_x( 'Property Features', 'Taxonomy General Name', 'real-estate-properties' ),
			'singular_name'              => esc_html_x( 'Property Feature', 'Taxonomy Singular Name', 'real-estate-properties' ),
			'menu_name'                  => esc_html__( 'Features', 'real-estate-properties' ),
			'all_items'                  => esc_html__( 'All Property Features', 'real-estate-properties' ),
			'parent_item'                => esc_html__( 'Parent Property Feature', 'real-estate-properties' ),
			'parent_item_colon'          => esc_html__( 'Parent Property Feature:', 'real-estate-properties' ),
			'new_item_name'              => esc_html__( 'New Property Feature Name', 'real-estate-properties' ),
			'add_new_item'               => esc_html__( 'Add New Property Feature', 'real-estate-properties' ),
			'edit_item'                  => esc_html__( 'Edit Property Feature', 'real-estate-properties' ),
			'update_item'                => esc_html__( 'Update Property Feature', 'real-estate-properties' ),
			'view_item'                  => esc_html__( 'View Property Feature', 'real-estate-properties' ),
			'separate_items_with_commas' => esc_html__( 'Separate property features with commas', 'real-estate-properties' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove property features', 'real-estate-properties' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'real-estate-properties' ),
			'popular_items'              => esc_html__( 'Popular Property Features', 'real-estate-properties' ),
			'search_items'               => esc_html__( 'Search Property Features', 'real-estate-properties' ),
			'not_found'                  => esc_html__( 'Not Found', 'real-estate-properties' ),
			'no_terms'                   => esc_html__( 'No items', 'real-estate-properties' ),
			'items_list'                 => esc_html__( 'Property Features list', 'real-estate-properties' ),
			'items_list_navigation'      => esc_html__( 'Property Features list navigation', 'real-estate-properties' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'show_in_rest'      => false,
		);
		register_taxonomy( 'property-feature', array( 'property' ), $args );

	}

	/**
	 * Register meta boxes related to property post type
	 *
	 * @param   array $meta_boxes
	 *
	 * @since   1.0.0
	 * @return  array   $meta_boxes
	 */
	public function register_meta_boxes( $meta_boxes ) {

		$prefix = 'pearl_';


		$agents_options = array(
			- 1 => esc_html__( 'None', 'real-estate-properties' ),
		);

		$agents_posts = get_posts(
			array(
				'post_type'        => 'agent',
				'posts_per_page'   => - 1,
				'suppress_filters' => 0,
			)
		);

		if ( count( $agents_posts ) > 0 ) {
			foreach ( $agents_posts as $agent_post ) {
				$agents_options[ $agent_post->ID ] = $agent_post->post_title;
			}
		}

		$meta_boxes[] = array(
			'id'        => 'property-meta-box',
			'title'     => esc_html__( 'Property', 'real-estate-properties' ),
			'pages'     => array( 'property' ),
			'tabs'      => array(
				'details'     => array(
					'label' => esc_html__( 'Basic Information', 'real-estate-properties' ),
					'icon'  => 'dashicons-admin-home',
				),
				'gallery'     => array(
					'label' => esc_html__( 'Gallery Images', 'real-estate-properties' ),
					'icon'  => 'dashicons-format-gallery',
				),
				'floor-plans' => array(
					'label' => esc_html__( 'Floor Plans', 'real-estate-properties' ),
					'icon'  => 'dashicons-layout',
				),
				'video'       => array(
					'label' => esc_html__( 'Property Video', 'real-estate-properties' ),
					'icon'  => 'dashicons-format-video',
				),
				'agent'       => array(
					'label' => esc_html__( 'Agent Information', 'real-estate-properties' ),
					'icon'  => 'dashicons-businessman',
				),
				'misc'        => array(
					'label' => esc_html__( 'Misc', 'real-estate-properties' ),
					'icon'  => 'dashicons-lightbulb',
				),
				'home-slider' => array(
					'label' => esc_html__( 'Homepage Slider', 'real-estate-properties' ),
					'icon'  => 'dashicons-images-alt',
				),
//				'banner'      => array(
//					'label' => esc_html__( 'Top Banner', 'real-estate-properties' ),
//					'icon'  => 'dashicons-format-image',
//				),
			),
			'tab_style' => 'left',
			'fields'    => array(

				// Details
				array(
					'id'      => "{$prefix}price",
					'name'    => esc_html__( 'Sale or Rent Price ( Only digits )', 'real-estate-properties' ),
					'desc'    => esc_html__( 'Example Value: 787000', 'real-estate-properties' ),
					'type'    => 'text',
					'std'     => "",
					'columns' => 6,
					'tab'     => 'details',
				),
				array(
					'id'      => "{$prefix}price_postfix",
					'name'    => esc_html__( 'Price Postfix', 'real-estate-properties' ),
					'desc'    => esc_html__( 'Example Value: Per Month', 'real-estate-properties' ),
					'type'    => 'text',
					'std'     => "",
					'columns' => 6,
					'tab'     => 'details',
				),
				array(
					'id'      => "{$prefix}size",
					'name'    => esc_html__( 'Area Size ( Only digits )', 'real-estate-properties' ),
					'desc'    => esc_html__( 'Example Value: 2500', 'real-estate-properties' ),
					'type'    => 'text',
					'std'     => "",
					'columns' => 6,
					'tab'     => 'details',
				),
				array(
					'id'      => "{$prefix}size_postfix",
					'name'    => esc_html__( 'Size Postfix', 'real-estate-properties' ),
					'desc'    => esc_html__( 'Example Value: Sq Ft', 'real-estate-properties' ),
					'type'    => 'text',
					'std'     => "",
					'columns' => 6,
					'tab'     => 'details',
				),
				array(
					'id'      => "{$prefix}bedrooms",
					'name'    => esc_html__( 'Bedrooms', 'real-estate-properties' ),
					'desc'    => esc_html__( 'Example Value: 4', 'real-estate-properties' ),
					'type'    => 'text',
					'std'     => "",
					'columns' => 6,
					'tab'     => 'details',
				),
				array(
					'id'      => "{$prefix}bathrooms",
					'name'    => esc_html__( 'Bathrooms', 'real-estate-properties' ),
					'desc'    => esc_html__( 'Example Value: 2', 'real-estate-properties' ),
					'type'    => 'text',
					'std'     => "",
					'columns' => 6,
					'tab'     => 'details',
				),
				array(
					'id'      => "{$prefix}garage",
					'name'    => esc_html__( 'Garages', 'real-estate-properties' ),
					'desc'    => esc_html__( 'Example Value: 1', 'real-estate-properties' ),
					'type'    => 'text',
					'std'     => "",
					'columns' => 6,
					'tab'     => 'details',
				),
				array(
					'id'      => "{$prefix}id",
					'name'    => esc_html__( 'Property ID', 'real-estate-properties' ),
					'desc'    => esc_html__( 'It will help you search a property directly.', 'real-estate-properties' ),
					'type'    => 'text',
					'std'     => "",
					'columns' => 6,
					'tab'     => 'details',
				),


				// Map
				array(
					'type'    => 'divider',
					'columns' => 12,
					'id'      => 'google_map_divider', // Not used, but needed
					'tab'     => 'details',
				),
				array(
					'id'      => "{$prefix}address",
					'name'    => esc_html__( 'Property Address', 'real-estate-properties' ),
					'desc'    => esc_html__( 'Leaving it empty will hide the google map on property detail page.', 'real-estate-properties' ),
					'type'    => 'text',
					// 'std' => 'Miami, FL, USA',
					'columns' => 12,
					'tab'     => 'details',
				),
				array(
					'id'            => "{$prefix}location",
					'name'          => esc_html__( 'Property Location at Google Map*', 'real-estate-properties' ),
					'desc'          => esc_html__( 'Drag the google map marker to point your property location. You can also use the address field above to search for your property.', 'real-estate-properties' ),
					'type'          => 'map',
					'std'           => '25.761680,-80.191790,14',
					// 'latitude,longitude[,zoom]' (zoom is optional)
					'style'         => 'width: 95%; height: 400px',
					'address_field' => "{$prefix}address",
					'columns'       => 12,
					'tab'           => 'details',
				),

				array(
					'name'             => esc_html__( 'Property Gallery Images', 'real-estate-properties' ),
					'id'               => "{$prefix}images",
					'desc'             => 'upload images',
					'type'             => 'image_advanced',
					'max_file_uploads' => 48,
					'columns'          => 12,
					'tab'              => 'gallery',
				),

				// Floor Plans
				array(
					'id'      => "pearl_floor_plans",
					'type'    => 'group',
					'columns' => 12,
					'clone'   => true,
					'tab'     => 'floor-plans',
					'fields'  => array(
						array(
							'name' => esc_html__( 'Floor Name', 'real-estate-properties' ),
							'id'   => "pearl_floor_plan_name",
							'desc' => esc_html__( 'Example: Ground Floor', 'real-estate-properties' ),
							'type' => 'text',
						),
						array(
							'name'    => esc_html__( 'Floor Price ( Only digits )', 'real-estate-properties' ),
							'id'      => "pearl_floor_plan_price",
							'desc'    => esc_html__( 'Example: 4000', 'real-estate-properties' ),
							'type'    => 'text',
							'columns' => 6,
						),
						array(
							'name'    => esc_html__( 'Price Postfix', 'real-estate-properties' ),
							'id'      => "pearl_floor_plan_price_postfix",
							'desc'    => esc_html__( 'Example: Per Month', 'real-estate-properties' ),
							'type'    => 'text',
							'columns' => 6,
						),
						array(
							'name'    => esc_html__( 'Floor Size ( Only digits )', 'real-estate-properties' ),
							'id'      => "pearl_floor_plan_size",
							'desc'    => esc_html__( 'Example: 2500', 'real-estate-properties' ),
							'type'    => 'text',
							'columns' => 6,
						),
						array(
							'name'    => esc_html__( 'Size Postfix', 'real-estate-properties' ),
							'id'      => "pearl_floor_plan_size_postfix",
							'desc'    => esc_html__( 'Example: Sq Ft', 'real-estate-properties' ),
							'type'    => 'text',
							'columns' => 6,
						),
						array(
							'name'    => esc_html__( 'Bedrooms', 'real-estate-properties' ),
							'id'      => "pearl_floor_plan_bedrooms",
							'desc'    => esc_html__( 'Example: 4', 'real-estate-properties' ),
							'type'    => 'text',
							'columns' => 6,
						),
						array(
							'name'    => esc_html__( 'Bathrooms', 'real-estate-properties' ),
							'id'      => "pearl_floor_plan_bathrooms",
							'desc'    => esc_html__( 'Example: 2', 'real-estate-properties' ),
							'type'    => 'text',
							'columns' => 6,
						),
						array(
							'name' => esc_html__( 'Description', 'real-estate-properties' ),
							'id'   => "pearl_floor_plan_description",
							'type' => 'textarea',
						),
						array(
							'name'             => esc_html__( 'Floor Plan Image', 'real-estate-properties' ),
							'id'               => "pearl_floor_plan_image",
							'desc'             => esc_html__( 'The recommended minimum width is 700px and height is flexible.', 'real-estate-properties' ),
							'type'             => 'file_input',
							'max_file_uploads' => 1,
						),
					),
				),

				// Property Video
				array(
					'id'      => "{$prefix}tour_video_url",
					'name'    => esc_html__( 'Virtual Tour Video URL', 'real-estate-properties' ),
					'desc'    => esc_html__( 'Provide virtual tour video URL. YouTube, Vimeo, SWF File and MOV File are supported', 'real-estate-properties' ),
					'type'    => 'text',
					'columns' => 12,
					'tab'     => 'video',
				),
				array(
					'name'             => esc_html__( 'Virtual Tour Video Image', 'real-estate-properties' ),
					'id'               => "{$prefix}tour_video_image",
					'desc'             => 'Set Virtual Tour Video Image',
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
					'columns'          => 12,
					'tab'              => 'video',
				),
				array(
					'id'      => "{$prefix}virtual_tour",
					'name'    => esc_html__( '360 Virtual Tour', 'real-estate-properties' ),
					'desc'    => esc_html__( 'Provide 360 virtual tour code using iframe.', 'real-estate-properties' ),
					'type'    => 'textarea',
					'columns' => 12,
					'tab'     => 'video',
				),

				// Agents
				array(
					'name'    => esc_html__( 'What to display in agent information box ?', 'real-estate-properties' ),
					'id'      => "{$prefix}agent_display_option",
					'type'    => 'radio',
					'std'     => 'none',
					'options' => array(
						'none'        => esc_html__( 'None', 'real-estate-properties' ),
						'author_info' => esc_html__( 'Author', 'real-estate-properties' ),
						'agent_info'  => esc_html__( 'Agent', 'real-estate-properties' ),
					),
					'columns' => 12,
					'tab'     => 'agent',
				),
				array(
					'name'            => esc_html__( 'Select Agent', 'real-estate-properties' ),
					'id'              => "{$prefix}agents",
					'type'            => 'select',
					'options'         => $agents_options,
					'multiple'        => true,
					'select_all_none' => true,
					'columns'         => 12,
					'tab'             => 'agent',
				),
				array(
					'type'    => 'divider',
					'columns' => 12,
					'id'      => 'gdpr_checkbox_divider',
					'tab'     => 'agent',
				),
				array(
					'name'    => esc_html__( 'GDPR checkbox for agent contact form', 'real-estate-properties' ),
					'id'      => "{$prefix}gdpr_checkbox",
					'type' => 'checkbox',
					'std'     => 0,
					'tab'     => 'agent',
				),

				// Misc
				array(
					'name'    => esc_html__( 'Mark this property as featured ?', 'real-estate-properties' ),
					'id'      => "{$prefix}featured",
					'type'    => 'radio',
					'std'     => 0,
					'options' => array(
						1 => esc_html__( 'Yes ', 'real-estate-properties' ),
						0 => esc_html__( 'No', 'real-estate-properties' )
					),
					'columns' => 12,
					'tab'     => 'misc',
				),
				array(
					'id'        => "{$prefix}attachments",
					'name'      => esc_html__( 'Attachments', 'real-estate-properties' ),
					'desc'      => esc_html__( 'You can attach PDF files, Map images OR other documents to provide further details related to property.', 'real-estate-properties' ),
					'type'      => 'file_advanced',
					'mime_type' => '',
					'columns'   => 12,
					'tab'       => 'misc',
				),
				array(
					'id'      => "{$prefix}private_note",
					'name'    => esc_html__( 'Private Note', 'real-estate-properties' ),
					'desc'    => esc_html__( 'In this textarea, You can write your private note about this property. This field will not be displayed anywhere else.', 'real-estate-properties' ),
					'type'    => 'textarea',
					'std'     => "",
					'columns' => 12,
					'tab'     => 'misc',
				),

				// Homepage Slider
				array(
					'name'    => esc_html__( 'Do you want to add this property in Homepage Slider ?', 'real-estate-properties' ),
					'desc'    => esc_html__( 'If Yes, Then you need to provide a slider image below.', 'real-estate-properties' ),
					'id'      => "{$prefix}add_in_slider",
					'type'    => 'radio',
					'std'     => 'no',
					'options' => array(
						'yes' => esc_html__( 'Yes ', 'real-estate-properties' ),
						'no'  => esc_html__( 'No', 'real-estate-properties' )
					),
					'columns' => 12,
					'tab'     => 'home-slider',
				),
				array(
					'name'             => esc_html__( 'Slider Image', 'real-estate-properties' ),
					'id'               => "{$prefix}slider_image",
					'desc'             => 'Please upload the slider image.',
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
					'columns'          => 12,
					'tab'              => 'home-slider',
				),

				// Top Banner
//				array(
//					'name'             => esc_html__( 'Top Banner Image', 'real-estate-properties' ),
//					'id'               => "{$prefix}page_banner_image",
//					'desc'             => esc_html__( 'Upload the banner image, If you want to change it for this property. Otherwise default banner image uploaded from theme options will be displayed. Image should have minimum width of 2000px and minimum height of 230px.', 'real-estate-properties' ),
//					'type'             => 'image_advanced',
//					'max_file_uploads' => 1,
//					'columns'          => 12,
//					'tab'              => 'banner',
//				)
			)
		);

		// apply a filter before returning meta boxes
		$meta_boxes = apply_filters( 'real_estate_property_meta_boxes', $meta_boxes );

		return $meta_boxes;
	}

	/**
	 * Edit Property Custom Post Type Columns
	 *
	 * @param   array $columns
	 *
	 * @since   1.0.0
	 * @return  array $columns
	 */
	public function edit_property_columns( $columns ) {

		$custom_columns = array(
			'cb'                         => '<input type="checkbox" />',
			'title'                      => __( 'Title', 'real-estate-properties' ),
			'photo'                      => __( 'Photo', 'real-estate-properties' ),
			'custom_id'                  => __( 'Property ID', 'real-estate-properties' ),
			'price'                      => __( 'Price', 'real-estate-properties' ),
			'taxonomy-property-type'     => 'Property Types',
			'taxonomy-property-status'   => 'Property Statuses',
			'taxonomy-property-location' => 'Property Locations',
			'date'                       => 'Date',
		);

		return $custom_columns;
	}

	/**
	 * Modify Column Values
	 *
	 * @param   array $column
	 *
	 * @since   1.0.0
	 */
	public function property_custom_columns( $column ) {

		$post_id     = get_the_ID();
		$HF_property = new Pearl_Property();

		switch ( $column ) {
			case 'photo' :
				echo get_the_post_thumbnail( $post_id, 'thumbnail' );
				break;

			case 'custom_id' :
				echo get_post_meta( $post_id, 'pearl_id', true );
				break;

			case 'price' :
				echo $HF_property->get_price();
				break;
		}
	}
}

// include property additional features metabox
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/custom-metaboxes/additional-features.php';