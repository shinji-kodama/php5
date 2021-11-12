<?php
session_start();

//1.外部ファイル読み込み＆DB接続
//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
sschk();
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sql_error($stmt);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<P>';
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
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>USER表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
    <?php echo $_SESSION["name"]; ?>さん　
    <?php include("menu.php"); ?>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <h1>ユーザー一覧</h1>
    <div>
        <input id="search" type="text">
        <button id="send">検索</button>
    </div>
    <div id="view" class="container jumbotron"><?php echo $view; ?></div>
</div>
<!-- Main[End] -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.getElementById('send').addEventListener('click', function(){

    //Ajax（非同期通信）
    //1.パラメータ変更
    //2.送信先
    //3.DOM操作
    const params = new URLSearchParams(); //クラス こうやって値をセットしないとデータが飛ばない
    params.append('search',  $('#search').val());

    //axiosでAjax送信
    axios.post('user_select_ajax.php',params).then(function (response) {
        console.log(response.data);//通信OK
        document.querySelector("#view").innerHTML=response.data;
    }).catch(function (error) {
        console.log(error);//通信Error
    }).then(function () {
        console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
    });
    });


</script>
</body>
</html>
