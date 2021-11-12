<?php
//1. POSTデータ取得
$name   = $_POST["name"];
$email  = $_POST["email"];
$naiyou = $_POST["naiyou"];

//2. DB接続します(エラー処理追加)
include("funcs.php");
$pdo = db_conn();

$img = fileUpload('upfile','upload/');

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_an_table( name, email, naiyou, indate, img )VALUES(:name, :email, :naiyou, sysdate(), :img)");
$stmt->bindValue(':name', $name);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':naiyou', $naiyou);
$stmt->bindValue(':img', $img);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect('index.php');
  // echo "true";
}
?>
