<?php

namespace Hotel;

use PDO;
use Hotel\BaseService;

class User extends BaseService {

    const TOKEN_KEY = 'asfdhkgjlr;ofijhgbfdklfsadf';

    private static $currentUserId;

    public function getByEmail($email) {
        $parameters = [
            ':email' => $email,
        ];
        return $this->fetch('SELECT * FROM user WHERE email = :email', $parameters);
    }

    public function getList() {

        return $this->fetchAll('SELECT * FROM user');

    }

    public function insert($name, $email, $password) {

        //Hash password
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // Prepare parameters
        $parameters = [
            ':name' => $name,
            ':email' => $email,
            ':password' => $passwordHash,
        ];
        $rows = $this->execute('INSERT INTO user (name, email, password) VALUES (:name, :email, :password)', $parameters);

        // //Prepare statement
        // $statement = $this->getPdo()->prepare('INSERT INTO user (name, email, password) VALUES (:name, :email, :password)');

        // //Hash password
        // $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // //Bind parameters
        // $statement->bindParam(':name', $name, PDO::PARAM_STR);
        // $statement->bindParam(':email', $email, PDO::PARAM_STR);
        // $statement->bindParam(':password', $passwordHash, PDO::PARAM_STR);

        // $rows = $statement->execute();

        return $rows == 1;
    }

    public function verify($email, $password) {

        //Step 1 - Retrieve user
        $user = $this->getByEmail($email);

        //Step 2 - Verify user password
        return password_verify($password, $user['password']);
    }

    public function generateToken($userId) {

        // Create token payload
        $payload = [ 'user_id' => $userId,];
        $payloadEncoded = base64_encode(json_encode($payload));
        $signature = hash_hmac('sha256', $payloadEncoded, self::TOKEN_KEY);

        return sprintf('%s.%s', $payloadEncoded, $signature);
    }

    public function getTokenPayload($token) {
        // Get payload and signature
        [$payloadEncoded] = explode('.', $token);

        //Get payload
        return json_decode(base64_decode($payloadEncoded), true);
    }

    public function verifyToken($token) {
        //Get payload
        $payload = $this->getTokenPayload($token);
        $userId = $payload['user_id'];

        //Generate signature and verify
        return $this->generateToken($userId) == $token;
    }

    public static function getCurrentUserId() {
        return self::$currentUserId;
    }

    public static function setCurrentUserId($userId) {
        self::$currentUserId = $userId;
    }
}
