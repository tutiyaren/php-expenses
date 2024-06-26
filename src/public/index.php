<?php
require_once 'common/auth.php';
require '../app/Spendings.php';
require '../app/Incomes.php';
use App\Incomes;
use App\Spendings;
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

$incomeModel = new Incomes($pdo);
$spendingModel = new Spendings($pdo);

$currentYear = date('Y');
$yearsIncomes = $incomeModel->getYear($userId);
$yearsSpendings = $spendingModel->getYear($userId);

$selectedYear = isset($_GET['year']) ? $_GET['year'] : $currentYear;

if(isset($_GET['search'])) {
    // 選択された年の収支データを取得
    $monthIncomes = $incomeModel->getMonthAmount($userId, $selectedYear);
    $monthSpendings = $spendingModel->getMonthAmount($userId, $selectedYear);
}


$monthIncomes = $incomeModel->getMonthAmount($userId, $selectedYear);
$monthSpendings = $spendingModel->getMonthAmount($userId, $selectedYear);

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
                <select name="year">
                    <?php 
                    $allYears = array_merge($yearsIncomes, $yearsSpendings);
                    $uniqueYears = [];
                    foreach ($allYears as $yearArray) {
                        $year = $yearArray['year'];
                        if (!in_array($year, $uniqueYears)) {
                            $uniqueYears[] = $year;
                    ?>
                            <option value="<?php echo $year; ?>" <?php if($year == $selectedYear) echo 'selected'; ?>><?php echo $year; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <span>
                    年の収支一覧
                    <button type="submit" name="search">検索</button>
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
            <?php foreach(range(1, 12) as $month): ?>
                <tr>
                    <td><?php echo $month; ?>月</td>
                    <?php
                    $income = isset($monthIncomes[$selectedYear][$month]) ? $monthIncomes[$selectedYear][$month] : 0;
                    $spending = isset($monthSpendings[$selectedYear][$month]) ? $monthSpendings[$selectedYear][$month] : 0;
                    ?>
                    <td><?php echo $income; ?></td>
                    <td><?php echo $spending; ?></td>
                    <td><?php echo $income - $spending; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>
  
</body>
</html>
