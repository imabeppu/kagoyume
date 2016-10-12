<?php
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
page(SEARCH);

if(isset($_GET["query"])){$query=$_GET["query"];}else{$query="";}
if(isset($_GET["sort"]) && array_key_exists($_GET["sort"],$sortname)){$sort=$_GET["sort"];}else{$sort="-score";}
if(isset($_GET["category_id"]) && array_key_exists($_GET["category_id"],$categories) && ctype_digit($_GET["category_id"]))
{$category_id =$_GET["category_id"];}
else{$category_id=1;}

if (!empty($query) && $query != "") {
    $query4url = rawurlencode($query);
    $sort4url = rawurlencode($sort);
    $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/itemSearch?appid=$APPID&query=$query4url&category_id=$category_id&sort=$sort4url&hits=10";
    $xml=simplexml_load_file($url);
    if ($xml["totalResultsReturned"] != 0) {//検索件数が0件でない場合,変数$hitsに検索結果を格納します。
        $hits = $xml->Result->Hit;}
    }
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <title>ショッピングデモサイト - 検索画面</title>
        <link rel="stylesheet" type="text/css" href="../css/prototype.css"/>
    </head>
    <body>
      <?php login(); ?>
     <form action=<?php echo SEARCH; ?> 　class="Search">
       表示順序:
      <select name="sort">
      <?php foreach ($sortname as $key => $value) { ?>
      <option value="<?php echo h($key); ?>" <?php if($sort == $key) echo "selected=\"selected\""; ?>><?php echo h($value);?></option>
      <?php } ?>
      </select>
      キーワード検索：
      <select name="category_id">
      <?php foreach ($categories as $id => $name) { ?>
      <option value="<?php echo h($id); ?>" <?php if($category_id == $id) echo "selected=\"selected\""; ?>><?php echo h($name);?></option>
      <?php } ?>
      </select>
      <input type="text" name="query" value="<?php echo h($query); ?>"/>
      <input type="submit" value="Yahooショッピングで検索"/>
      </form>
      <?php if(!isset($_GET['query']) or $_GET['query']==""){
        echo '<a>キーワードが入力されていません</a>';
      }
      foreach ($hits as $hit) {?>
      <div class="Item">
          <h2><a href="<?php echo ITEM.'?code='.h($hit->Code).'&query='.$_GET['query'].'&sort='.$_GET['sort'].'&category_id='.$_GET['category_id']; ?>"><?php echo h($hit->Name); ?></a></h2><a><?php echo h($hit->Price); ?>円</a>
          <p><a href="<?php echo ITEM.'?code='.h($hit->Code).'&query='.$_GET['query'].'&sort='.$_GET['sort'].'&category_id='.$_GET['category_id']; ?>"><img src="<?php echo h($hit->Image->Medium); ?>" /></a><?php echo h($hit->Description); ?></p>
      </div>
      <?php } ?>
      <!-- Begin Yahoo! JAPAN Web Services Attribution Snippet -->
      <a href="http://developer.yahoo.co.jp/about">
      <img src="http://i.yimg.jp/images/yjdn/yjdn_attbtn2_105_17.gif" width="105" height="17" title="Webサービス by Yahoo! JAPAN" alt="Webサービス by Yahoo! JAPAN" border="0" style="margin:15px 15px 15px 15px"></a>
      <!-- End Yahoo! JAPAN Web Services Attribution Snippet -->
          </body>
      </html>
