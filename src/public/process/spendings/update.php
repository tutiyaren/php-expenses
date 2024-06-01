<?php
session_start();
use App\Spendings;
require '../../../app/Spendings.php';
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

if(empty($_POST['name'])) {
    $_SESSION['errorUpdateSpending'] = '支出名を入力してください';
    header('Location: /../spendings/edit.php?id=' . $_POST['spending_id']);
}
if(empty($_POST['categoryName'])) {
    $_SESSION['errorUpdateSpending'] = '支出源を選択してください';
    header('Location: /../spendings/edit.php?id=' . $_POST['spending_id']);
}
if(empty($_POST['amount'])) {
    $_SESSION['errorUpdateSpending'] = '金額を入力してください';
    header('Location: /../spendings/edit.php?id=' . $_POST['spending_id']);
}
if(empty($_POST['accrual_date'])) {
    $_SESSION['errorUpdateSpending'] = '日付を入力してください';
    header('Location: /../spendings/edit.php?id=' . $_POST['spending_id']);
}

$userId = $_SESSION['id'];
$category_id = $_POST['categoryName'];
$name = $_POST['name'];
$amount = $_POST['amount'];
$accrual_date = $_POST['accrual_date'];
$spendingModel = new Spendings($pdo);

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $spending_id = $_POST['spending_id'];
    $spendingModel->updateSpending($spending_id, $category_id, $name, $amount, $accrual_date);
    header('Location: /../spendings/index.php');
    exit();
}