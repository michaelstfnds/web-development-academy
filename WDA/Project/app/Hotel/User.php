<?php

namespace Hotel;

use PDO;

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=127.0.0.1;dbname=hotel;charset=UTF8', 'hotel', '123456789', [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"]);
    }

    public function getByEmail($email) {
        $statement = $this->getPdo()->prepare('SELECT * FROM user WHERE email = :email');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getList() {
        $statement = $this->getPdo()->prepare('SELECT * FROM user');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($name, $email, $password) {
        
        //Prepare statement
        $statement = $this->getPdo()->prepare('INSERT INTO user (name, email, password) VALUES (:name, :email, :password)');

        //Hash password
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        //Bind parameters
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $passwordHash, PDO::PARAM_STR);

        $rows = $statement->execute();

        return $rows == 1;
    }

    public function verify($email, $password) {

        //Step 1 - Retrieve user
        $user = $this->getByEmail($email);

        //Step 2 - Verify user password
        return password_verify($password, $user['password']);
    }

    protected function getPdo()
    {
        return $this->pdo;
    }
}