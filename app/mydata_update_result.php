<?php
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
require_once("../util/dbaccessUtil.php");
page(MYDATA_UP_RESULT);
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
      <title>更新結果画面</title>
</head>
  <body>
    <?php
    login();
     if(isset($_POST['mode']) && $_POST['mode']=='update' or  isset($_POST['mode']) && $_POST['mode']=="RESULT"){
           if($_POST['mode'] =="RESULT"){
             $name = $_SESSION['name'];
             $password = $_SESSION['password'];
             $mail = $_SESSION['mail'];
             $address = $_SESSION['address'];
             $userID=$_SESSION['login'][0]['userID'];
           //idはPOSTで来るので変更
           $result = update_user($userID,$name,$password,$mail,$address);
           //エラーが発生しなければ表示を行う
           if(!isset($result)){
           ?>
           <h1>更新確認</h1>
           名前:<?php echo $name;?><br>
           パスワード:<?php echo $password;?><br>
           メールアドレス:<?php echo $mail;?><br>
           住所:<?php echo $address;?><br><br>
           以上の内容で更新しました。<br>
           <?php
            $_SESSION['login']=null;
            $_SESSION['login']=select_user($userID);
           ?>
           <?php
           }else{
               echo 'データの更新に失敗しました。次記のエラーにより処理を中断します:'.$result;
           }
         }
         else{
         //ポストの存在チェックとセッションに値を格納しつつ、連想配列にポストされた値を格納
         $confirm_values = array(
                                 'name' => bind_p2s('name'),
                                 'password' =>bind_p2s('password'),
                                 'mail' =>bind_p2s('mail'),
                                 'address' =>bind_p2s('address'));

         //1つでも未入力項目があったら表示しない
         if(!in_array(null,$confirm_values, true)){
             ?>
             <h1>登録確認画面</h1><br>
             名前:<?php echo $confirm_values['name'];?><br>
             パスワード:<?php echo $confirm_values['password'];?><br>
             メールアドレス:<?php echo $confirm_values['mail'];?><br>
             住所:<?php echo $confirm_values['address'];?><br><br>

             上記の内容で登録します。よろしいですか？

             <form action="<?php echo MYDATA_UP_RESULT ?>" method="POST">
                 <input type="hidden" name="mode" value="RESULT" >
                 <input type="submit" name="yes" value="はい">
             </form>
             <form action="<?php echo MYDATA_UP  ?>" method="POST">
                 <input type="hidden" name="mode" value="REINPUT" >
                 <input type="submit" name="no" value="登録画面に戻る">
             </form>
             <?php
         }else {
             ?>
             <h1>入力項目が不完全です</h1><br>
             再度入力を行ってください<br>
             <h3>不完全な項目</h3>
             <?php
             //連想配列内の未入力項目を検出して表示
             foreach ($confirm_values as $key => $value){
                 if($value == null){
                     if($key == 'name'){
                         echo '名前';
                     }
                     if($key == 'password'){
                         echo 'パスワード';
                     }
                     if($key == 'mail'){
                         echo 'メールアドレス';
                     }
                     if($key == 'address'){
                         echo '住所';
                     }
                     echo 'が未記入です<br>';
                 }
             }
             ?>
             <form action="<?php echo MYDATA_UP  ?>" method="POST">
                 <input type="hidden" name="mode" value="REINPUT" >
                 <input type="submit" name="no" value="登録画面に戻る">
             </form>
             <?php
         }
       }

         //詳細画面に戻るボタンを追加
         //このページから戻る場合は1度ＤＢにアクセスしないと正確な情報が表示されないので詳細画面でセッションから情報を取得する処理は行わないようにする
         ?>
         <form action="<?php echo MYDATA; ?>" method="POST">
           <input type="submit" name="NO" value="マイデータに戻る"style="width:200px">
        <?php
      }else{
        echo 'アクセスルートが不正です。もう一度トップページからやり直してください<br>';
      }
         ?>
         <p><a href=<?=INDEX?>>トップページに戻る</a></p>
       </body>
     </html>
