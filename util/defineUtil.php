<?php
$APPID = 'dj0zaiZpPUhGd2R4cjQyTWNobiZzPWNvbnN1bWVyc2VjcmV0Jng9NDM-';//yahooのアプリケーションＩＤ
$a=0;
const DB_TYPE='mysql';
const DBHOST = 'localhost';//ＤＢのホスト名
const DBNAME = 'kagoyume_db';//使うＤＢの名前
const DBUSER = 'imabe';//ＤＢのユーザー名
const DBPASS = 'ppu';//ＤＢのユーザーのパスワード
const USER = 'user_t';//ユーザー情報の入ったテーブル
const BUY = 'buy_t';//購入情報の入ったテーブル
const ROOT_URL = 'http://localhost/kago/app';
const INDEX = 'top.php';
const SEARCH = 'search.php';
const ITEM = 'item.php';
const ADD = 'add.php';
const CART = 'cart.php';
const LOGIN = 'login.php';
const REGIST = 'registration.php';
const REGIST_CONF = 'registration_confirm.php';
const REGIST_COMP = 'registration_complete.php';
const MYDATA = 'mydata.php';
const MYDATA_UP = 'mydata_update.php';
const MYDATA_UP_RESULT = 'mydata_update_result.php';
const MY_HISTORY = 'my_history.php';
const MY_DELETE = 'my_delete.php';
const MY_DELETE_RESULT = 'my_delete_result.php';
const BUY_CONF = 'buy_confirm.php';
const BUY_COMP = 'buy_complete.php';

$categories = array(
                    "1" => "すべてのカテゴリから",
                    "13457"=> "ファッション",
                    "2498"=> "食品",
                    "2500"=> "ダイエット、健康",
                    "2501"=> "コスメ、香水",
                    "2502"=> "パソコン、周辺機器",
                    "2504"=> "AV機器、カメラ",
                    "2505"=> "家電",
                    "2506"=> "家具、インテリア",
                    "2507"=> "花、ガーデニング",
                    "2508"=> "キッチン、生活雑貨、日用品",
                    "2503"=> "DIY、工具、文具",
                    "2509"=> "ペット用品、生き物",
                    "2510"=> "楽器、趣味、学習",
                    "2511"=> "ゲーム、おもちゃ",
                    "2497"=> "ベビー、キッズ、マタニティ",
                    "2512"=> "スポーツ",
                    "2513"=> "レジャー、アウトドア",
                    "2514"=> "自転車、車、バイク用品",
                    "2516"=> "CD、音楽ソフト",
                    "2517"=> "DVD、映像ソフト",
                    "10002"=> "本、雑誌、コミック"
                    );
/**
 * @brief ソート方法一覧
 *
 * 検索結果のソート方法の一覧です。
 * キーに検索用パラメータ、値にソート方法が入っています。
 * @access private
 * @var array
 *
 */
$sortname = array( "-score" => "おすすめ順",
                   "+price" => "商品価格が安い順",
                   "-price" => "商品価格が高い順",
                   "+name" => "ストア名昇順",
                   "-name" => "ストア名降順",
                   "-sold" => "売れ筋順"
                   );

$arr = array();
                   /**
 * @brief 特殊文字を HTML エンティティに変換する
 *
 * これは、htmlspecialchars()を使いやすくするための関数です。
 * htmlspecialchars() http://jp.php.net/htmlspecialcharsより
 *   文字の中には HTML において特殊な意味を持つものがあり、
 *   それらの本来の値を表示したければ HTML の表現形式に変換してやらなければなりません。
 *   この関数は、これらの変換を行った結果の文字列を返します。
 *
 *   '&' (アンパサンド) は '&amp;' になります。
 *   ENT_QUOTES が設定されている場合のみ、 ''' (シングルクオート) は '&#039;'になります。
 *   '<' (小なり) は '&lt;' になります。
 *   '>' (大なり) は '&gt;' になります。
 *   ''' (シングルクオート) は '&#039;'になります。
 *
 * echo h("<>&'\""); //&lt;&gt;&amp;&#039;&quotと出力します。
 *
 * @param string $str 変換したい文字列
 *
 * @return string html用に変換した文字列
 *
 */
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

$hits = array();
// const scriptUtil.php;
// const dbaccessUtil.php;
// const defineUtil.php;
