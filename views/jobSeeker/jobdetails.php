<!-- Rendered by controllers/jobSeekerControls.php?page=jobDetails
     Expects: $name, $initials, $job, $alreadyApplied -->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CareerLink - Job Details</title>

    <link rel="stylesheet" href="../views/jobSeeker/css/shared.css">
    <link rel="stylesheet" href="../views/jobSeeker/css/jobDetails.css">

</head>

<body>

<div class="container">


    <!-- Navbar -->
    <div class="navbar">

        <div class="logo">
            <span class="logo-circle"></span>
            CareerLink
        </div>


        <div class="nav-links">

            <a href="jobSeekerControls.php?page=dashboard">
                Dashboard
            </a>

            <a href="jobSeekerControls.php?page=browseJobs" class="active">
                Browse Jobs
            </a>

            <a href="jobSeekerControls.php?page=myApplications">
                My Applications
            </a>

            <a href="jobSeekerControls.php?page=profile">
                Profile
            </a>

        </div>


        <div class="profile">

            <div class="avatar">
                <?php echo htmlspecialchars($initials); ?>
            </div>

            <span class="user-name">
                <?php echo htmlspecialchars($name); ?>
            </span>

            <a href="../views/logout.php">
                Logout
            </a>

        </div>

    </div>


    <!-- Main -->
    <div class="main">

        <a href="jobSeekerControls.php?page=browseJobs" class="back-link">
            &larr; Back to Jobs
        </a>


        <div class="details-layout">


            <!-- Job Details -->
            <div class="job-details">

                <span class="tag">
                    <?php echo htmlspecialchars($job["category"]); ?>
                </span>


                <h1 class="job-title-heading">
                    <?php echo htmlspecialchars($job["title"]); ?>
                </h1>


                <div class="job-subinfo">

                    <?php echo htmlspecialchars($job["company_name"]); ?>

                    &middot;

                    <?php echo htmlspecialchars($job["location"]); ?>

                    &middot;

                    Posted
                    <?php echo date("M d", strtotime($job["posted_date"])); ?>

                </div>


                <h3 class="section-heading">
                    Description
                </h3>


                <p class="section-text">
                    <?php
                    echo nl2br(
                        htmlspecialchars($job["description"])
                    );
                    ?>
                </p>

            </div>


            <!-- Apply Box -->
            <div class="apply-box">

                <h3 class="apply-heading">
                    Apply for this job
                </h3>


                <?php

                if ($alreadyApplied) {

                    echo "<p class='section-text'>";
                    echo "You've already applied for this job. ";
                    echo "<a href='jobSeekerControls.php?page=myApplications'>My Applications</a>";
                    echo " for status updates.";
                    echo "</p>";

                } else {

                ?>


                    <!-- Error Messages -->

                    <?php

                    if (isset($_GET["jobError"]) &&  $_GET["jobError"] != "") {

                        echo "<span class='form-error'>";
                        echo htmlspecialchars($_GET["jobError"]);
                        echo "</span>";
                    }


                    if (isset($_GET["resumeError"]) && $_GET["resumeError"] != "") {

                        echo "<span class='form-error'>";
                        echo htmlspecialchars($_GET["resumeError"]);
                        echo "</span>";
                    }

                    ?>


                    <!-- Application Form -->

                    <form
                        method="POST"
                        action="jobSeekerControls.php?page=applyJob"
                    >

                        <input
                            type="hidden"
                            name="job_id"
                            value="<?php echo $job["job_id"]; ?>"
                        >


                        <p class="section-text">

                            Your currently saved resume from Profile
                            will be submitted with this application.

                        </p>


                        <button
                            type="submit"
                            class="submit-btn"
                        >
                            Submit Application
                        </button>

                    </form>


                <?php

                }

                ?>


                <!-- Salary and Deadline -->

                <div class="apply-meta">

                    Salary:
                    <?php echo htmlspecialchars($job["salary"]); ?>

                    <br>

                    Deadline:
                    <?php
                    echo date(
                        "M d, Y",
                        strtotime($job["deadline"])
                    );
                    ?>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>