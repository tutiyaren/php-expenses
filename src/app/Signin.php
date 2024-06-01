<?php
namespace App;
use PDO;

interface signinInterface
{
    public function item($email, $password);
    public function getUserByEmail($email);
    public function validateUserLogin($user, $password);
    public function together($user);
}

abstract class signinAbstract implements signinInterface
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}

class Signin extends signinAbstract
{
    public function item($email, $password)
    {
        // いずれかの項目に入力がない場合
        if(empty($email) || empty($password)) {
             $_SESSION['errorMessage'] = "メールアドレスとパスワードを入力してください";
            header('Location: /user/signin.php');
            exit();
        }
    }

    public function getUserByEmail($email)
    {
        $smt = $this->pdo->prepare('SELECT * FROM users WHERE email = ?');
        $smt->execute([$email]);
        return $smt->fetch(PDO::FETCH_ASSOC);
    }

    public function validateUserLogin($user, $password)
    {
        if(!$user || $password !== $user['password']) {
            $_SESSION['errorMessage'] = 'メールアドレスまたはパスワードが違います';
            header('Location: /user/signin.php');
            exit();
        }
        $this->together($user);
    }

    public function together($user)
    {
        $_SESSION['logged_in'] = true;
        $_SESSION['id'] = $user['id'];
        header('Location: /../index.php');
        exit();
    }
}