<?php

require_once __DIR__ . '/../boot/boot.php';

use Hotel\User;

// Check for existing logged in user
// if (!empty(User::getCurrentUserId())) {
//     header('Location: /Project/public/index.php');die;
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel Stay - Create an account</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" 
    rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap"
    rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" 
    crossorigin="anonymous"> -->
    <link rel="stylesheet" href="bootstrap-4.5.0-dist\css\custom.css">
    <script src="https://kit.fontawesome.com/4ce5ded0cf.js"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="app-style.css">
</head>
<body>
    <header class="header-shadow">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#" style="color: black;">Hotel Stay</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="list.php" style="color: black;">Hotels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: black;">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: black;">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <!--<li><a href="#">Sign Up <i class="fas fa-user-plus"></i></a></li>
                    <li><a href="#">Login <i class="fas fa-user"></i></a></li>-->
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php"><i class="glyphicon glyphicon-home"></i>Home</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div>
                <h3 class="login-msg">Create your account</h3>
            </div>
            <hr>
            <div class="register-form">
                <form method="POST" action="actions/register.php">
                    <?php if (!empty($_GET['error'])) { ?>
                    <div class="alert alert-danger alert-styled-left">Register Error</div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="name">Full Name</label><br>
                        <input type="text" id="name" name="name" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label><br>
                        <input type="email" id="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="re-email">Verify your email</label><br>
                        <input type="email" id="re-email" name="re-email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label><br>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-size">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <p class="copyrights"> © CollegeLink 2020</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>