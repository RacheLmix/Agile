<?php

namespace App;

use Doctrine\DBAL\DriverManager;

class Model
{
    protected $connection;
    protected $tableName;

    public function __construct()
    {
        $connectionParams = [
            'dbname'    => $_ENV['DB_NAME'],
            'user'      => $_ENV['DB_USERNAME'],
            'password'  => $_ENV['DB_PASSWORD'],
            'host'      => $_ENV['DB_HOST'],
            'driver'    => $_ENV['DB_DRIVER'],
        ];

        $this->connection = DriverManager::getConnection($connectionParams);
    }

    public function __destruct()
    {
        $this->connection->close();
    }
    // Viết các hàm truy xuat du lieu
    public function findAll()
    {
        $sql = $this->connection->createQueryBuilder();
        $sql->select('*')->from($this->tableName);
        return $sql->fetchAllAssociative();
    }
    public function find($id)
    {
        $sql = $this->connection->createQueryBuilder();
        $sql->select('*')->from($this->tableName)->where('id=:id')->setParameter('id', $id);
        return $sql->fetchAssociative();
    }
    public function insert(array $data)
    {
        $this->connection->insert($this->tableName, $data);
    }
    public function update($id, array $data){
        $this->connection->update($this->tableName, $data, ['id' => $id]);
    }
    public function delete($id){
        $this->connection->delete($this->tableName, ['id' => $id]);
    }
}
