<?php
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
page(CART);
$num=0;
$numval=0;
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
        <title>ショッピングデモサイト - カート</title>
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
<?php
      if(isset($_SESSION['cart'])){
        foreach ($_SESSION['cart'] as $value) {
          echo '<p>'.$_SESSION[$value]['name'].'</p>
                <p>'.$_SESSION[$value]['price'].'円</p>
                <p><img src="'.$_SESSION[$value]['image'].'" width="150" height="150"></p>
                <p>'.$_SESSION[$value]['description'].'</p>
                <p>'.$_SESSION[$value]['code'].'</p>
                <p>総額'.$_SESSION[$value]['value']*$_SESSION[$value]['price'].'円</p>
                <p>個数'.$_SESSION[$value]['value'].'個</p>';
                $numval=$numval+$_SESSION[$value]['value'];
                $num=$num+$_SESSION[$value]['value']*$_SESSION[$value]['price'];
       }
     }
?>              <br><p>カート内の合計個数<?php echo $numval; ?>点</p>
　              <p>カート内の合計金額<?php echo $num; ?>円</p>
　　　　　　　　 <p><a href="<?php echo BUY_CONF; ?>">購入する</a></p>
               <p><a href="<?php echo SEARCH ?>">検索画面</a></p>
    </body>
</html>
