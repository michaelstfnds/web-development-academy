<?php


use Hotel\User;
use Hotel\Favorite;

//Boot Application
require_once __DIR__ . '/../../boot/boot.php';

// Return to home page if not a post request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
    header('Location: /');

    return;
}

// If no user is logged in, return to main page
if (empty(User::getCurrentUserId())) {
    header('Location: /');

    return;
}

// Check if room id is given
$roomId = $_REQUEST['room_id'];
if (empty($roomId)) {
    header('Location: /');

    return;
}

// Set room to favorites
$favorite = new Favorite();

//Add or remove from favorites
$isFavorite = $_REQUEST['is_favorite'];
if (!$isFavorite) {
    $favorite->addFavorite($roomId, User::getCurrentUserId());
} else {
    $favorite->removeFavorite($roomId, User::getCurrentUserId());
}


// Return to room page
header(sprintf('Location: room.php?room_id=%s', $roomId));