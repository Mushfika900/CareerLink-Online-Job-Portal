<!-- Rendered by controllers/jobSeekerControls.php?page=myApplications
     Expects: $name, $initials, $applications -->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CareerLink - My Applications</title>

    <link rel="stylesheet" href="../views/jobSeeker/css/shared.css">
    <link rel="stylesheet" href="../views/jobSeeker/css/myApplications.css">

</head>

<body>

<div class="container">


    <div class="navbar">

        <div class="logo">
            <span class="logo-circle"></span>
            CareerLink
        </div>


        <div class="nav-links">

            <a href="jobSeekerControls.php?page=dashboard">
                Dashboard
            </a>

            <a href="jobSeekerControls.php?page=browseJobs">
                Browse Jobs
            </a>

            <a href="jobSeekerControls.php?page=myApplications" class="active">
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


    <div class="main">

        <h1 class="page-title">
            My Applications
        </h1>


        <?php

        if (isset($_GET["applied"])) {

            echo "<span class='form-success'>";
            echo "Application submitted successfully!";
            echo "</span>";

        }

        ?>


        <table>

            <tr>

                <th>JOB TITLE</th>
                <th>COMPANY</th>
                <th>APPLIED DATE</th>
                <th>STATUS</th>

            </tr>


            <?php

            if (empty($applications)) {

                echo "<tr>";
                echo "<td colspan='4'>";
                echo "You haven't applied to any jobs yet.";
                echo "</td>";
                echo "</tr>";

            } else {

                foreach ($applications as $app) {

            ?>

                    <tr>

                        <td>
                            <?php
                            echo htmlspecialchars($app["title"]);
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars($app["company_name"]);
                            ?>
                        </td>


                        <td>
                            <?php
                            echo date(
                                "M d, Y",
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

</body>
</html>