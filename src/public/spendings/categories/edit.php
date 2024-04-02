<?php
require_once '../../common/auth.php';
use App\Categories;
require '../../../app/Categories.php';
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

$categoriesModel = new Categories($pdo);
$categories_id = $_GET['id'];
$categories = $categoriesModel->getCategory($categories_id);
$errorUpdateCategory = "";
if(isset($_SESSION['errorUpdateCategory'])) {
    $errorUpdateCategory = $_SESSION['errorUpdateCategory'];
    unset($_SESSION['errorUpdateCategory']);
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

    <?php include '../../header/header.php'; ?>

    <div>

        <div>
            <h1>編集</h1>
        </div>

        <!-- 支出編集 -->
        <div>
            <form action="../../process/spendings/categories/update.php" method="POST">
                <div>
                    <span>支出源 : </span>
                    <input type="text" name="name" placeholder="支出源を追加" value="<?php echo $categories['name'] ?>">
                </div>
                <input type="hidden" name="category_id" value="<?php echo $categories['id'] ?>">
                <button type="submit" name="update">編集</button>

            </form>
            <div>
                <?php echo $errorUpdateCategory ?>
            </div>
        </div>
    </div>
  
</body>
</html>
