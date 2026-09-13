<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Statistics - CareerLink</title>

    <link rel="stylesheet" href="../views/admin/css/admin.css">

</head>

<body>
    <?php require_once 'sidebar.php'; ?>

<main class="main-content">

    <header class="topbar">

        <div>

            <h1>Statistics</h1>

            <p>View platform statistics and activity.</p>

        </div>

    </header>


    <section class="dashboard-section">

        <div class="section-header">

            <h2>Platform Overview</h2>

            <p>Current CareerLink platform statistics.</p>

        </div>


        <!-- Main Statistics -->

        <div class="stats-grid">

            <div class="stat-card">

                <h3>Total Users</h3>

                <p>
                    <?php echo $totalUsers; ?>
                </p>

            </div>


            <div class="stat-card">

                <h3>Job Seekers</h3>

                <p>
                    <?php echo $totalJobSeekers; ?>
                </p>

            </div>


            <div class="stat-card">

                <h3>Employers</h3>

                <p>
                    <?php echo $totalEmployers; ?>
                </p>

            </div>


            <div class="stat-card">

                <h3>Total Jobs</h3>

                <p>
                    <?php echo $totalJobs; ?>
                </p>

            </div>


            <div class="stat-card">

                <h3>Total Applications</h3>

                <p>
                    <?php echo $totalApplications; ?>
                </p>

            </div>

        </div>


        <!-- Job Statistics -->

        <div class="section-header">

            <h2>Job Status</h2>

        </div>


        <div class="stats-grid">

            <?php while ($jobStatus = mysqli_fetch_assoc($jobStatusStatistics)) { ?>

                <div class="stat-card">

                    <h3>
                        <?php echo ucfirst($jobStatus['status']); ?> Jobs
                    </h3>

                    <p>
                        <?php echo $jobStatus['total']; ?>
                    </p>

                </div>

            <?php } ?>

        </div>


        <!-- Application Statistics -->

        <div class="section-header">

            <h2>Application Status</h2>

        </div>


        <div class="stats-grid">

            <?php if (mysqli_num_rows($applicationStatusStatistics) > 0) { ?>

                <?php while ($applicationStatus = mysqli_fetch_assoc($applicationStatusStatistics)) { ?>

                    <div class="stat-card">

                        <h3>
                            <?php echo ucfirst($applicationStatus['status']); ?> Applications
                        </h3>

                        <p>
                            <?php echo $applicationStatus['total']; ?>
                        </p>

                    </div>

                <?php } ?>

            <?php } else { ?>

                <p>
                    No applications available.
                </p>

            <?php } ?>

        </div>

    </section>

</main>

</body>

</html>