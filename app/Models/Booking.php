<?php
namespace App\Models;
use App\Model;

class Booking extends Model
{
    protected $tableName = 'bookings';

    public function FindAllBookings()
    {
        $sql = "SELECT b.id, b.user_id, u.full_name AS user_name, b.room_id, r.name AS room_name, b.check_in, b.check_out, b.guests, b.total_price, b.status, b.created_at 
                FROM bookings b 
                INNER JOIN users u ON b.user_id = u.id 
                INNER JOIN rooms r ON b.room_id = r.id 
                ORDER BY b.created_at DESC";
        $stmt = $this->connection->prepare($sql);
        $ru = $stmt->executeQuery();
        return $ru->fetchAllAssociative();
    }

    public function create($data)
    {
        try {
            $columns = implode(', ', array_keys($data));
            $placeholders = implode(', ', array_fill(0, count($data), '?'));
            $sql = "INSERT INTO {$this->tableName} ({$columns}) VALUES ({$placeholders})";
            $stmt = $this->connection->prepare($sql);
            $stmt->executeStatement(array_values($data));
            return (int) $this->connection->lastInsertId();
        } catch (\Exception $e) {
            throw new \Exception("Failed to create booking: " . $e->getMessage());
        }
    }

    public function find($id)
    {
        try {
            $sql = "SELECT * FROM {$this->tableName} WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':id', $id);
            $result = $stmt->executeQuery();
            return $result->fetchAssociative() ?: null;
        } catch (\Exception $e) {
            throw new \Exception("Failed to find booking: " . $e->getMessage());
        }
    }

    public function checkRoomAvailability($room_id, $check_in, $check_out) {
        $sql = "SELECT COUNT(*) as count FROM bookings 
                WHERE room_id = ? 
                AND status != 'cancelled'
                AND ((check_in BETWEEN ? AND ?) 
                OR (check_out BETWEEN ? AND ?)
                OR (check_in <= ? AND check_out >= ?))";
                
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->executeQuery([$room_id, $check_in, $check_out, $check_in, $check_out, $check_in, $check_out]);
        $count = $result->fetchOne();
        return $count == 0;
    }

    public function findUserBookings($user_id)
    {
        try {
            $sql = "SELECT b.* FROM {$this->tableName} b
                    WHERE b.user_id = :user_id
                    ORDER BY b.created_at DESC";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':user_id', $user_id);
            $result = $stmt->executeQuery();
            return $result->fetchAllAssociative();
        } catch (\Exception $e) {
            throw new \Exception("Failed to find user bookings: " . $e->getMessage());
        }
    }
}