<?php
namespace App\Models;
use App\Model;

class User extends Model
{
    protected $tableName = 'users';
    public function fetchUsers()
    {
        $sql = "SELECT id, full_name, email, password, role FROM users";
        $stmt = $this->connection->prepare($sql);
        $ru = $stmt->executeQuery();
        return $ru->fetchAllAssociative();
    }
    public function findById($id)
    {
        try {
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':id', $id);
            $result = $stmt->executeQuery();
            return $result->fetchAssociative() ?: null;
        } catch (\Exception $e) {
            return null;
        }
    }
}