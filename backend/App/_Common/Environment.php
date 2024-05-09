<?php

namespace App\_Common;

class Environment {
    public static string $dbDriver;
    public static string $dbHost;
    public static string $dbPort;
    public static string $dbUser;
    public static string $dbPassword;
    public static string $dbName;

    public static function load() {
        $config = parse_ini_file("../.env");
        static::$dbDriver     = $config['DB_DRIVER'] ?? '';
        static::$dbHost     = $config['DB_HOST'] ?? '';
        static::$dbPort     = $config['DB_PORT'] ?? '';
        static::$dbUser     = $config['DB_USER'] ?? '';
        static::$dbPassword = $config['DB_PASSWORD'] ?? '';
        static::$dbName      = $config['DB_NAME'] ?? '';
    }
}