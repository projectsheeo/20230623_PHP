<!-- データを削除する -->

<?php
// 送られてきたidをgetで受け取る
$id = $_GET['id'];

// DBに接続
try{
    $pdo = new PDO('mysql:dbname=puresake_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
}

// データ削除SQLを作成する
$sql = "DELETE FROM rating WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

// SQL処理実行
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // エラー処理
    $error = $stmt->errorInfo();
    exit('sqlError:'.$error[2]);
} else {
    // 登録ページへ移動
    header('Location: read.php');
}