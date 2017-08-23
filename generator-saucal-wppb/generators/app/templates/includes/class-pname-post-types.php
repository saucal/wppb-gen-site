<?php
/**
 * Post Types
 *
 * Registers post types and taxonomies.
 *
 * @class     <%= pluginShortClass %>_Post_Types
 * @version   1.0.0
 * @package   <%= pluginClass %>/Classes
 * @category  Class
 * @author    <%= authorName %>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * <%= pluginShortClass %>_Post_Types Class.
 */
class <%= pluginShortClass %>_Post_Types {

	/**
	 * Hook in methods.
	 */
	public static function init() {
		// add_action( 'init', array( __CLASS__, 'register_taxonomies' ), 5 );
		// add_action( 'init', array( __CLASS__, 'register_post_types' ), 5 );
	}

	/**
	 * Register core taxonomies.
	 */
	public static function register_taxonomies() {
		if ( taxonomy_exists( 'taxonomy_name' ) ) {
			return;
		}

		do_action( '<%= plugin_name %>_register_taxonomy' );

		// REGISTER A TAXONOMY HERE

		do_action( '<%= plugin_name %>_after_register_taxonomy' );
	}

	/**
	 * Register core post types.
	 */
	public static function register_post_types() {
		if ( post_type_exists( 'post_type_name' ) ) {
			return;
		}

		do_action( '<%= plugin_name %>_register_post_type' );

		// REGISTER A POST TYPE HERE

		do_action( '<%= plugin_name %>_after_register_post_type' );
	}
}

<%= pluginShortClass %>_Post_Types::init();
