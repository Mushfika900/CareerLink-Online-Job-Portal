<?php
/*
 
    
    ------------------------------------------------------------------
*/

// STATIC DATA - remove when DB is wired
$initials = "AR";
$fullName = "Arafat Hossain";
$alreadyApplied = false;
$job = [
    "job_id" => 1,
    "title" => "Junior PHP Developer",
    "category" => "Web Development",
    "company_name" => "Nexbridge Ltd.",
    "location" => "Dhaka",
    "posted_date" => "2026-08-10",
    "description" => "We're looking for a junior PHP developer comfortable with MVC-style codebases to help maintain and extend our internal tools. You'll work closely with two senior engineers.\n\nRequirements: PHP, MySQL, basic Git workflow, willingness to learn our internal MVC framework.",
    "salary" => "৳30,000-40,000",
    "deadline" => "2026-09-05",
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerLink - Job Details</title>
    <link rel="stylesheet" href="css/jobseekershared.css">
    <link rel="stylesheet" href="css/jobseekerjobdetails.css">
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
                <a href="jobseekerdashboard.php">Dashboard</a>
                <a href="jobseekerbrowsejobs.php" class="active">Browse Jobs</a>
                <a href="jobseekermyapplications.php">My Applications</a>
                <a href="jobseekerprofile.php">Profile</a>
            </div>

            <div class="profile">
                <div class="avatar"><?php echo htmlspecialchars($initials); ?></div>
                <span class="user-name"><?php echo htmlspecialchars($fullName); ?></span>
                <a href="../logout.php" style="font-size:12px;color:#718078;text-decoration:none;margin-left:8px;">Logout</a>
            </div>

        </div>


        <!-- Main Content -->
        <div class="main">

            <a href="jobseekerbrowsejobs.php" class="back-link">&larr; Back to Jobs</a>

            <div class="details-layout">

                <!-- Job Details -->
                <div class="job-details">

                    <span class="tag"><?php echo htmlspecialchars($job["category"]); ?></span>

                    <h1 class="job-title-heading"><?php echo htmlspecialchars($job["title"]); ?></h1>
                    <div class="job-subinfo">
                        <?php echo htmlspecialchars($job["company_name"]); ?> &middot;
                        <?php echo htmlspecialchars($job["location"]); ?> &middot;
                        Posted <?php echo date("M d", strtotime($job["posted_date"])); ?>
                    </div>

                    <h3 class="section-heading">Description</h3>
                    <p class="section-text"><?php echo nl2br(htmlspecialchars($job["description"])); ?></p>

                </div>

                <!-- Apply Box -->
                <div class="apply-box">

                    <h3 class="apply-heading">Apply for this job</h3>

                    <?php if ($alreadyApplied): ?>
                        <p class="section-text">You've already applied for this job. Check <a href="jobseekermyapplications.php">My Applications</a> for status updates.</p>
                    <?php else: ?>
                        <form method="POST">
                            <label class="field-label">Resume / CV</label>
                            <input type="file" name="resume" class="file-input" accept=".pdf,.doc,.docx">
                            <p class="section-text" style="margin:-10px 0 15px; font-size:12px;">
                                (Your saved resume from Profile will be used; this uploader is for a future update.)
                            </p>

                            <button type="submit" class="submit-btn">Submit Application</button>
                        </form>
                    <?php endif; ?>

                    <div class="apply-meta">
                        Salary: <?php echo htmlspecialchars($job["salary"]); ?><br>
                        Deadline: <?php echo date("M d, Y", strtotime($job["deadline"])); ?>
                    </div>

                </div>

            </div>

        </div>

    </div>

</body>
</html>
