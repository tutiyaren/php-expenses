<?php
require_once '../common/auth.php';
require '../../app/Spendings.php';
require '../../app/Categories.php';
use App\Categories;
use App\Spendings;
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

$spendingModel = new Spendings($pdo);
$allSpendings = $spendingModel->getSpendings($userId);
$allAmount = $spendingModel->getAllAmount($userId);

$categoriesModel = new Categories($pdo);
$allCategory = $categoriesModel->getCategory($userId);


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
            <h1>支出</h1>
        </div>

        <div>
            <p>合計額 : <?php echo $allAmount ?></p>
        </div>
        <div>
            <a href="create.php">支出を登録する</a>
        </div>

        <!-- 支出の絞り込み検索 -->
        <div>
            <form method="GET">
                <span>
                    収入源 : 
                </span>
                <select name="">
                    <option value=""></option>
                    <option value=""></option>
                </select>
                <span>
                    日付 : 
                </span>
                <select name="">
                    <option value=""></option>
                    <option value=""></option>
                </select>
                <select name="">
                    <option value=""></option>
                    <option value=""></option>
                </select>
                <button type="button">検索</button>
            </form>
        </div>

        <!-- 支出一覧テーブル -->
        <table>
            <tr>
                <th>支出名</th>
                <th>カテゴリー</th>
                <th>金額</th>
                <th>日付</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
            <!-- foreach -->
            <?php foreach($allSpendings as $allSpending): ?>
            <tr>
                <td><?php echo $allSpending['name'] ?></td>
                <td><?php echo $allSpending['categoryName'] ?></td>
                <td><?php echo $allSpending['amount'] ?></td>
                <td><?php echo $allSpending['accrual_date'] ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $allSpending['id'] ?>">編集</a>
                </td>
                <td>
                    <form action="../process/spendings/delete.php" method="POST">
                        <input type="hidden" name="spending_id" value="<?php echo $allSpending['id'] ?>">
                        <button type="submit" name="delete">削除</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

    </div>
  
</body>
</html>
