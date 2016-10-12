<?php
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
require_once("../util/dbaccessUtil.php");
page(MYDATA_UP);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
      <title>変更入力画面</title>
</head>
<body>
  <?php
  login();
    $result = $_SESSION['login'];
    if(isset($_POST['mode']) && $_POST['mode']=='REINPUT'){
      $name=form_value('name');
      $password=form_value('password');
      $mail=form_value('mail');
      $address=form_value('address');
    }
    else{
    $name=$result[0]['name'];
    $password=$result[0]['password'];
    $mail=$result[0]['mail'];
    $address=$result[0]['address'];
  }
    ?>
    <form action="<?=MYDATA_UP_RESULT?>" method="post">
    名前:
    <input type="text" name="name" value="<?php echo $name; ?>">
    <br><br>

    パスワード:
    <input type="text" name="password" value="<?php echo $password; ?>">
    <br><br>

    メールアドレス:
    <input type="text" name="mail" value="<?php echo $mail; ?>">
    <br><br>

    住所:
    <input type="text" name="address" value="<?php echo $address; ?>">
    <br><br>

    <input type="hidden" name="mode" value="update">

    <Div Align="left"><input type="submit" name="btnSubmit" value="以上の内容で更新を行う"></Div>
    </form>
    <p><a  href="<?=MYDATA?>">ユーザー情報画面に戻る</a></p>
    <p><a href=<?=INDEX?>>トップページに戻る</a></p>
</body>
</html>
