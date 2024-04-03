<?php
require_once '../common/auth.php';
require '../../app/Spendings.php';
require '../../app/Categories.php';
use App\Spendings;
use App\Categories;
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

$spendingModel = new Spendings($pdo);
$spending_id = $_GET['id'];
$spending = $spendingModel->getSpending($spending_id);

$categoryModel = new Categories($pdo);
$allSpendings = $categoryModel->getCategories($userId);

$errorUpdateSpending = "";
if(isset($_SESSION['errorUpdateSpending'])) {
    $errorUpdateSpending = $_SESSION['errorUpdateSpending'];
    unset($_SESSION['errorUpdateSpending']);
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
            <h1>支出編集</h1>
        </div>

        <!-- 支出編集 -->
        <div>
            <form action="../process/spendings/update.php" method="POST">
                <div>
                    <label for="name">支出名</label>
                    <input type="text" id="name" placeholder="支出名" name="name" value="<?php echo $spending['name'] ?>">
                </div>
                <div>
                    <span>支出源 : </span>
                    <select name="categoryName">
                        <?php foreach($allSpendings as $allSpending): ?>  
                        <?php if($allSpending['id'] === $spending['category_id']): ?>  
                        <option value="<?php echo $allSpending['id']; ?>" selected><?php echo $allSpending['name'] ?></option>
                        <?php endif; ?>
                        <?php if(!($allSpending['id'] === $spending['category_id'])): ?>  
                        <option value="<?php echo $allSpending['id']; ?>"><?php echo $allSpending['name'] ?></option>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <span>金額</span>
                    <input type="text" name="amount" placeholder="金額を入力" value="<?php echo $spending['amount'] ?>">
                    <span>円</span>
                </div>

                <div>
                    <span>日付</span>
                    <input type="date" name="accrual_date" value="<?php echo $spending['accrual_date'] ?>">
                </div>
                <input type="hidden" name="spending_id" value="<?php echo $spending['id'] ?>">
                <button type="submit" name="update">編集</button>

            </form>

            <div>
                <?php echo $errorUpdateSpending; ?>
            </div>
            
        </div>
    </div>
  
</body>
</html>
