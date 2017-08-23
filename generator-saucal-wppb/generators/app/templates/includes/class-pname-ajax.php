<?php
/**
 * <%= pluginClass %> <%= pluginShortClass %>_AJAX.
 *
 * AJAX Event Handler.
 *
 * @class    <%= pluginShortClass %>_AJAX
 * @version  1.0.0
 * @package  <%= pluginClass %>/Classes
 * @category Class
 * @author   <%= authorName %>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class <%= pluginShortClass %>_AJAX {

	/**
	 * Hook in ajax handlers.
	 */
	public static function init() {
		self::add_ajax_events();
	}

	/**
	 * Hook in methods - uses WordPress ajax handlers (admin-ajax).
	 */
	public static function add_ajax_events() {
		// <%= plugin_name %>_EVENT => nopriv
		$ajax_events = array(
			'sample_event' => true,
		);

		foreach ( $ajax_events as $ajax_event => $nopriv ) {
			add_action( 'wp_ajax_<%= plugin_name %>_' . $ajax_event, array( __CLASS__, $ajax_event ) );

			if ( $nopriv ) {
				add_action( 'wp_ajax_nopriv_<%= plugin_name %>_' . $ajax_event, array( __CLASS__, $ajax_event ) );
			}
		}
	}

	/**
	 * This is a sample AJAX event callback.
	 */
	public static function sample_event() {
		wp_send_json( $data );
	}
}

<%= pluginShortClass %>_AJAX::init();
