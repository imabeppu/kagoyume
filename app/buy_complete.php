<?php
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
require_once("../util/dbaccessUtil.php");
page(BUY_COMP);
$num=0;
$numval=0;
?>
 <html lang="ja">
     <head>
         <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
         <title>ショッピングデモサイト - 購入結果画面</title>
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
                 $insertresult=insert_buy($_SESSION['login'][0]['userID'], $value, $_POST['type']);
                 if(isset($insertresult)){
                 echo $insertresult;
                 break;
                }
              }
            }
       ?>              <p>合計個数<?php echo $numval; ?>点</p>
                       <p>合計金額<?php echo $num; ?>円</p>
                       <p>発送方法<?php if($_POST['type']==1){echo '通常配送';}elseif($_POST['type']==2){echo '速達';} ?></p>
                       <?php
                       if(!isset($insertresult)){
                       $_SESSION['cart']=null; ?>
                       <p>購入確定しました</p>
                       <?php }else{
                         echo '<p>購入処理に失敗しました</p>';
                       } ?>
<?php } ?>
       <p><a href=<?=INDEX?>>トップページに戻る</a></p>
       <p><a href=<?=MY_HISTORY?>>購入履歴へ</a></p>
     </body>
 </html>
