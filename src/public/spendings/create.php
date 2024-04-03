<?php
require_once '../common/auth.php';
require '../../app/Categories.php';
use App\Categories;
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

$categoriesModel = new Categories($pdo);
$allCategories = $categoriesModel->getCategories($userId);
$categoryName = "";

$errorAddSpendings = "";
if(isset($_SESSION['errorAddSpendings'])) {
    $errorAddSpendings = $_SESSION['errorAddSpendings'];
    unset($_SESSION['errorAddSpendings']);
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
            <h1>支出登録</h1>
        </div>

        <!-- 支出登録 -->
        <div>
            <form action="../process/spendings/store.php" method="POST">
                <div>
                    <label for="name">支出名</label>
                    <input type="text" id="name" name="name" placeholder="支出名">
                </div>
                <div>
                    <span>支出源 : </span>
                    <select name="categoryName">
                        <option disabled selected style="display: none;">支出を選択してください</option>
                        <?php foreach($allCategories as $allCategory): ?>
                        <option><?php echo $allCategory['name'] ?></option>
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
                <?php echo $errorAddSpendings ?>
            </div>
            <div>
                <a href="index.php">戻る</a>
            </div>
        </div>
    </div>
    
  
</body>
</html>
