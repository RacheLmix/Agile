<?php
namespace App\Models;
use App\Model;

class User extends Model
{
    protected $tableName = 'users';
    public function fetchUsers()
    {
        $sql = "SELECT id, email, password, role FROM users";
        $stmt = $this->connection->prepare($sql);
        $ru = $stmt->executeQuery();
        return $ru->fetchAllAssociative();
    }
}