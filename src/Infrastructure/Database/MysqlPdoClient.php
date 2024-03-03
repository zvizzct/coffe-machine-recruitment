<?php

namespace Pdpaola\CoffeeMachine\Infrastructure\Database;

class MysqlPdoClient
{
    private static $pdo;

    public function __construct()
    {
        if (!(self::$pdo instanceof \PDO)) {
            $this->initializePdo();
        }
    }

    private function initializePdo()
    {
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $dsn = "mysql:host=coffee-machine.mysql;dbname=coffee_machine;charset=utf8";
        try {
            self::$pdo = new \PDO($dsn, 'coffee_machine', 'coffee_machine', $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    public static function getPdo()
    {
        return self::$pdo;
    }
}
