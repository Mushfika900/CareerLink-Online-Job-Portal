<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerLink</title>
    <link rel="stylesheet" href="views/css/index.css">
</head>
<body>

<nav>
    <a href="index.php">Home</a>
    <a href="views/jobs.php">Browse Jobs</a>

    <?php 
    if(isset($_SESSION['user_id'])){ ?>

        <?php
        if($_SESSION['role']=="admin"){ ?>
            <a href="controllers/adminControls.php?page=dashboard">Dashboard</a>

        <?php }
        elseif($_SESSION['role']=="jobseeker"){ ?>
            <a href="controllers/jobSeekerControls.php?page=dashboard">Dashboard</a>

        <?php }
        elseif($_SESSION['role']=="employer"){ ?>
            <a href="controllers/employerControls.php?page=dashboard">Dashboard</a>
        <?php } ?>

        <a href="views/logout.php">Logout</a>

    <?php }
    else{ ?>

        <a href="views/login.php">Login</a>
        <a href="views/registration.php">Register</a>

    <?php } ?>
</nav>

<section class="hero">
    <div class="hero-content">
        <h1>Find Your Next Opportunity</h1>
        <p>Browse thousands of job opportunities and connect with the right employers through CareerLink.</p>
        <a href="views/jobs.php" class="hero-btn">Browse Jobs</a>
    </div>
</section>

</body>
</html>