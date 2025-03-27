<?php

namespace App\Models;

use App\Model;

class Category extends Model
{
    protected $tableName = 'categories';

    public function getallstus($categoryId) {  // Add parameter for category ID
        $sql = "SELECT COUNT(*) as total FROM homestays WHERE category_id = ?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $categoryId, \PDO::PARAM_INT);  // Bind the parameter
        $result = $stmt->executeQuery();
        $row = $result->fetchAssociative();  // Get single row instead of all rows

        return $row['total'];  // Return just the count
    }

}