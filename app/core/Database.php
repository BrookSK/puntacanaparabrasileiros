<?php
/**
 * Classe de conexão com o banco de dados
 * As credenciais ficam hardcoded aqui - sem .env
 * Altere conforme seu ambiente
 */
class Database
{
    private $host = 'localhost';
    private $db_name = 'puntacana_db';
    private $username = 'root';
    private $password = '';
    private $charset = 'utf8mb4';
    private $conn = null;

    public function getConnection()
    {
        if ($this->conn === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $e) {
                die("Erro de conexão: " . $e->getMessage());
            }
        }
        return $this->conn;
    }
}
