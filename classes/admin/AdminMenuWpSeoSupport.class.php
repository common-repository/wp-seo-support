<?php
/**
 * AdminMenuWpSeoSupport
 * Version:     0.1
 * Author:      Green Sheep
 * Created:     March 20, 2018
 * Modified:
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
namespace plugins\wss;

class AdminMenuWpSeoSupport
{
    /**
     * 本プラグイン専用のメタボックス
     */
    public function __construct()
    {
        // メタボックスを追加するページタイプを指定
        $screens = ['post', 'page'];
        // フィルターフック
        $screens = apply_filters('wpv_add_meta_box', $screens);

        foreach ($screens as $screen) {
            add_meta_box(
                'wp_seo_support_meta_box',
                'WP SEO Support',
                array($this, 'addMetaBoxWpSeoSupport'),
                $screen,
                'normal',
                'low'
            );
        }
    }

    /**
     * メタボックスの詳細
     */
    public function addMetaBoxWpSeoSupport()
    {
        ?>
            <input type="button" name="analytics_contents" class="button" value="キーワード解析">
            <div id="analytics-result" class="seo-result"></div>
            <input type="button" name="correction_contents" class="button" value="文字列チェック">
            <div id ="correction-result" class="seo-result"></div>
        <?php
    }
}
