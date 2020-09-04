<?php

namespace Hotel;

use PDO;
use Support\Configuration\Configuration;

class BaseService {

    private static $pdo;

    public function __construct() {
        $this->initializePdo();
    }

    protected function initializePdo() {

        // Check if pdo is initialized
        if (!empty(self::$pdo)) {
            return;
        }
        // Load database configuration
        $config = Configuration::getInstance();
        $databaseConfig = $config->getConfig()['database'];

        // Connect to database
        // $this->pdo = new PDO('mysql:host=127.0.0.1;dbname=hotel;charset=UTF8', 'hotel', '123456789', [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"]);
        try{
            self::$pdo = new PDO(sprintf('mysql:host=%s;dbname=%s;charset=UTF8', $databaseConfig['host'],
            $databaseConfig['dbname']), $databaseConfig['username'], $databaseConfig['password'],
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"]);
        } catch (\PDOException $ex) {
            throw new \Exception(sprintf('Could not connect to database. Error: %s', $ex->getMessage()));
        }
    }

    protected function execute($sql, $parameters) {

        // Prepare statement
        $statement = $this->getPdo()->prepare($sql);

        // Bind Parameters
        foreach($parameters as $key => $value) {
            $statement->bindParam($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }

        // Execute
        $status = $statement->execute();
        if (!$status) {
            throw new Exception($statement->errorInfo()[2]);
        }

        return $status;
    }

    protected function fetchAll($sql, $parameters = [], $type = PDO::FETCH_ASSOC) {
        // Prepare Statement
        $statement = $this->getPdo()->prepare($sql);

        // Bind Parameters
        foreach($parameters as $key => $value) {
            $statement->bindParam($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }

        // Execute
        $status = $statement->execute();
        if (!$status) {
            throw new Exception($statement->errorInfo()[2]);
        }

        // Fetch all
        return $statement->fetchAll($type);
    }

    protected function fetch($sql, $parameters = [], $type = PDO::FETCH_ASSOC) {
        // Prepare Statement
        $statement = $this->getPdo()->prepare($sql);

        // Bind Parameters
        foreach($parameters as $key => $value) {
            $statement->bindParam($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }

        // Execute
        $status = $statement->execute();
        if (!$status) {
            throw new Exception($statement->errorInfo()[2]);
        }

        // Fetch all
        return $statement->fetch($type);
    }

    protected function getPdo()
    {
        return self::$pdo;
    }
}