<?php

namespace App\Models;

use App\Model;

class Homestay extends Model{
    protected $tableName = "homestays";

    public function findAllHomestaysWithDetails() {
        try {
            $sql = "SELECT h.id, h.name, h.location, h.address, h.description, h.image, h.rating, h.price, c.name AS category_name, u.full_name AS host_name
                    FROM homestays h
                    LEFT JOIN categories c ON h.category_id = c.id
                    LEFT JOIN users u ON h.host_id = u.id
                    ORDER BY h.created_at DESC";
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->executeQuery();
            $data = $result->fetchAllAssociative();
            
            // Return empty array instead of null if no results
            return $data ?: [];
        } catch (\Exception $e) {
            // Log error or handle exception
            // Return empty array in case of error
            return [];
        }
    }
    
    public function findHomestayWithDetails($id) {
        try {
            $sql = "SELECT h.id, h.name, h.location, h.address, h.description, h.image, h.ratin, c.name AS category_name, u.full_name AS host_name
                    FROM homestays h
                    LEFT JOIN categories c ON h.category_id = c.id
                    LEFT JOIN users u ON h.host_id = u.id
                    WHERE h.id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':id', $id);
            $result = $stmt->executeQuery();
            return $result->fetchAssociative() ?: null;
        } catch (\Exception $e) {
            // Log error or handle exception
            return null;
        }
    }
    
    // Get rooms associated with a homestay
    public function getRooms($homestayId) {
        try {
            $sql = "SELECT * FROM rooms WHERE homestay_id = :homestayId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':homestayId', $homestayId);
            $result = $stmt->executeQuery();
            return $result->fetchAllAssociative() ?: [];
        } catch (\Exception $e) {
            // Log error or handle exception
            return [];
        }
    }
}