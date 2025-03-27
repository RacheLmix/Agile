<?php

namespace App\Models;

use App\Model;

class Rating extends Model{
    protected $tableName= 'ratings';
    
    public function findAllRating() {
        $sql = "SELECT r.*, u.full_name AS user_name, h.name AS homestay_name
                FROM ratings r
                LEFT JOIN users u ON r.user_id = u.id
                LEFT JOIN homestays h ON r.homestay_id = h.id";
        $stmt= $this->connection->prepare($sql);
        $result= $stmt->executeQuery();
        return $result->fetchAllAssociative();
    }
}