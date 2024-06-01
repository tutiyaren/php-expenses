<?php 
session_start();
use App\Income_sources;
require '../../../../app/Income_sources.php';
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

if(empty($_POST['name'])) {
    $_SESSION['errorUpdateIncome_source'] = '収入源が入力されていません';
    header('Location: /../incomes/income_sources/edit.php?id=' . $_POST['income_source_id']);
    exit();
}

$userId = $_SESSION['id'];
$name = $_POST['name'];
$income_sourceModel = new Income_sources($pdo);

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $income_source_id = $_POST['income_source_id'];
    $income_sourceModel->updateIncome_sources($income_source_id, $name);
    header('Location: /../incomes/income_sources/index.php');
    exit();
}
