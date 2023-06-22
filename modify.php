<!-- 登録済のデータを編集する -->

<?php

// 更新したいデータのidを取得
$id = $_GET['id'];

// データベースに接続
try {
    $db = new PDO('mysql:dbname=puresake_db;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    echo 'データベースに接続できませんでした' . $e->getMessage();
}

// idを指定してデータを取得
$sql = 'SELECT * FROM rating WHERE id=:id';
$stmt = $db->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// 取得したデータを表示
$view = '';
if ($status == false) {
    // エラーがあればエラーを表示
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    // 取得したデータを配列表示
    $row = $stmt->fetch();
    // $row['id], $row['nameOfSake']...
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>日本酒アプリ_データ更新</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
</head>

<body>

    <div class="title">
        <p>Modify your rating</p>
    </div>

    <div class="form">
        <form action="update.php" method="post">

            <!-- 基本質問項目 -->
            <div class="form-group">
                <label for="nameOfSake">Name of sake</label>
                <input type="text" id="nameOfSake" name="nameOfSake" value="<?php echo $row['nameOfSake']; ?>" required>
            </div>

            <div class="form-group">
                <label for="nameOfBrewery">Name of brewery</label>
                <input type="text" id="nameOfBrewery" name="nameOfBrewery" value="<?php echo $row['nameOfBrewery']; ?>">
            </div>

            <div class="form-group">
                <label for="typeOfSake">Type of sake</label>
                <select id="typeOfSake" name="typeOfSake" required>
                    <option value="">Select an option</option>
                    <option value="Junmai Daiginjo" <?php if ($row['typeOfSake'] === 'Junmai Daiginjo') echo ' selected'; ?>>Junmai Daiginjo</option>
                    <option value="Daiginjo" <?php if ($row['typeOfSake'] === 'Daiginjo') echo ' selected'; ?>>Daiginjo</option>
                    <option value="Junmai Ginjo" <?php if ($row['typeOfSake'] === 'Junmai Ginjo') echo ' selected'; ?>>Junmai Ginjo</option>
                    <option value="Ginjo" <?php if ($row['typeOfSake'] === 'Ginjo') echo ' selected'; ?>>Ginjo</option>
                    <option value="Junmai" <?php if ($row['typeOfSake'] === 'Junmai') echo ' selected'; ?>>Junmai</option>
                    <option value="Honjozo" <?php if ($row['typeOfSake'] === 'Honjozo') echo ' selected'; ?>>Honjozo</option>
                    <option value="sparkling" <?php if ($row['typeOfSake'] === 'sparkling') echo ' selected'; ?>>Sparkling</option>
                </select>
            </div>

            <div class="form-group">
                <label for="rating">Rating</label>
                <input type="range" id="rating" name="rating" min="1" max="5" step="0.1">
                <span class="slider-value">0</span>
            </div>

            <script>
                // PHPの値をJavaScriptで取得し、スライダーの値を設定する
                let ratingInput = document.getElementById('rating');
                let ratingValue = <?php echo $row['rating']; ?>;
                ratingInput.value = ratingValue;
                document.querySelector('.slider-value').textContent = ratingValue;
            </script>


            <div class="form-group">
                <label for="review">Review</label>
                <textarea id="review" name="review"><?php echo $row['review']; ?></textarea>
            </div>


            <div id="additionalQ">

                <div class="form-group">
                    <label for="price">Price (US$)</label>
                    <input type="number" id="price" name="price" step="0.01" value="<?php echo $row['price']; ?>">
                </div>

                <div class="form-group">
                    <div class="slider_label">
                        <label for="dry">Dry</label>
                        <label for="sweet">Sweet</label>
                    </div>
                    <input type="range" id="sweetness" name="sweetness" min="-5" max="5" step="0.1" value="<?php echo $row['sweetness']; ?>">
                    <!-- 数値を表示したい場合は以下のコードを挿入 -->
                    <!-- <span class="slider-value">0</span> -->
                </div>

                <div class="form-group">
                    <div class="slider_label">
                        <label for="light">Light</label>
                        <label for="bold">Bold</label>
                    </div>
                    <input type="range" id="boldness" name="boldness" min="-5" max="5" step="0.1" value="<?php echo $row['boldness']; ?>">
                    <!-- 数値を表示したい場合は以下のコードを挿入 -->
                    <!-- <span class="slider-value">0</span> -->
                </div>

                <div class="form-group">
                    <div class="slider_label">
                        <label for="sharp">Sharp</label>
                        <label for="smooth">Smooth</label>
                    </div>
                    <input type="range" id="smoothness" name="smoothness" min="-5" max="5" step="0.1" value="<?php echo $row['smoothness']; ?>">
                    <!-- 数値を表示したい場合は以下のコードを挿入 -->
                    <!-- <span class="slider-value">0</span> -->
                </div>

            </div>

            <div class="form-group">
                <button type="submit">Done</button>
            </div>

            <!-- Doneボタンが押されたら、ボタンが押された時間を取得して送る -->
            <input type="hidden" name="dateOfPost" value="<?php echo date('Y-m-d H:i:s'); ?>">

            <!-- ユーザーには表示されない形でidも送る -->
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        </form>
    </div>
    
</body>

</html>