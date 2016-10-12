<?php
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
page(ITEM.'?code='.$_GET['code']);
$code=$_GET['code'];
$url="http://shopping.yahooapis.jp/ShoppingWebService/V1/itemLookup?appid=$APPID&itemcode=$code&responsegroup=medium&image_size=300";
$xml=simplexml_load_file($url);
$hit = $xml->Result->Hit;
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <title>ショッピングデモサイト - 商品詳細</title>
        <link rel="stylesheet" type="text/css" href="../css/prototype.css"/>
    </head>
    <body>
      <?php login(); ?>
      <div>
          <h2><a><?php echo h($hit->Name); ?></a></h2><a><?php echo h($hit->Price); ?>円</a>
          <p><a><img src="<?php echo h($hit->ExImage->Url); ?>" width="300" height="300"/></a></p>
          <?php echo h($hit->Description);
          if(!isset($_SESSION['login'])){
            echo '<p>カートに追加するにはログインしてください</p>';
          }else{ ?>
          <form action = "<?=ADD?>" method="POST">
            <p>数量
              <select name="val">
              <?php
              for($i=1; $i<=30; $i++){ ?>
              <option value="<?php echo $i;?>"><?php echo $i ;?></option>
              <?php } ?>
          </select>個</p>
            <input type="hidden" name="name" value="<?php echo h($hit->Name); ?>">
            <input type="hidden" name="price" value="<?php echo ($hit->Price); ?>">
            <input type="hidden" name="image" value="<?php echo ($hit->ExImage->Url); ?>">
            <input type="hidden" name="description" value="<?php echo h($hit->Description); ?>">
            <input type="hidden" name="code" value="<?php echo h($hit->Code); ?>">
            <input type="hidden" name="mode" value="item">
            <input type="submit" name="btnSubmit" value="カートに追加する">
          </form>
          <a href="<?php echo SEARCH.'?query='.$_GET['query'].'&sort='.$_GET['sort'].'&category_id='.$_GET['category_id']; ?>">検索画面に戻る</a>
  <?php  } ?>
    </div>
    <p><a href=<?=INDEX?>>トップページに戻る</a></p>
  </body>
</html>
