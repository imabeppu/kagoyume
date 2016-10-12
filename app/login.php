<?php
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
require_once("../util/dbaccessUtil.php");
session_start();
file_put_contents('../logs/log.txt',LOGIN.'に遷移',FILE_APPEND);
$check=false;
if(isset($_POST['mode']) && $_POST['mode']=="ログイン"){
   $result=login_user($_POST['name']);
   if(is_array($result)){
     foreach ($result as $value) {
       foreach ($value as $key => $value) {
         if($key=='deleteFlag' && $value==1){
           $check=='delete';
         }
         else if($key=='password' && $value==$_POST['password']){
           $check=true;
         }
       }
     }
   }else{echo $result;}
   if($check==true){
     $_SESSION['login']=$result;
   }
 }
 ?>
 <!DOCTYPE html>
 <html lang="ja">
     <head>
         <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
         <title>ショッピングデモサイト - ログイン</title>
         <link rel="stylesheet" type="text/css" href="../css/prototype.css"/>
     </head>
     <body>
       <?php if(isset($_GET['mode']) && $_GET['mode']=='logout'){
              session_unset();
              if (isset($_COOKIE['PHPSESSID'])) {
              setcookie('PHPSESSID', '', time() - 1800, '/');
              }
              session_destroy();
              file_put_contents('../logs/log.txt','ログアウト',FILE_APPEND);
                echo '<p>ログアウトしました</p><p><a href='.INDEX.'>トップページに戻る</a></p>' ;
             }else{ ?>
       <?php   if(isset($_POST['mode']) && $_POST['mode']=="ログイン"){
                if($check==false){ ?>
                 <p>ログインに失敗しました<br>ユーザーＩＤとパスワードが一致しません</p>
      <?php    }elseif($check==true){
               file_put_contents('../logs/log.txt','ログイン',FILE_APPEND); ?>
                <p>ログインに成功しました<br><a href="<?=$_SESSION['page']?>">元のページに戻る</a></p>
    <?php      }else if($check=='delete'){
                  echo 'そのユーザーは消去されています';
               }
              }else{ ?>
               <form action="<?=LOGIN?>" method="post">
                <p>名前<input type="text" name="name"></p>
                <p>パスワード<input type="password" name="password"></p>
                <?php modecheck('ログイン'); ?>
                <input type="submit" name="sub" value="ログイン">
               </form>
               <p><a href="<?=REGIST?>">ユーザー登録する</a></p>
       <?php  }
            } ?>
     </body>
</html>
