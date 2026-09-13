<!-- Rendered by controllers/jobSeekerControls.php?page=profile
     Expects: $name (session name), $initials, $seeker -->

<?php

if (isset($_GET["name"])) {
    $pname = $_GET["name"];
} else {
    $pname = $seeker["name"] ?? $name;
}

if (isset($_GET["phone"])) {
    $phone = $_GET["phone"];
} else {
    $phone = $seeker["phone"] ?? "";
}

if (isset($_GET["education"])) {
    $education = $_GET["education"];
} else {
    $education = $seeker["education"] ?? "";
}

if (isset($_GET["experience"])) {
    $experience = $_GET["experience"];
} else {
    $experience = $seeker["experience"] ?? "";
}

if (isset($_GET["skills"])) {
    $skills = $_GET["skills"];
} else {
    $skills = $seeker["skills"] ?? "";
}

$email = $seeker["email"] ?? "";
$resumeFile = $seeker["resume_file"] ?? null;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CareerLink - Profile</title>

    <link rel="stylesheet" href="../views/jobSeeker/css/shared.css">
    <link rel="stylesheet" href="../views/jobSeeker/css/profile.css">

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

            <a href="jobSeekerControls.php?page=dashboard">Dashboard</a>

            <a href="jobSeekerControls.php?page=browseJobs">Browse Jobs</a>

            <a href="jobSeekerControls.php?page=myApplications">My Applications</a>

            <a href="jobSeekerControls.php?page=profile" class="active">Profile</a>

        </div>

        <div class="profile">

            <div class="avatar">
                <?php echo htmlspecialchars($initials); ?>
            </div>

            <span class="user-name">
                <?php echo htmlspecialchars($name); ?>
            </span>

            <a href="../views/logout.php"
               style="font-size:12px;color:#718078;text-decoration:none;margin-left:8px;">
                Logout
            </a>

        </div>

    </div>


    <div class="main">

        <a href="jobSeekerControls.php?page=dashboard" class="back-link">
            &larr; Back to Dashboard
        </a>


        <!-- Success Messages -->

        <?php
        if (isset($_GET["success"])) {
            echo '<span class="form-success">Profile updated successfully!</span>';
        }

        if (isset($_GET["resumeSuccess"])) {
            echo '<span class="form-success">Resume uploaded successfully!</span>';
        }

        if (isset($_GET["resumeDeleted"])) {
            echo '<span class="form-success">Resume deleted successfully!</span>';
        }
        ?>


        <div class="profile-layout">


            <!-- Profile Form -->

            <form class="profile-form"
                  method="POST"
                  action="jobSeekerControls.php?page=profile">

                <input type="hidden" name="saveProfile" value="1">

                <!-- Full Name -->

                <div class="field-group">

                    <label class="field-label">
                        Full Name
                    </label>

                    <input type="text"
                           name="name"
                           class="field-input"
                           value="<?php echo htmlspecialchars($pname); ?>">

                    <?php
                    if (isset($_GET["nameError"]) && $_GET["nameError"] !== "") {
                        echo '<span class="form-error">';
                        echo htmlspecialchars($_GET["nameError"]);
                        echo '</span>';
                    }
                    ?>

                </div>


                <!-- Email -->

                <div class="field-group">

                    <label class="field-label">
                        Email
                    </label>

                    <input type="email"
                           class="field-input"
                           value="<?php echo htmlspecialchars($email); ?>"
                           disabled>

                </div>


                <!-- Phone -->

                <div class="field-group">

                    <label class="field-label">
                        Phone
                    </label>

                    <input type="text"
                           name="phone"
                           class="field-input"
                           value="<?php echo htmlspecialchars($phone); ?>"
                           placeholder="Enter your phone number">

                    <?php
                    if (isset($_GET["phoneError"]) && $_GET["phoneError"] !== "") {
                        echo '<span class="form-error">';
                        echo htmlspecialchars($_GET["phoneError"]);
                        echo '</span>';
                    }
                    ?>

                </div>


                <!-- Education -->

                <div class="field-group">

                    <label class="field-label">
                        Education
                    </label>

                    <textarea name="education"
                              class="field-textarea"
                              placeholder="Your education background"><?php echo htmlspecialchars($education); ?></textarea>

                </div>


                <!-- Experience -->

                <div class="field-group">

                    <label class="field-label">
                        Experience
                    </label>

                    <textarea name="experience"
                              class="field-textarea"
                              placeholder="Your work experience"><?php echo htmlspecialchars($experience); ?></textarea>

                </div>


                <!-- Skills -->

                <div class="field-group">

                    <label class="field-label">
                        Skills
                    </label>

                    <input type="text"
                           name="skills"
                           class="field-input"
                           value="<?php echo htmlspecialchars($skills); ?>"
                           placeholder="e.g. PHP, MySQL, JavaScript">

                </div>


                <button type="submit" class="save-btn">
                    Save Changes
                </button>

            </form>



            <!-- Resume + Danger Zone -->

            <div class="side-box">

                <h3 class="side-heading">
                    Resume
                </h3>


                <!-- Current Resume -->

                <?php
                if (!empty($resumeFile)) {
                ?>

                    <p class="side-text">

                        Current:

                        <a href="../<?php echo htmlspecialchars($resumeFile); ?>"
                           target="_blank">

                            <?php echo basename($resumeFile); ?>

                        </a>

                    </p>


                    <!-- Delete Resume -->

                    <form method="POST"
                          action="jobSeekerControls.php?page=deleteResume"
                          onsubmit="return confirm('Delete your current resume?');"
                          style="margin-bottom:14px;">

                        <button type="submit" class="delete-btn">
                            Delete Resume
                        </button>

                    </form>

                <?php
                } else {
                ?>

                    <p class="side-text">
                        No resume uploaded yet.
                    </p>

                <?php
                }
                ?>


                <!-- Resume Error -->

                <?php
                if (isset($_GET["resumeError"]) && $_GET["resumeError"] !== "") {

                    echo '<span class="form-error">';
                    echo htmlspecialchars($_GET["resumeError"]);
                    echo '</span>';

                }
                ?>


                <!-- Upload Resume -->

                <form method="POST"
                      action="jobSeekerControls.php?page=uploadResume"
                      enctype="multipart/form-data">

                    <input type="file"
                           name="resume"
                           class="file-input"
                           accept=".pdf,.doc,.docx">

                    <button type="submit" class="side-btn">
                        Upload
                    </button>

                </form>


                <!-- Danger Zone -->

                <h3 class="danger-heading">
                    Danger Zone
                </h3>

                <p class="side-text">
                    Permanently delete your account and all application history.
                </p>


                <form method="POST"
                      action="jobSeekerControls.php?page=deleteAccount"
                      onsubmit="return confirm('Are you sure? This cannot be undone.');">

                    <button type="submit" class="delete-btn">
                        Delete Account
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>