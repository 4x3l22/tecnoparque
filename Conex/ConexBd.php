<?php
namespace Conex;

require_once 'Config/ConfigBd.php';

use Config\ConfigBd;
use PDO;
use PDOException;

class ConexBd
{
    private static $instace = null;
    private $pdo;
    private $charset = "utf8mb4";

    private function __construct(){
        try {
            $config = ConfigBd::getConfig();
            $dns = "mysql:host={$config['host']};dbname={$config['database']};charset={$this->charset}";
            $this->pdo = new PDO($dns, $config['user'], $config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            die("Error connecting to the database".$e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instace == null) {
            self::$instace = new self();
        }
        return self::$instace;
    }

    public function getConex()
    {
        return $this->pdo;
    }
}