<?php

    namespace App\Config;

    use PDO;
    use PDOException;

    class Database 
    {

        private string $host;
        private string $db;
        private string $user;
        private string $password;

        private ?PDO $pdo = null;

        public function __construct()
        {
            $this->host = $_ENV['DB_HOST'];
            $this->db = $_ENV['DB_NAME'];
            $this->user = $_ENV['DB_USER'];
            $this->password = $_ENV['DB_PASS'];
        }

        public function connect(): PDO
        {
            if ($this->pdo === null) {

                try {
                    $this->pdo = new PDO(
                        "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4",
                        $this->user,
                        $this->password,
                        [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                        ]
                    );

                } catch (PDOException $e) {
                    error_log($e->getMessage());
                    throw new PDOException("Erro na conexão com o banco.");
                }
            }

            return $this->pdo;
        }
    }

   