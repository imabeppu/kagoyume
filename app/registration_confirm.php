<?php
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
page(REGIST_CONF);
 ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
      <title>登録確認画面</title>
</head>
  <body>
    <?php
    login();
    //入力画面から「確認画面へ」ボタンを押した場合のみ処理を行う
    if(isset($_POST['name'])){

        //ポストの存在チェックとセッションに値を格納しつつ、連想配列にポストされた値を格納
        $confirm_values = array(
                                'name' => bind_p2s('name'),
                                'password' =>passcheck('password'),
                                'mail' =>bind_p2s('mail'),
                                'address' =>bind_p2s('address'));

        //1つでも未入力項目があったら表示しない
        if(!in_array(null,$confirm_values, true)){
            ?>
            <h1>登録確認画面</h1><br>
            名前:<?php echo $confirm_values['name'];?><br>
            パスワード:<?php echo '●●●●' ?><br>
            電話番号:<?php echo $confirm_values['mail'];?><br>
            自己紹介:<?php echo $confirm_values['address'];?><br><br>

            上記の内容で登録します。よろしいですか？

            <form action="<?php echo REGIST_COMP ?>" method="POST">
                <?php modecheck('RESULT') ?>
                <input type="submit" name="yes" value="はい">
            </form>
            <?php
        }else {
            ?>
            <h1>入力項目が不完全です</h1><br>
            再度入力を行ってください<br>
            <h3>不完全な項目</h3>
            <?php
            foreach ($confirm_values as $key => $value){
                if($value == null){
                    if($key == 'name'){
                        echo '名前';
                    }
                    if($key == 'mail'){
                        echo 'メール';
                    }
                    if($key == 'address'){
                        echo '住所';
                    }
                    if($key == 'password'){
                      echo 'パスワードが不正です<br>';
                    }
                    else{
                    echo 'が未記入です<br>';
                    }
                }
            }
        }
        ?>
        <form action="<?php echo REGIST ?>" method="POST">
            <?php modecheck('REINPUT') ?>
            <input type="submit" name="no" value="登録画面に戻る">
        </form>
        <?php
    }else{
      echo 'アクセスルートが不正です。もう一度トップページからやり直してください<br>';
    }
    ?>
    <p><a href=<?=INDEX?>>トップページに戻る</a></p>
</body>
</html>
