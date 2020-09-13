<?php

require_once __DIR__ . '/../boot/boot.php';

use Hotel\Room;
use DateTime;
use Hotel\RoomType;

// Initialize Room service
$room = new Room();

// Get all cities
$cities = $room->getCities();

// Get all room types
$type = new RoomType();
$allTypes = $type->getAllTypes();

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
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" -->
    <!-- rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" 
    crossorigin="anonymous"> -->
    <link rel="stylesheet" href="bootstrap-4.5.0-dist\css\custom.css">
    <script src="https://kit.fontawesome.com/4ce5ded0cf.js"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="list-style.css">
    <link rel="stylesheet" href="assets/jquery/jquery-ui-1.12.1/jquery-ui.css">
    <script src="assets/jquery/jquery-1.12.4.js"></script>
    <script src="assets/jquery/jquery-ui-1.12.1/jquery-ui.js"></script>
    <script>
    $( function() {

        // Select menu
        //$( "#city" ).selectmenu();
        //$( "#room_type" ).selectmenu();

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
                        <a class="nav-link" href="list.html" style="color: black;" >Hotels</a>
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
            <aside class="sidebar-menu">
                <section>
                    <h5>FIND THE PERFECT HOTEL</h5>
                    <div class="sidebar-form">
                        <form method="POST" action="list.php">
                            <select name="form-count-guests" id="form-count-guests" class="homepage-form-controll">
                                <option value="null" selected>Guests</option>
                                <option value="male">1</option>
                                <option value="female">2</option>
                                <option value="other">3+</option>
                            </select>
                            <select name="room_type" id="room_type" class="homepage-form-controll">
                                <option hidden disabled selected>Room Type</option>
                                <?php
                                    foreach ($allTypes as $type) {
                                ?>
                                    <option <?php echo $selectedTypeId == $type ? 'selected="selected"' : ''; ?> value="<?php echo $city; ?>"><?php echo $city; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <select name="city" id="city" class="homepage-form-controll">
                            <option hidden disabled selected>City</option>
                                <?php
                                    foreach ($cities as $city) {
                                ?>
                                    <option <?php echo $selectedCity==$city ? 'selected="selected"' : ''; ?> value="<?php echo $city; ?>"><?php echo $city; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <div class="price-range">
                                    <p class="f-price" id="amount1">0$</p>
                                    <p class="l-price" id="amount2">600$</p>
                            </div>
                            <div class="clear"></div>
                            <div id="slider-range" class="price-range"></div>
                            <!-- <input type="range" id="price-range" name="price-range" min="0" max="5000"> -->
                            <input type="text" id="datepicker1" name="check_in_date" value="<?php echo $checkInDate; ?>" placeholder="Check-in Date" class="homepage-form-controll">
                            <input type="text" id="datepicker2" name="check_out_date" value="<?php echo $checkOutDate; ?>" placeholder="Check-out Date" class="homepage-form-controll">
                            <button type="button" class="btn btn-info">FIND HOTEL</button>
                        </form>
                    </div>
                </section>
            </aside>
            <section class="hotel-list">
                <h6 class="search-results-title">Search Results</h6>
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

    <footer class="list-page-footer">
        <p class="copyrights"> © CollegeLink 2020</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="assets/jquery/jquery-ui-1.12.1/external/jquery/jquery.js"></script>
    <script src="assets/jquery/jquery-ui-1.12.1/jquery-ui.js"></script>
</body>
</html>