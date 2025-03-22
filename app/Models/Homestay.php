<?php

namespace App\Models;

use App\Model;

class Homestay extends Model{
    protected $tableName = "homestays";

    public function findAllHomestaysWithDetails() {
            $sql = "SELECT h.id, h.name, h.location, h.address, h.description, h.image, h.rating, h.price, c.name AS category_name, u.full_name AS host_name
                    FROM homestays h
                    LEFT JOIN categories c ON h.category_id = c.id
                    LEFT JOIN users u ON h.host_id = u.id
                    ORDER BY h.created_at DESC";
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->executeQuery();
            $data = $result->fetchAllAssociative();
            return $data; 
    }
}