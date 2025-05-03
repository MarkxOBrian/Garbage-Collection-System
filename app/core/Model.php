<?php
/**
 * Base Model class
 */
class Model {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Execute a query
     * @param string $sql The SQL query
     * @param array $params Parameters for prepared statement
     * @return PDOStatement The prepared statement
     */
    protected function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    /**
     * Get all records
     * @param string $table The table name
     * @return array All records
     */
    protected function getAll($table) {
        $sql = "SELECT * FROM $table";
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get a record by ID
     * @param string $table The table name
     * @param int $id The record ID
     * @return array The record
     */
    protected function getById($table, $id) {
        $sql = "SELECT * FROM $table WHERE id = :id";
        return $this->query($sql, ['id' => $id])->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new record
     * @param string $table The table name
     * @param array $data The data to insert
     * @return int The ID of the new record
     */
    protected function create($table, $data) {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $this->query($sql, $data);
        
        return $this->db->lastInsertId();
    }

    /**
     * Update a record
     * @param string $table The table name
     * @param int $id The record ID
     * @param array $data The data to update
     * @return bool True if successful, false otherwise
     */
    protected function update($table, $id, $data) {
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key = :$key";
        }
        $set = implode(', ', $set);
        
        $sql = "UPDATE $table SET $set WHERE id = :id";
        $data['id'] = $id;
        
        return $this->query($sql, $data)->rowCount() > 0;
    }

    /**
     * Delete a record
     * @param string $table The table name
     * @param int $id The record ID
     * @return bool True if successful, false otherwise
     */
    protected function delete($table, $id) {
        $sql = "DELETE FROM $table WHERE id = :id";
        return $this->query($sql, ['id' => $id])->rowCount() > 0;
    }
} 