<?php
session_start();
require_once "../config/dbConnect.php";

$id=$_GET['id'];

$sql="SELECT * FROM jobs WHERE job_id='$id'";
$result=mysqli_query($conn,$sql);
$job=mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
    <link rel="stylesheet" href="css/jobDetails.css">
</head>
<body>

<div class="details-wrapper">

    <a href="jobs.php" class="back-link">&larr;Back to Jobs</a>

    <div class="job-details">

        <h1><?php echo $job['title']; ?></h1>

        <p><?php echo $job['description']; ?></p>

        <?php 
        if(isset($_SESSION['user_id']) && $_SESSION['role']=="jobseeker"){ ?>

            <a href="../controllers/jobSeekerControls.php?page=apply&id=<?php echo $job['job_id']; ?>" class="apply-btn">
                Apply Now
            </a>

        <?php }
        else{ ?>

            <a href="login.php" class="apply-btn">
                Login to Apply
            </a>

        <?php } ?>

    </div>

</div>

</body>
</html>