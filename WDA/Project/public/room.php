<?php

require_once __DIR__ . '/../boot/boot.php';

use Hotel\Room;
use Hotel\Favorite;
use Hotel\User;
use Hotel\Review;
use DateTime;

// Initialize Room service
$room = new Room();
$favorite = new Favorite();

// Check for room id
$roomId = $_REQUEST['room_id'];
if (empty($roomId)) {
    header('Location: index.php');

    return;
}

// Load room info
$roomInfo = $room->get($roomId);
if (empty($roomInfo)) {
    header('Location: index.php');

    return;
}

//Get current user id
$userId = User::getCurrentUserId();

// Check if room is favorite for current user
$isFavorite = $favorite->isFavorite($roomId, $userId);

//Load all reviews
$review = new Review();
$allReviews = $review->getReviewsByRoom($roomId);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $roomInfo['name'] ?></title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-4.5.0-dist\css\custom.css">
    <script src="https://kit.fontawesome.com/4ce5ded0cf.js"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="room-style.css">
    <link rel=”stylesheet” href=”https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header class="header-shadow">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div style="width:900px;margin:auto;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="list.php" style="color: black;" >Hotels</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
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
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="register.php">Sign Up <i class="fas fa-user-plus"></i></a>
                            <a class="dropdown-item" href="login.php">Log In <i class="fas fa-user"></i></a>
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
                    <div class="title-review">
                        <span>Reviews:</span>
                        <?php
                            $roomAvgReview = $roomInfo['avg_reviews'];
                            for ($i = 1; $i <= 5; $i++) {
                                if ($roomAvgReview > $i) {
                                    ?>
                                    <span class="fa fa-star checked"></span>
                                    <?php
                                } else {
                                    ?>
                                    <span class="fa fa-star unchecked"></span>
                                    <?php
                                }
                            }
                        ?>
                        |
                    </div>
                    <div class="fav">
                        <form name="favoriteForm" method="post" id="favoriteForm" class="favoriteForm" 
                            action="actions/favorite.php" >
                            <input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
                            <input type="hidden" name="is_favorite" value="<?php echo $isFavorite ? '1' : '0'; ?>">
                            <li class="fa fa-heart <?php echo $isFavorite ? 'selected' : ''; ?>" id="fav" ></li>
                        </form>
                    </div>
                    <span class="room-price">Price per night: <?php echo $roomInfo['price'];?>€</span>
                    <div class="clear"></div>
                </div>
                <div class="hotel-room-media">
                    <div style="max-width:700px;">
                        <img src="assets/images/hotel-rooms/<?php echo $roomInfo['photo_url']; ?>" alt="" width="100%" height="auto">
                    </div>
                </div>
                <div class="profile-info tab">
                    <li>
                        <div class="amen-title">
                            COUNT OF GUESTS
                        </div>
                        <div>
                            <i class="fas fa-user"></i> <?php echo $roomInfo['count_of_guests'];?>
                        </div>
                    </li>
                    <li>
                        <div class="amen-title">
                            TYPE OF ROOM
                        </div>
                        <div>
                            <i class="fas fa-bed"></i> 
                            <?php
                                if ($roomInfo['type_id'] == 1) {
                                    echo "Single Room" ;
                                } elseif ($roomInfo['type_id'] == 2) {
                                    echo "Double Room" ;
                                } elseif ($roomInfo['type_id'] == 3) {
                                    echo "Triple Room" ;
                                } else {
                                    echo "Fourfold Room" ;
                                }
                            ?>
                        </div>
                    </li>
                    <li>
                        <div class="amen-title">
                            PARKING
                        </div>
                        <div>
                            <i class="fas fa-parking"></i> 
                            <?php
                                if ($roomInfo['parking'] == 1) {
                                    echo "Yes";
                                } else {
                                    echo "No";
                                }
                            ?>
                        </div>
                    </li>
                    <li>
                        <div class="amen-title">
                            WIFI
                        </div>
                        <div>
                            <i class="fas fa-wifi"></i> 
                            <?php
                                if ($roomInfo['wifi'] == 1) {
                                    echo "Yes";
                                } else {
                                    echo "No";
                                }
                            ?>
                        </div>
                    </li>
                    <li>
                        <div class="amen-title">
                            PET FRIENDLY
                        </div>
                        <div>
                            <i class="fas fa-dog"></i> 
                            <?php
                                if ($roomInfo['pet_friendly'] == 1) {
                                    echo "Yes";
                                } else {
                                    echo "No";
                                }
                            ?>
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
                    <h3>Reviews</h3>
                    <br>
                    <?php
                        foreach ($allReviews as $review) {
                    ?>
                        <div class="review-list">
                            <h4>
                                <span>1. John Doe</span>
                                <div class="div-reviews">
                                    <?php
                                        $roomAvgReview = $roomInfo['avg_reviews'];
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($roomAvgReview > $i) {
                                                ?>
                                                <span class="fa fa-star checked"></span>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="fa fa-star unchecked"></span>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </h4>
                        </div>
                    <?php
                        }
                    ?>
                    <div class="add-review">
                        <h3>Add A Review</h3>
                        <span>
                            <span class="fa fa-star unchecked" id="one"></span>
                            <span class="fa fa-star unchecked" id="two"></span>
                            <span class="fa fa-star unchecked" id="three"></span>
                            <span class="fa fa-star unchecked" id="four"></span>
                            <span class="fa fa-star unchecked" id="five"></span>
                        </span>
                        <textarea name="review" rows="2" cols="95">Add your review here...</textarea>
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
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnCjGr_c6T1dAgRtnbSEegZTm1cRwrGvs&callback=initMap"></script>
    <script src="slider-js.js"></script>
    <script src="rating.js"></script>
    <script src="favorite.js"></script>
    <script>
        function initMap() {
        // The location of Uluru
        //var uluru = {lat: 37.976604, lng: 23.735558};
        var uluru = {lat: <?php echo $roomInfo['location_lat'];?>, lng: <?php echo $roomInfo['location_long'];?>};
        // The map, centered at Uluru
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 15, center: uluru});
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: uluru, map: map});
        }
    </script>
</body>
</html>