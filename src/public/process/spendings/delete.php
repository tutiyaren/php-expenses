<?php
session_start();

use App\Spendings;
require '../../../app/Spendings.php';
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

$userId = $_SESSION['id'];
$spendingModel = new Spendings($pdo);

if(!($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']))) {
    header('Location: /../spendings/index.php');
    exit();
}

$spending_id = $_POST['spending_id'];
$spendingModel->deleteSpending($spending_id);
header('Location: /../spendings/index.php');
