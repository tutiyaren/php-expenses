<?php
require_once '../common/auth.php';
require '../../app/Incomes.php';
require '../../app/Income_sources.php';
use App\Incomes;
use App\Income_sources;
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

$incomeModel = new Incomes($pdo);
$income_id = $_GET['id'];
$income = $incomeModel->getIncome($income_id);

$income_sourceModel = new Income_sources($pdo);
$allIncomes = $income_sourceModel->getIncome_sources($userId);

$errorUpdateIncome = "";
if(isset($_SESSION['errorUpdateIncome'])) {
    $errorUpdateIncome = $_SESSION['errorUpdateIncome'];
    unset($_SESSION['errorUpdateIncome']);
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
            <h1>収入編集</h1>
        </div>

        <!-- 収支編集 -->
        <div>
            <form action="../process/incomes/update.php" method="POST">
                <div>
                    <span>収入源 : </span>
                    <select name="income_sourceName">
                        <?php foreach($allIncomes as $allIncome): ?>  
                        <?php if($allIncome['id'] === $income['income_source_id']): ?>  
                        <option value="<?php echo $allIncome['id']; ?>" selected><?php echo $allIncome['name'] ?></option>
                        <?php endif; ?>
                        <?php if(!($allIncome['id'] === $income['income_source_id'])): ?>  
                        <option value="<?php echo $allIncome['id']; ?>"><?php echo $allIncome['name'] ?></option>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <span>金額</span>
                    <input type="text" name="amount" placeholder="金額を入力" value="<?php echo $income['amount'] ?>">
                    <span>円</span>
                </div>

                <div>
                    <span>日付</span>
                    <input type="date" name="accrual_date" value="<?php echo $income['accrual_date'] ?>">
                </div>
                <input type="hidden" name="income_id" value="<?php echo $income['id'] ?>">
                <button type="submit" name="update">編集</button>

            </form>

            <div>
                <?php echo $errorUpdateIncome; ?>
            </div>
            
        </div>
    </div>
  
</body>
</html>
