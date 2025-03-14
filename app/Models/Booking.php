<?php
namespace App\Models;
use App\Model;

class Booking extends Model
{
    protected $tableName = 'bookings';
    public function FindAllBookings()
    {
        $sql = "SELECT b.booking_id, b.user_id, u.full_name AS user_name, b.room_id, r.name AS room_name, b.check_in, b.check_out, b.guests, b.total_price, b.status, b.created_at FROM bookings b INNER JOIN users u ON b.user_id = u.user_id INNER JOIN rooms r ON b.room_id = r.room_id ORDER BY b.created_at DESC";
        $stmt = $this->connection->prepare($sql);
        $ru = $stmt->executeQuery();
        return $ru->fetchAllAssociative();

    }
}