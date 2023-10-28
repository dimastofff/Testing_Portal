<?php

namespace App\Config;

class Application
{
    public static function initizalize(): void
    {
        self::initializeDatabaseConnection();
        self::initializeLogging();
        session_start();
    }

    private static function initializeDatabaseConnection(): void
    {
        try {
            $DB_HOST = $_ENV['DB_HOST'];
            $DB_PORT = $_ENV['DB_PORT'];
            $DB_NAME = $_ENV['DB_NAME'];
            $DB_USER = $_ENV['DB_USER'];
            $DB_PASSWORD = $_ENV['DB_PASSWORD'];
            $dsn = 'mysql:host=' . $DB_HOST . ';port=' . $DB_PORT . ';dbname=' . $DB_NAME;
            $GLOBALS['PDO_CONNECTION'] = new \PDO($dsn, $DB_USER, $DB_PASSWORD, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
        } catch (\PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    private static function initializeLogging(): void
    {
        $PHP_LOGS_PATH = $_ENV['PHP_LOGS_PATH'];
        $logger = new \Monolog\Logger('testing_portal_web');
        $fileHandler = new \Monolog\Handler\StreamHandler($PHP_LOGS_PATH);
        $logger->pushHandler($fileHandler);
        $errorHandler = new \Monolog\ErrorHandler($logger);
        $errorHandler->registerErrorHandler();
        $errorHandler->registerExceptionHandler();
        $GLOBALS['LOGGER'] = $logger;
    }
}
