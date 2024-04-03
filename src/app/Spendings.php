<?php
namespace App;
use PDO;

interface spendingInterface
{
    public static function validateSpending();
    public function addSpending($userId, $category_id, $name, $amount, $accrual_date);
    public function getSpendings($userId);
    public function deleteSpending($spending_id);
    public function getSpending($spending_id);
    public function updateSpending($spending_id, $category_id, $name, $amount, $accrual_date);
    public function getAllAmount($userId);
}

abstract class AbstractSpending implements spendingInterface
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}

class Spendings extends AbstractSpending
{
    public static function validateSpending()
    {
        if(empty($_POST['name'])) {
            $_SESSION['errorAddSpendings'] = '支出名が入力されていません';
            header('Location: /Spendings/create.php');
            exit();
        }
        if(empty($_POST['categoryName'])) {
            $_SESSION['errorAddSpendings'] = '支出源が選択されていません';
            header('Location: /Spendings/create.php');
            exit();
        }
        if(empty($_POST['amount'])) {
            $_SESSION['errorAddSpendings'] = '金額が入力されていません';
            header('Location: /spendings/create.php');
            exit();
        }
        if(empty($_POST['accrual_date'])) {
            $_SESSION['errorAddSpendings'] = '日付が入力されていません';
            header('Location: /spendings/create.php');
            exit();
        }
    }

    public function addSpending($userId, $category_id, $name, $amount, $accrual_date)
    {
        date_default_timezone_set('Asia/Tokyo');
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        $smt = $this->pdo->prepare('INSERT INTO spendings(user_id, category_id, name, amount, accrual_date, created_at, updated_at) VALUES(:user_id, :category_id, :name, :amount, :accrual_date, :created_at, :updated_at)');
        $smt->bindParam(':user_id', $userId);
        $smt->bindParam(':category_id', $category_id);
        $smt->bindParam(':name', $name);
        $smt->bindParam(':amount', $amount);
        $smt->bindParam(':accrual_date', $accrual_date);
        $smt->bindParam(':created_at', $created_at);
        $smt->bindParam(':updated_at', $updated_at);
        $smt->execute();
    }

    public function getSpendings($userId)
    {
        $sql = 'SELECT spendings.*, categories.name AS categoryName FROM spendings LEFT JOIN categories ON spendings.category_id = categories.id WHERE spendings.user_id = :user_id ORDER BY spendings.created_at ASC';
        $smt = $this->pdo->prepare($sql);
        $smt->execute([':user_id' => $userId]);
        return $smt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteSpending($spending_id)
    {
        $smt = $this->pdo->prepare('DELETE FROM spendings WHERE id = :id');
        $smt->execute([':id' => $spending_id]);
    }

    public function getSpending($spending_id)
    {
        $smt = $this->pdo->prepare('SELECT * FROM spendings WHERE id = :id');
        $smt->execute([':id' => $spending_id]);
        $spending = $smt->fetch(PDO::FETCH_ASSOC);
        return $spending;
    }

    public function updateSpending($spending_id, $category_id, $name, $amount, $accrual_date)
    {
        $smt = $this->pdo->prepare('UPDATE spendings SET category_id = :category_id, name = :name, amount = :amount, accrual_date = :accrual_date WHERE id = :id');
        $smt->execute([
            ':id' => $spending_id,
            ':category_id' => $category_id,
            ':name'=> $name,
            ':amount' => $amount,
            ':accrual_date' => $accrual_date,
        ]);
    }

    public function getAllAmount($userId)
    {
        $smt = $this->pdo->prepare('SELECT SUM(amount) as totalAmount FROM spendings WHERE user_id = :user_id');
        $smt->execute([':user_id' => $userId]);
        $allAmount = $smt->fetch(PDO::FETCH_ASSOC);
        return $allAmount['totalAmount'];
    }
}