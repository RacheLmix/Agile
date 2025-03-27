<?php
namespace App\Models;
use App\Model;

class Room extends Model{
    protected $tableName = 'rooms';
    public function findrooms()
    {
        $sql = "SELECT rooms.*, homestays.name as name_homestay FROM rooms JOIN homestays ON rooms.homestay_id = homestays.id";
        $stmt = $this->connection->prepare($sql);
        $ru = $stmt->executeQuery();
        return $ru->fetchAllAssociative();
    }

    public function findByHomestay($homestay_id) {
        $query = "SELECT id, homestay_id, name, description, price, quantity, capacity, image1, image2, image3, image4, status
                  FROM rooms 
                  WHERE homestay_id = ? AND status = 'available'";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(1, $homestay_id);
        $result = $stmt->executeQuery();
        return $result->fetchAllAssociative();
    }

    public function checkAvailability($room_id, $check_in, $check_out) {
        try {
            // Look for overlapping bookings
            $sql = "SELECT COUNT(*) as booking_count
                    FROM bookings b
                    WHERE b.room_id = :room_id
                    AND b.status != 'cancelled'
                    AND (
                        (b.check_in <= :check_in AND b.check_out > :check_in) OR
                        (b.check_in < :check_out AND b.check_out >= :check_out) OR
                        (b.check_in >= :check_in AND b.check_out <= :check_out)
                    )";
            
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':room_id', $room_id);
            $stmt->bindValue(':check_in', $check_in);
            $stmt->bindValue(':check_out', $check_out);
            $result = $stmt->executeQuery();
            $row = $result->fetchAssociative();
            
            // If booking count is 0, the room is available
            return $row['booking_count'] == 0;
        } catch (\Exception $e) {
            // Log error if needed
            return false;
        }
    }
}
