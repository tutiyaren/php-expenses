<?php
require_once '../../common/auth.php';
require '../../../app/Categories.php';
use App\categories;
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

$errorDeleteCategories = '';
if(isset($_SESSION['errorDeleteCategories'])) {
    $errorDeleteCategories = $_SESSION['errorDeleteCategories'];
    unset($_SESSION['errorDeleteCategories']);
}

$categoriesModel = new Categories($pdo);
$allCategories = $categoriesModel->getCategories($userId);

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
            <h1>支出源一覧</h1>
        </div>

        <div>
            <a href="create.php">支出源を追加する</a>
        </div>

        <!-- 支出源一覧 -->
        <table>
            <tr>
                <th>支出源</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
            <?php foreach($allCategories as $allCategory): ?>
            <tr>
                <td><?php echo $allCategory['name'] ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $allCategory['id']; ?>">編集</a>
                </td>
                <td>
                    <form action="../../process/spendings/categories/delete.php" method="POST">
                        <input type="hidden" name="category_id" value="<?php echo $allCategory['id'] ?>">
                        <button type="submit" name="delete">削除</button>
                    </form
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php echo $errorDeleteCategories ?>

        <div>
            <a href="../create.php">戻る</a>
        </div>

    </div>
  
</body>
</html>
