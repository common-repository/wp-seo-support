<?php
/**
 * AnalyticsContents
 * Version:     0.1
 * Author:      Green Sheep
 * Created:     March 16, 2018
 * Modified:
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
namespace plugins\wss;

class AnalyticsContents extends AbstractAjax
{
    protected $count;
    protected $keywords;

    protected function ajaxAction()
    {
        $str = '';

        // コンテンツを取得し、HTMLタグを取り除く
        $sentence = strip_tags($this->getProperty('sentence'));
        $sentence = str_replace(array("\r\n", "\r", "\n"), '', $sentence);

        $appid = DAO::getOption('yahoo_api_key', '');
        if ($appid === '') {
            $str = 'WP SEO Support画面よりYahoo! JAPANのアプリケーションIDを登録してください。';
            $result = [
                'target_id' => 'analytics-result',
                'content' => $str
            ];
            echo json_encode($result);
            die();
        }

        $options = ['results' => 'uniq'];
        $xml = $this->getApiXML(Cmn::YAHOO_API_PARSE, $appid, $sentence, $options);
        list($this->count, $this->keywords) = $this->parseSentence($xml);
        $str = $this->render();

        $result = [
            'target_id' => 'analytics-result',
            'content' => $str
        ];
        echo json_encode($result);
        die();
    }

    /**
     * APIで取得したxmlを解析する
     *
     * @param string $xml リクエストするURL
     *
     * @return array [string $count, string $keywords] 品詞の数と品詞
     */
    private function parseSentence($xml)
    {
        $str = '';

        if (!$xml->uniq_result) {
            $str = 'エラーが発生しました。';
            $result = [
                'target_id' => 'analytics-result',
                'content' => $str
            ];
            echo json_encode($result);
            die();
        }

        $targetCategory = $this->getTargetCategory();

        $count = 0;
        $keywords = [];
        foreach ($xml->uniq_result->word_list->word as $word) {
            // 目的の品詞でない場合はリストしない
            if (!in_array($word->pos, $targetCategory)) {
                continue;
            }

            $tmp = [];

            $tmp['word'] = htmlspecialchars($word->surface, ENT_QUOTES);
            $tmp['count'] = htmlspecialchars($word->count, ENT_QUOTES);

            $keywords[] = $tmp;
            $count++;
        }

        return [$count, $keywords];
    }

    private function getTargetCategory()
    {
        $category = [
            '動詞',
            '形容詞',
            '形容動詞',
            '名詞'
        ];

        return $category;
    }
}
