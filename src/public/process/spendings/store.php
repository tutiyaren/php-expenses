<?php
session_start();

use App\Spendings;
require '../../../app/Spendings.php';
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

if(empty($_POST['name']) || empty($_POST['categoryName']) || empty($_POST['amount']) || empty($_POST['accrual_date'])) {
    Spendings::validateSpending();
}

$categoryName = $_POST['categoryName'];
$smt = $pdo->prepare('SELECT id FROM categories WHERE name = :name');
$smt->execute([':name' => $categoryName]);
$category = $smt->fetch(PDO::FETCH_ASSOC);
$category_id = $category['id'];

$userId = $_SESSION['id'];
$name = $_POST['name'];
$amount = $_POST['amount'];
$accrual_date = $_POST['accrual_date'];

$spendingModel = new Spendings($pdo);
$createSpendings = $spendingModel->addSpending($userId, $category_id, $name, $amount, $accrual_date);
if($createSpendings !== false) {
    header('Location: /../spendings/index.php');
    exit();
}
