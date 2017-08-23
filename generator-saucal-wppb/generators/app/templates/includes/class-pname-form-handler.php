<?php
/**
 * Handle frontend forms.
 *
 * @class 		<%= pluginShortClass %>_Form_Handler
 * @version		1.0.0
 * @package		<%= pluginClass %>/Classes
 * @category	Class
 * @author 		<%= authorName %>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class <%= pluginShortClass %>_Form_Handler {

	/**
	 * Hook in methods.
	 */
	public static function init() {
		// add_action( 'wp_loaded', array( __CLASS__, 'sample_callback' ), 20 );
	}

	/**
	 * This is a sample callback function.
	 */
	public static function sample_callback() {

	}
}

<%= pluginShortClass %>_Form_Handler::init();
