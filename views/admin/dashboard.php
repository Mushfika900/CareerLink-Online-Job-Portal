
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard - CareerLink</title>

    <link rel="stylesheet" href="../views/admin/css/admin.css">

</head>

<body>

<?php require_once 'sidebar.php'; ?>


    <main class="main-content">

        <header class="topbar">

            <div>
                <h1>Admin Dashboard</h1>
                <p>Welcome back, Admin.</p>
            </div>

            <div class="admin-profile">
                Admin
            </div>

        </header>


        <section class="stats-grid">

            <div class="stat-card">

                <p class="stat-title">Total Users</p>

                <h2><?php echo $totalUsers; ?></h2>

                <span>Registered users</span>

            </div>


            <div class="stat-card">

                <p class="stat-title">Job Seekers</p>

                <h2><?php echo $totalJobSeekers; ?></h2>

                <span>Registered job seekers</span>

            </div>


            <div class="stat-card">

                <p class="stat-title">Employers</p>

                <h2><?php echo $totalEmployers; ?></h2>

                <span>Registered employers</span>

            </div>


            <div class="stat-card">

                <p class="stat-title">Total Jobs</p>

                <h2><?php echo $totalJobs; ?></h2>

                <span>Posted jobs</span>

            </div>

        </section>


        <section class="dashboard-section">
            

            <div class="section-header">

                <div>
                    <h2>Quick Management</h2>
                    <p>Manage the CareerLink platform.</p>
                </div>

            </div>


            <div class="quick-actions">

                <a href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=users" class="action-card">

                    <h3>Manage Users</h3>

                    <p>
                        View and manage registered job seekers and employers.
                    </p>

                </a>


                <a href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=jobs"class="action-card">

                    <h3>Manage Jobs</h3>

                    <p>
                        Monitor and manage job postings on the platform.
                    </p>

                </a>


                <a href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=statistics" class="action-card">

                    <h3>View Statistics</h3>

                    <p>
                        View overall CareerLink platform statistics.
                    </p>

                </a>

            </div>

        </section>

    </main>

</body>
</html>