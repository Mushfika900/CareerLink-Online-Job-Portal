<!DOCTYPE html>
<html>

<head>

    <title>Applicants</title>

    <link rel="stylesheet"
          href="../views/employer/css/employer.css?v=6">

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


    <a href="employerControls.php?page=myJobs"
       id="backLink">

        ← Back to My Jobs

    </a>


    <p id="jobPath">

        My Jobs /
        <?php echo $job["title"]; ?>

    </p>


    <h2>

        Applicants
        (<?php echo mysqli_num_rows($applicants); ?>)

    </h2>



    <div id="applicantsTableBox">

        <table id="applicantsTable">


            <tr>

                <th>Applicant</th>

                <th>Applied</th>

                <th>Resume</th>

                <th>Status</th>

                <th>Action</th>

            </tr>


            <?php

            if (mysqli_num_rows($applicants) > 0)
            {

                mysqli_data_seek($applicants, 0);

                while ($applicant = mysqli_fetch_assoc($applicants))
                {

            ?>


                <tr>


                    <td>

                        <?php
                        echo $applicant["name"];
                        ?>

                    </td>


                    <td>

                        <?php
                        echo date(
                            "M d",
                            strtotime($applicant["applied_date"])
                        );
                        ?>

                    </td>


                    <td>

                        <?php

                        if ($applicant["resume_file"] != "")
                        {

                        ?>

                            <a href="../uploads/cv/<?php echo basename($applicant["resume_file"]); ?>"
                               download
                               class="resumeLink">

                                Download CV

                            </a>

                        <?php

                        }
                        else
                        {

                            echo "No CV";

                        }

                        ?>

                    </td>


                    <td>

                        <span class="applicationStatus <?php echo $applicant["status"]; ?>">

                            <?php
                            echo ucfirst($applicant["status"]);
                            ?>

                        </span>

                    </td>


                   <td>

    <form method="post"
          action="employerControls.php?page=updateApplication"
          class="statusForm">

        <input type="hidden"
               name="applicationId"
               value="<?php echo $applicant["application_id"]; ?>">

        <input type="hidden"
               name="jobId"
               value="<?php echo $job["job_id"]; ?>">

        <select name="status"
                class="statusActionSelect"
                onchange="this.form.submit()">

            <option value="accepted"
                <?php
                if ($applicant["status"] == "accepted")
                {
                    echo "selected";
                }
                ?>>

                Accepted

            </option>


            <option value="pending"
                <?php
                if ($applicant["status"] == "pending")
                {
                    echo "selected";
                }
                ?>>

                Pending

            </option>


            <option value="rejected"
                <?php
                if ($applicant["status"] == "rejected")
                {
                    echo "selected";
                }
                ?>>

                Rejected

            </option>

        </select>

    </form>

</td>

                </tr>


            <?php

                }

            }

            else
            {

            ?>


                <tr>

                    <td colspan="5"
                        class="emptyApplicants">

                        No applicants found.

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