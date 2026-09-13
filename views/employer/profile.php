<!DOCTYPE html>
<html>

<head>

    <title>Employer Profile</title>

    <link rel="stylesheet"
          href="../views/employer/css/employer.css?v=8">

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
        Logout</a>

    </div>


    <div id="user">

        <?php
        echo substr($employer["name"], 0, 1);
        ?>

    </div>


</div>



<div id="main">


    <a href="employerControls.php?page=dashboard"
       id="backLink">

        ← Back to Dashboard

    </a>



    <div id="profileLayout">


        <div id="profileFormBox">


            <?php

            if (isset($message))
            {

            ?>

                <p class="profileError">

                    <?php echo $message; ?>

                </p>

            <?php

            }

            ?>


            <form method="post"
                  action="employerControls.php?page=profile">


                <label>
                    Full Name
                </label>

                <input type="text"
                       name="name"
                       value="<?php echo $employer["name"]; ?>"
                       required>



                <label>
                    Email
                </label>

                <input type="email"
                       name="email"
                       value="<?php echo $employer["email"]; ?>"
                       required>



                <label>
                    Phone
                </label>

                <input type="text"
                       name="phone"
                       value="<?php echo $employer["phone"]; ?>"
                       required>



                <label>
                    Company Name
                </label>

                <input type="text"
                       name="companyName"
                       value="<?php echo $employer["company_name"]; ?>"
                       required>



                <label>
                    Company Address
                </label>

                <textarea name="companyAddress"
                          required><?php echo $employer["company_address"]; ?></textarea>



                <button type="submit"
                        name="saveProfile"
                        id="saveProfileButton">

                    Save Changes

                </button>


            </form>


        </div>



        <div id="dangerZone">


            <h4>
                Danger Zone
            </h4>


            <p>

                Permanently delete this employer account
                and all posted jobs.

            </p>

<form method="post"
      action="employerControls.php?page=deleteAccount"
      id="deleteAccountForm">

    <button type="submit"
            name="deleteAccount"
            id="deleteAccountButton">

        Delete Account

    </button>

</form>


        </div>


    </div>


</div>

<script src="../views/employer/js/employer.js"></script>
</body>

</html>