<?php

namespace App\Models;

use App\Model;

class Category extends Model{
    protected $tableName= 'categories';
    public function findAll(){
        $sql= "SELECT * from {$this->tableName}";
        $stmt= $this->connection->prepare($sql);
        $result= $stmt->executeQuery();
        return $result->fetchAllAssociative();
    }
}