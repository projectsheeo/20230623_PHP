<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>日本酒アプリ_データ入力</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
</head>

<body>

    <header class="header">

        <div>
            <img src="img/logo.png" alt="" width="100px">
        </div>
        <nav>
            <ul class="header_nav">
                <li class="header_nav_i">Sake</li>
                <li class="header_nav_i">Types</li>
                <li class="header_nav_i">Regions</li>
                <li class="header_nav_i">Pairings</li>
                <li class="header_nav_i">Offers</li>
            </ul>
        </nav>

    </header>

    <div class="title">
        <p>Rate your sake experience!</p>
    </div>

    <div class="form">
        <form action="write.php" method="post">

            <!-- 基本質問項目 -->
            <div class="form-group">
                <label for="nameOfSake">Name of sake</label>
                <input type="text" id="nameOfSake" name="nameOfSake" required>
            </div>

            <div class="form-group">
                <label for="nameOfBrewery">Name of brewery</label>
                <input type="text" id="nameOfBrewery" name="nameOfBrewery" required>
            </div>

            <div class="form-group">
                <label for="typeOfSake">Type of sake</label>
                <select id="typeOfSake" name="typeOfSake" required>
                    <option value="">Select an option</option>
                    <option value="Junmai Daiginjo">Junmai Daiginjo</option>
                    <option value="Daiginjo">Daiginjo</option>
                    <option value="Junmai Ginjo">Junmai Ginjo</option>
                    <option value="Ginjo">Ginjo</option>
                    <option value="Junmai">Junmai</option>
                    <option value="Honjozo">Honjozo</option>
                    <option value="sparkling">Sparkling</option>
                </select>
            </div>

            <div class="form-group">
                <label for="rating">Rating</label>
                <input type="range" id="rating" name="rating" min="1" max="5" step="0.1">
                <span class="slider-value">0</span>
            </div>

            <div class="form-group">
                <label for="review">Review</label>
                <textarea id="review" name="review"></textarea>
            </div>

            <!-- 追加質問項目 -->

            <p id="moreInfoQuestion" class="moreInfoQuestion">Do you want to post more information about this sake?</p>

            <div id="additionalQ">

                <div class="form-group">
                    <label for="price">Price (US$)</label>
                    <input type="number" id="price" name="price" step="0.01">
                </div>

                <div class="form-group">
                    <div class="slider_label">
                        <label for="dry">Dry</label>
                        <label for="sweet">Sweet</label>
                    </div>
                    <input type="range" id="sweetness" name="sweetness" min="-5" max="5" step="0.1">
                    <!-- 数値を表示したい場合は以下のコードを挿入 -->
                    <!-- <span class="slider-value">0</span> -->
                </div>

                <div class="form-group">
                    <div class="slider_label">
                        <label for="light">Light</label>
                        <label for="bold">Bold</label>
                    </div>
                    <input type="range" id="boldness" name="boldness" min="-5" max="5" step="0.1">
                     <!-- 数値を表示したい場合は以下のコードを挿入 -->
                    <!-- <span class="slider-value">0</span> -->
                </div>

                <div class="form-group">
                    <div class="slider_label">
                        <label for="sharp">Sharp</label>
                        <label for="smooth">Smooth</label>
                    </div>
                    <input type="range" id="smoothness" name="smoothness" min="-5" max="5" step="0.1">
                    <!-- 数値を表示したい場合は以下のコードを挿入 -->
                    <!-- <span class="slider-value">0</span> -->
                </div>

            </div>

            <div class="form-group">
                <button type="submit">Done</button>
            </div>

            <!-- Doneボタンが押されたら、ボタンが押された時間を取得してwrite.phpに送る -->
            <input type="hidden" name="dateOfPost" value="<?php echo date('Y-m-d H:i:s'); ?>">

        </form>
    </div>

    <script src="input.js"></script>

</body>

</html>