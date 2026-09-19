<?php
require_once "../config/dbConnect.php";

$sql="SELECT * FROM jobs ORDER BY job_id DESC";
$result=mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Jobs - CareerLink</title>
    <link rel="stylesheet" href="css/jobs.css">
</head>
<body>

<div class="jobs-wrapper">

    <a href="../index.php" class="back-link">← Back to Home</a>

    <div class="jobs-header">
        <h1>Available Jobs</h1>
        <p>Explore the latest job opportunities.</p>
    </div>

    <?php while($job=mysqli_fetch_assoc($result)){ ?>

        <div class="job-card">

            <h3><?php echo $job['title']; ?></h3>

            <p><?php echo $job['description']; ?></p>

            <a href="jobDetails.php?id=<?php echo $job['job_id']; ?>" class="view-btn">
                View Details
            </a>

        </div>

    <?php } ?>

</div>

</body>
</html>