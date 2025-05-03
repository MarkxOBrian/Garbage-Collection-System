<?php
/**
 * View class for handling view rendering
 */
class View {
    /**
     * Render a view file
     * @param string $view The view file to render
     * @param array $data Data to pass to the view
     */
    public function render($view, $data = []) {
        // Extract data to make variables available in view
        extract($data);

        // Start output buffering
        ob_start();

        // Include the view file
        require_once BASE_PATH . '/app/views/' . $view . '.php';

        // Get the contents of the buffer
        $content = ob_get_clean();

        // Include the layout
        require_once BASE_PATH . '/app/views/layouts/main.php';
    }

    /**
     * Render a partial view
     * @param string $view The partial view file to render
     * @param array $data Data to pass to the partial view
     */
    public function partial($view, $data = []) {
        // Extract data to make variables available in view
        extract($data);

        // Include the partial view file
        require_once BASE_PATH . '/app/views/partials/' . $view . '.php';
    }
} 