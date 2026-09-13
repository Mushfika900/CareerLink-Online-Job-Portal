<!DOCTYPE html>
<html>

<head>

    <title>Edit Job</title>

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

        <a href="employerControls.php?page=profile">
    Profile
    </a>
    <a href="/CareerLink-Online-Job-Portal/views/logout.php">
        Logout
    </a>
    </div>


    <div id="user">

        <?php
        echo substr($employer["name"], 0, 1);
        ?>

    </div>

</div>



<div id="main">

    <div id="postJobBox">

        <h2>
            Edit Job
        </h2>


        <?php

        if (isset($message))
        {
            echo "<p>" . $message . "</p>";
        }

        ?>


        <form method="post">

            <label>
                Job Title
            </label>

            <input type="text"
                   name="title"
                   value="<?php echo $job["title"]; ?>"
                   required>



            <label>
                Description
            </label>

            <textarea name="description"
                      required><?php echo $job["description"]; ?></textarea>



            <div class="formRow">

                <div class="formGroup">

                    <label>
                        Category
                    </label>

                    <input type="text"
                           name="category"
                           value="<?php echo $job["category"]; ?>"
                           required>

                </div>


                <div class="formGroup">

                    <label>
                        Location
                    </label>

                    <input type="text"
                           name="location"
                           value="<?php echo $job["location"]; ?>"
                           required>

                </div>

            </div>



            <div class="formRow">

                <div class="formGroup">

                    <label>
                        Salary Range
                    </label>

                    <input type="text"
                           name="salary"
                           value="<?php echo $job["salary"]; ?>"
                           required>

                </div>


                <div class="formGroup">

                    <label>
                        Application Deadline
                    </label>

                    <input type="date"
                           name="deadline"
                           value="<?php echo $job["deadline"]; ?>"
                           required>

                </div>

            </div>



            <button type="submit"
                    name="updateJob"
                    id="submitJob">

                Update Job

            </button>

        </form>

    </div>

</div>


</body>

</html>