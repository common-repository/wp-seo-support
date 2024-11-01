<?php
/**
 * AjaxInit
 * Version:     0.1
 * Author:      Green Sheep
 * Created:     March 16, 2018
 * Modified:
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
namespace plugins\wss;

class AjaxInit
{
    /**
     * コンストラクタでは、テーブル名のセット、ajax用のアクションフックを登録する
     *
     * [ajax一覧]
     * set_click_data
     */
    public function __construct()
    {
        // 形態素解析を行い文章のキーワードの出現率を出力
        add_action('wp_ajax_analytics_contents', array($this, 'addAnalyticsContents'));

        // 文章の校正支援を行う
        add_action('wp_ajax_correction_contents', array($this, 'addCorrectionContents'));
    }

    /**
     * wp ajax用のアクション
     * コンテンツのキーワード解析を行う
     */
    public function addAnalyticsContents()
    {
        new AnalyticsContents();
    }

    /**
     * wp ajax用のアクション
     * 文章の校正支援を行う
     */
    public function addCorrectionContents()
    {
        new CorrectionContents();
    }
}
