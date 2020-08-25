<?php

require_once __DIR__ . '/../boot/boot.php';

use Hotel\User;

// Get users
$user = new User();
$userRecord = $user->getByEmail('george@hotel.com');
print_r($userRecord);

?>