<?php

namespace App\Models;

use App\Model;

class Amenity extends Model
{
    protected $tableName = "amenities";

    // Lấy tất cả tiện ích
    public function findAllAmenities()
    {
        try {
            $sql = "SELECT id, name, description, icon, created_at, updated_at 
                    FROM amenities 
                    ORDER BY created_at DESC";
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->executeQuery();
            return $result->fetchAllAssociative() ?: [];
        } catch (\Exception $e) {
            return [];
        }
    }   

    // Lấy một tiện ích theo ID
    public function find($id)
    {
        try {
            $sql = "SELECT * FROM amenities WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':id', $id);
            $result = $stmt->executeQuery();
            return $result->fetchAssociative() ?: null;
        } catch (\Exception $e) {
            return null;
        }
    }
}