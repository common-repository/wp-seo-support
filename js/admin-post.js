/**
 * admin-post.js
 * Version:     0.1
 * Author:      Green Sheep
 * Created:     March 16, 2018
 * Modified:
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
(function ($) {
  $('input:button[name=analytics_contents], input:button[name=correction_contents]').on('click', function(e) {
    e.preventDefault();

    var sentence = document.getElementById('content').value;

    // コンテンツが空の場合は何もしない
    if (sentence === '') {
      return false;
    }

    $.ajax({
      type: 'POST',
      url: wssGl.ajaxUrl,
      dataType: 'json',
      data: {
        action: e.target.name,
        nonce: wssGl.nonce,
        sentence: sentence
      }
    })
  	.done(function (response) {
      document.getElementById(response['target_id']).innerHTML = response['content'];
    })
    .fail(function (response) {
      document.getElementById(response['target_id']).innerHTML = 'エラーが発生しました。';
    });
  });
})(jQuery);
