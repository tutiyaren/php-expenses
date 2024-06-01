<?php
session_start();
use App\Income_sources;
require '../../../../app/Income_sources.php';
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

if(empty(htmlspecialchars($_POST['name']))) {
    Income_sources::validate();
}

$userId = $_SESSION['id'];
$name = $_POST['name'];
$income_sourcesModel = new Income_sources($pdo);
$createIncome_sources = $income_sourcesModel->addIncome_sources($userId, $name);
if($createIncome_sources !== false) {
    header('Location: /../incomes/income_sources/index.php');
}
