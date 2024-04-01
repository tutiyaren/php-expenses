<?php
session_start();
use App\Incomes;
require '../../../app/Incomes.php';
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

if(empty($_POST['income_sourceName'])) {
    $_SESSION['errorUpdateIncome'] = '収入源を選択してください';
    header('Location: /../incomes/edit.php?id=' . $_POST['income_id']);
}
if(empty($_POST['amount'])) {
    $_SESSION['errorUpdateIncome'] = '金額を入力してください';
    header('Location: /../incomes/edit.php?id=' . $_POST['income_id']);
}
if(empty($_POST['accrual_date'])) {
    $_SESSION['errorUpdateIncome'] = '日付を入力してください';
    header('Location: /../incomes/edit.php?id=' . $_POST['income_id']);
}

$userId = $_SESSION['id'];
$income_source_id = $_POST['income_sourceName'];
$amount = $_POST['amount'];
$accrual_date = $_POST['accrual_date'];
$incomeModel = new Incomes($pdo);

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $income_id = $_POST['income_id'];
    $incomeModel->updateIncome($income_id, $income_source_id, $amount, $accrual_date);
    header('Location: /../incomes/index.php');
    exit();
}
