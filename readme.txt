=== WP SEO Support ===
Contributors: gs_miyashita,greensheepwp
Donate link:
Tags: seo, morphological analysis
Requires at least: 4.9.4
Tested up to: 4.9.5
Stable tag: 0.3.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WP SEO Supportプラグインでは、投稿内容を解析し、キーワードの出現率をチェックしたり、文字の入力ミスをチェックしたりします。

== Description ==

投稿内容を解析し誤字のチェックやキーワードの出現率を確認することで、公開前のチェックに利用したり、読みやすい文章作成のサポートをしたり、SEO対策を行ったりすることが出来ます

WP SEO Supportプラグインでは、投稿編集をサポートするために2つの機能を提供しています。
(1) キーワードの出現率をチェック
(2) 文字の入力ミスや言葉の誤用がないかチェック

(1) キーワードの出現率をチェックでは、
投稿の編集画面にて、編集した文章の形態素解析を行い、
キーワードの出現率を高い順に表示します。

目的のキーワードや最も伝えたい言葉が、文章の中でどれくらいの出現率を示しているか確認することで、読み手に伝わりやすい文章の作成に役立てたり、SEO対策に役立てたりすることが出来ます。

(2) 文字の入力ミスや言葉の誤用がないかチェックでは、
文章中における、
誤変換、誤用、使用注意語、不快語、当て字、表外漢字、用字、用語言い換え、二重否定、助詞不足の可能性あり、冗長表現、略語
の指摘を行います。

編集内容中の文脈を理解し、全ての間違いを指摘するものではございませんので文章校正の一環としてご利用ください。

上記2点の機能ではYahoo! JAPANのWeb APIを用いています。
(1)においては、<a href="https://developer.yahoo.co.jp/webapi/jlp/ma/v1/parse.html">日本語形態素解析</a>のAPIを、
(2)においては、<a href="https://developer.yahoo.co.jp/webapi/jlp/kousei/v1/kousei.html">校正支援</a>のAPIを利用しております。

WP SEO Supportプラグインの利用に辺り、Yahoo! JAPAN IDを取得しWeb APIを利用するためにアプリケーションIDを発行する必要がございます。
また、発行したアプリケーションIDはユーザーのWordPressと紐づけることでWordPress上で利用開始することが出来ます。

WordPressとの紐づけは、WP SEO Supportプラグインが用意した専用のWordPress管理画面より発行したアプリケーションIDの登録を行うことで関連付けられます。

尚、アプリケーションIDの発行にあたりYahoo!デベロッパーネットワークのガイドラインに従う必要がございますのでご確認をお願い致します。
・ソフトウエアに関する規則（ガイドライン）
https://about.yahoo.co.jp/docs/info/terms/chapter1.html#cf5th

それでは、より良い文章作成、SEO対策にお役立てください。

== Installation ==

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php do_action('plugin_name_hook'); ?>` in your templates

== Frequently asked questions ==

= A question that someone might have =

An answer to that question.

== Screenshots ==



== Changelog ==

= 0.3.0 =
* APIのリクエストをGET形式からPOSTに変更することで2kバイト弱でエラーとなる現象の解消

= 0.2.0 =
* 投稿編集時の文章の文字列をチェックする機能を追加

= 0.1.1 =
* change a internal logic. Separate views.


== Upgrade notice ==



== Arbitrary section 1 ==
