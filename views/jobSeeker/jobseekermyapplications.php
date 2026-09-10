<?php
/*

*/

// STATIC DATA - remove when DB is wired
$initials = "AR";
$fullName = "Arafat Hossain";
$applications = [
    ["title" => "Junior PHP Developer", "company_name" => "Nexbridge Ltd.", "applied_date" => "2026-08-12", "status" => "accepted"],
    ["title" => "Frontend Engineer", "company_name" => "Studio Loom", "applied_date" => "2026-08-15", "status" => "pending"],
    ["title" => "Network Support Intern", "company_name" => "ConnectIT", "applied_date" => "2026-08-09", "status" => "rejected"],
    ["title" => "QA Tester", "company_name" => "PixelWorks", "applied_date" => "2026-08-18", "status" => "pending"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerLink - My Applications</title>
    <link rel="stylesheet" href="css/jobseekershared.css">
    <link rel="stylesheet" href="css/jobseekermyapplications.css">
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
                <a href="jobseekermyapplications.php" class="active">My Applications</a>
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

            <h1 class="page-title">My Applications</h1>

            <table>
                <tr>
                    <th>JOB TITLE</th>
                    <th>COMPANY</th>
                    <th>APPLIED DATE</th>
                    <th>STATUS</th>
                </tr>

                <?php if (empty($applications)): ?>
                    <tr>
                        <td colspan="4">You haven't applied to any jobs yet.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($applications as $app): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($app["title"]); ?></td>
                            <td><?php echo htmlspecialchars($app["company_name"]); ?></td>
                            <td><?php echo date("M d, Y", strtotime($app["applied_date"])); ?></td>
                            <td><span class="status <?php echo $app["status"]; ?>-status"><?php echo ucfirst($app["status"]); ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>

        </div>

    </div>

</body>
</html>
