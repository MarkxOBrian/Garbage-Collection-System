<?php
/**
 * Router class for handling application routes
 */
class Router {
    private $routes = [];

    /**
     * Add a new route
     * @param string $method HTTP method
     * @param string $path URL path
     * @param string $handler Controller@method
     */
    public function addRoute($method, $path, $handler) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    /**
     * Dispatch the request to the appropriate controller and method
     */
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                list($controller, $action) = explode('@', $route['handler']);
                
                // Include the controller file
                $controllerFile = BASE_PATH . '/app/controllers/' . $controller . '.php';
                if (file_exists($controllerFile)) {
                    require_once $controllerFile;
                    
                    // Create controller instance and call the action
                    $controllerInstance = new $controller();
                    $controllerInstance->$action();
                    return;
                }
            }
        }
        
        // No route found
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }
} 