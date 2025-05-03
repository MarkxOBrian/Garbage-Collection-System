<?php
class BaseController {
    protected $db;
    protected $errors = [];

    public function __construct($db) {
        $this->db = $db;
    }

    protected function sanitize($input) {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    protected function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    protected function validatePassword($password) {
        return strlen($password) >= 6;
    }

    protected function validatePhone($phone) {
        return strlen($phone) == 10 && ctype_digit($phone);
    }

    protected function displayErrors() {
        if (!empty($this->errors)) {
            return '<div class="alert alert-danger">' . implode('<br>', $this->errors) . '</div>';
        }
        return '';
    }

    protected function redirect($url) {
        header("Location: $url");
        exit();
    }
} 