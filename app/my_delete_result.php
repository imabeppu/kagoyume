<?php
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
require_once("../util/dbaccessUtil.php");
page(MY_DELETE_RESULT);
?>
<!DOCTYPE html>
<html lang="ja">
 <head>
 <meta charset="UTF-8">
      <title>ユーザー消去結果画面</title>
 </head>
  <body>
    <?php
    $result=delete_user($_SESSION['login'][0]['userID']);
    if($result==null){
      echo '<p>ユーザーデータの消去が完了しました</p>';
      session_unset();
      if (isset($_COOKIE['PHPSESSID'])) {
      setcookie('PHPSESSID', '', time() - 1800, '/');
      }
      session_destroy();
      file_put_contents('../logs/log.txt','ユーザーデータ消去',FILE_APPEND);
    }else{
      echo '<p>右記のエラーにより消去を中断しました:'.$result.'</p><p><a  href="'.MYDATA.'">ユーザー情報画面に戻る</a></p>';
      }
    echo '<p><a href='.INDEX.'>トップページに戻る</a></p>';
    ?>
  </body>
</html>
