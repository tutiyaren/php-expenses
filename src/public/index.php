<?php
require_once 'common/auth.php';
require '../app/Spendings.php';
require '../app/Incomes.php';
use App\Incomes;
use App\Spendings;
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

$incomeModel = new Incomes($pdo);
$monthAmountIncome = $incomeModel->getMonthAmount($userId);
$spendingModel = new Spendings($pdo);
$monthAmountSpending = $spendingModel->getMonthAmount($userId);
$balance = $monthAmountIncome - $monthAmountSpending;

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP-家計簿アプリ</title>
</head>
<body>

    <?php include 'header/header.php'; ?>

    <div>

        <div>
            <h1>家計簿アプリ</h1>
        </div>

        <!-- 年セレクトの検索 -->
        <div>
            <form method="GET">
                <select name="">
                    <option value=""></option>
                    <option value=""></option>
                </select>
                <span>
                    年の収支一覧
                    <button type="button">検索</button>
                </span>
            </form>
        </div>

        <!-- 収支一覧テーブル -->
        <table>
            <tr>
                <th>月</th>
                <th>収入</th>
                <th>支出</th>
                <th>収支</th>
            </tr>
            <!-- foreach -->
            <tr>
                <td>n月</td>
                <td><?php echo $monthAmountIncome ?></td>
                <td><?php echo $monthAmountSpending ?></td>
                <td><?php echo $balance ?></td>
            </tr>
        </table>

    </div>
  
</body>
</html>
