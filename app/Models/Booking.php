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

    /**
     * Create a new booking record and return the inserted ID
     * @param array $data Associative array of booking data
     * @return int The ID of the newly created booking
     * @throws \Exception If insertion fails
     */
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

    /**
     * Find a booking by its ID
     * @param int $id The booking ID
     * @return array|null The booking data as an associative array, or null if not found
     */
    public function find($id)
    {
        try {
            $sql = "SELECT * FROM {$this->tableName} WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $result = $stmt->executeQuery([$id])->fetchAssociative();
            return $result ?: null;
        } catch (\Exception $e) {
            throw new \Exception("Failed to find booking: " . $e->getMessage());
        }
    }

    /**
     * Check if a room is available for the given date range
     * @param int $room_id The room ID
     * @param string $check_in Check-in date (Y-m-d)
     * @param string $check_out Check-out date (Y-m-d)
     * @return bool True if available, false if already booked
     */
    public function checkAvailability($room_id, $check_in, $check_out)
    {
        try {
            $sql = "SELECT COUNT(*) FROM {$this->tableName} 
                    WHERE room_id = ? 
                    AND status != 'cancelled'
                    AND (
                        (check_in <= ? AND check_out >= ?) 
                        OR (check_in <= ? AND check_out >= ?) 
                        OR (check_in >= ? AND check_out <= ?)
                    )";
            $stmt = $this->connection->prepare($sql);
            $overlap = $stmt->executeQuery([
                $room_id,
                $check_out, $check_in,
                $check_out, $check_in,
                $check_in, $check_out
            ])->fetchOne();
            return $overlap == 0; // Trả về true nếu không có trùng lịch
        } catch (\Exception $e) {
            throw new \Exception("Failed to check room availability: " . $e->getMessage());
        }
    }
}