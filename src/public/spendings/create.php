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
            <h1>支出登録</h1>
        </div>

        <!-- 支出登録 -->
        <div>
            <form action="../process/incomes/store.php" method="POST">
                <div>
                    <span>支出 : </span>
                    <select name="income_sourceName">
                        <option disabled selected style="display: none;">支出を選択してください</option>
                        <?php foreach($allIncome_sources as $allIncome_source): ?>
                        <option><?php echo $allIncome_source['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <a href="categories/index.php">支出一覧へ</a>
                </div>

                <div>
                    <span>金額</span>
                    <input type="number" name="amount">
                    <span>円</span>
                </div>

                <div>
                    <span>日付</span>
                    <input type="date" name="accrual_date">
                </div>

                <button type="submit" name="create">登録</button>

            </form>
            
            <div>
                <a href="index.php">戻る</a>
            </div>
        </div>
    </div>
  
</body>
</html>
