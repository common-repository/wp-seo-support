<?php
/**
 * ClassLoader
 * Version    : 1.0
 * Author     : Green Sheep
 * Created    : March 16, 2018
 * Modified   :
 * License    : GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
namespace plugins\wss;

class ClassLoader
{
    /**
     * 読み込むディレクトリ
     */
    private $dir;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        // classesまでのディレクトリ名の取得
        $this->dir = WSS_PLUGIN_PATH . 'classes/';

        spl_autoload_register(array($this, 'loader'), true, true);
    }

    /**
     * コールバック
     * ディレクトリとファイルを指定して読み込む
     *
     * @param string filename
     */
    public function loader($filename)
    {
        // 名前空間が異なる場合は何もしない
        if (strpos($filename, __NAMESPACE__) === false) {
            return false;
        }

        // 名前空間がついている場合は、オブジェクト名のみ取り出す
        if (strstr($filename, '\\')) {
            $filenames = explode('\\', $filename);
            $filename = end($filenames);
        }

        // 読み込むクラスファイルのセット
        $file = $this->dir . $filename . '.class.php';

        // ファイルがclasses直下にない場合は同階層のディレクトリにあるファイルを探索する
        if (!file_exists($file)) {
            $files = scandir($this->dir);

            foreach ($files as $file) {
                if ($file === '.' || $file === '..') {
                    continue;
                } elseif (is_file($this->dir . $file)) {
                    continue;
                } elseif (is_dir($this->dir . $file)) {
                    // ディレクトリである場合に、存在するファイル名を返す
                    $tmp = $this->dir . $file . '/' . $filename . '.class.php';
                    if (file_exists($tmp)) {
                        $file = $tmp;
                        break;
                    }
                }
            }
        }

        if (is_readable($file)) {
            require $file;

            return true;
        }
    }
}
new ClassLoader();
