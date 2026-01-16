<?php
namespace App\Core;

use App\Core\Database;
use PDO;

class BaseModel {
    
    protected $table;
    protected $connection;

    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function all() {
        $stmt = $this->connection->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->connection->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(array $data) {
        $keys = array_keys($data);
        $columns = implode(", ", $keys);
        $placeholders = ":" . implode(", :", $keys);

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $stmt = $this->connection->prepare($sql);
        
        return $stmt->execute($data);
    }

    public function update($id, array $data) {
        $fields = "";
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ", ");

        $sql = "UPDATE {$this->table} SET $fields WHERE id = :id";
        $data['id'] = $id;

        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function where($column, $value) {
        $stmt = $this->connection->prepare("SELECT * FROM {$this->table} WHERE {$column} = ?");
        $stmt->execute([$value]);
        return $stmt->fetchAll();
    }
}