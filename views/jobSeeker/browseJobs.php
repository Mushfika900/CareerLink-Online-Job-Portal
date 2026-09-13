<!-- Rendered by controllers/jobSeekerControls.php?page=browseJobs
     Expects: $name, $initials, $jobs, $keyword, $category, $location -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CareerLink - Browse Jobs</title>

    <link rel="stylesheet" href="../views/jobSeeker/css/shared.css">
    <link rel="stylesheet" href="../views/jobSeeker/css/browseJobs.css">
</head>

<body>

<div class="container">

    <div class="navbar">

        <div class="logo">
            <span class="logo-circle"></span>
            CareerLink
        </div>

        <div class="nav-links">
            <a href="jobSeekerControls.php?page=dashboard">Dashboard</a>
            <a href="jobSeekerControls.php?page=browseJobs" class="active">Browse Jobs</a>
            <a href="jobSeekerControls.php?page=myApplications">My Applications</a>
            <a href="jobSeekerControls.php?page=profile">Profile</a>
        </div>

        <div class="profile">

            <div class="avatar">
                <?php echo htmlspecialchars($initials); ?>
            </div>

            <span class="user-name">
                <?php echo htmlspecialchars($name); ?>
            </span>

            <a href="../views/logout.php">
                Logout
            </a>

        </div>

    </div>


    <div class="main">

        <form class="search-bar" method="GET" action="jobSeekerControls.php">

            <input type="hidden" name="page" value="browseJobs">

            <input
                type="text"
                name="keyword"
                class="search-input"
                placeholder="Search job title or keyword..."
                value="<?php echo htmlspecialchars($keyword); ?>"
            >


            <select name="category" class="filter-select">

                <option value="">All Categories</option>

                <option value="Web Development"
                    <?php if ($category == "Web Development") echo "selected"; ?>>
                    Web Development
                </option>

                <option value="Networking"
                    <?php if ($category == "Networking") echo "selected"; ?>>
                    Networking
                </option>

            </select>


            <select name="location" class="filter-select">

                <option value="">All Locations</option>

                <option value="Dhaka"
                    <?php if ($location == "Dhaka") echo "selected"; ?>>
                    Dhaka
                </option>

                <option value="Chattogram"
                    <?php if ($location == "Chattogram") echo "selected"; ?>>
                    Chattogram
                </option>

                <option value="Remote"
                    <?php if ($location == "Remote") echo "selected"; ?>>
                    Remote
                </option>

            </select>


            <button type="submit" class="search-btn">
                Search
            </button>

        </form>

        <div class="job-list">

         <?php

            if (empty($jobs)) {

                echo "<p>No jobs found.</p>";

            } else {

                foreach ($jobs as $job) {

            ?>

                    <div class="job-card">

                        <div class="job-marker"></div>

                        <div class="job-info">

                            <div class="job-title">
                                <?php echo htmlspecialchars($job["title"]); ?>
                            </div>

                            <div class="job-meta">

                                <span class="tag">
                                    <?php echo htmlspecialchars($job["category"]); ?>
                                </span>

                                <span>
                                    <?php echo htmlspecialchars($job["company_name"]); ?>
                                </span>

                                <span>
                                    <?php echo htmlspecialchars($job["location"]); ?>
                                </span>

                                <span class="job-salary">
                                    <?php echo htmlspecialchars($job["salary"]); ?>
                                </span>

                            </div>

                        </div>


                        <a
                            href="jobSeekerControls.php?page=jobDetails&id=<?php echo $job["job_id"]; ?>"
                            class="view-details">
                            View Details
                        </a>

                    </div>

            <?php

                }
            }

            ?>

        </div>

    </div>

</div>

</body>
</html>