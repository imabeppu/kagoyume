<?php
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
page(REGIST);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
      <title>登録画面</title>
</head>
<body>
    <?php login(); ?>
    <form action="<?php echo REGIST_CONF ?>" method="POST">

        名前:<br>
        <input type="text" name="name" value="<?php echo form_value('name'); ?>">
        <br><br>

        パスワード:<br>
        <input type="password" name="password">
        <br>パスワード再入力：<br>
        <input type="password" name="reinput">
        <br><br>

        メールアドレス:<br>
        <input type="text" name="mail" value="<?php echo form_value('mail'); ?>">
        <br><br>

        住所:<br>
        <input type="text" name="address" value="<?php echo form_value('address'); ?>">
        <br><br>

        <input type="submit" name="btnSubmit" value="確認画面へ">
    </form>
    <p><a href=<?=INDEX?>>トップページに戻る</a></p>
</body>
</html>
