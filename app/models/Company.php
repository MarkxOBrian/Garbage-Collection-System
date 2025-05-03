<?php
class Company {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($data) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO companies (
                    comp_name, comp_email, comp_category, comp_location, 
                    comp_description, comp_phone, password, comp_logo
                ) VALUES (
                    :comp_name, :comp_email, :comp_category, :comp_location,
                    :comp_description, :comp_phone, :password, :comp_logo
                )
            ");

            $stmt->execute([
                ':comp_name' => $data['comp_name'],
                ':comp_email' => $data['comp_email'],
                ':comp_category' => $data['comp_category'],
                ':comp_location' => $data['comp_location'],
                ':comp_description' => $data['comp_description'],
                ':comp_phone' => $data['comp_phone'],
                ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
                ':comp_logo' => $data['comp_logo']
            ]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function login($email, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM companies WHERE comp_email = :email");
            $stmt->execute([':email' => $email]);
            $company = $stmt->fetch();

            if ($company && password_verify($password, $company['password'])) {
                return $company;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function findCompanyByEmail($email) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM companies WHERE comp_email = :email");
            $stmt->execute([':email' => $email]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAllCompanies() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM companies ORDER BY comp_name");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }

    public function updateProfile($companyId, $data) {
        try {
            $stmt = $this->db->prepare("
                UPDATE companies 
                SET comp_name = :comp_name,
                    comp_email = :comp_email,
                    comp_category = :comp_category,
                    comp_location = :comp_location,
                    comp_description = :comp_description,
                    comp_phone = :comp_phone
                WHERE id = :id
            ");

            $stmt->execute([
                ':comp_name' => $data['comp_name'],
                ':comp_email' => $data['comp_email'],
                ':comp_category' => $data['comp_category'],
                ':comp_location' => $data['comp_location'],
                ':comp_description' => $data['comp_description'],
                ':comp_phone' => $data['comp_phone'],
                ':id' => $companyId
            ]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateLogo($companyId, $logoPath) {
        try {
            $stmt = $this->db->prepare("
                UPDATE companies 
                SET comp_logo = :comp_logo
                WHERE id = :id
            ");

            $stmt->execute([
                ':comp_logo' => $logoPath,
                ':id' => $companyId
            ]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function changePassword($companyId, $newPassword) {
        try {
            $stmt = $this->db->prepare("
                UPDATE companies 
                SET password = :password
                WHERE id = :id
            ");

            $stmt->execute([
                ':password' => password_hash($newPassword, PASSWORD_DEFAULT),
                ':id' => $companyId
            ]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
} 