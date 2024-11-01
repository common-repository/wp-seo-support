<?php
/**
 * AbstractAjax
 * Version    : 0.1
 * Author     : Green Sheep
 * Created    : December 15, 2017
 * Modified   :
 * License    : GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
namespace plugins\wss;

abstract class AbstractAjax
{
    /** HTTPリクエスト変数 */
    protected $properties;

    public function __construct()
    {
        // nonceのチェック
        if (!(isset($_POST['nonce']) && wp_verify_nonce($_POST['nonce'], 'wss-ajax-action'))) {
            return false;
        }

        $this->properties = $_POST;

        $this->ajaxAction();
    }

    public function setProperty($key, $val)
    {
        $this->properties[$key] = $val;
    }

    public function getProperty($key)
    {
        if (isset($this->properties[$key])) {
            return $this->properties[$key];
        }

        return null;
    }

    abstract protected function ajaxAction();

    protected function render($resource = '')
    {
        if ($resource === '') {
            $classname = get_class($this);
            $classname_array = explode('\\', $classname);
            $resource = WSS_PLUGIN_PATH . 'classes/view/' . end($classname_array) . 'View.php';
        }

        ob_start();
        include($resource);
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }

    /**
     * getによりAPIのURLを生成する
     *
     * @param string $request_url リクエストするURL
     * @param string $appid Yahoo アプリケーションID
     * @param string $sentence 解析対象の文章
     * @param array $options Yahoo APIのpostにおけるオプション
     *
     * @return string $xml
     */
    protected function getUrl($request_url, $appid, $sentence, $options = [])
    {
        $url  = $request_url;
        $url .= '?appid=' . $appid;
        $url .= '&sentence=' . urlencode($sentence);

        if (count($options) > 0) {
            foreach ($options as $key => $val) {
                $url .= '&' . $key . '=' . $val;
            }
        }

        return $url;
    }

    /**
     * curlを用いてpost送信を行い、APIの結果を取得する
     *
     * @param string $request_url リクエストするURL
     * @param string $appid Yahoo アプリケーションID
     * @param string $sentence 解析対象の文章
     * @param array $options Yahoo APIのpostにおけるオプション
     *
     * @return string $xml
     */
    protected function getApiXML($request_url, $appid, $sentence, $options = [])
    {
        $params = [
            'sentence' => $sentence
        ];
        $params += $options;

        $ch = curl_init($request_url);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT      => "Yahoo AppID: $appid",
            CURLOPT_POSTFIELDS     => http_build_query($params),
        ]);

        $result = curl_exec($ch);
        $xml = new \SimpleXMLElement($result);
        curl_close($ch);

        return $xml;
    }
}
