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
            <h1>収入編集</h1>
        </div>

        <!-- 収支登録 -->
        <div>
            <form action="../process/incomes/update.php" method="POST">
                <div>
                    <span>収入源 : </span>
                    <select name="">
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                </div>

                <div>
                    <span>金額</span>
                    <input type="text" name="" value="">
                    <span>円</span>
                </div>

                <div>
                    <span>日付</span>
                    <input type="date" name="" value="">
                </div>

                <button type="submit" name="update">編集</button>

            </form>
            
        </div>
    </div>
  
</body>
</html>
