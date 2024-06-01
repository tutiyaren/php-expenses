<?php
session_start();
ob_start();

$userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
// ログインされていない場合にログインページにリダイレクト
if (!$userId) {
    header('Location: /user/signin.php');
    exit();
}
