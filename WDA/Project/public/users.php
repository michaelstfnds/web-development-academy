<?php

require_once __DIR__.'/../autoload.php';

use Hotel\User;

$user = new User();
//$list = $user->getList();
// print_r($list);

//Create new user
// $status = $user->insert('Jim', 'Jim@hotel.com', 'password123');
// var_dump($status);

// $list = $user->getList();
// print_r($list);

$verified = $user->verify('jim@hotel.com', 'password123');
var_dump($verified);