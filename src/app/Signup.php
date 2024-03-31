<?php
namespace App;
use PDO;

interface signupInterface
{
    public function createUser(string $name, string $email, string $password, string $password_confirmation): void;
    public function isEmail(string $email): bool;
    public function addUser(string $name, string $email, string $passowrd): void;
}

abstract class signupAbstract implements signupInterface
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}

class Signup extends signupAbstract
{
    public function createUser(string $name, string $email, string $password, string $password_confirmation): void
    {
        // いずれかの項目に入力がない場合
        if(empty($name) || empty($email) || empty($password) || empty($password_confirmation)) {
            $_SESSION['errorMessage'] = '「UserName」か「Email」か「Password」の入力がありません';
            header('Location: /user/signup.php');
            exit();
        }
        // パスワードが一致しない場合
        if($password !== $password_confirmation) {
            $_SESSION['errorPassword'] = 'パスワードが一致しません';
            header('Location: /user/signup.php');
            exit();
        }
        // 同一のemailがすでに登録されている場合
        if($this->isEmail($email)) {
            $_SESSION['errorEmail'] = 'すでに保存されているメールアドレスです';
            header('Location: /user/signup.php');
            exit();
        }

        $this->addUser($name, $email, $password);
    }

    public function isEmail(string $email): bool
    {
        $smt = $this->pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
        $smt->bindParam(':email', $email);
        $smt->execute();
        $count = $smt->fetchColumn();
        return $count > 0;
    }

    public function addUser(string $name, string $email, string $password): void
    {
        date_default_timezone_set('Asia/Tokyo');
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        $smt = $this->pdo->prepare('INSERT INTO users(name, email, password, created_at, updated_at) VALUES (:name, :email, :password, :created_at, :updated_at)');

        $smt->bindParam(':name', $name);
        $smt->bindParam(':email', $email);
        $smt->bindParam(':password', $password);
        $smt->bindParam(':created_at', $created_at);
        $smt->bindParam(':updated_at', $updated_at);
        $smt->execute();
        $_SESSION['success'] = '登録できました';
        header('Location: /user/signin.php');
        exit();
    }
}