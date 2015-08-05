<?php
/**
 * @package   Gallery_Factory_Lite
 * @author    Vilyon Studio <vilyonstudio@gmail.com>
 * @link      http://galleryfactory.vilyon.net
 * @copyright 2015 Vilyon Studio
 *
 * @wordpress-plugin
 * Plugin Name:       Gallery Factory Lite
 * Plugin URI:        http://galleryfactory.vilyon.net
 * Description:       Great tool for managing large image collections with user-friendly album manager interface and visual layout builder.
 * Version:           1.1.2
 * Author:            Vilyon Studio
 * Author URI:        http://vilyon.net/
 * Text Domain:       gallery-factory
 * Domain Path:       /languages
 */

if ( ! function_exists( 'add_action' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

//defining global variables
define( 'VLS_GF_VERSION', '1.1.2' );
define( 'VLS_GF_DB_VERSION', 2 );
define( 'VLS_GF_MINIMUM_WP_VERSION', '3.9' );
define( 'VLS_GF_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'VLS_GF_PLUGIN_DIR', dirname( __FILE__ ) . '/' );
define( 'VLS_GF_POST_TYPE_FOLDER', 'vls_gf_folder' );
define( 'VLS_GF_POST_TYPE_ALBUM', 'vls_gf_album' );
define( 'VLS_GF_POST_TYPE_IMAGE', 'vls_gf_image' );
define( 'VLS_GF_POST_TYPE_ALBUM_IMAGE', 'vls_gf_album_image' );
define( 'VLS_GF_TEXTDOMAIN', 'gallery-factory' );
define( 'VLS_GF_UPLOADS_DIR', '/gf-uploads' );

//including main GF class
require_once( VLS_GF_PLUGIN_DIR . 'shared/class-gallery-factory.php' );

//including front-end or admin classes depending on current request
if ( is_admin() ) {
	require_once( VLS_GF_PLUGIN_DIR . 'admin/class-gallery-factory-admin.php' );
	require_once( VLS_GF_PLUGIN_DIR . 'admin/class-gallery-factory-admin-ajax.php' );
	require_once( VLS_GF_PLUGIN_DIR . 'admin/class-gallery-factory-admin-utils.php' );
} else {
	require_once( VLS_GF_PLUGIN_DIR . 'frontend/class-gallery-factory-frontend.php' );
}

