<?php
/**
 * <%= pluginName %> Admin
 *
 * @class    <%= pluginShortClass %>_Admin
 * @author   <%= authorName %>
 * @category Admin
 * @package  <%= pluginClass %>/Admin/Classes
 * @version  2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * <%= pluginShortClass %>_Admin class.
 */
class <%= pluginShortClass %>_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->includes();
		add_action( 'current_screen', array( $this, 'conditional_includes' ) );
	}

	/**
	 * Include any classes we need within admin.
	 */
	public function includes() {
		include_once( '<%= pluginSlug %>-admin-functions.php' );
		include_once( 'class-<%= pluginShortSlug %>-admin-assets.php' );
	}

	/**
	 * Include admin files conditionally.
	 */
	public function conditional_includes() {
		if ( ! $screen = get_current_screen() ) {
			return;
		}

		switch ( $screen->id ) {
			case 'dashboard' :
			case 'options-permalink' :
			case 'users' :
			case 'user' :
			case 'profile' :
			case 'user-edit' :
		}
	}
}

return new <%= pluginShortClass %>_Admin();
