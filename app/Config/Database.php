<?php

namespace App\Config;

use PDO;
use PDOException;

class Database {

    private string $host = "localhost";
    private string $db = "login_system";
    private string $user = "root";
    private string $password = "";

    private ?PDO $pdo = null;

    public function connect(): PDO
    {
        if($this->pdo === null){

            try{

                $this->pdo = new PDO(
                    "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4",
                    $this->user,
                    $this->password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );

            }catch(PDOException $e){

                die("Erro na conexão: " . $e->getMessage());
            }
        }

        return $this->pdo;
    }
}

   