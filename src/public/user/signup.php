<?php
session_start();

$error = "";
if(isset($_SESSION['errorMessage'])) {
    $error = $_SESSION['errorMessage'];
    unset($_SESSION['errorMessage']);
}
if(isset($_SESSION['errorPassword'])) {
    $error = $_SESSION['errorPassword'];
    unset($_SESSION['errorPassword']);
}
if(isset($_SESSION['errorEmail'])) {
    $error = $_SESSION['errorEmail'];
    unset($_SESSION['errorEmail']);
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
            <h1>会員登録</h1>
        </div>
        <div>
            <?php echo $error ?>
        </div>
        <!-- form -->
        <form action="signup_confirm.php" method="post">
            <div>
                <input type="text" name="name" placeholder="User name">
            </div>
            <div>
                <input type="email" name="email" placeholder="Email">
            </div>
            <div>
                <input type="password" name="password" placeholder="Password">
            </div>
            <div>
                <input type="password" name="password_confirmation" placeholder="Password確認用">
            </div>
            <div>
                <button type="submit">アカウント作成</button>
            </div>
        </form>
        <div>
            <a href="signin.php">ログイン画面へ</a>   
        </div>
    </div>

</body>
</html>