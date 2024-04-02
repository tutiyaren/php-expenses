<?php 
session_start();
use App\Categories;
require '../../../../app/Categories.php';
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

if(empty($_POST['name'])) {
    $_SESSION['errorUpdateCategory'] = '収入源が入力されていません';
    header('Location: /../spendings/categories/edit.php?id=' . $_POST['category_id']);
    exit();
}

$userId = $_SESSION['id'];
$name = $_POST['name'];
$categoryModel = new Categories($pdo);

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $category_id = $_POST['category_id'];
    $categoryModel->updateCategories($category_id, $name);
    header('Location: /../spendings/categories/index.php');
    exit();
}
