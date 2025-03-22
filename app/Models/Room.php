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
}
