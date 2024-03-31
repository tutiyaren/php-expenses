<?php
namespace App;
use PDO;

interface income_sourcesInterface
{
    public static function validate();
    public function addIncome_sources($userId, $name);
    public function getIncome_sources($userId);
}

abstract class AbstractIncome_sources implements income_sourcesInterface
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}

class Income_sources extends AbstractIncome_sources
{
    public static function validate()
    {
        $_SESSION['errorAddIncome_source'] = '収入源名が入力されていません';
        header('Location: /income_sources/create.php');
        exit();
    }

    public function addIncome_sources($userId, $name) {
        date_default_timezone_set('Asia/Tokyo');
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");

        $smt = $this->pdo->prepare('INSERT INTO income_sources(user_id, name, created_at, updated_at) VALUES(:user_id, :name, :created_at, :updated_at)');
        $smt->bindParam(':user_id', $userId);
        $smt->bindParam(':name', $name);
        $smt->bindParam(':created_at', $created_at);
        $smt->bindParam(':updated_at', $updated_at);
        $smt->execute();
    }

    public function getIncome_sources($userId)
    {
        $smt = $this->pdo->prepare('SELECT * FROM income_sources WHERE user_id = :user_id');
        $smt->execute([':user_id' => $userId]);
        return $smt->fetchAll(PDO::FETCH_ASSOC);
    }
}
