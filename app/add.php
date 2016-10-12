<?php
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
page(ADD);
$check=true;
if(isset($_POST['mode']) && $_POST['mode']=="item"){
  $name=$_POST['name'];
  $price=$_POST['price'];
  $image=$_POST['image'];
  $des=$_POST['description'];
  $code=$_POST['code'];
  $val=$_POST['val'];
  if(isset($_SESSION[$code])){
      $val=$_SESSION[$code]['value']+$val;
  }else{
    $cartcord=array();
    if(isset($_SESSION['cart'])){
      $cartcord=$_SESSION['cart'];
      for($i=0; $i<100; $i++){
      if(!isset($cartcord[$i])){
        $cartcord[$i]=$code;
        break;
      }
      }
    }else{
      $cartcord[0]=$code;
    }
    $_SESSION['cart']=$cartcord;
  }
  $_SESSION[$code]=array('name' => $name,'price' => $price,'image' => $image,'description' => $des,'code' => $code,'value' =>$val);
}else{
$check=false;
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <title>ショッピングデモサイト - カートに追加</title>
        <link rel="stylesheet" type="text/css" href="../css/prototype.css"/>
    </head>
    <body>
      <?php
      login();
       if($check==false){echo '不正なアクセスです。トップページから入りなおしてください。';}
       else{
      ?>
            <p><?php echo $name; ?></p>
            <p><?php echo $price; ?></p>
            <p><img src="<?php echo $image; ?>"></p>
            <p><?php echo $des; ?></p>
            <p><?php echo $code; ?></p>
            <p>個数<?php echo $_POST['val']; ?>個</p>
            <p>上記商品をカートに追加しました</p>
     <?php } ?>
     <a href="<?php echo CART; ?>">カートを見る</a>
     <a href="<?php echo ITEM; ?>">詳細画面に戻る</a>
     <br><a href="<?php echo SEARCH; ?>">検索画面</a>
    </body>
</html>
