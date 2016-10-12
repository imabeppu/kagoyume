<?php
/** @mainpage
 *  商品検索フォームを表示
 */

/**
 * @file
 * @brief 商品検索フォームを表示
 *
 * 商品検索フォームを表示し、
 * フォームから入力された値を条件に、検索APIを利用して、検索した結果をhtmlに埋め込んで表示します。
 * 検索結果に対して、カテゴリーによる絞り込みと、並び順の変更ができます。
 *
 * PHP version 5
 */

require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
page(INDEX);
login();
$query="";
$sort="-score";
$category_id=1;

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <title>ショッピングデモサイト - 商品を検索する</title>
        <link rel="stylesheet" type="text/css" href="../css/prototype.css"/>
    </head>
    <body>
        <h1><a href="./top.php">ショッピングデモサイト - 商品を検索する</a></h1>
        <p>このサイトでは、yahooショッピングで買い物をするデモンストレーションをする事が出来ます</p>
        <p>実際に購入する事は出来ません</p>
        <form action=<?php echo SEARCH; ?> 　class="Search">
        表示順序:
        <select name="sort">
        <?php foreach ($sortname as $key => $value) { ?>
        <option value="<?php echo h($key); ?>"><?php echo h($value);?></option>
        <?php } ?>
        </select>
        キーワード検索：
        <select name="category_id">
        <?php foreach ($categories as $id => $name) { ?>
        <option value="<?php echo h($id); ?>"><?php echo h($name);?></option>
        <?php } ?>
        </select>
        <input type="text" name="query" value="<?php echo h($query); ?>"/>
        <input type="submit" value="Yahooショッピングで検索"/>
        </form>
<!-- Begin Yahoo! JAPAN Web Services Attribution Snippet -->
<a href="http://developer.yahoo.co.jp/about">
<img src="http://i.yimg.jp/images/yjdn/yjdn_attbtn2_105_17.gif" width="105" height="17" title="Webサービス by Yahoo! JAPAN" alt="Webサービス by Yahoo! JAPAN" border="0" style="margin:15px 15px 15px 15px"></a>
<!-- End Yahoo! JAPAN Web Services Attribution Snippet -->
    </body>
</html>
