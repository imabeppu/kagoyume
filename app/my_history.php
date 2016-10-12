<?php
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
require_once("../util/dbaccessUtil.php");
page(MY_HISTORY);
$userID=$_SESSION['login'][0]['userID'];
?>
<!DOCTYPE html>
<html lang="ja">
 <head>
 <meta charset="UTF-8">
      <title>購入履歴</title>
 </head>
  <body>
   <?php login();
   $result=select_buy($userID);
   if(is_array($result)){
     foreach ($result as $value){
      foreach ($value as $key => $value) {
        echo $key.$value;
      }echo '<br>';
     }
   }else{
   echo $result;
   }
   ?>
   <p><a  href="<?=MYDATA?>">ユーザー情報に戻る</a></p>
   <p><a href=<?=INDEX?>>トップページに戻る</a></p>
 </body>
</html>
