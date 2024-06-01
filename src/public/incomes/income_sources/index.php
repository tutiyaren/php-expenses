<?php
require_once '../../common/auth.php';
require '../../../app/Income_sources.php';
use App\Income_sources;
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

$errorDeleteIncome_sources = '';
if(isset($_SESSION['errorDeleteIncome_sources'])) {
    $errorDeleteIncome_sources = $_SESSION['errorDeleteIncome_sources'];
    unset($_SESSION['errorDeleteIncome_sources']);
}

$income_sourcesModel = new Income_sources($pdo);
$allIncome_sources = $income_sourcesModel->getIncome_sources($userId);

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
            <h1>収入源一覧</h1>
        </div>

        <div>
            <a href="create.php">収入源を追加する</a>
        </div>

        <!-- 収入源一覧 -->
        <table>
            <tr>
                <th>収入源</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
            <?php foreach($allIncome_sources as $allIncome_source): ?>
            <tr>
                <td><?php echo $allIncome_source['name'] ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $allIncome_source['id']; ?>">編集</a>
                </td>
                <td>
                    <form action="../../process/incomes/income_sources/delete.php" method="POST">
                        <input type="hidden" name="income_source_id" value="<?php echo $allIncome_source['id'] ?>">
                        <button type="submit" name="delete">削除</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php echo $errorDeleteIncome_sources ?>

        <div>
            <a href="../create.php">戻る</a>
        </div>

    </div>
  
</body>
</html>
