<?php
/**
 * Plugin name: WP SEO Support
 * Plugin URI: https://www.greensheep.co.jp/service/wordpress-plugin/wp-seo-support-plugin/
 * Description: SEO support
 * Version: 0.3.0
 * Author: Green Sheep
 * Author URI: https://www.greensheep.co.jp/
 * Created: March 16, 2018
 * Modified: March 30, 2018
 * Text Domain:
 * Domain Path:
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
namespace plugins\wss;

define('WSS_PLUGIN_PATH', plugin_dir_path(__FILE__));

require dirname(__FILE__) . '/classes/ClassLoader.class.php';

$init_plugin = new InitPlugin();
$init_plugin->executeEnqueueScripts();

if (is_admin()) {
    new AdminInit();

    register_deactivation_hook(__FILE__, array($init_plugin, 'deleteWpSeoSupportOptions'));
}

// ajax処理
new AjaxInit();
