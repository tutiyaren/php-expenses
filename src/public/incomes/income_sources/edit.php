<?php
require_once '../../common/auth.php';


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP-家計簿アプリ</title>
</head>
<body>

    <?php include '../../header/header.php'; ?>

    <div>

        <div>
            <h1>編集</h1>
        </div>

        <!-- 収支編集 -->
        <div>
            <form action="../../process/incomes/income_sources/update.php" method="POST">
                <div>
                    <span>収入源 : </span>
                    <input type="text" name="" placeholder="収入源を追加" value="">
                </div>

                <button type="submit" name="update">編集</button>

            </form>
        </div>
    </div>
  
</body>
</html>
