<?php
class ErrorHandler {
    private static $errors = [];
    private static $debug = true;

    public static function setDebug($debug) {
        self::$debug = $debug;
    }

    public static function addError($message, $code = 0, $data = []) {
        self::$errors[] = [
            'message' => $message,
            'code' => $code,
            'data' => $data,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        error_log("Error: $message (Code: $code)");
    }

    public static function getErrors() {
        return self::$errors;
    }

    public static function hasErrors() {
        return !empty(self::$errors);
    }

    public static function clearErrors() {
        self::$errors = [];
    }

    public static function displayErrors() {
        if (empty(self::$errors)) {
            return '';
        }

        $output = '<div class="alert alert-danger">';
        foreach (self::$errors as $error) {
            $output .= '<p><strong>Error:</strong> ' . htmlspecialchars($error['message']);
            if (self::$debug && $error['code']) {
                $output .= ' (Code: ' . $error['code'] . ')';
            }
            $output .= '</p>';
        }
        $output .= '</div>';

        self::clearErrors();
        return $output;
    }

    public static function handleException($exception) {
        self::addError(
            $exception->getMessage(),
            $exception->getCode(),
            [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString()
            ]
        );

        if (!self::$debug) {
            self::addError('An unexpected error occurred. Please try again later.');
        }
    }

    public static function handleError($errno, $errstr, $errfile, $errline) {
        if (!(error_reporting() & $errno)) {
            return false;
        }

        self::addError(
            $errstr,
            $errno,
            [
                'file' => $errfile,
                'line' => $errline
            ]
        );

        return true;
    }

    public static function handleShutdown() {
        $error = error_get_last();
        if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
            self::addError(
                $error['message'],
                $error['type'],
                [
                    'file' => $error['file'],
                    'line' => $error['line']
                ]
            );
        }
    }
} 