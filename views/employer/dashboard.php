<!DOCTYPE html>
<html>

<head>
    <title>Employer Dashboard</title>

    <link rel="stylesheet"
          href="../views/employer/css/employer.css">
</head>

<body>

<div id="header">

    <div id="logo">
        CareerLink
    </div>

    <div id="nav">
        <a href="employerControls.php?page=dashboard">
            Dashboard
        </a>

        <a href="employerControls.php?page=myJobs">
        My Jobs
     </a>
       <a href="employerControls.php?page=postJob">
            Post Job
         </a>

        <a href="#">
            Profile
        </a>
    </div>

    <div id="user">
        <?php
        if ($employer)
        {
            echo substr($employer["name"], 0, 1);
        }
        ?>
    </div>

</div>


<div id="main">

    <h2>
        <?php echo $employer["company_name"]; ?>
    </h2>

    <p id="subtitle">
        Your hiring activity at a glance.
    </p>


    <div id="cards">

        <div class="card">
            <h2><?php echo $totalJobs; ?></h2>
            <p>Jobs Posted</p>
        </div>


        <div class="card">
            <h2><?php echo $activeJobs; ?></h2>
            <p>Active Jobs</p>
        </div>


        <div class="card">
            <h2><?php echo $totalApplicants; ?></h2>
            <p>Total Applicants</p>
        </div>


        <div class="card">
            <h2>
                <?php echo $pendingApplications; ?>
            </h2>

            <p>Pending Review</p>
        </div>

    </div>


    <div id="recentHeader">

        <h3>
            Recently Posted Jobs
        </h3>

        <a href="employerControls.php?page=postJob"
         id="postButton">
        + Post New Job
        </a>

    </div>


    <div id="jobBox">

        <?php

        if (mysqli_num_rows($recentJobs) > 0)
        {
            while ($job = mysqli_fetch_assoc($recentJobs))
            {
        ?>

            <div class="job">

                <div class="jobInfo">

                    <h4>
                        <?php echo $job["title"]; ?>
                    </h4>

                    <p>
                        <?php echo $job["location"]; ?>

                        |

                        <?php echo $job["applicants"]; ?>
                        applicants
                    </p>

                </div>


                <div class="jobStatus">

                    <?php echo ucfirst($job["status"]); ?>

                </div>


                <div>

                    <button type="button">
                        Manage
                    </button>

                </div>

            </div>

        <?php
            }
        }
        else
        {
        ?>

            <p id="empty">
                No jobs posted yet.
            </p>

        <?php
        }
        ?>

    </div>

</div>

</body>
</html>