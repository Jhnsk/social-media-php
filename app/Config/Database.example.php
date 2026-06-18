<?php

    class Database
    {
        private string $host = 'localhost';
        private string $dbname = 'nome_do_banco';
        private string $user = 'usuario';
        private string $password = 'senha';

        public function connect(): PDO
        {
            try {
                $pdo = new PDO(
                    "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                    $this->user,
                    $this->password
                );

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $pdo;

            } catch (PDOException $e) {
                die('Erro de conexão com o banco de dados.');
            }
        }
    }