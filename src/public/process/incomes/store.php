<?php
session_start();

use App\Incomes;
require '../../../app/Incomes.php';
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

if(empty($_POST['income_sourceName']) || empty($_POST['amount']) || empty($_POST['accrual_date'])) {
    Incomes::validateIncome();
}

$income_sourceName = $_POST['income_sourceName'];
$smt = $pdo->prepare('SELECT id FROM income_sources WHERE name = :name');
$smt->execute([':name' => $income_sourceName]);
$income_source = $smt->fetch(PDO::FETCH_ASSOC);
$income_source_id = $income_source['id'];

$userId = $_SESSION['id'];
$amount = $_POST['amount'];
$accrual_date = $_POST['accrual_date'];

$incomeModel = new Incomes($pdo);
$createIncomes = $incomeModel->addIncome($userId, $income_source_id, $amount, $accrual_date);
if($createIncomes !== false) {
    header('Location: /../incomes/index.php');
    exit();
}
