<?php
require_once '../../common/auth.php';

$errorAddCategory = "";
if(isset($_SESSION['errorAddCategory'])) {
    $errorAddCategory = $_SESSION['errorAddCategory'];
    unset($_SESSION['errorAddCategory']);
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
            <h1>支出源追加</h1>
        </div>

        <!-- 支出登録 -->
        <div>
            <div>
                <?php echo $errorAddCategory ?>
            </div>
            <form action="../../process/spendings/categories/store.php" method="POST">
                <div>
                    <span>支出源 : </span>
                    <input type="text" name="name" placeholder="支出源を追加">
                </div>

                <button type="submit" name="store">登録</button>

            </form>
            <div>
                <a href="index.php">戻る</a>
            </div>
        </div>
    </div>
  
</body>
</html>
