<?php

// STATIC DATA - remove when DB is wired (this is what employer-posted jobs will look like)
$initials = "AR";
$fullName = "Arafat Hossain";
$jobs = [
    ["job_id" => 1, "title" => "Junior PHP Developer", "category" => "Web Development", "company_name" => "Nexbridge Ltd.", "location" => "Dhaka", "salary" => "৳30,000-40,000"],
    ["job_id" => 2, "title" => "Frontend Engineer (React)", "category" => "Web Development", "company_name" => "Studio Loom", "location" => "Remote", "salary" => "৳45,000-60,000"],
    ["job_id" => 3, "title" => "Network Support Intern", "category" => "Networking", "company_name" => "ConnectIT", "location" => "Chattogram", "salary" => "৳15,000"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerLink - Browse Jobs</title>
    <link rel="stylesheet" href="css/jobseekershared.css">
    <link rel="stylesheet" href="css/jobseekerbrowsejobs.css">
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

            <!-- Search Bar -->
            <form class="search-bar" method="GET">
                <input type="text" name="keyword" class="search-input" placeholder="Search job title or keyword...">
                <select name="category" class="filter-select">
                    <option>All Categories</option>
                    <option>Web Development</option>
                    <option>Networking</option>
                </select>
                <select name="location" class="filter-select">
                    <option>All Locations</option>
                    <option>Dhaka</option>
                    <option>Chattogram</option>
                    <option>Remote</option>
                </select>
                <button type="submit" class="search-btn">Search</button>
            </form>

            <!-- Job List -->
            <div class="job-list">

                <?php if (empty($jobs)): ?>
                    <p>No jobs found.</p>
                <?php else: ?>
                    <?php foreach ($jobs as $job): ?>
                        <div class="job-card">
                            <div class="job-marker"></div>
                            <div class="job-info">
                                <div class="job-title"><?php echo htmlspecialchars($job["title"]); ?></div>
                                <div class="job-meta">
                                    <span class="tag"><?php echo htmlspecialchars($job["category"]); ?></span>
                                    <span><?php echo htmlspecialchars($job["company_name"]); ?></span>
                                    <span><?php echo htmlspecialchars($job["location"]); ?></span>
                                    <span class="job-salary"><?php echo htmlspecialchars($job["salary"]); ?></span>
                                </div>
                            </div>
                            <a href="jobseekerjobdetails.php?id=<?php echo $job["job_id"]; ?>" class="view-details">View Details</a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>

        </div>

    </div>

</body>
</html>
