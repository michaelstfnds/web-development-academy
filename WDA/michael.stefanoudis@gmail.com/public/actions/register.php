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

// Retrive user
$userInfo = $user->getByEmail($_REQUEST['email']);

// Generate token
$token = $user->generateToken($userInfo['user_id']);

// Set cookie
setcookie('user_token', $token, time() + (30*24*60*60), '/');

//Return to homepage
header('Location: /Project/public/index.php');