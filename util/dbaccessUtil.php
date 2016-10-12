<?php
//DBへの接続を行う。成功ならPDOオブジェクトを、失敗なら中断、メッセージの表示を行う
function create_pdo() {
        $dsn = DB_TYPE . ':host=' . DBHOST . ';dbname=' . DBNAME . ';charset=utf8';
        $obj_pdo = new PDO($dsn, DBUSER, DBPASS);
        $obj_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $obj_pdo;
    }
function insert_buy($userID, $itemCode, $type){
        //db接続を確立
        try{
        $insert_db = create_pdo();
      }catch(PDOException $e) {
             return $e->getMessage();
          }
        //DBに全項目のある1レコードを登録するSQL
        $insert_sql = "INSERT INTO ".BUY."(userID,itemCode,type,buyDate)"
                . "VALUES(:userID,:itemCode,:type,:buyDate)";
        //現在時をdatetime型で取得
        $datetime =new DateTime();
        $date = $datetime->format('Y-m-d H:i:s');

        //クエリとして用意
        $insert_query = $insert_db->prepare($insert_sql);

        //SQL文にセッションから受け取った値＆現在時をバインド
        $insert_query->bindValue(':userID',$userID);
        $insert_query->bindValue(':itemCode',$itemCode);
        $insert_query->bindValue(':type',$type);
        $insert_query->bindValue(':buyDate',$date);

        //SQLを実行
        try{
            $insert_query->execute();
        } catch (PDOException $e) {
            //接続オブジェクトを初期化することでDB接続を切断
            $insert_db = null;
            return $e->getMessage();
        }

        $insert_db = null;
        return null;
    }
    function insert_user($name, $password, $mail,$address){
            //db接続を確立
            try{
            $insert_db = create_pdo();
            }catch(PDOException $e) {
                 return $e->getMessage();
              }
            //DBに全項目のある1レコードを登録するSQL
            $insert_sql = "INSERT INTO ".USER."(name,password,mail,address,newDate)"
                    . "VALUES(:name,:password,:mail,:address,:newDate)";

            //現在時をdatetime型で取得
            $datetime =new DateTime();
            $date = $datetime->format('Y-m-d H:i:s');

            //クエリとして用意
            $insert_query = $insert_db->prepare($insert_sql);

            //SQL文にセッションから受け取った値＆現在時をバインド
            $insert_query->bindValue(':name',$name);
            $insert_query->bindValue(':password',$password);
            $insert_query->bindValue(':mail',$mail);
            $insert_query->bindValue(':address',$address);
            $insert_query->bindValue(':newDate',$date);

            //SQLを実行
            try{
                $insert_query->execute();
            } catch (PDOException $e) {
                //接続オブジェクトを初期化することでDB接続を切断
                $insert_db = null;
                return $e->getMessage();
            }

            $insert_db = null;
            return null;
        }

    function select_user($userID){
            //db接続を確立
            try{
            $db = create_pdo();
           }catch(PDOException $e){
                 return $e->getMessage();
            }
            //DBに全項目のある1レコードを登録するSQL
            $sql="SELECT * from ".USER." WHERE userID =".$userID;

            //クエリとして用意
            $query=$db->prepare($sql);
            try{
               $query->execute();
            }catch (PDOException $e){
                //接続オブジェクトを初期化することでDB接続を切断
                $db = null;
                return $e->getMessage();
            }
            $result=$query->fetchall(PDO::FETCH_ASSOC);
            $db = null;
            return $result;
    }
    function login_user($name){
            //db接続を確立
            try{
            $db = create_pdo();
           }catch(PDOException $e){
                 return $e->getMessage();
            }
            //DBに全項目のある1レコードを登録するSQL
            $sql="SELECT * from ".USER." WHERE name =:name";

            //クエリとして用意
            $query=$db->prepare($sql);

            $query->bindValue(':name',$name);
            try{
               $query->execute();
            }catch (PDOException $e){
                //接続オブジェクトを初期化することでDB接続を切断
                $db = null;
                return $e->getMessage();
            }
            $result=$query->fetchall(PDO::FETCH_ASSOC);
            $db = null;
            return $result;
    }
function update_user($userID,$name,$password,$mail,$address){
  try{
  $update_db = create_pdo();
 }catch(PDOException $e){
       return $e->getMessage();
  }
  //DBに全項目のある1レコードを登録するSQL
  $update_sql="UPDATE ".USER.
  " SET name=:name,password=:password,mail=:mail,address=:address,newDate=:newDate
  WHERE userID=:id";
   //現在時をdatetime型で取得
   $datetime =new DateTime();
   $date = $datetime->format('Y-m-d H:i:s');
  //クエリとして用意
  $update_query = $update_db->prepare($update_sql);

  //SQL文にセッションから受け取った値＆現在時をバインド
  $update_query->bindValue(':name',$name);
  $update_query->bindValue(':password',$password);
  $update_query->bindValue(':mail',$mail);
  $update_query->bindValue(':address',$address);
  $update_query->bindValue(':newDate',$date);
  $update_query->bindValue(':id',$userID);
  //SQLを実行
  try{
     $update_query->execute();
   }catch (PDOException $e) {
     $update_db=null;
     return $e->getMessage();
   }
   $update_db=null;
   return null;
}


function select_buy($userID){
        //db接続を確立
        try{
        $db = create_pdo();
       }catch(PDOException $e){
             return $e->getMessage();
        }
        //DBに全項目のある1レコードを登録するSQL
        $sql="SELECT * from ".BUY." WHERE userID =:userID";

        //クエリとして用意
        $query=$db->prepare($sql);

        $query->bindValue(':userID',$userID);
        try{
           $query->execute();
        }catch (PDOException $e){
            //接続オブジェクトを初期化することでDB接続を切断
            $db = null;
            return $e->getMessage();
        }
        $result=$query->fetchall(PDO::FETCH_ASSOC);
        $db = null;
        return $result;
}


function delete_user($userID){
  try{
  $update_db = create_pdo();
 }catch(PDOException $e){
       return $e->getMessage();
  }
  //DBに全項目のある1レコードを登録するSQL
  $update_sql="UPDATE ".USER.
  " SET deleteFlg=1
  WHERE userID=:id";
  //クエリとして用意
  $update_query = $update_db->prepare($update_sql);
  $update_query->bindValue(':id',$userID);

  //SQLを実行
  try{
     $update_query->execute();
   }catch (PDOException $e) {
     $update_db=null;
     return $e->getMessage();
   }
   $update_db=null;
   return null;
}
