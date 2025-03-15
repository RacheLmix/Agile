<?php

namespace App\Models;

use App\Model;

class Homestay extends Model{
    protected $tableName = "homestays";

    public function findAllHomestaysWithDetails() {
        $sql = "SELECT h.homestay_id, h.name, h.location, h.description, h.image, h.rating, c.name AS category_name, u.full_name AS host_name
                FROM homestays h
                LEFT JOIN categories c ON h.category_id = c.category_id
                LEFT JOIN users u ON h.host_id = u.user_id
                ORDER BY h.created_at DESC";
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->executeQuery();
        return $result->fetchAllAssociative();
    }
}