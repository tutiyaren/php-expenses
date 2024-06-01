<?php
namespace App;
use PDO;

interface categoriesInterface
{
    public static function validate();
    public function addCategories($userId, $name);
    public function getCategories($userId);
    public function deleteCategories($categories_id);
    public function getCategory($categories_id);
    public function updateCategories($category_id, $name);
}

abstract class AbstractCategories implements CategoriesInterface
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}

class Categories extends AbstractCategories
{
    public static function validate()
    {
        $_SESSION['errorAddCategory'] = '収入源名が入力されていません';
        header('Location: /spendings/categories/create.php');
        exit();
    }

    public function addCategories($userId, $name) {
        date_default_timezone_set('Asia/Tokyo');
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");

        $smt = $this->pdo->prepare('INSERT INTO categories(user_id, name, created_at, updated_at) VALUES(:user_id, :name, :created_at, :updated_at)');
        $smt->bindParam(':user_id', $userId);
        $smt->bindParam(':name', $name);
        $smt->bindParam(':created_at', $created_at);
        $smt->bindParam(':updated_at', $updated_at);
        $smt->execute();
    }

    public function getCategories($userId)
    {
        $smt = $this->pdo->prepare('SELECT * FROM categories WHERE user_id = :user_id');
        $smt->execute([':user_id' => $userId]);
        return $smt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteCategories($category_id)
    {
        $spendingsCountQuery = $this->pdo->prepare('SELECT COUNT(*) FROM spendings WHERE category_id = :category_id');
        $spendingsCountQuery->execute(array(':category_id' => $category_id));
        $spendingsCount = $spendingsCountQuery->fetchColumn();
        if($spendingsCount > 0) {
            $_SESSION['errorDeleteCategories'] = '現在紐づく収入があるので削除できません';
            return;
        }
        $smt = $this->pdo->prepare('DELETE FROM categories WHERE id = :id');
        $smt->execute(array(':id' => $category_id));
    }

    public function getCategory($categories_id)
    {
        $smt = $this->pdo->prepare('SELECT * FROM categories WHERE id = :id');
        $smt->execute(['id' => $categories_id]);
        $categories = $smt->fetch(PDO::FETCH_ASSOC);
        return $categories;
    }

    public function updateCategories($categories, $name)
    {
        $smt = $this->pdo->prepare('UPDATE categories SET name = :name WHERE id = :id');
        $smt->execute(array(':id' => $categories, ':name' => $name));
    } 
}
