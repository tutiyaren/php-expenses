<?php
session_start();
use App\Categories;
require '../../../../app/Categories.php';
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

$userId = $_SESSION['id'];
$categoriesModel = new Categories($pdo);

if(!($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']))) {
    header('Location: /../categories/index.php');
    exit();
}
$category_id = $_POST['category_id'];
$categoriesModel->deleteCategories($category_id);
header('Location: /../spendings/categories/index.php');
exit();
