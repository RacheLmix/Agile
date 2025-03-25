<?php

namespace App\Models;

use App\Model;

class Homestay extends Model{
    protected $tableName = "homestays";

    public function findAllHomestaysWithDetails() {
        try {
            $sql = "SELECT h.id, h.name, h.location, h.address, h.description, h.image, h.rating, c.name AS category_name, u.full_name AS host_name
                    FROM homestays h
                    LEFT JOIN categories c ON h.category_id = c.id
                    LEFT JOIN users u ON h.host_id = u.id
                    ORDER BY h.created_at DESC";
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->executeQuery();
            $data = $result->fetchAllAssociative();
            return $data ?: [];
        } catch (\Exception $e) {
            return [];
        }
    }
    
    public function findHomestayWithDetails($id) {
        try {
            $sql = "SELECT h.*, c.name AS category_name, u.full_name AS host_name, 
                    (SELECT COUNT(*) FROM ratings WHERE homestay_id = h.id) as review_count
                    FROM homestays h
                    LEFT JOIN categories c ON h.category_id = c.id
                    LEFT JOIN users u ON h.host_id = u.id
                    WHERE h.id = :id";
            
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':id', $id);
            $result = $stmt->executeQuery();
            return $result->fetchAssociative() ?: null;
        } catch (\Exception $e) {
            // Log error if needed
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

    public function findSimilarHomestays($category_id, $location, $excludeId, $limit = 3) {
        try {
            $sql = "SELECT h.*, c.name AS category_name
                    FROM homestays h
                    LEFT JOIN categories c ON h.category_id = c.id
                    WHERE h.id != :exclude_id 
                      AND (h.category_id = :category_id OR h.location = :location)
                      AND h.status = 'active'
                    ORDER BY h.rating DESC, h.created_at DESC
                    LIMIT :limit";
            
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':exclude_id', $excludeId);
            $stmt->bindValue(':category_id', $category_id);
            $stmt->bindValue(':location', $location);
            $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
            $result = $stmt->executeQuery();
            return $result->fetchAllAssociative() ?: [];
        } catch (\Exception $e) {
            // Log error if needed
            return [];
        }
    }

    public function searchHomestays($keyword, $location, $category_id, $price_min, $price_max) {
        try {
            $conditions = [];
            $params = [];
            
            $sql = "SELECT h.id, h.name, h.location, h.address, h.description, h.image, h.rating, h.price, c.name AS category_name
                    FROM homestays h
                    LEFT JOIN categories c ON h.category_id = c.id
                    WHERE 1=1";
            
            if (!empty($keyword)) {
                $sql .= " AND h.name LIKE :keyword";
                $params[':keyword'] = '%' . $keyword . '%';
            }
            
            if (!empty($location)) {
                $sql .= " AND h.location = :location";
                $params[':location'] = $location;
            }
            
            if (!empty($category_id)) {
                $sql .= " AND h.category_id = :category_id";
                $params[':category_id'] = $category_id;
            }
            
            $sql .= " AND h.price BETWEEN :price_min AND :price_max";
            $params[':price_min'] = $price_min;
            $params[':price_max'] = $price_max;
            
            $sql .= " ORDER BY h.rating DESC, h.created_at DESC";
            
            $stmt = $this->connection->prepare($sql);
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            
            $result = $stmt->executeQuery();
            return $result->fetchAllAssociative() ?: [];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function findByCategory($category_id) {
        try {
            $sql = "SELECT h.id, h.name, h.location, h.address, h.description, h.image, h.rating, h.price, c.name AS category_name
                    FROM homestays h
                    LEFT JOIN categories c ON h.category_id = c.id
                    WHERE h.category_id = :category_id
                    ORDER BY h.rating DESC, h.created_at DESC";
            
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':category_id', $category_id);
            $result = $stmt->executeQuery();
            return $result->fetchAllAssociative() ?: [];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function findByLocation($location) {
        try {
            $sql = "SELECT h.id, h.name, h.location, h.address, h.description, h.image, h.rating, h.price, c.name AS category_name
                    FROM homestays h
                    LEFT JOIN categories c ON h.category_id = c.id
                    WHERE h.location = :location
                    ORDER BY h.rating DESC, h.created_at DESC";
            
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':location', $location);
            $result = $stmt->executeQuery();
            return $result->fetchAllAssociative() ?: [];
        } catch (\Exception $e) {
            return [];
        }
    }
}