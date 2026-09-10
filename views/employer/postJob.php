<!DOCTYPE html>
<html>

<head>
    <title>Post Job</title>

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
        <?php echo substr($employer["name"], 0, 1); ?>
    </div>

</div>


<div id="main">

    <div id="postJobBox">

        <h2>Post a New Job Circular</h2>

        <?php

        if (isset($message))
        {
            echo "<p>" . $message . "</p>";
        }

        ?>

        <form method="post"
              action="employerControls.php?page=postJob">

            <label>Job Title</label>

            <input type="text"
                   name="title"
                   placeholder="e.g. Junior PHP Developer"
                   required>


            <label>Description</label>

            <textarea name="description"
                      placeholder="Describe the role..."
                      required></textarea>


            <label>Requirements</label>

            <textarea name="requirements"
                      placeholder="Skills, experience needed..."
                      required></textarea>


            <div class="formRow">

                <div class="formGroup">

                    <label>Category</label>

                    <input type="text"
                           name="category"
                           placeholder="Web Development"
                           required>

                </div>


                <div class="formGroup">

                    <label>Location</label>

                    <input type="text"
                           name="location"
                           placeholder="Dhaka"
                           required>

                </div>

            </div>


            <div class="formRow">

                <div class="formGroup">

                    <label>Salary Range</label>

                    <input type="text"
                           name="salary"
                           placeholder="30,000 - 40,000"
                           required>

                </div>


                <div class="formGroup">

                    <label>Application Deadline</label>

                    <input type="date"
                           name="deadline"
                           required>

                </div>

            </div>


            <button type="submit"
                    name="postJob"
                    id="submitJob">

                Post Job

            </button>

        </form>

    </div>

</div>

</body>
</html>