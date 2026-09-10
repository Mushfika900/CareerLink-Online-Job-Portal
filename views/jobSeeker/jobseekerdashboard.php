<?php
/*

*/

// STATIC DATA - remove when DB is wired
$firstName = "Arafat";
$fullName = "Arafat Hossain";
$initials = "AR";
$stats = ["Total" => 12, "pending" => 5, "accepted" => 4, "rejected" => 3];
$recentApplications = [
    ["title" => "Junior PHP Developer", "company_name" => "Nexbridge Ltd.", "applied_date" => "2026-08-12", "status" => "accepted"],
    ["title" => "Frontend Engineer", "company_name" => "Studio Loom", "applied_date" => "2026-08-15", "status" => "pending"],
    ["title" => "Network Support Intern", "company_name" => "ConnectIT", "applied_date" => "2026-08-09", "status" => "rejected"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerLink - Dashboard</title>
    <link rel="stylesheet" href="css/jobseekershared.css">
    <link rel="stylesheet" href="css/jobseekerdashboard.css">
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
                <a href="jobseekerdashboard.php" class="active">Dashboard</a>
                <a href="jobseekerbrowsejobs.php">Browse Jobs</a>
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

            <!-- Welcome -->
            <div class="welcome">
                <h1>Welcome back, <?php echo htmlspecialchars($firstName); ?></h1>
                <p>Here's where your applications stand.</p>
            </div>

            <!-- Statistics -->
            <div class="stats">

                <div class="stat-box">
                    <div class="number"><?php echo $stats["Total"]; ?></div>
                    <div class="label">Total Applications</div>
                </div>

                <div class="stat-box pending">
                    <div class="number"><?php echo $stats["pending"]; ?></div>
                    <div class="label">Pending</div>
                </div>

                <div class="stat-box accepted">
                    <div class="number"><?php echo $stats["accepted"]; ?></div>
                    <div class="label">Accepted</div>
                </div>

                <div class="stat-box rejected">
                    <div class="number"><?php echo $stats["rejected"]; ?></div>
                    <div class="label">Rejected</div>
                </div>

            </div>

            <!-- Recent Applications -->
            <div class="recent">

                <div class="recent-header">
                    <h2>Recent Applications</h2>
                    <a href="jobseekermyapplications.php" class="view-btn">View all</a>
                </div>

                <table>
                    <tr>
                        <th>JOB TITLE</th>
                        <th>COMPANY</th>
                        <th>APPLIED</th>
                        <th>STATUS</th>
                    </tr>

                    <?php foreach ($recentApplications as $app): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($app["title"]); ?></td>
                            <td><?php echo htmlspecialchars($app["company_name"]); ?></td>
                            <td><?php echo date("M d", strtotime($app["applied_date"])); ?></td>
                            <td><span class="status <?php echo $app["status"]; ?>-status"><?php echo ucfirst($app["status"]); ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            </div>

        </div>

    </div>

</body>
</html>
