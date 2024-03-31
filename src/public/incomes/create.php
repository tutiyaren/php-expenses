<?php
require_once '../common/auth.php';


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP-家計簿アプリ</title>
</head>
<body>

    <?php include '../header/header.php'; ?>

    <div>

        <div>
            <h1>収入登録</h1>
        </div>

        <!-- 収支登録 -->
        <div>
            <form action="../process/incomes/store.php" method="POST">
                <div>
                    <span>収入源 : </span>
                    <select name="">
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                    <a href="income_sources/index.php">収入源一覧へ</a>
                </div>

                <div>
                    <span>金額</span>
                    <input type="text" name="">
                    <span>円</span>
                </div>

                <div>
                    <span>日付</span>
                    <input type="date" name="">
                </div>

                <button type="submit" name="store">登録</button>

            </form>
            <div>
                <a href="index.php">戻る</a>
            </div>
        </div>
    </div>
  
</body>
</html>
