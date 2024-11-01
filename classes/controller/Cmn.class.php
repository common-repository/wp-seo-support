<?php
/**
 * Cmn
 * Version:     0.1
 * Author:      Green Sheep
 * Created:     March 19, 2018
 * Modified:
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
namespace plugins\wss;

class Cmn
{
    /** プラグインプレフィックス */
    const PREFIX = 'wss_';

    const UNIQUE_KEY = 'P7kAVf_';

    /** YAHOO! JAPAN API 日本語形態素解析 */
    const YAHOO_API_PARSE = 'https://jlp.yahooapis.jp/MAService/V1/parse';

    /** YAHOO! JAPAN API 校正支援 */
    const YAHOO_API_KOUSEI = 'https://jlp.yahooapis.jp/KouseiService/V1/kousei';

    /**
     * プラグインのURLのパスを返す
     *
     * @return string
     */
    public static function pluginUrlPath()
    {
        return plugins_url() . '/' . basename(WSS_PLUGIN_PATH) . '/';
    }
}
