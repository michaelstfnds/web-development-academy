<?php

namespace Hotel;

use PDO;
use DateTime;
use Hotel\BaseService;

class Room extends BaseService {

    public function getCities() {

        // Get all cities
        $cities = [];
        $rows = $this->fetchAll('SELECT DISTINCT city FROM room');
        foreach($rows as $row) {
            $cities[] = $row['city'];
        }

        return $cities;
    }

    public function search($city, $typeId, $checkInDate, $checkOutDate) {

        // Get all available rooms
        $parameters = [
            ':city' => $city,
            ':type_id' => $typeId,
            ':check_in_date' => $checkInDate,
            ':check_out_date' => $checkOutDate,
        ];
        return $this->fetchAll('SELECT * FROM room
            WHERE city = :city AND type_id = :type_id AND room_id NOT IN (
                SELECT room_id
                FROM booking
                WHERE check_in_date <= :check_out_date AND check_out_date >= :check_in_date)
        ', $parameters);
    }
}
