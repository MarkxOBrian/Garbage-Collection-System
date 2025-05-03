<?php
/**
 * Database class for handling database connections
 */
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->user,
                $this->pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            ErrorHandler::logError("Database Connection Error: " . $e->getMessage());
            die("Database connection failed. Please try again later.");
        }
    }

    /**
     * Get the database connection
     * @return PDO The database connection
     */
    public function getConnection() {
        return $this->conn;
    }

    /**
     * Prepare a statement
     * @param string $sql The SQL query
     * @return PDOStatement The prepared statement
     */
    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    /**
     * Begin a transaction
     * @return bool True if successful, false otherwise
     */
    public function beginTransaction() {
        return $this->conn->beginTransaction();
    }

    /**
     * Commit a transaction
     * @return bool True if successful, false otherwise
     */
    public function commit() {
        return $this->conn->commit();
    }

    /**
     * Rollback a transaction
     * @return bool True if successful, false otherwise
     */
    public function rollBack() {
        return $this->conn->rollBack();
    }

    /**
     * Get the last inserted ID
     * @return string The last inserted ID
     */
    public function lastInsertId() {
        return $this->conn->lastInsertId();
    }
} 