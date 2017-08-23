<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              <%= authorURI %>
 * @since             1.0.0
 * @package           <%= pluginClass %>
 *
 * @wordpress-plugin
 * Plugin Name:       <%= pluginName %>
 * Plugin URI:        <%= authorURI %>
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            <%= authorName %>
 * Author URI:        <%= authorURI %>
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       <%= pluginSlug %>
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( '<%= pluginClass %>' ) ) :

	final class <%= pluginClass %> {

		/**
		 * <%= pluginClass %> version.
		 *
		 * @var string
		 */
		public $version = '1.0.0';

		/**
		 * The single instance of the class.
		 *
		 * @var <%= pluginClass %>
		 * @since 1.0.0
		 */
		protected static $_instance = null;

		/**
		 * Main <%= pluginClass %> Instance.
		 *
		 * Ensures only one instance of <%= pluginClass %> is loaded or can be loaded.
		 *
		 * @since 1.0.0
		 * @static
		 * @see <%= pluginSingleton %>()
		 * @return <%= pluginClass %> - Main instance.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Cloning is forbidden.
		 * @since 1.0.0
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', '<%= pluginSlug %>' ), '1.0.0' );
		}

		/**
		 * Unserializing instances of this class is forbidden.
		 * @since 1.0.0
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', '<%= pluginSlug %>' ), '1.0.0' );
		}

		/**
		 * <%= pluginClass %> Constructor.
		 */
		public function __construct() {
			$this->define_constants();
			$this->includes();
			$this->init_hooks();

			do_action( '<%= plugin_name %>_loaded' );
		}

		/**
		 * Define <%= pluginShortClass %> Constants.
		 */
		private function define_constants() {
			$upload_dir = wp_upload_dir();

			$this->define( '<%=pluginShortNameUpper %>_PLUGIN_FILE', __FILE__ );
			$this->define( '<%=pluginShortNameUpper %>_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
			$this->define( '<%=pluginShortNameUpper %>_VERSION', $this->version );
		}

		/**
		 * Define constant if not already set.
		 *
		 * @param  string $name
		 * @param  string|bool $value
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * What type of request is this?
		 *
		 * @param  string $type admin, ajax, cron or frontend.
		 * @return bool
		 */
		private function is_request( $type ) {
			switch ( $type ) {
				case 'admin':
					return is_admin();
				case 'ajax':
					return defined( 'DOING_AJAX' );
				case 'cron':
					return defined( 'DOING_CRON' );
				case 'frontend':
					return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
			}
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 */
		public function includes() {
			include_once( 'includes/class-<%= pluginShortSlug %>-autoloader.php' );
			include_once( 'includes/<%= pluginSlug %>-core-functions.php' );
			include_once( 'includes/class-<%= pluginShortSlug %>-install.php' );

			if ( $this->is_request( 'admin' ) ) {
				include_once( 'includes/admin/class-<%= pluginShortSlug %>-admin.php' );
			}

			if ( $this->is_request( 'frontend' ) ) {
				include_once( 'includes/class-<%= pluginShortSlug %>-frontend-assets.php' ); // Frontend Scripts
				include_once( 'includes/class-<%= pluginShortSlug %>-form-handler.php' );
			}
			//include_once( 'includes/class-<%= pluginSlug %>-post-types.php' )
			$this->customizations_includes();
		}

		/**
		 * Include required customizations files.
		 */
		public function customizations_includes() {
			$customizations = array(
				'acf',
			);

			foreach ( $customizations as $customization ) {
				include_once( 'includes/customizations/class-<%= pluginShortSlug %>-' . $customization . '-hooks.php' );
			}
		}

		/**
		 * Hook into actions and filters.
		 * @since  1.0.0
		 */
		private function init_hooks() {
			add_action( 'init', array( $this, 'init' ), 0 );
		}

		/**
		 * Init <%= pluginClass %> when WordPress Initialises.
		 */
		public function init() {
			// Before init action.
			do_action( 'before_<%= plugin_name %>_init' );

			// Set up localisation.
			$this->load_plugin_textdomain();

			// Init action.
			do_action( '<%= plugin_name %>_init' );
		}

		/**
		 * Load Localisation files.
		 *
		 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
		 *
		 * Locales found in:
		 *      - WP_LANG_DIR/<%= pluginSlug %>/<%= pluginSlug %>-LOCALE.mo
		 *      - WP_LANG_DIR/plugins/<%= pluginSlug %>-LOCALE.mo
		 */
		public function load_plugin_textdomain() {
			$locale = apply_filters( 'plugin_locale', get_locale(), '<%= pluginSlug %>' );

			load_textdomain( '<%= pluginSlug %>', WP_LANG_DIR . '/<%= pluginSlug %>/<%= pluginSlug %>-' . $locale . '.mo' );
			load_plugin_textdomain( '<%= pluginSlug %>', false, plugin_basename( dirname( __FILE__ ) ) . '/i18n/languages' );
		}

		/**
		 * Get the plugin url.
		 * @return string
		 */
		public function plugin_url() {
			return untrailingslashit( plugins_url( '/', __FILE__ ) );
		}

		/**
		 * Get the plugin path.
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( __FILE__ ) );
		}

		/**
		 * Get the template path.
		 * @return string
		 */
		public function template_path() {
			return apply_filters( '<%= plugin_name %>_template_path', '<%= pluginSlug %>/' );
		}

		/**
		 * Get Ajax URL.
		 * @return string
		 */
		public function ajax_url() {
			return admin_url( 'admin-ajax.php', 'relative' );
		}
	}

endif;

/**
 * Main instance of <%= pluginClass %>.
 *
 * Returns the main instance of <%= pluginShortClass %> to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return <%= pluginClass %>
 */
function <%= pluginSingleton %>() {
	return <%= pluginClass %>::instance();
}

// Global for backwards compatibility.
$GLOBALS['<%= plugin_name %>'] = <%= pluginSingleton %>();
