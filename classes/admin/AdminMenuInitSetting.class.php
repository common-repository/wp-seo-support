<?php
/**
 * AdminMenuInitSetting
 * Version:     0.1
 * Author:      Green Sheep
 * Created:     March 19, 2018
 * Modified:
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
namespace plugins\wss;

class AdminMenuinitSetting extends AbstractAdminMenu
{
    public $setting_value;

    protected function execute()
    {
        $this->submit();

        $this->setting_value = $this->getSettingValue();

        $this->render();
    }

    /**
     * フォームの送信が行われた際に然るべき処理を行う
     *
     * @return boolean
     */
    private function submit()
    {
        // nonce check
        if (!(isset($_POST['wp_seo_support_field']) && wp_verify_nonce($_POST['wp_seo_support_field'], 'wp_seo_support_action') === 1)) {
            return false;
        }

        // Yahoo API KEY
        if ($_POST['yahoo_api_key'] !== '') {
            DAO::updateOption('yahoo_api_key', $_POST['yahoo_api_key']);
        }

        // プラグイン無効化時の関連データの削除
        if ($_POST['delete_flg'] === '0' || $_POST['delete_flg'] === '1') {
            DAO::updateOption('delete_flg', $_POST['delete_flg']);
        }
    }

    /**
     * WP SEO Supportに関する設定値を取得
     */
    private function getSettingValue()
    {
        $setting_value = [];

        // Yahoo API KEY
        $setting_value['yahoo_api_key'] = (DAO::getOption('yahoo_api_key') === false) ? '' : DAO::getOption('yahoo_api_key');

        // 本プラグインに関するデータの削除
        $setting_value['delete_flg']  = (int)DAO::getOption('delete_flg', 0);
        if ($setting_value['delete_flg'] != 0 && $setting_value['delete_flg'] != 1) {
            $setting_value['delete_flg'] = 0;
        }

        return $setting_value;
    }
}
