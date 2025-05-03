<?php
/**
 * Base Controller class
 */
class Controller {
    protected $db;
    protected $view;

    public function __construct() {
        $this->db = new Database();
        $this->view = new View();
    }

    /**
     * Load a model
     * @param string $model The model to load
     * @return object The model instance
     */
    protected function model($model) {
        require_once BASE_PATH . '/app/models/' . $model . '.php';
        return new $model($this->db);
    }

    /**
     * Load a view
     * @param string $view The view to load
     * @param array $data Data to pass to the view
     */
    protected function view($view, $data = []) {
        $this->view->render($view, $data);
    }

    /**
     * Redirect to a URL
     * @param string $url The URL to redirect to
     */
    protected function redirect($url) {
        header('Location: ' . $url);
        exit;
    }

    /**
     * Check if user is logged in
     * @return bool True if user is logged in, false otherwise
     */
    protected function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    /**
     * Check if company is logged in
     * @return bool True if company is logged in, false otherwise
     */
    protected function isCompanyLoggedIn() {
        return isset($_SESSION['company_id']);
    }
} 