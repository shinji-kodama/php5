<?php
//関数読込み
include("../funcs.php");

//ファイルアップロード処理
$status = fileUpload("upfile","upload/"); //戻り値：0=ファイル名,1=NG,2=NG
if($status==1 || $status==2){
    $img ="アップロード失敗";
}else{
    $img = $status; //ファイル名
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>アップロード画面サンプル</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   <main>
    <!-- ヘッダー -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand">写真アップロード</a></div>
            </div>
        </nav>
    </header>
    <!-- ヘッダー -->
    <?php echo $img; ?>
</main>
</body>
</html>