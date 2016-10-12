<?php
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
require_once("../util/dbaccessUtil.php");
page(MYDATA);
$data=$_SESSION['login'];

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <title>ショッピングデモサイト - マイデータ</title>
        <link rel="stylesheet" type="text/css" href="../css/prototype.css"/>
    </head>
    <body>
      <?php login();
      foreach ($data as $value) {
        foreach ($value as $key => $value) {
          if($key=='userID'){continue;}
          echo '<p>'.$key.' '.$value.'</p>';
        }
      } ?>
      <p><a  href="<?php echo MYDATA_UP; ?>">ユーザーの情報を変更する</a></p>
      <p><a  href="<?=MY_HISTORY?>">購入履歴を見る</a></p>
      <p><a  href="<?=MY_DELETE?>">このユーザーの情報を消去する</a></p>
      <p><a href=<?=INDEX?>>トップページに戻る</a></p>
    </body>
</html>
