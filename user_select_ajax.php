<?php
session_start();

//1.外部ファイル読み込み＆DB接続
//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
sschk();
$pdo = db_conn();

//２．データ登録SQL作成
$search = $_POST['search'];
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE name LIKE :name");
$stmt->bindValue(':name', "%".$search."%", PDO::PARAM_STR);
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sql_error($stmt);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<p>';
        $view .= '<a href="user_detail.php?id='.$result["id"].'">';
        $view .= $result["name"] . "," . $result["lid"];
        $view .= '</a>';
        $view .= '　';
        $view .= '<a href="user_delete.php?id='.$result["id"].'">';
        $view .= '[ 削除 ]';
        $view .= '</a>';
        $view .= '</p>';
    }
}
echo $view;
?>