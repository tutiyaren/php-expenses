<?php
require_once '../../common/auth.php';


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
            <!-- foreach -->
            <tr>
                <td>SES</td>
                <td>
                    <a href="edit.php">編集</a>
                </td>
                <td>
                    <form action="../../process/incomes/income_sources/delete.php" method="POST">
                        <button type="submit" name="delete">削除</button>
                    </form>
                </td>
            </tr>
        </table>

        <div>
            <a href="../create.php">戻る</a>
        </div>

    </div>
  
</body>
</html>
