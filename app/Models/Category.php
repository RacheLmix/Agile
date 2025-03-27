<?php

namespace App\Models;

use App\Model;

class Category extends Model
{
    protected $tableName = 'categories';

//    public function getallstus($categoryId)
//    {
//        // Chuyển đổi $categoryId thành số nguyên nếu cần
//        $categoryId = (int)$categoryId;
//
//        // Chuẩn bị câu SQL
//        $sql = "SELECT COUNT(*) as total FROM homestays WHERE category_id = :categoryId";
//
//        // Thực thi câu truy vấn với tham số
//        $stmt = $this->connection->prepare($sql);
//        $stmt->bindValue('categoryId', $categoryId, \PDO::PARAM_INT); // Chỉ định kiểu dữ liệu là số nguyên
//        $result = $stmt->executeQuery(); // Thực thi truy vấn
//
//        // Lấy kết quả
//        $row = $result->fetchAssociative();
//        return $row['total'];
//    }

}