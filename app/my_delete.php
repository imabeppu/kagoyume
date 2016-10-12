<?php
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
require_once("../util/dbaccessUtil.php");
page(MY_DELETE);
?>
<!DOCTYPE html>
<html lang="ja">
 <head>
 <meta charset="UTF-8">
      <title>ユーザー消去画面</title>
 </head>
  <body>
    <?php
    login();
    foreach ($_SESSION['login'] as $value) {
      foreach ($value as $key => $value) {
        echo '<p>'.$key.' '.$value.'</p>';
      }
    }
     ?>
     <p>以上のユーザーの情報を消去してもよろしいですか？</p>
     <p><a  href="<?=MY_DELETE_RESULT?>">消去する</a></p>
     <p><a  href="<?=MYDATA?>">ユーザー情報画面に戻る</a></p>
     <p><a href=<?=INDEX?>>トップページに戻る</a></p>
  </body>
</html>
