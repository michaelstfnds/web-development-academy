<?php

require_once __DIR__ . '/../boot/boot.php';

use Hotel\Room;
use DateTime;

// Initialize Room service
$room = new Room();

// Get all cities
$cities = $room->getCities();

// Get page parameters
$selectedCity = $_REQUEST['city'];
$selectedTypeId = $_REQUEST['room_type'];
$checkInDate = $_REQUEST['date_check_in'];
$checkOutDate = $_REQUEST['date_check_out'];

// Search for room
$allAvailableRooms = $room->search(new DateTime($checkInDate), new DateTime($checkOutDate), $selectedCity, $selectedTypeId);
//print_r($allAvailableRooms);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-4.5.0-dist\css\custom.css">
    <script src="https://kit.fontawesome.com/4ce5ded0cf.js"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="profile-style.css">
    <link rel="stylesheet" href="assets/jquery/jquery-ui-1.12.1/jquery-ui.css">
    <script src="assets/jquery/jquery-1.12.4.js"></script>
    <script src="assets/jquery/jquery-ui-1.12.1/jquery-ui.js"></script>
    <script>
    $( function() {

        $( "#datepicker1" ).datepicker();
        $( "#datepicker2" ).datepicker();

        // Slider
        $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 600,
      values: [ 0, 600 ],
      slide: function( event, ui ) {
        $( "#amount1" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount2" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );

    } );
    </script>
</head>
<body class="list-page">
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
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item"><span class="divider"> | </span></li>
                    <li class="nav-item dropdown">
                        <a style="color: #465699;" class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> Profile
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="">Account Details <i class="fas fa-infi"></i></a>
                            <a class="dropdown-item" href="">Log Out <i class="fas fa-user"></i></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        </nav>
    </header>

    <main>
        <section class="container-xl">
            <aside class="sidebar-menu">
                <section>
                    <div class="favorite-hotels">
                        <h6>FAVORITES</h6>
                        <ol>
                            <li>Megali Vretania Hotel</li>
                        </ol>
                    </div>
                    <div class="my-reviews">
                        <h6>REVIEWS</h6>
                        <ol>
                            <li>Megali Vretania Hotel</li>
                            <div>
                                <i class="fa fa-star checked" id="one"></i>
                                <i class="fa fa-star checked" id="two"></i>
                                <i class="fa fa-star checked" id="three"></i>
                                <i class="fa fa-star checked" id="four"></i>
                                <i class="fa fa-star unchecked" id="five"></i>
                            </div>
                            <li>Hilton Hotel</li>
                            <div>
                                <i class="fa fa-star checked" id="one"></i>
                                <i class="fa fa-star checked" id="two"></i>
                                <i class="fa fa-star checked" id="three"></i>
                                <i class="fa fa-star unchecked" id="four"></i>
                                <i class="fa fa-star unchecked" id="five"></i>
                            </div>
                        </ol>
                    </div>
                </section>
            </aside>
            <section class="hotel-list">
                <h6 class="profile-title">My Bookings</h6>
                <section>
                    <?php
                        foreach ($allAvailableRooms as $availableRoom) {
                    ?>
                    <article class="hotel">
                        <aside class="article-media">
                            <img src="assets/images/hotel-rooms/<?php echo $availableRoom['photo_url']; ?>" alt="" width="100%" height="auto">
                        </aside>
                        <main class="hotel-info">
                            <h4 class="hotel-name"><?php echo $availableRoom['name']; ?></h4>
                            <p  class="hotel-address"><?php echo $availableRoom['city'] . ", " . $availableRoom[':area']; ?></p>
                            <p class="hotel-description"><?php echo $availableRoom['description_short']; ?></p>
                            <button type="button" class="btn btn-info">Go to Room Page</button>
                        </main>
                        <div class="clear"></div>
                        <div class="hotel-footer">
                            <p class="price"> Per Night: <?php echo $availableRoom['price']; ?>$</p>
                            <div class="tag">
                                <span class="put-left" >Count of Guests: <?php echo $availableRoom['count_of_guests']; ?></span>
                                <span>|</span>
                                <span class="put-right">Type of Room: 
                                <?php
                                    if ($availableRoom['type_id'] == 1) {
                                        echo "Single Room" ;
                                    } elseif ($availableRoom['type_id'] == 2) {
                                        echo "Double Room" ;
                                    } elseif ($availableRoom['type_id'] == 3) {
                                        echo "Triple Room" ;
                                    } else {
                                        echo "Fourfold Room" ;
                                    }
                                ?>
                            </span>
                            </div>
                        </div>
                    </article>
                    <?php
                        }
                    ?>
                </section>
                <?php
                    if (count($allAvailableRooms) == 0) {
                ?>
                    <h2>There are no rooms!</h2>
                    <hr>
                <?php
                    }
                ?>
            </section>
            <div class="clear"></div>
        </section>
    </main>

    <footer class="profile-page-footer">
        <p class="copyrights"> © CollegeLink 2020</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="assets/jquery/jquery-ui-1.12.1/external/jquery/jquery.js"></script>
    <script src="assets/jquery/jquery-ui-1.12.1/jquery-ui.js"></script>
</body>
</html>