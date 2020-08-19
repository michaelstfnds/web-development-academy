<?php

// Boot application
require_once __DIR__ . '/../../autoload.php';

use Hotel\User;

//Return to homepage if not a post request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
    header('Location: /');

    return;
}

// Create new user
$user = new User();
$user->insert($_REQUEST['name'], $_REQUEST['email'], $_REQUEST['password']);