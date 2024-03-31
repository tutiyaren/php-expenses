<?php
session_start();
use App\Income_sources;
require '../../../../app/Income_sources.php';
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

$userId = $_SESSION['id'];
$income_sourcesModel = new Income_sources($pdo);

if(!($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']))) {
    header('Location: /../incomes_income_sources/index.php');
    exit();
}
$income_source_id = $_POST['income_source_id'];
$income_sourcesModel->deleteIncome_sources($income_source_id);
header('Location: /../incomes/income_sources/index.php');
exit();
