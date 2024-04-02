<?php
require_once '../common/auth.php';


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
            <h1>支出</h1>
        </div>

        <div>
            <p>合計額 : 800000</p>
        </div>
        <div>
            <a href="create.php">支出を登録する</a>
        </div>

        <!-- 支出の絞り込み検索 -->
        <div>
            <form method="GET">
                <span>
                    収入源 : 
                </span>
                <select name="">
                    <option value=""></option>
                    <option value=""></option>
                </select>
                <span>
                    日付 : 
                </span>
                <select name="">
                    <option value=""></option>
                    <option value=""></option>
                </select>
                <select name="">
                    <option value=""></option>
                    <option value=""></option>
                </select>
                <button type="button">検索</button>
            </form>
        </div>

        <!-- 支出一覧テーブル -->
        <table>
            <tr>
                <th>支出名</th>
                <th>金額</th>
                <th>日付</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
            <!-- foreach -->
            <tr>
                <td>SES</td>
                <td>300000</td>
                <td>2024-09-18</td>
                <td>
                    <a href="edit.php">編集</a>
                </td>
                <td>
                    <form action="../process/spendings/delete.php" method="POST">
                        <button type="submit" name="delete">削除</button>
                    </form>
                </td>
            </tr>
        </table>

    </div>
  
</body>
</html>
