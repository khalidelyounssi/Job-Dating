<?php
namespace App\Models;

use App\Core\BaseModel;
use PDO;

class User extends BaseModel {

    protected $table = 'users';

    public function findByEmail($email) {
        $stmt = $this->connexion->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function create($table, $data) {
        
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        
        $stmt = $this->connexion->prepare($sql);
        
        return $stmt->execute($data);
    }
}