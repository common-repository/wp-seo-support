<?php
/**
 * CorrectionContents
 * Version:     0.1
 * Author:      Green Sheep
 * Created:     March 30, 2018
 * Modified:
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
namespace plugins\wss;

class CorrectionContents extends AbstractAjax
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
                'target_id' => 'correction-result',
                'content' => $str
            ];
            echo json_encode($result);
            die();
        }

        $xml = $this->getApiXML(Cmn::YAHOO_API_KOUSEI, $appid, $sentence);
        list($this->count, $this->keywords) = $this->parseSentence($xml);

        if ($this->count > 0) {
            $str = $this->render();
        } else {
            $str = '校正対象の文字列は見つかりませんでした。';
        }

        $result = [
            'target_id' => 'correction-result',
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
     * @return array [string $count, string $keywords] 対象の数と対象の言葉
     */
    private function parseSentence($xml)
    {
        $str = '';

        if (!$xml || !isset($xml->Result)) {
            return [0, []];
        }

        $count = 0;
        $keywords = [];
        foreach ($xml->Result as $result) {

            $tmp = [];

            $tmp['surface'] = htmlspecialchars($result->Surface, ENT_QUOTES);
            $tmp['shiteki_word'] = htmlspecialchars($result->ShitekiWord, ENT_QUOTES);
            $tmp['shiteki_info'] = htmlspecialchars($result->ShitekiInfo, ENT_QUOTES);

            $keywords[] = $tmp;
            $count++;
        }

        return [$count, $keywords];
    }
}
