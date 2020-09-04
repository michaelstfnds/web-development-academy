<?php

namespace Hotel;

use PDO;
use DateTime;
use Hotel\BaseService;

class Room extends BaseService {

    public function getCities() {

        // Get all cities
        $cities = [];
        try {
            $rows = $this->fetchAll('SELECT DISTINCT city FROM room');
            foreach($rows as $row) {
                $cities[] = $row['city'];
            }
        } catch (Exception $ex) {
            // Log Error
        }

        return $cities;
    }

    public function search($checkInDate, $checkOutDate, $city = '', $typeId = '') {

        // Set up parameters
        $parameters = [
            ':check_in_date' => $checkInDate->format(DateTime::ATOM),
            ':check_out_date' => $checkOutDate->format(DateTime::ATOM),
        ];

        if (!empty($city)) {
            $parameters[':city'] = $city;
        }
        if (!empty($typeId)) {
            $parameters[':type_id'] = $typeId;
        }

        // Build query
        $sql = 'SELECT * FROM room WHERE ';
        if (!empty($city)) {
            $sql .= 'city = :city AND ';
        }
        if (!empty($typeId)) {
            $sql .= 'type_id = :type_id AND ';
        }
        $sql .= 'room_id NOT IN (
            SELECT room_id
            FROM booking
            WHERE check_in_date <= :check_out_date AND check_out_date >= :check_in_date
        )';

        // Get results
        return $this->fetchAll($sql, $parameters);
    }
}
