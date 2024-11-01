<?php
/**
 * DAO
 * Version:     0.1
 * Author:      Green Sheep
 * Created:     March 19, 2018
 * Modified:
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
namespace plugins\wss;

class DAO
{
    /**
     * optionsテーブルの同プラグインで保存したオプション名一覧を取得
     *
     * @return array $result
     */
    public static function getOptionsName()
    {
        global $wpdb;

        $options_name = Cmn::PREFIX . Cmn::UNIQUE_KEY;

        $result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT op.option_name FROM $wpdb->options op WHERE op.option_name LIKE %s",
                $options_name . '%%'
            ),
            'ARRAY_A'
        );

        return $result;
    }

    /**
     * オプションの取得の際にプラグインのプレフィックスをつけて取得
     *
     * @param  string  $option  オプション名
     * @param  boolean $default
     * @return 取得結果
     */
    public static function getOption($option, $default = false)
    {
        return get_option(Cmn::PREFIX . Cmn::UNIQUE_KEY . $option, $default);
    }

    /**
     * オプションの保存の際にプラグインのプレフィックスをつけて保存
     *
     * @param  string  $option  オプション名
     * @param  string  $new_value  保存ずる値
     * @param  $autoload
     * @return 保存結果
     */
    public static function updateOption($option, $new_value, $autoload = null)
    {
        return update_option(Cmn::PREFIX . Cmn::UNIQUE_KEY . $option, $new_value, $autoload);
    }
}
