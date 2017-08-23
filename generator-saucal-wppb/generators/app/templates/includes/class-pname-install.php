<?php
/**
 * Installation related functions and actions.
 *
 * @author   <%= authorName %>
 * @category Admin
 * @package  <%= pluginClass %>/Classes
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * <%= pluginShortClass %>_Install Class.
 */
class <%= pluginShortClass %>_Install {

	/**
	 * Install <&= pluginShortName %>.
	 */
	public static function install() {
		// PERFORM INSTALL ACTIONS HERE

		// Trigger action
		do_action( '<%= plugin_name %>_installed' );
	}
}

register_activation_hook( __FILE__, array( '<%= pluginShortClass %>_Install', 'install' ) );
