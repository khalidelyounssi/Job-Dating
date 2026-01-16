<?php
namespace App\Models;

use App\Core\BaseModel;
use PDO;

class User extends BaseModel {

    protected $table = 'users';

    public function findByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function create($data) { 
    
    if (isset($data['password'])) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    }

    return parent::create($data); 
}
}