<?php
/**
 * ポストから情報を受け取っていた場合それを変数とクッキーに保存する関数
 * @param type フォームのname
 * @return string 前回入力情報
 */
 function form_value($name){
    if(isset($_POST['mode']) && $_POST['mode']=='REINPUT'){
        if(isset($_SESSION[$name])){
            return $_SESSION[$name];
        }
    }
}
/**
* ポストからセッションに存在チェックしてから値を渡す。
* 二回目以降のアクセス用に、ポストから値の上書きがされない該当セッションは初期化する
* @param type $name
* @return type
*/
function bind_p2s($name){
   if(!empty($_POST[$name])){
       $_SESSION[$name] = $_POST[$name];
       return $_POST[$name];
   }else{
       $_SESSION[$name] = null;
       return null;
   }
}
/**
* ポストからセッションに存在チェックしてから値を渡す。
* 二回目以降のアクセス用に、ポストから値の上書きがされない該当セッションは初期化する
* @param type $name
* @return type
*/
function passcheck($name){
  if(isset($_POST['password']) && $_POST['password'] != null){
   if($_POST['password']==$_POST['reinput']){
       $_SESSION[$name] = $_POST[$name];
       return $_POST[$name];
   }else{
       $_SESSION[$name] = null;
       return null;
   }
 }else{
   $_SESSION[$name]=null;
   return null;
 }
}
/**
 * modeをhiddenでＰＯＳＴ先のページに渡す
 * @param type　$name　ページの名前
 * @return type　不正アクセスを防ぐためにmodeを伝えるhiddenのフォーム
 */
function modecheck($name){
echo  '<input type="hidden" name="mode" value="'.$name.'">';
}


function login(){
if(!isset($_SESSION['login'])){
  echo '<a href="'.LOGIN.'">ログインする</a><br>';
}else{
  foreach ($_SESSION['login'] as $value) {
    foreach ($value as $key => $value) {
      if($key=='name'){echo '<p>ようこそ<a href="'.MYDATA.'">'.$value.'さん！</p><p>ユーザーデータを見る</p></a>';}

    }
  }
  echo '<p><a href="'.LOGIN.'?mode=logout">ログアウト</a></p><p><a href='.CART.'>カートを見る</a></p>';
}
}


function page($name){
  file_put_contents('../logs/log.txt',$name.'に遷移',FILE_APPEND);
  session_start();
  $_SESSION['page']=$name;
}
