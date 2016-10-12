<?php
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
require_once("../util/dbaccessUtil.php");
page(REGIST_COMP);
 ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
      <title>登録結果画面</title>
</head>
    <body>
    <?php
    login();
    if(isset($_POST['mode']) && $_POST['mode']=='RESULT'){
        $name = $_SESSION['name'];
        $mail = $_SESSION['mail'];
        $password = $_SESSION['password'];
        $address = $_SESSION['address'];

        //データのDB挿入処理。エラーの場合のみエラー文がセットされる。成功すればnull
        $result = insert_user($name, $password, $mail, $address);

        //エラーが発生しなければ表示を行う
        if(!isset($result)){
        ?>
        <h1>登録結果画面</h1><br>
        名前:<?php echo $name;?><br>
        メールアドレス:<?php echo $mail;?><br>
        自己紹介:<?php echo $address;?><br>
        以上の内容で更新しました。<br>
        <?php
        }else{
            echo 'データの挿入に失敗しました。次記のエラーにより処理を中断します:'.$result;
        }
    }else{
    echo 'アクセスルートが不正です。もう一度トップページからやり直してください<br>';
    }
    ?>
    <p><a href=<?=INDEX?>>トップページに戻る</a></p>
    </body>
</html>
