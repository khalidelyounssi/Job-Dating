<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $connection; 

    private function __construct() {
        require_once __DIR__ . '/../../config/config.php';
        
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->connection = new PDO($dsn, DB_USER, DB_PASS); // بدلتها هنا
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur DB : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}