<?php
require_once '../common/auth.php';
require '../../app/Incomes.php';
use App\Incomes;
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

$incomeModel = new Incomes($pdo);
$allIncomes = $incomeModel->getIncomes($userId);
$uniqueIncomeSources = array_unique(array_column($allIncomes, 'name'));
$allAmount = $incomeModel->getAllAmount($userId);

if(isset($_GET['search']) && isset($_GET['income_sourceName']) && !empty($_GET['income_sourceName'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $income_sourceName = $_GET['income_sourceName'];
    $filteredIncomes = $incomeModel->getFilteredIncomes($userId, $income_sourceName, $start_date, $end_date);
}
if(isset($_GET['search']) && !(isset($_GET['income_sourceName'])) && empty($_GET['income_sourceName'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $income_sourceName = null;
    $filteredIncomes = $incomeModel->getFilteredIncomes($userId, $income_sourceName, $start_date, $end_date);
}

if(!(isset($_GET['search']))) {
    $filteredIncomes = $allIncomes;
}

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
            <h1>収入</h1>
        </div>

        <div>
            <p>合計額 : <?php echo $allAmount ?></p>
        </div>
        <div>
            <a href="create.php">収入を登録する</a>
        </div>

        <!-- 収支の絞り込み検索 -->
        <div>
            <form method="GET">
                <span>
                    収入源 : 
                </span>
                <select name="income_sourceName">
                    <option disabled selected style="display: none;">収入源を選択してください</option>
                    <?php foreach($uniqueIncomeSources as $income): ?>
                    <option value="<?php echo $income ?>"><?php echo $income ?></option>
                    <?php endforeach; ?>
                </select>
                <span>
                    日付 : 
                </span>
                <input type="date" name="start_date" value="<?php echo $_GET['start_date'] ?? '' ?>">
                <input type="date" name="end_date" value="<?php echo $_GET['end_date'] ?? '' ?>">
                <button type="submit" name="search">検索</button>
            </form>
        </div>

        <!-- 収入一覧テーブル -->
        <table>
            <tr>
                <th>収入名</th>
                <th>金額</th>
                <th>日付</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
            <!-- foreach -->
            <?php foreach($filteredIncomes as $allIncome): ?>
            <tr>
                <td><?php echo $allIncome['name'] ?></td>
                <td><?php echo $allIncome['amount'] ?></td>
                <td><?php echo $allIncome['accrual_date'] ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $allIncome['id'] ?>">編集</a>
                </td>
                <td>
                    <form action="../process/incomes/delete.php" method="POST">
                        <input type="hidden" name="income_id" value="<?php echo $allIncome['id'] ?>">
                        <button type="submit" name="delete">削除</button>
                    </form>
                </td>
            </tr>
            <? endforeach; ?>
        </table>

    </div>
  
</body>
</html>
