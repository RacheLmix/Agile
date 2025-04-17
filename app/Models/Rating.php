<?php

namespace App\Models;

use App\Model;

class Rating extends Model
{
    protected $tableName = 'ratings';
    
    public function findAllRating()
    {
        $sql = "SELECT r.*, u.full_name AS user_name, h.name AS homestay_name
                FROM ratings r
                LEFT JOIN users u ON r.user_id = u.id
                LEFT JOIN homestays h ON r.homestay_id = h.id";
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->executeQuery();
        return $result->fetchAllAssociative();
    }

    // Kiểm tra xem người dùng đã đánh giá homestay này chưa
    public function hasUserRated($userId, $homestayId)
    {
        try {
            $sql = "SELECT * FROM ratings 
                    WHERE user_id = :user_id
                    AND homestay_id = :homestay_id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':user_id', $userId);
            $stmt->bindValue(':homestay_id', $homestayId);
            $result = $stmt->executeQuery();
            return $result->fetchAssociative() ?: null;
        } catch (\Exception $e) {
            return null;
        }
    }

    // Lưu đánh giá mới
    public function createRating($userId, $homestayId, $score, $content)
    {
        try {
            $sql = "INSERT INTO ratings (user_id, homestay_id, score, content, created_at, updated_at) 
                    VALUES (:user_id, :homestay_id, :score, :content, NOW(), NOW())";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':user_id', $userId);
            $stmt->bindValue(':homestay_id', $homestayId);
            $stmt->bindValue(':score', $score);
            $stmt->bindValue(':content', $content);
            $stmt->executeQuery();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}