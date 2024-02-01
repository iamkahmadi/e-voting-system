<?php
session_start();


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Voting System using PHP</title>
    <link rel="stylesheet" href="dist/css/style.css">
</head>

<!-- navbar code starts here -->
<nav class="c-navbar">
    <div class="c-nav-item">
        <a href="/votesystem">
            <img src="dist/img/logo.jpeg" alt="Our logo" id="logo">
        </a>
    </div>
    <div class="c-nav-item">
        <ul class="nav-links">
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="blogs.php">Blogs</a>
            </li>
            <li>
                <a href="election_results.php">Election Results</a>
            </li>
        </ul>
    </div>
    <?php

    if (isset($_SESSION['voter'])) {
        echo '
        <div class="c-nav-item c-nav-buttons">
            <a href="home.php" style="width: 150px;">Dashboard</a>
        </div>
        ';
    } else {
        echo '
        <div class="c-nav-item c-nav-buttons">
            <a href="login_page.php">Login</a>
            <a href="register.php">Register</a>
        </div>  
        ';
    }

    ?>
</nav>
<!-- navbar code ends here -->