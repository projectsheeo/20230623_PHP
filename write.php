<!-- Inputから受領したデータをデータベースに登録 -->

<?php 

// 直接ブラウザでアクセスした際のエラー防止用コード
if (
    !isset($_POST["nameOfSake"]) || $_POST["nameOfSake"]=="" ||
    !isset($_POST["nameOfBrewery"]) || $_POST["nameOfBrewery"]=="" ||
    !isset($_POST["typeOfSake"]) || $_POST["typeOfSake"]=="" ||
    !isset($_POST["rating"]) || $_POST["rating"]=="" ||
    !isset($_POST["review"]) || $_POST["review"]=="" ||
    !isset($_POST["dateOfPost"]) || $_POST["dateOfPost"]==""
) {
    exit('ParamError');
}

// Input.phpからデータを取得
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

// データベースへ接続（定型文）
    // 変更する箇所：
        // データベース名（'mysql:dbname）
        // データベースの場所（host eg. ローカル、さくらサーバー等）
        // 'root',''（ユーザー名、パスワード）→初期設定はroot,空欄
try{
    $pdo = new PDO('mysql:dbname=puresake_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
}

// データベースへデータを登録（SQLを使用）
    // INSERT INTO "*****" → テーブル名
    // VALUES(NULL, :a1, :a2, :a3, :a4, :a5, :a6, :a7, :a8, sysdate()) → テーブルのカラム名
$sql = '
INSERT INTO rating(id, nameOfSake, nameOfBrewery, typeOfSake, rating, review, price, sweetness, boldness, smoothness, dateOfPost)
VALUES(NULL, :a1, :a2, :a3, :a4, :a5, :a6, :a7, :a8, :a9, sysdate())';

// SQL準備
    // 引数1 = 上記のValues
    // 引数2 = inputから取得したデータを変数に代入したもの
    // 引数3 = データの型
            // PDO::PARAM_STR は文字列
            // PDO::PARAM_INT は数値
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $nameOfSake, PDO::PARAM_STR);  
$stmt->bindValue(':a2', $nameOfBrewery, PDO::PARAM_STR); 
$stmt->bindValue(':a3', $typeOfSake, PDO::PARAM_STR);
$stmt->bindValue(':a4', $rating, PDO::PARAM_INT);
$stmt->bindValue(':a5', $review, PDO::PARAM_STR);
$stmt->bindValue(':a6', $price, PDO::PARAM_INT);
$stmt->bindValue(':a7', $sweetness, PDO::PARAM_INT);
$stmt->bindValue(':a8', $boldness, PDO::PARAM_INT);
$stmt->bindValue(':a9', $smoothness, PDO::PARAM_INT);
// SQL実行
$status = $stmt->execute();

// データ登録処理の後：エラーがあれば処理を停止・表示、なければinput.phpへ移動
if ($status == false) {
    // エラーがあれば表示
    $error = $stmt->errorInfo();
    exit('QueryError:'.$error[2]);
} else {
    // input.phpへ移動
    header('Location: input.php');
    exit;
}

?>
