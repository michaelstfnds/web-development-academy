<?php

namespace Hotel;

use PDO;

class Room {

    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=127.0.0.1;dbname=hotel;charset=UTF8', 'hotel', '123456789', [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"]);
    }

    public function getCities() {

        // Execute SQL
        $statement = $this->getPdo()->prepare('SELECT DISTINCT city FROM room');
        $statement->execute();

        // Get cities
        $cities = [];
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($rows as $row) {
            $cities[] = $row['city'];
        }

        return $cities;
    }

    public function search($city, $typeId, $checkInDate, $checkOutDate) {
        // Execute SQL
        $statement = $this->getPdo()->prepare('SELECT * FROM room
            WHERE city = :city AND type_id = :type_id AND room_id NOT IN (
                SELECT room_id
                FROM booking
                WHERE check_in_date <= :check_out_date AND check_out_date >= :check_in_date)
        ');

        //Bind parameters
        $statement->bindParam(':city', $city, PDO::PARAM_STR);
        $statement->bindParam(':type_id', $typeId, PDO::PARAM_INT);
        $statement->bindParam(':check_in_date', $checkInDate->format(\DateTime::ATOM), PDO::PARAM_STR);
        $statement->bindParam(':check_out_date', $checkOutDate->format(\DateTime::ATOM), PDO::PARAM_STR);

        $statement->execute();

        // Get rooms
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    protected function getPdo()
    {
        return $this->pdo;
    }

}
