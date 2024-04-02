<?php
session_start();
use App\Categories;
require '../../../../app/Categories.php';
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

if(empty(htmlspecialchars($_POST['name']))) {
    Categories::validate();
}

$userId = $_SESSION['id'];
$name = $_POST['name'];
$categoriesModel = new Categories($pdo);
$createCategories = $categoriesModel->addCategories($userId, $name);
if($createCategories !== false) {
    header('Location: /../spendings/categories/index.php');
}
