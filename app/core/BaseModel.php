<?php
namespace App\Core;

use App\Core\Database;
use PDO;

class BaseModel {

    protected $connexion;

    public function __construct() {
        $db = Database::getInstance();
        
        $this->connexion = $db->getConnexion();
    }

    public function findAll($table) {
        $sql = "SELECT * FROM $table";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOne($table, $id) {
        $sql = "SELECT * FROM $table WHERE id = :id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($table, $id) {
        $sql = "DELETE FROM $table WHERE id = :id";
        $stmt = $this->connexion->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function create($table, $data) {
        $colonnes = implode(", ", array_keys($data));
        $marqueurs = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO $table ($colonnes) VALUES ($marqueurs)";
        
        $stmt = $this->connexion->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($table, $id, $data) {
        $champs = "";
        foreach($data as $key => $value) {
            $champs .= "$key = :$key, ";
        }
        $champs = rtrim($champs, ", ");

        $sql = "UPDATE $table SET $champs WHERE id = :id";
        
        $data['id'] = $id;

        $stmt = $this->connexion->prepare($sql);
        return $stmt->execute($data);
    }
}