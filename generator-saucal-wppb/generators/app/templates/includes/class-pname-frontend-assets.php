<?php
/**
 * Handle frontend scripts
 *
 * @class       <%= pluginShortClass %>_Frontend_Scripts
 * @version     1.0.0
 * @package     <%= pluginClass %>/Classes
 * @category    Class
 * @author      <%= authorName %>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include_once( <%= pluginSingleton %>()->plugin_path() . '/includes/class-<%= pluginShortSlug %>-assets.php' );

/**
 * <%= pluginShortClass %>_Frontend_Scripts Class.
 */
class <%= pluginShortClass %>_Frontend_Assets extends <%= pluginShortClass %>_Assets {

	/**
	 * Hook in methods.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
		add_action( 'wp_print_scripts', array( $this, 'localize_printed_scripts' ), 5 );
		add_action( 'wp_print_footer_scripts', array( $this, 'localize_printed_scripts' ), 5 );
	}

	/**
	 * Get styles for the frontend.
	 * @access private
	 * @return array
	 */
	public function get_styles() {
		return apply_filters( '<%= plugin_name %>_enqueue_styles', array(
			'<%= pluginSlug %>-general' => array(
				'src'     => $this->localize_asset( 'css/frontend/<%= pluginSlug %>.css' ),
			),
		) );
	}

	/**
	 * Get styles for the frontend.
	 * @access private
	 * @return array
	 */
	public function get_scripts() {
		return apply_filters( '<%= plugin_name %>_enqueue_scripts', array(
			'<%= pluginSlug %>-general' => array(
				'src'  => $this->localize_asset( 'js/frontend/<%= pluginSlug %>.js' ),
				'data' => array(
					'ajax_url' => <%= pluginSingleton %>()->ajax_url(),
				),
			),
		) );
	}

}

new <%= pluginShortClass %>_Frontend_Assets();
