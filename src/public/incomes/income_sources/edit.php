<?php
require_once '../../common/auth.php';
use App\Income_sources;
require '../../../app/Income_sources.php';
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

$income_sourcesModel = new Income_sources($pdo);
$incom_sources_id = $_GET['id'];
$incom_sources = $income_sourcesModel->getIncome_source($incom_sources_id);
$errorUpdateIncome_source = "";
if(isset($_SESSION['errorUpdateIncome_source'])) {
    $errorUpdateIncome_source = $_SESSION['errorUpdateIncome_source'];
    unset($_SESSION['errorUpdateIncome_source']);
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

        <!-- 収支編集 -->
        <div>
            <form action="../../process/incomes/income_sources/update.php" method="POST">
                <div>
                    <span>収入源 : </span>
                    <input type="text" name="name" placeholder="収入源を追加" value="<?php echo $incom_sources['name'] ?>">
                </div>
                <input type="hidden" name="income_source_id" value="<?php echo $incom_sources['id'] ?>">
                <button type="submit" name="update">編集</button>

            </form>
            <div>
                <?php echo $errorUpdateIncome_source ?>
            </div>
        </div>
    </div>
  
</body>
</html>
