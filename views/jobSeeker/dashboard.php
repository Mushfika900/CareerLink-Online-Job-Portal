<!-- Rendered by controllers/jobSeekerControls.php?page=dashboard
     Expects: $name, $initials, $stats, $recentApplications -->

<?php
$nameParts = explode(" ", $name);
$firstName = $nameParts[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CareerLink - Dashboard</title>

    <link rel="stylesheet" href="../views/jobSeeker/css/shared.css">
    <link rel="stylesheet" href="../views/jobSeeker/css/dashboard.css">

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

            <a href="jobSeekerControls.php?page=dashboard" class="active">
                Dashboard
            </a>

            <a href="jobSeekerControls.php?page=browseJobs">
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


        <!-- Welcome -->
        <div class="welcome">

            <h1>
                Welcome back,
                <?php echo htmlspecialchars($firstName); ?>
            </h1>

            <p>
                Here's where your applications stand.
            </p>

        </div>


        <!-- Statistics -->
        <div class="stats">

            <div class="stat-box">

                <div class="number">
                    <?php echo $stats["Total"]; ?>
                </div>

                <div class="label">
                    Total Applications
                </div>

            </div>


            <div class="stat-box pending">

                <div class="number">
                    <?php echo $stats["pending"]; ?>
                </div>

                <div class="label">
                    Pending
                </div>

            </div>


            <div class="stat-box accepted">

                <div class="number">
                    <?php echo $stats["accepted"]; ?>
                </div>

                <div class="label">
                    Accepted
                </div>

            </div>


            <div class="stat-box rejected">

                <div class="number">
                    <?php echo $stats["rejected"]; ?>
                </div>

                <div class="label">
                    Rejected
                </div>

            </div>

        </div>


        <!-- Recent Applications -->
        <div class="recent">

            <div class="recent-header">

                <h2>
                    Recent Applications
                </h2>

                <a href="jobSeekerControls.php?page=myApplications" class="view-btn">
                    View all
                </a>

            </div>


            <table>

                <tr>

                    <th>JOB TITLE</th>
                    <th>COMPANY</th>
                    <th>APPLIED</th>
                    <th>STATUS</th>

                </tr>


                <?php

                if (empty($recentApplications)) {

                    echo "<tr>";
                    echo "<td colspan='4'>No applications yet.</td>";
                    echo "</tr>";

                } else {

                    foreach ($recentApplications as $app) {

                ?>

                        <tr>

                            <td>
                                <?php echo htmlspecialchars($app["title"]); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($app["company_name"]); ?>
                            </td>

                            <td>
                                <?php
                                echo date(
                                    "M d",
                                    strtotime($app["applied_date"])
                                );
                                ?>
                            </td>

                            <td>

                                <span class="status <?php echo $app["status"]; ?>-status">

                                    <?php
                                    echo ucfirst($app["status"]);
                                    ?>

                                </span>

                            </td>

                        </tr>

                <?php

                    }
                }

                ?>

            </table>

        </div>

    </div>

</div>

</body>
</html>