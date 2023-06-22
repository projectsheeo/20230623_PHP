<?php
// modify.phpから送られてきたデータを受け取る
$id = $_POST['id'];
$nameOfSake = $_POST['nameOfSake'];
$nameOfBrewery = $_POST['nameOfBrewery'];
$typeOfSake = $_POST['typeOfSake'];
$rating = $_POST['rating'];
$review = $_POST['review'];
$price = $_POST['price'];
$sweetness = $_POST['sweetness'];
$boldness = $_POST['boldness'];
$smoothness = $_POST['smoothness'];
$dateOfPost = $_POST['dateOfPost'];

// DBに接続

try{
    $pdo = new PDO('mysql:dbname=puresake_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
}

// データ更新SQLを作成する
$sql = "UPDATE rating SET nameOfSake=:nameOfSake, nameOfBrewery=:nameOfBrewery, typeOfSake=:typeOfSake, rating=:rating, review=:review, price=:price, sweetness=:sweetness, boldness=:boldness, smoothness=:smoothness, dateOfPost=:dateOfPost WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':nameOfSake', $nameOfSake, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':nameOfBrewery', $nameOfBrewery, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':typeOfSake', $typeOfSake, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':rating', $rating, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':review', $review, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':price', $price, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':sweetness', $sweetness, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':boldness', $boldness, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':smoothness', $smoothness, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':dateOfPost', $dateOfPost, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
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

?>