<?php
/*

*/

// STATIC DATA - remove when DB is wired
$initials = "AR";
$seeker = [
    "name" => "Arafat Hossain",
    "email" => "arafat@example.com",
    "phone" => "01XXXXXXXXX",
    "education" => "BSc in Computer Science, AIUB (2023-present)",
    "experience" => "6-month intern, local web agency",
    "skills" => "PHP, MySQL, JavaScript, HTML, CSS",
    "resume_file" => null,
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerLink - Profile</title>
    <link rel="stylesheet" href="css/jobseekershared.css">
    <link rel="stylesheet" href="css/jobseekerprofile.css">
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
                <a href="jobseekerbrowsejobs.php">Browse Jobs</a>
                <a href="jobseekermyapplications.php">My Applications</a>
                <a href="jobseekerprofile.php" class="active">Profile</a>
            </div>

            <div class="profile">
                <div class="avatar"><?php echo htmlspecialchars($initials); ?></div>
                <span class="user-name"><?php echo htmlspecialchars($seeker["name"]); ?></span>
                <a href="../logout.php" style="font-size:12px;color:#718078;text-decoration:none;margin-left:8px;">Logout</a>
            </div>

        </div>


        <!-- Main Content -->
        <div class="main">

            <a href="jobseekerdashboard.php" class="back-link">&larr; Back to Dashboard</a>

            <div class="profile-layout">

                <!-- Profile Form -->
                <form class="profile-form" method="POST">
                    <input type="hidden" name="action" value="update_profile">

                    <div class="field-group">
                        <label class="field-label">Full Name</label>
                        <input type="text" name="name" class="field-input" value="<?php echo htmlspecialchars($seeker["name"]); ?>" required>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Email</label>
                        <input type="email" class="field-input" value="<?php echo htmlspecialchars($seeker["email"]); ?>" disabled>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Phone</label>
                        <input type="text" name="phone" class="field-input" value="<?php echo htmlspecialchars($seeker["phone"] ?? ""); ?>" placeholder="Enter your phone number">
                    </div>

                    <div class="field-group">
                        <label class="field-label">Education</label>
                        <textarea name="education" class="field-textarea" placeholder="Your education background"><?php echo htmlspecialchars($seeker["education"] ?? ""); ?></textarea>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Experience</label>
                        <textarea name="experience" class="field-textarea" placeholder="Your work experience"><?php echo htmlspecialchars($seeker["experience"] ?? ""); ?></textarea>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Skills</label>
                        <input type="text" name="skills" class="field-input" value="<?php echo htmlspecialchars($seeker["skills"] ?? ""); ?>" placeholder="e.g. PHP, MySQL, JavaScript">
                    </div>

                    <button type="submit" class="save-btn">Save Changes</button>

                </form>

                <!-- Resume + Danger Zone -->
                <div class="side-box">

                    <h3 class="side-heading">Resume</h3>
                    <?php if (!empty($seeker["resume_file"])): ?>
                        <p class="side-text">Current: <a href="../../<?php echo htmlspecialchars($seeker["resume_file"]); ?>" target="_blank"><?php echo basename($seeker["resume_file"]); ?></a></p>
                    <?php else: ?>
                        <p class="side-text">No resume uploaded yet.</p>
                    <?php endif; ?>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="upload_resume">
                        <input type="file" name="resume" class="file-input" accept=".pdf,.doc,.docx" required>
                        <button type="submit" class="side-btn">Upload</button>
                    </form>

                    <h3 class="danger-heading">Danger Zone</h3>
                    <p class="side-text">Permanently delete your account and all application history.</p>
                    <form method="POST" onsubmit="return confirm('Are you sure? This cannot be undone.');">
                        <input type="hidden" name="action" value="delete_account">
                        <button type="submit" class="delete-btn">Delete Account</button>
                    </form>

                </div>

            </div>

        </div>

    </div>

</body>
</html>
