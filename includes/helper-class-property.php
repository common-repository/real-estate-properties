<?php

/**
 * This class is responsible for the property metadata supply.
 *
 * @since      1.0.0
 * @package    Real_Estate_Proerperties
 * @subpackage Real_Estate_Proerperties/includes
 * @author     PearlThemes <hello@pearlthemes.com>
 */
class Pearl_Property {

	/**
	 * @var int $property_id contains property post id.
	 */
	private $property_id;

	/**
	 * @var array property meta keys
	 */
	private $meta_keys = array(
		'price'                => 'pearl_price',
		'price_postfix'        => 'pearl_price_postfix',
		'custom_id'            => 'pearl_id',
		'area'                 => 'pearl_size',
		'area_postfix'         => 'pearl_size_postfix',
		'beds'                 => 'pearl_bedrooms',
		'baths'                => 'pearl_bathrooms',
		'garages'              => 'pearl_garage',
		'additional_details'   => 'pearl_additional_details',
		'address'              => 'pearl_address',
		'map_location'         => 'pearl_location',
		'attachments'          => 'pearl_attachments',
		'agent_display_option' => 'pearl_agent_display_option',
		'agent_id'             => 'pearl_agents',
		'featured'             => 'pearl_featured',
		'slider_image'         => 'pearl_slider_image',
		'payment_status'       => 'pearl_payment_status',
		'video_url'            => 'pearl_tour_video_url',
		'video_image'          => 'pearl_tour_video_image',
		'virtual_tour'         => 'pearl_virtual_tour',
	);

	/**
	 * @var array $meta_data contains custom fields data related to a property
	 */
	private $meta_data;


	/**
	 * @param int $property_id
	 */
	public function __construct( $property_id = null ) {

		if ( ! $property_id ) {
			$property_id = get_the_ID();
		} else {
			$property_id = intval( $property_id );
		}

		if ( $property_id > 0 ) {
			$this->property_id = $property_id;
			$this->meta_data   = get_post_custom( $property_id );
		}

	}

	/**
	 * Return property post id
	 * @return bool|mixed
	 */
	public function get_post_ID() {
		return $this->property_id;
	}

	/**
	 * Return property custom id
	 * @return bool|mixed
	 */
	public function get_custom_ID() {
		if ( ! $this->property_id ) {
			return false;
		}

		return $this->get_property_meta( $this->meta_keys['custom_id'] );
	}

	/**
	 * Return property meta
	 *
	 * @param $meta_key
	 *
	 * @return mixed
	 */
	public function get_property_meta( $meta_key ) {
		if ( isset( $this->meta_data[ $meta_key ] ) ) {
			return $this->meta_data[ $meta_key ][0];
		} else {
			return false;
		}
	}

	/**
	 * Return property area
	 * @return bool|mixed
	 */
	public function get_area() {
		if ( ! $this->property_id ) {
			return false;
		}

		return $this->get_property_meta( $this->meta_keys['area'] );
	}

	/**
	 * Return property area postfix
	 * @return bool|mixed
	 */
	public function get_area_postfix() {
		if ( ! $this->property_id ) {
			return false;
		}

		return $this->get_property_meta( $this->meta_keys['area_postfix'] );
	}

	/**
	 * Return property beds
	 * @return bool|mixed
	 */
	public function get_beds() {
		if ( ! $this->property_id ) {
			return false;
		}

		return $this->get_property_meta( $this->meta_keys['beds'] );
	}

	/**
	 * Return property baths
	 * @return bool|mixed
	 */
	public function get_baths() {
		if ( ! $this->property_id ) {
			return false;
		}

		return $this->get_property_meta( $this->meta_keys['baths'] );
	}

	/**
	 * Return property garages
	 * @return bool|mixed
	 */
	public function get_garages() {
		if ( ! $this->property_id ) {
			return false;
		}

		return $this->get_property_meta( $this->meta_keys['garages'] );
	}

	/**
	 * Return is property featured
	 * @return bool|mixed
	 */
	public function is_featured() {
		if ( ! $this->property_id ) {
			return false;
		}

		return $this->get_property_meta( $this->meta_keys['featured'] );
	}

	/**
	 * Return property additional details
	 * @return bool|mixed
	 */
	public function get_additional_details() {
		if ( ! $this->property_id ) {
			return false;
		}

		return maybe_unserialize( $this->get_property_meta( $this->meta_keys['additional_details'] ) );
	}

	/**
	 * Return property address
	 * @return bool|mixed
	 */
	public function get_address() {
		if ( ! $this->property_id ) {
			return false;
		}

		return $this->get_property_meta( $this->meta_keys['address'] );
	}

	/**
	 * Return latitude value
	 * @return bool|string
	 */
	public function get_latitude() {
		$location = $this->get_location();
		if ( $location ) {
			$lat_lng = explode( ',', $location );
			if ( is_array( $lat_lng ) && isset( $lat_lng[0] ) ) {
				return $lat_lng[0];
			}
		}

		return false;
	}

	/**
	 * Return property location, A string containing comma separated values of latitude and longitude
	 * @return bool|mixed
	 */
	public function get_location() {
		if ( ! $this->property_id ) {
			return false;
		}

		return $this->get_property_meta( $this->meta_keys['map_location'] );
	}

	/**
	 * Return longitude value
	 * @return bool|string
	 */
	public function get_longitude() {
		$location = $this->get_location();
		if ( $location ) {
			$lat_lng = explode( ',', $location );
			if ( is_array( $lat_lng ) && isset( $lat_lng[1] ) ) {
				return $lat_lng[1];
			}
		}

		return false;
	}

	/**
	 * Return attachments array
	 * @return bool|mixed
	 */
	public function get_attachments() {
		if ( ! $this->property_id ) {
			return false;
		}
		if ( isset( $this->meta_data[ $this->meta_keys['attachments'] ] ) ) {
			return $this->meta_data[ $this->meta_keys['attachments'] ];
		}

		return false;
	}

	/**
	 * Return number of gallery images
	 * @return string
	 */
	public function get_gallery_count() {
		if ( ! $this->property_id ) {
			return false;
		}

		$gallery_images = get_post_meta( get_the_ID(), 'pearl_images' );
		if ( ! empty( $gallery_images ) ) {

			if ( has_post_thumbnail( $this->property_id ) ) {
				return count( $gallery_images ) + 1;
			}

			return count( $gallery_images );
		} else if ( has_post_thumbnail( $this->property_id ) ) {
			return 1;
		}

		return false;
	}

	/**
	 * Get agent display option
	 * @return bool|mixed
	 */
	public function get_agent_display_option() {
		if ( ! $this->property_id ) {
			return false;
		}

		return $this->get_property_meta( $this->meta_keys['agent_display_option'] );
	}

	/**
	 * Get agent id
	 * @return bool|mixed
	 */
	public function get_agent_id() {
		if ( ! $this->property_id ) {
			return false;
		}

		return $this->get_property_meta( $this->meta_keys['agent_id'] );
	}

	/**
	 * Get multiple agents ids
	 * @return bool|mixed
	 */
	public function get_agents_ids() {

		if ( ! $this->property_id ) {
			return false;
		}

		if ( isset( $this->meta_data[ $this->meta_keys['agent_id'] ] ) ) {
			return $this->meta_data[ $this->meta_keys['agent_id'] ];
		}

		return false;
	}

	/**
	 * Get slider image URL
	 * @return bool|string
	 */
	public function get_slider_image() {
		if ( ! $this->property_id ) {
			return false;
		}

		$slider_image_id = $this->get_property_meta( $this->meta_keys['slider_image'] );
		if ( $slider_image_id ) {
			return wp_get_attachment_url( $slider_image_id );
		}

		return false;
	}

	/**
	 * Display property price
	 */
	public function price() {
		if ( ! $this->property_id ) {
			return false;
		}
		echo $this->get_price();
	}

	/**
	 * Returns property price
	 * @param $postfix
	 * @return string price
	 */
	public function get_price( $postfix = true ) {
		if ( ! $this->property_id ) {
			return null;
		}
		$price_amount  = doubleval( $this->get_property_meta( $this->meta_keys['price'] ) );
		$price_postfix = $this->get_property_meta( $this->meta_keys['price_postfix'] );

		if ( $postfix ) {
			return $this->format_price( $price_amount, $price_postfix );
		} else {
			return $this->format_price( $price_amount );
		}
	}

	/**
	 * Returns property price without postfix
	 * @return string price
	 */
	public function get_price_without_postfix() {
		if ( ! $this->property_id ) {
			return null;
		}
		$price_amount = doubleval( $this->get_property_meta( $this->meta_keys['price'] ) );

		return $this->format_price( $price_amount );
	}

	/**
	 * Provide formatted price
	 *
	 * @param int|double|float $price_amount price amount
	 * @param string $price_postfix price post fix
	 *
	 * @return null|string  formatted price
	 */
	public static function format_price( $price_amount, $price_postfix = '' ) {

		// get related plugin options
		$pearl_real_estate = Pearl_Price_Format::get_instance();

		if ( $price_amount ) {

			$currency_sign      = $pearl_real_estate->get_currency_sign();
			$number_of_decimals = $pearl_real_estate->get_number_of_decimals();
			$decimal_separator  = $pearl_real_estate->get_decimal_separator();
			$thousand_separator = $pearl_real_estate->get_thousand_separator();
			$currency_position  = $pearl_real_estate->get_currency_position();

			// format price
			$formatted_price = number_format( $price_amount, $number_of_decimals, $decimal_separator, $thousand_separator );

			// add currency and post fix
			if ( $currency_position == 'after' ) {
				$formatted_price = $formatted_price . $currency_sign;
			} else {
				$formatted_price = $currency_sign . $formatted_price;
			}

			if ( ! empty( $price_postfix ) ) {
				$formatted_price = $formatted_price . ' ' . $price_postfix;
			}

			return $formatted_price;

		} else {

			return $pearl_real_estate->get_empty_price_text();

		}

	}

	/**
	 * Returns property price postfix
	 * @return string price postfix
	 */
	public function get_price_postfix() {
		if ( ! $this->property_id ) {
			return null;
		}
		$price_postfix = $this->get_property_meta( $this->meta_keys['price_postfix'] );

		return $price_postfix;
	}

	/**
	 * Returns payment status of property
	 * @return mixed|null
	 */
	public function get_payment_status() {
		if ( ! $this->property_id ) {
			return null;
		}
		$payment_status = $this->get_property_meta( $this->meta_keys['payment_status'] );

		return $payment_status;
	}

	/**
	 * Returns url of video if exists
	 * @return mixed|null
	 */
	public function get_video_url() {
		if ( ! $this->property_id ) {
			return null;
		}
		$video_url = $this->get_property_meta( $this->meta_keys['video_url'] );

		return $video_url;
	}

	/**
	 * Return video image id if exists
	 * @return mixed|null
	 */
	public function get_video_image() {
		if ( ! $this->property_id ) {
			return null;
		}
		$video_url = $this->get_property_meta( $this->meta_keys['video_image'] );

		return $video_url;
	}

	/**
	 * Returns virtual tour if exists
	 * @return mixed|null
	 */
	public function get_virtual_tour() {
		if ( ! $this->property_id ) {
			return null;
		}
		$virtual_tour = $this->get_property_meta( $this->meta_keys['virtual_tour'] );

		return $virtual_tour;
	}

	/**
	 * Return property types
	 * @return bool|null|string
	 */
	public function get_types() {
		return $this->get_taxonomy_terms( 'property-type' );
	}

	/**
	 * Return taxonomy terms
	 *
	 * @param $taxonomy
	 *
	 * @return bool|null|string
	 */
	public function get_taxonomy_terms( $taxonomy ) {

		if ( ! $this->property_id || empty( $taxonomy ) || ! taxonomy_exists( $taxonomy ) ) {
			return false;
		}

		$taxonomy_terms = get_the_terms( $this->property_id, $taxonomy );
		if ( ! empty( $taxonomy_terms ) && ! is_wp_error( $taxonomy_terms ) ) {
			$taxonomy_terms_array = array();
			foreach ( $taxonomy_terms as $term ) {
				$taxonomy_terms_array[ $term->term_id ] = $term->name;
			}

			return $taxonomy_terms_array;
		}

		return null;
	}

	/**
	 * Return property status
	 * @return bool|null|string
	 */
	public function get_status() {
		return $this->get_taxonomy_terms( 'property-status' );
	}

	/**
	 * Return property city
	 * @return bool|null|string
	 */
	public function get_city() {
		return $this->get_taxonomy_terms( 'property-city' );
	}

	/**
	 * Return slug or name of first term of given taxonomy
	 *
	 * @param $taxonomy
	 * @param string $field
	 *
	 * @return null|string|mixed
	 */
	public function get_taxonomy_first_term( $taxonomy, $field = 'slug' ) {
		if ( ! $this->property_id || ! $taxonomy || ! taxonomy_exists( $taxonomy ) ) {
			return null;
		}
		$taxonomy_terms = get_the_terms( $this->property_id, $taxonomy );
		if ( ! empty( $taxonomy_terms ) && ! is_wp_error( $taxonomy_terms ) ) {
			foreach ( $taxonomy_terms as $single_term ) {
				if ( $field == 'name' ) {
					return $single_term->name;
				} elseif ( $field == 'slug' ) {
					return $single_term->slug;
				} else {
					return $single_term;
				}
			}
		}

		return null;
	}

}