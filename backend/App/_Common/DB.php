<?php

namespace App\_Common;

use PDO;

class DB
{
    static protected ?PDO $pdo = null;

    static public function connect(bool $isCreateAnotherConnection = false) : PDO {
        if (static::$pdo and !$isCreateAnotherConnection) return static::$pdo;

        $dsn = Environment::$dbDriver .":host=" .Environment::$dbHost .";port=" .Environment::$dbPort .
               ";dbname=" .Environment::$dbName;
        $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
        $pdo = new PDO( $dsn, Environment::$dbUser, Environment::$dbPassword, $options);

        if (!$isCreateAnotherConnection) static::$pdo = $pdo;

        return $pdo;
    }
}