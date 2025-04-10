<?php

namespace App\Models;

use App\Model;

class Category extends Model
{
    protected $tableName = "categories";

    // Static method to fetch all categories
    public static function all()
    {
        try {
            // Instantiate the class temporarily to access the connection
            $connection = (new self())->connection;
            $sql = "SELECT * FROM categories ORDER BY name ASC";
            $stmt = $connection->prepare($sql);
            $result = $stmt->executeQuery();
            return $result->fetchAllAssociative() ?: [];
        } catch (\Exception $e) {
            // Log error if needed
            return [];
        }
    }

    // Instance method to find a category by ID
    public function find($id)
    {
        try {
            $sql = "SELECT * FROM categories WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':id', $id);
            $result = $stmt->executeQuery();
            return $result->fetchAssociative() ?: null;
        } catch (\Exception $e) {
            return null;
        }
    }
}