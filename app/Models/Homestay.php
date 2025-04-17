<?php

namespace App\Models;

use App\Model;

class Homestay extends Model
{
    protected $tableName = "homestays";

    public function findAllHomestaysWithDetails()
    {
        try {
            $sql = "SELECT h.id, h.name, h.price, h.location, h.address, h.description, h.image, h.rating, h.status, c.name AS category_name
                    FROM homestays h
                    LEFT JOIN categories c ON h.category_id = c.id
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
            $sql = "SELECT h.*, c.name AS category_name, 
                    (SELECT COUNT(*) FROM ratings WHERE homestay_id = h.id) as review_count
                    FROM homestays h
                    LEFT JOIN categories c ON h.category_id = c.id
                    WHERE h.id = :id";

            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':id', $id);
            $result = $stmt->executeQuery();
            return $result->fetchAssociative() ?: null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function findByName($name)
    {
        try {
            $sql = "SELECT * FROM homestays WHERE name = :name";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':name', $name);
            $result = $stmt->executeQuery();
            return $result->fetchAssociative() ?: null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getAmenities($homestayId)
    {
        try {
            $sql = "SELECT a.* 
                    FROM amenities a
                    INNER JOIN homestay_amenities ha ON a.id = ha.amenity_id
                    WHERE ha.homestay_id = :homestayId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':homestayId', $homestayId);
            $result = $stmt->executeQuery();
            return $result->fetchAllAssociative() ?: [];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getAllAmenities()
    {
        try {
            $sql = "SELECT * FROM amenities ORDER BY name";
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->executeQuery();
            return $result->fetchAllAssociative() ?: [];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function addAmenity($homestayId, $amenityId)
    {
        try {
            $sql = "INSERT INTO homestay_amenities (homestay_id, amenity_id) VALUES (:homestayId, :amenityId)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':homestayId', $homestayId);
            $stmt->bindValue(':amenityId', $amenityId);
            $stmt->executeQuery();
        } catch (\Exception $e) {
            // Xử lý lỗi nếu cần
        }
    }

    public function deleteAmenities($homestayId)
    {
        try {
            $sql = "DELETE FROM homestay_amenities WHERE homestay_id = :homestayId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':homestayId', $homestayId);
            $stmt->executeQuery();
        } catch (\Exception $e) {
            // Xử lý lỗi nếu cần
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

    public function getRatings($homestayId)
    {
        try {
            $sql = "SELECT r.score, r.content, u.full_name 
                    FROM ratings r
                    INNER JOIN users u ON r.user_id = u.id
                    WHERE r.homestay_id = :homestayId
                    ORDER BY r.created_at DESC";
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
            $sql = "SELECT h.id, h.name, h.location, h.address, h.description, h.image, h.rating, h.status,
                    c.name AS category_name
                    FROM homestays h
                    LEFT JOIN categories c ON h.category_id = c.id
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
            $sql = "SELECT h.id, h.name, h.location, h.address, h.description, h.image, h.rating, h.price, h.status, c.name AS category_name
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
            $sql = "SELECT h.id, h.name, h.location, h.address, h.description, h.image, h.rating, h.price, h.status,
                    c.name AS category_name
                    FROM homestays h
                    LEFT JOIN categories c ON h.category_id = c.id
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

    public function findSimilarHomestays($category_id, $location, $excludeId, $limit = 3)
    {
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
            return [];
        }
    }

    public function findByHost($hostId)
    {
        try {
            $sql = "SELECT id, name, image, location, city, price, rating, status
                    FROM homestays
                    WHERE host_id = :hostId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':hostId', $hostId);
            $result = $stmt->executeQuery();
            return $result->fetchAllAssociative() ?: [];
        } catch (\Exception $e) {
            return [];
        }
    }
}