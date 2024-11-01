<?php
/**
 * AdminInit
 * Version:     0.1
 * Author:      Green Sheep
 * Created:     March 20, 2018
 * Modified:
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
namespace plugins\wss;

class AdminInit
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'addAdminMenuWpSeoSupport'));
        add_action('admin_menu', array($this, 'wpSeoSupportMenu'));
    }

    /**
     * 投稿ごとにSEOコンテンツを追加
     */
    public function addAdminMenuWpSeoSupport()
    {
        new AdminMenuWpSeoSupport();
    }

    /**
     * 管理画面のメニューに設定画面を追加
     */
    public function wpSeoSupportMenu()
    {
        add_menu_page(
            'WP SEO Support',
            'WP SEO Support',
            'manage_options',
            'wp-seo-support-setting',
            array($this, 'addAdminMenuInitSetting'),
            ''
        );
    }

    /**
     * 初期設定用のページを呼び出す
     */
    public function addAdminMenuInitSetting()
    {
        new AdminMenuInitSetting();
    }
}
