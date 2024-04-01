<?php
namespace App;
use PDO;

interface incomeInterface
{
    public static function validateIncome();
    public function addIncome($userId, $income_source_id, $amount, $accrual_date); 
    public function getIncomes($userId);
    public function deleteIncome($income_id);
    public function getIncome($incomeId);
    public function updateIncome($income_id, $income_source_id, $amount, $accrual_date);
}

abstract class AbstractIncome implements incomeInterface
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}

class Incomes extends AbstractIncome
{
    public static function validateIncome()
    {
        if(empty($_POST['income_sourceName'])) {
            $_SESSION['errorAddIncomes'] = '収入源が選択されていません';
            header('Location: /incomes/create.php');
            exit();
        }
        if(empty($_POST['amount'])) {
            $_SESSION['errorAddIncomes'] = '金額が入力されていません';
            header('Location: /incomes/create.php');
            exit();
        }
        if(empty($_POST['accrual_date'])) {
            $_SESSION['errorAddIncomes'] = '日付が入力されていません';
            header('Location: /incomes/create.php');
            exit();
        }
    }

    public function addIncome($userId, $income_source_id, $amount, $accrual_date)
    {
        date_default_timezone_set('Asia/Tokyo');
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");

        $smt = $this->pdo->prepare('INSERT INTO incomes(user_id, income_source_id, amount, accrual_date, created_at, updated_at) VALUES(:user_id, :income_source_id, :amount, :accrual_date, :created_at, :updated_at)');
        $smt->bindParam(':user_id', $userId);
        $smt->bindParam(':income_source_id', $income_source_id);
        $smt->bindParam(':amount', $amount);
        $smt->bindParam(':accrual_date', $accrual_date);
        $smt->bindParam(':created_at', $created_at);
        $smt->bindParam(':updated_at', $updated_at);
        $smt->execute();
    }

    public function getIncomes($userId)
    {
        $sql = 'SELECT incomes.*, income_sources.name AS name FROM incomes LEFT JOIN income_sources ON incomes.income_source_id = income_sources.id WHERE incomes.user_id = :user_id ORDER BY incomes.created_at ASC';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteIncome($income_id)
    {
        $smt = $this->pdo->prepare('DELETE FROM incomes WHERE id = :id');
        $smt->execute([':id' => $income_id]);
    }

    public function getIncome($incomeId)
    {
        $smt = $this->pdo->prepare('SELECT * FROM incomes WHERE id = :id');
        $smt->execute([':id' => $incomeId]);
        $income = $smt->fetch(PDO::FETCH_ASSOC);
        return $income;
    }

    public function updateIncome($income_id, $income_source_id, $amount, $accrual_date)
    {
        $smt = $this->pdo->prepare('UPDATE incomes SET income_source_id = :income_source_id, amount = :amount, accrual_date = :accrual_date WHERE id = :id');
        $smt->execute([
            ':id' => $income_id,
            ':income_source_id' => $income_source_id,
            ':amount' => $amount,
            ':accrual_date' => $accrual_date
        ]);
    }
}
