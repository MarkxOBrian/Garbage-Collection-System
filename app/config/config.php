<?php
/**
 * Application Configuration
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'garbage_collection');

// Application Configuration
define('APP_NAME', 'Garbage Collection System');
define('APP_URL', 'http://localhost/garbage-collection-system');
define('APP_ROOT', dirname(dirname(__FILE__)));

// Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session Configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);

// Timezone
date_default_timezone_set('Africa/Nairobi');

// File Upload Configuration
define('MAX_FILE_SIZE', 2 * 1024 * 1024); // 2MB
define('ALLOWED_FILE_TYPES', ['image/jpeg', 'image/png']);
define('UPLOAD_DIR', APP_ROOT . '/public/uploads/');

// Email Configuration
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your-email@gmail.com');
define('SMTP_PASSWORD', 'your-password');
define('SMTP_FROM_EMAIL', 'noreply@garbagecollection.com');
define('SMTP_FROM_NAME', 'Garbage Collection System');