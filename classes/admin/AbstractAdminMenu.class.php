<?php
/**
 * AbstractAdminMenu
 * Version:     0.1
 * Author:      Green Sheep
 * Created:     March 19, 2018
 * Modified:
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
namespace plugins\wss;

abstract class AbstractAdminMenu
{
    public function __construct()
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        // 本プラグインの設定画面ではハートビートを行わない
        wp_deregister_script('heartbeat');

        $this->execute();
    }

    abstract protected function execute();

    protected function render($resource = '')
    {
        if ($resource === '') {
            $classname = get_class($this);
            $classname_array = explode('\\', $classname);
            $resource = WSS_PLUGIN_PATH . 'classes/view/' . end($classname_array) . 'View.php';
        }

        include($resource);
    }
}
