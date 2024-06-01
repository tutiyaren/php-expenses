<?php
session_start();

$_SESSION['name'] = $_POST['name'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['password_confirmation'] = $_POST['password_confirmation'];

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
            <h1>会員登録はこちらの内容でよろしいですか</h1>
        </div>
        <div>
            <p>ユーザー名：<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name'], ENT_QUOTES) : ''; ?></p>
            <p>メールアドレス：<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email'], ENT_QUOTES) : ''; ?></p>
            <p>パスワード：<?php echo isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password'], ENT_QUOTES) : ''; ?></p>
        </div>
        <!-- form -->
        <form action="../process/user/signup_complete.php" method="post">
            <input type="hidden" name="name" value="<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name'], ENT_QUOTES) : ''; ?>">
            <input type="hidden" name="email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email'], ENT_QUOTES) : ''; ?>">
            <input type="hidden" name="password" value="<?php echo isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password'], ENT_QUOTES) : ''; ?>">
            <input type="hidden" name="password_confirmation" value="<?php echo isset($_SESSION['password_confirmation']) ? htmlspecialchars($_SESSION['password_confirmation'], ENT_QUOTES) : ''; ?>">
            <div>
                <button type="submit" name="">送信</button>
            </div>
        </form>
    </div>

</body>
</html>