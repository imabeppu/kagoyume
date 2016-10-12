<?php
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
page(BUY_CONF);
$num=0;
$numval=0;
 ?>
 <!DOCTYPE html>
 <html lang="ja">
     <head>
         <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
         <title>ショッピングデモサイト - 購入確認画面</title>
         <link rel="stylesheet" type="text/css" href="../css/prototype.css"/>
     </head>
     <body>
       <?php
       login();
       if(!isset($_SESSION['login'])){
         echo '<p>ログインしてください</p><p><a href='.LOGIN.'>ログインへ</a></p>';
       }else{
             if(isset($_SESSION['cart'])){
               foreach ($_SESSION['cart'] as $value) {
                 echo '<p>'.$_SESSION[$value]['name'].'</p>
                       <p>'.$_SESSION[$value]['price'].'円</p>
                       <p>個数'.$_SESSION[$value]['value'].'個</p>
                       <p>総額'.$_SESSION[$value]['value']*$_SESSION[$value]['price'].'円</p><br>';
                       $numval=$numval+$_SESSION[$value]['value'];
                       $num=$num+$_SESSION[$value]['value']*$_SESSION[$value]['price'];
              }
            }
       ?>              <p>合計個数<?php echo $numval; ?>点</p>
                       <p>合計金額<?php echo $num; ?>円</p>
                       <form action=<?php echo BUY_COMP; ?> method="post">
                         <p>発送方法<input type="radio" name="type" value="1"　checked="checked">通常配送<input type="radio" name="type<?php $_SESSION[$value]['code'] ?>" value="2"　>速達</p>
                         <input type="submit" value="購入を確定する">
                       </form>
<?php } ?>
       <p><a href=<?=INDEX?>>トップページに戻る</a></p>
     </body>
 </html>
