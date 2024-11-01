<div class="wrap">
    <h1>WP SEO Support</h1>
    <p>WP SEO Supportプラグインに関する設定を行います。</p>
    <form method="post">
        <?php wp_nonce_field('wp_seo_support_action', 'wp_seo_support_field');
        if (!empty($_POST)) {
            if (isset($_POST['error'])) {
                $class_name = 'error';
                $str = '設定の保存に失敗しました';
            } else {
                $class_name = 'updated';
                $str = '設定を保存しました';
            } ?>
            <div class="<?php echo $class_name; ?> notice is-dismissible">
                <p><strong><?php echo $str; ?></strong></p>
                <button class="notice-dismiss" type="button">
                    <span class="screen-reader-text">この通知を非表示にする</span>
                </button>
            </div>
        <?php } ?>
        <hr>
        <h2>WP SEO Support設定</h2>
        <table class="form-table">
            <tr>
                <th scope="row">Yahoo! JAPAN<br>アプリケーションID</th>
                <td>
                    <input type="text" id="yahoo_api_key" class="large-text" name="yahoo_api_key" value="<?php echo $this->setting_value['yahoo_api_key']; ?>">
                    <p class="description">Yahoo! JAPANのアプリケーションIDを登録し、コンテンツのキーワード解析を行います。<span style="margin:15px 15px 15px 15px"><a href="https://developer.yahoo.co.jp/about">Webサービス by Yahoo! JAPAN</a></span></p>
                </td>
            </tr>
        </table>
        <hr>
        <h2>WP SEO Supportに関するデータの削除</h2>
        <p>プラグインの無効化時にWP SEO Supportプラグインが作成したオプションデータを削除するか選択できます。</p>
        <table class="form-table">
            <tr>
                <th scope="row">関連データの削除</th>
                <td>
                    <label><input type="radio" name="delete_flg" value="0" <?php if ($this->setting_value['delete_flg'] === 0) echo "checked"; ?>>削除しない</label><br>
                    <label><input type="radio" name="delete_flg" value="1" <?php if ($this->setting_value['delete_flg'] === 1) echo "checked"; ?>>削除する</label>
                </td>
            </tr>
        </table>
        <input type="submit" name="regist_wss_detail" id="regist_wss_detail" class="button-primary" value="変更を保存">
    </form>
</div>