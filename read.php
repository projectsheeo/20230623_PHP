<!-- データベースから情報を取得 -->

<?php

// データベースに接続（定型文
    // 変更する箇所：
        // データベース名（'mysql:dbname）
        // データベースの場所（host eg. ローカル、さくらサーバー等）
        // 'root',''（ユーザー名、パスワード）→初期設定はroot,空欄
try{
    $pdo = new PDO('mysql:dbname=puresake_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
}

// データ取得SQLを作成する →ここでどんなデータを取得するかを決定する
    // 変更する箇所：
        // 1. 操作名（SELECT）
        // 2. 対象のカラム名（*は全てのカラム）
        // 3. テーブル名（rating）
$stmt = $pdo->prepare("SELECT * FROM rating");
// SQLを実行する
$status = $stmt->execute();

// データ表示
    // 取得結果を格納する変数を定義する（今回は$view）
    $view="";
    // エラーがある場合、エラーを表示・処理を終了
    if ($status==false){
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
    } else {
        // データを取得して$viewに格納する
        while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
            // $viewの最後に.をつけることで上書きしないようにする
            // リンクは表示された出力結果をクリックするとmodify.phpに飛ぶようにする
            $view .= "<p>";
            $view .= '<a href="modify.php?id='.$result["id"].'">';
            $view .= $result["dateOfPost"].":  ".$result["id"].":  ".$result["nameOfSake"].":  ".$result["nameOfBrewery"].":  ".$result["typeOfSake"].":  ".$result["rating"].":  ".$result["review"].":  ".'$'.$result["price"].":  ".$result["sweetness"].":  ".$result["boldness"].":  ".$result["smoothness"];
            $view .= '</a>';
            $view .= "</p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>日本酒アプリ_データ表示</title>
</head>
<body>

    <h1>Sake rating data</h1>
    <br>
    <div><?php echo $view; ?></div>

</body>
</html>