<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($data) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO users (first_name, second_name, email, location, phone_number, password) 
                VALUES (:first_name, :second_name, :email, :location, :phone_number, :password)
            ");

            $stmt->execute([
                ':first_name' => $data['first_name'],
                ':second_name' => $data['second_name'],
                ':email' => $data['email'],
                ':location' => $data['location'],
                ':phone_number' => $data['phone_number'],
                ':password' => password_hash($data['password'], PASSWORD_DEFAULT)
            ]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function login($email, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function findUserByEmail($email) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateProfile($userId, $data) {
        try {
            $stmt = $this->db->prepare("
                UPDATE users 
                SET first_name = :first_name,
                    second_name = :second_name,
                    email = :email,
                    location = :location,
                    phone_number = :phone_number
                WHERE id = :id
            ");

            $stmt->execute([
                ':first_name' => $data['first_name'],
                ':second_name' => $data['second_name'],
                ':email' => $data['email'],
                ':location' => $data['location'],
                ':phone_number' => $data['phone_number'],
                ':id' => $userId
            ]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function changePassword($userId, $newPassword) {
        try {
            $stmt = $this->db->prepare("
                UPDATE users 
                SET password = :password
                WHERE id = :id
            ");

            $stmt->execute([
                ':password' => password_hash($newPassword, PASSWORD_DEFAULT),
                ':id' => $userId
            ]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
} 