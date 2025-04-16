<?php

namespace App\Models;

use App\Model;

class Promotions extends Model
{
    protected $tableName = "promotions";

    public function findAllHomestaysWithDetails()
    {
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

    public function findHomestayWithDetails($id)
    {
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
            return null;
        }
    }

    public function getRooms($homestayId)
    {
        try {
            $sql = "SELECT * FROM rooms WHERE homestay_id = :homestayId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':homestayId', $homestayId);
            $result = $stmt->executeQuery();
            return $result->fetchAllAssociative() ?: [];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function searchHomestays($keyword = null, $location = null, $category_id = null)
    {
        try {
            $sql = "SELECT h.id, h.name, h.location, h.address, h.description, h.image, h.rating,
                    c.name AS category_name, u.full_name AS host_name
                    FROM homestays h
                    LEFT JOIN categories c ON h.category_id = c.id
                    LEFT JOIN users u ON h.host_id = u.id
                    WHERE 1=1";
            
            $params = [];
            
            if ($keyword) {
                $sql .= " AND h.name LIKE :keyword";
                $params['keyword'] = '%' . $keyword . '%';
            }
            if ($location) {
                $sql .= " AND h.location LIKE :location";
                $params['location'] = '%' . $location . '%';
            }
            if ($category_id) {
                $sql .= " AND h.category_id = :category_id";
                $params['category_id'] = $category_id;
            }
            
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

    public function findByCategory($category_id)
    {
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

    public function findByLocation($location)
    {
        try {
            $sql = "SELECT h.id, h.name, h.location, h.address, h.description, h.image, h.rating, h.price,
                           c.name AS category_name, u.full_name AS host_name
                    FROM homestays h
                    LEFT JOIN categories c ON h.category_id = c.id
                    LEFT JOIN users u ON h.host_id = u.id
                    WHERE h.location LIKE :location
                    AND h.status = 'active'
                    ORDER BY h.rating DESC, h.created_at DESC";

            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':location', '%' . $location . '%');
            $result = $stmt->executeQuery();
            return $result->fetchAllAssociative() ?: [];
        } catch (\Exception $e) {
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

    public function getRoomPromotions($roomId)
    {
        $currentDate = date('Y-m-d');
        $sql = "SELECT p.*, r.name as room_name 
                FROM {$this->tableName} p
                LEFT JOIN rooms r ON p.room_id = r.id
                WHERE p.room_id = :room_id 
                AND p.status = 'active'
                AND p.start_date <= :current_date 
                AND p.end_date >= :current_date";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':room_id', $roomId);
        $stmt->bindValue(':current_date', $currentDate);
        $stmt->bindValue(':current_date', $currentDate);
        
        return $stmt->executeQuery()->fetchAllAssociative();
    }

    public function findAll()
    {
        $sql = "SELECT p.*, r.name as room_name 
                FROM {$this->tableName} p
                LEFT JOIN rooms r ON p.room_id = r.id
                ORDER BY p.created_at DESC";
        
        return $this->connection->executeQuery($sql)->fetchAllAssociative();
    }

    public function find($id)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->executeQuery()->fetchAssociative();
    }

    public function insert($data)
    {
        $fields = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO {$this->tableName} ($fields) VALUES ($placeholders)";
        $stmt = $this->connection->prepare($sql);
        
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        
        return $stmt->executeQuery();
    }

    public function update($id, $data)
    {
        $fields = [];
        foreach (array_keys($data) as $field) {
            $fields[] = "$field = :$field";
        }
        $fields = implode(', ', $fields);
        
        $sql = "UPDATE {$this->tableName} SET $fields WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        $stmt->bindValue(':id', $id);
        
        return $stmt->executeQuery();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->tableName} WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->executeQuery();
    }

    public function getActivePromotions()
    {
        $currentDate = date('Y-m-d');
        $sql = "SELECT p.*, r.name as room_name, r.price as room_price 
                FROM {$this->tableName} p
                INNER JOIN rooms r ON p.room_id = r.id
                WHERE p.status = 'active' 
                AND p.start_date <= :current_date 
                AND p.end_date >= :current_date";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':current_date', $currentDate);
        $stmt->bindValue(':current_date', $currentDate);
        
        return $stmt->executeQuery()->fetchAllAssociative();
    }

    public function updatePromotionStatus()
    {
        $currentDate = date('Y-m-d');
        $sql = "UPDATE {$this->tableName} 
                SET status = 'expired' 
                WHERE end_date < :current_date 
                AND status = 'active'";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':current_date', $currentDate);
        return $stmt->executeQuery();
    }

    public function getActivePromotionForRoom($room_id) {
        $today = date('Y-m-d');
        $sql = "SELECT * FROM promotions 
                WHERE room_id = :room_id 
                AND status = 'active' 
                AND start_date <= :today 
                AND end_date >= :today 
                ORDER BY discount_percent DESC 
                LIMIT 1";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':room_id', $room_id);
        $stmt->bindValue(':today', $today);
        $result = $stmt->executeQuery();
        $promotion = $result->fetchAssociative();
        
        return $promotion ?: null;
    }
}
