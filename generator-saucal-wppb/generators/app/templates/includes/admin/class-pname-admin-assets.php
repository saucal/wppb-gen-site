<?php
/**
 * Load assets
 *
 * @author      <%= authorName %>
 * @category    Admin
 * @package     <%= pluginClass %>/Admin/Classes
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include_once( <%= pluginSingleton %>()->plugin_path() . '/includes/class-<%= pluginShortSlug %>-assets.php' );

/**
 * <%= pluginShortClass %>_Admin_Assets Class.
 */
class <%= pluginShortClass %>_Admin_Assets extends <%= pluginShortClass %>_Assets {

	/**
	 * Hook in methods.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );
		add_action( 'admin_print_scripts', array( $this, 'localize_printed_scripts' ), 5 );
		add_action( 'admin_print_footer_scripts', array( $this, 'localize_printed_scripts' ), 5 );
	}

	/**
	 * Get styles for the frontend.
	 * @access private
	 * @return array
	 */
	public function get_styles() {
		return apply_filters( '<%= plugin_name %>_enqueue_admin_styles', array(
			'<%= pluginSlug %>-admin' => array(
				'src'     => $this->localize_asset( 'css/admin/<%= pluginSlug %>-admin.css' ),
			),
		) );
	}

	/**
	 * Get styles for the frontend.
	 * @access private
	 * @return array
	 */
	public function get_scripts() {
		return apply_filters( '<%= plugin_name %>_enqueue_admin_scripts', array(
			'<%= pluginSlug %>-admin' => array(
				'src'  => $this->localize_asset( 'js/admin/<%= pluginSlug %>-admin.js' ),
				'data' => array(
					'ajax_url' => <%= pluginSingleton %>()->ajax_url(),
				),
			),
		) );
	}

}

return new <%= pluginShortClass %>_Admin_Assets();
