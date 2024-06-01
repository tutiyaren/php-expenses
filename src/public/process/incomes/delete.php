<?php
session_start();

use App\Incomes;
require '../../../app/Incomes.php';
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

$userId = $_SESSION['id'];
$incomeModel = new Incomes($pdo);

if(!($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']))) {
    header('Location: /../incomes/index.php');
    exit();
}

$income_id = $_POST['income_id'];
$incomeModel->deleteIncome($income_id);
header('Location: /../incomes/index.php');
exit();
