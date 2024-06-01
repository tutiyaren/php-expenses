<?php
session_start();

$success = "";
if(isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

$error = "";
if(isset($_SESSION['errorMessage'])) {
    $error = $_SESSION['errorMessage'];
    unset($_SESSION['errorMessage']);
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
    <div>
        <div>
            <h1>ログイン</h1>
        </div>
        <div>
            <?php echo $success ?>
            <?php echo $error ?>
        </div>
        <!-- form -->
        <form action="../process/user/signin_complete.php" method="post">
            <div>
                <input type="email" name="email" placeholder="Email">
            </div>
            <div>
                <input type="password" name="password" placeholder="Password">
            </div>
            <div>
                <button type="submit">ログイン</button>
            </div>
        </form>
        <div>
            <a href="signup.php">アカウントを作る</a>   
        </div>
    </div>
</body>
</html>