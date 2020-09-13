<?php

require_once __DIR__ . '/../boot/boot.php';

use Hotel\Room;

// Get cities
$room = new Room();
//$cities = $room->getCities();
//print_r($cities);

// Search rooms
$rooms = $room->search('Athens', 2, new DateTime('2020-08-01'), new DateTime('2020-08-31'));
print_r($rooms);

?>