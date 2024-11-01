<?php
/**
 * InitPlugin
 * Version:     0.1
 * Author:      Green Sheep
 * Created:     March 16, 2018
 * Modified:
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
namespace plugins\wss;

class InitPlugin
{
    /**
     * 管理画面・フロントにて独自のcssやjavascriptを読み込ませる
     */
    public function executeEnqueueScripts()
    {
        add_action('admin_enqueue_scripts', array($this, 'adminScript'));
    }

    /**
     * 管理画面にて独自のjavascriptとcssを読み込ませる
     */
    public function adminScript()
    {
        global $hook_suffix;

        if (strpos($hook_suffix, 'post.php') !== false || strpos($hook_suffix, 'post-new.php') !== false) {
            wp_register_script(
                Cmn::PREFIX . 'admin-post-js',
                Cmn::pluginUrlPath() . 'js/admin-post.js',
                array('jquery'),
                false,
                true
            );

            wp_localize_script(
                Cmn::PREFIX . 'admin-post-js',
                'wssGl',
                array(
                    'ajaxUrl' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('wss-ajax-action')
                )
            );

            wp_enqueue_script(
                Cmn::PREFIX . 'admin-post-js'
            );

            wp_enqueue_style(
                Cmn::PREFIX . 'admin-post-css',
                Cmn::pluginUrlPath() . 'css/admin-post.css',
                array(),
                false,
                'all'
            );
        }
    }

    /**
     * プラグイン専用のオプションデータ削除
     */
    public function deleteWpSeoSupportOptions()
    {
        if (DAO::getOption('delete_flg') !== '1') {
            return;
        }

        // プラグインに関連するオプション名を取得
        $options_name = DAO::getOptionsName();

        // 全オプションを削除
        foreach ($options_name as $option_name) {
            delete_option($option_name['option_name']);
        }
    }
}
