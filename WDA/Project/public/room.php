<?php

require_once __DIR__ . '/../boot/boot.php';

use Hotel\Room;
use DateTime;

// Initialize Room service
$room = new Room();

// Check for room id
$roomId = $_REQUEST['room_id'];
if (empty($roomId)) {
    header('Location: index.php');
    die;
}

// Load room info
$roomInfo = $room->get($roomId);
if (empty($roomInfo)) {
    header('Location: index.php');
    die;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel: Grande Bretagne</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap"
    rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" -->
    <!-- rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" 
    crossorigin="anonymous"> -->
    <link rel="stylesheet" href="bootstrap-4.5.0-dist\css\custom.css">
    <script src="https://kit.fontawesome.com/4ce5ded0cf.js"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="room-style.css">
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <link rel=”stylesheet” href=”https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <style>
    .mySlides {display:none}
    .w3-left, .w3-right, .w3-badge {cursor:pointer}
    .w3-badge {height:13px;width:13px;padding:0}
    </style> -->
</head>
<body>
    <header class="header-shadow">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div style="width:900px;margin:auto;">
            <!-- <a class="navbar-brand" style="color: black;">Hotel Stay</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="list.php" style="color: black;" >Hotels</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="about.html" style="color: black;">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: black;">Contact</a>
                    </li> -->
                </ul>
                <ul class="navbar-nav ml-auto">
                    <!--<li><a href="#">Sign Up <i class="fas fa-user-plus"></i></a></li>
                    <li><a href="#">Login <i class="fas fa-user"></i></a></li>-->
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item"><span class="divider"> | </span></li>
                    <li class="nav-item dropdown">
                        <a style="color: black;" class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> Profile
                        </a>
                        <!-- <ul class="dropdown-menu">
                            <li><a href="#">Sign Up <i class="fas fa-user-plus"></i></a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Login <i class="fas fa-user"></i></a></li>
                        </ul> -->
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="register.html">Sign Up <i class="fas fa-user-plus"></i></a>
                            <a class="dropdown-item" href="login.html">Log In <i class="fas fa-user"></i></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        </nav>
    </header>

    <main>
        <section class="container-xl">
            <section class="hotel-profile">
                <div class="profile-title"> <?php echo sprintf('%s - %s, %s', $roomInfo['name'], $roomInfo['city'], $roomInfo['area']) ?> |
                    <span class="">
                        <span>Reviews:</span>
                        <?php
                            $roomAvgReview = $roomInfo['avg_reviews'];
                        ?>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star unchecked"></span>
                        <span class="fa fa-star unchecked"></span>
                        <span class="fa fa-star unchecked"></span>
                        |
                    </span>
                    <span class="fa fa-heart" style="color: white;"></span>
                    <!-- <span>
                        <form name="favoriteForm" method="post" id="favoriteForm" class="favoriteForm" 
                        action="actions/favorute.php">
                            <input type="hidden" name="room_id" value="1">
                            <input type="hidden" name="is_favorite" value="1">
                            <span class="search_stars_span">
                                <ul class="fav_star">
                                    <li class="star selected" id="fav">❤</li>
                                </ul>
                            </span>
                        </form>
                    </span> -->
                    <span style="float: right;">Price per night: <?php echo $roomInfo['price'];?>€</span>
                </div>
                <div class="hotel-room-media">
                    <div style="max-width:700px;">
                        <img src="assets/images/hotel-rooms/hotelroom1.jpg" alt="" width="100%" height="auto">
                    </div>
                    <!-- <div class="w3-content w3-display-container" style="max-width:700px">
                        <img class="mySlides" src="assets/images/hotel-rooms/hotelroom1.jpg" style="width:100%">
                        <img class="mySlides" src="assets/images/hotel-rooms/hotelroom4.jpg" style="width:100%">
                        <img class="mySlides" src="assets/images/hotel-rooms/hotelroom5.jpg" style="width:100%">
                        <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
                            <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
                            <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
                            <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
                            <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
                            <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
                        </div>
                    </div> -->
                </div>
                <div class="profile-info tab">
                    <li>
                        <div>
                            COUNT OF GUESTS
                        </div>
                        <div>
                            <i class="fas fa-user"></i> #
                        </div>
                    </li>
                    <li>
                        <div>
                            TYPE OF ROOM
                        </div>
                        <div>
                            <i class="fas fa-bed"></i> #
                        </div>
                    </li>
                    <li>
                        <div>
                            PARKING
                        </div>
                        <div>
                            <i class="fas fa-parking"></i> #
                        </div>
                    </li>
                    <li>
                        <div>
                            WIFI
                        </div>
                        <div>
                            <i class="fas fa-wifi"></i> #
                        </div>
                    </li>
                    <li>
                        <div>
                            PET FRIENDLY
                        </div>
                        <div>
                            <i class="fas fa-dog"></i> #
                        </div>
                    </li>
                </div>
                <div class="room-description">
                    <h3>Room Description</h3>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempor nec feugiat nisl pretium fusce. Sit amet justo donec enim diam. Egestas diam in arcu cursus. Eu augue ut lectus arcu bibendum at varius vel.
                    </p>
                </div>
                <div class="book-button">
                    <button type="button" class="btn btn-secondary btn-sm" disabled>Already Booked</button>
                </div>
                <div id="map"></div>
                <div class="divider">
                    <hr>
                </div>
                <section class="reviews">
                    <div>
                        <h3>Reviews</h3>
                    </div>
                    <div class="review-list"></div>
                    <div class="add-review">
                        <h3>Add Review</h3>
                        <span>
                            <i class="fa fa-star unchecked" id="one"></i>
                            <i class="fa fa-star unchecked" id="two"></i>
                            <i class="fa fa-star unchecked" id="three"></i>
                            <i class="fa fa-star unchecked" id="four"></i>
                            <i class="fa fa-star unchecked" id="five"></i>
                        </span>
                        <textarea name="review" rows="2" cols="95">
                        Add your review here...
                        </textarea>
                        <div style="text-align:center;">
                        <button type="submit" class="btn btn-info" id="add-review-btn" style="width: 75px;">Submit</button>
                        </div>
                    </div>
                </section>
            </section>
            <div class="clear"></div>
        </section>
    </main>

    <footer class="list-page-footer">
        <p class="copyrights"> © CollegeLink 2020</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3tJMMl11BcfeDoHeqPbXvGObMvurT8Tw&callback=initMap"></script>
    <script src="slider-js.js"></script>
    <script src="rating.js"></script>
    <script src="google-maps.js"></script>
</body>
</html>