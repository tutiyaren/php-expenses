<?php
session_start();

use App\Signin;
require '../../../app/Signin.php';
$pdo = new PDO('mysql:host=mysql;dbname=kakeibo', 'root', 'password');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES);

    $userModel = new Signin($pdo);
    $userModel->item($email, $password);
    $user = $userModel->getUserByEmail($email);
    $userModel->validateUserLogin($user, $password);
    $error = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : '';
}