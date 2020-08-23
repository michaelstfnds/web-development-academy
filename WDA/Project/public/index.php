<?php

require_once __DIR__ . '/../boot/boot.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel Stay</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" 
    rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap"
    rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" 
    crossorigin="anonymous"> -->
    <link rel="stylesheet" href="bootstrap-4.5.0-dist\css\custom.css">
    <script src="https://kit.fontawesome.com/4ce5ded0cf.js"crossorigin="anonymous"></script>
    <link rel="stylesheet" href="app-style.css">
    <!-- Datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $( function() {
        $( "#datepicker" ).datepicker();
        $( "#anim" ).on( "change", function() {
        $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
        });
    } );
    </script>
</head>
<body class="homepage">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
            <a class="navbar-brand" href="#">Hotel Stay</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="list.html">Hotels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <!--<li><a href="#">Sign Up <i class="fas fa-user-plus"></i></a></li>
                    <li><a href="#">Login <i class="fas fa-user"></i></a></li>-->
                    <li class="nav-item active">
                        <a class="nav-link" href="index.html">
                            <i class="glyphicon glyphicon-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a style="color: black;" class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            My Account
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
        </nav>
    </header>

    <main>
        <section class="container">
            <div class="typewriter">
                <h3>Book Today Your Next Hotel Accommodation </h3>
            </div>
            <hr>
            <section class="search-form">
                <form method="POST" action="list.html" class="homepage-form">
                    <select name="formCity" id="formCity">
                        <option value="null" selected>City</option>
                        <option value="male">Athens</option>
                        <option value="female">Mykonos</option>
                        <option value="other">Chania</option>
                    </select>
                    <select name="formRoomType" id="formRoomType">
                        <option value="null" selected>Room Type</option>
                        <option value="singleRoom">Single Room</option>
                        <option value="doubleRoom">Double Room</option>
                        <option value="tripleRoom">Triple Room</option>
                    </select>
                    <input type="date" id="checkIn" name="checkIn" placeholder="Check-in Date">
                    <input type="date" id="checkOut" name="checkOut" placeholder="Check-out Date">
                    <button type="button" class="btn btn-info">Search</button>
                </form>
            </section>
            <div class="clear"></div>
        </section>
    </main>
    <footer class="homepage-footer">
        <p class="copyrights"> © CollegeLink 2020</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>