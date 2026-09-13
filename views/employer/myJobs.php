<!DOCTYPE html>
<html>

<head>
    <title>My Jobs</title>
<link rel="stylesheet"
      href="../views/employer/css/employer.css?v=5">
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

       <a href="employerControls.php?page=profile">
    Profile
   </a>
    </div>

    <div id="user">

        <?php
        echo substr($employer["name"], 0, 1);
        ?>

    </div>

</div>


<div id="main">

    <div id="myJobsHeader">

        <h2>
            My Job Postings
        </h2>

    </div>


    <div id="jobsTableBox">

        <table id="jobsTable">

            <tr>

                <th>Title</th>

                <th>Location</th>

                <th>Deadline</th>

                <th>Status</th>

                <th>Applicants</th>

                <th>Actions</th>

            </tr>


            <?php

            if (mysqli_num_rows($jobs) > 0)
            {
                while ($job = mysqli_fetch_assoc($jobs))
                {
            ?>

                <tr>

                    <td>
                        <?php echo $job["title"]; ?>
                    </td>


                    <td>
                        <?php echo $job["location"]; ?>
                    </td>


                    <td>
                        <?php echo $job["deadline"]; ?>
                    </td>


                    <td>
                        <?php echo ucfirst($job["status"]); ?>
                    </td>


                    <td>
                        <?php echo $job["applicants"]; ?>
                    </td>


                    <td>

                        <div class="jobActions">

                            <a href="employerControls.php?page=editJob&id=<?php echo $job["job_id"]; ?>"
                               class="jobActionButton">

                                Edit

                            </a>


                            <form method="post"
                                  action="employerControls.php?page=jobAction"
                                  onsubmit="return confirm('Are you sure you want to delete this job?');">

                                <input type="hidden"
                                       name="jobId"
                                       value="<?php echo $job["job_id"]; ?>">


                                <input type="hidden"
                                       name="action"
                                       value="delete">


                                <button type="submit"
                                        class="jobActionButton deleteAction">

                                    Delete

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            <?php
                }
            }
            else
            {
            ?>

                <tr>

                    <td colspan="6">
                        No jobs posted yet.
                    </td>

                </tr>

            <?php
            }
            ?>

        </table>

    </div>

</div>

</body>

</html>